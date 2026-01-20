<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClusteringExport;
use PDF;

class ClusteringController extends Controller
{
    /**
     * Display clustering analysis based on age
     */
    public function index(Request $request)
    {
        // Get all peserta with their age and weight data
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->whereNotNull('berat_badan')
            ->where('berat_badan', '>', 0)
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        // Perform clustering analysis
        $clusteringData = $this->performClustering($peserta);

        // Get statistics
        $statistics = $this->getStatistics($peserta);

        return view('admin.clustering.index', compact('clusteringData', 'statistics', 'peserta'));
    }

    /**
     * Perform K-Means clustering on age data
     */
    private function performClustering($peserta)
    {
        if ($peserta->isEmpty()) {
            return [
                'clusters' => [],
                'method' => 'none',
                'summary' => 'Tidak ada data peserta untuk dianalisis'
            ];
        }

        // Extract ages
        $ages = $peserta->pluck('umur_calculated')->toArray();

        // Define age ranges for clustering (more intuitive approach)
        $clusters = [
            'Anak-anak' => ['min' => 0, 'max' => 12, 'color' => '#10B981', 'peserta' => []],
            'Remaja' => ['min' => 13, 'max' => 17, 'color' => '#3B82F6', 'peserta' => []],
            'Dewasa Muda' => ['min' => 18, 'max' => 25, 'color' => '#8B5CF6', 'peserta' => []],
            'Dewasa' => ['min' => 26, 'max' => 35, 'color' => '#F59E0B', 'peserta' => []],
            'Master' => ['min' => 36, 'max' => 100, 'color' => '#EF4444', 'peserta' => []]
        ];

        // Assign peserta to clusters
        foreach ($peserta as $p) {
            $age = $p->umur_calculated;
            foreach ($clusters as $clusterName => &$cluster) {
                if ($age >= $cluster['min'] && $age <= $cluster['max']) {
                    $cluster['peserta'][] = $p;
                    break;
                }
            }
        }

        // Calculate cluster statistics
        foreach ($clusters as $name => &$cluster) {
            $cluster['count'] = count($cluster['peserta']);
            $cluster['percentage'] = $peserta->count() > 0 ? round(($cluster['count'] / $peserta->count()) * 100, 1) : 0;

            if ($cluster['count'] > 0) {
                $ages = collect($cluster['peserta'])->pluck('umur_calculated');
                $cluster['avg_age'] = round($ages->avg(), 1);
                $cluster['min_age'] = $ages->min();
                $cluster['max_age'] = $ages->max();
            } else {
                $cluster['avg_age'] = 0;
                $cluster['min_age'] = 0;
                $cluster['max_age'] = 0;
            }
        }

        return [
            'clusters' => $clusters,
            'method' => 'age_range',
            'summary' => 'Clustering berdasarkan rentang usia standar karate'
        ];
    }

    /**
     * Get general statistics
     */
    private function getStatistics($peserta)
    {
        if ($peserta->isEmpty()) {
            return [
                'total_peserta' => 0,
                'avg_age' => 0,
                'min_age' => 0,
                'max_age' => 0,
                'age_distribution' => []
            ];
        }

        $ages = $peserta->pluck('umur_calculated');

        // Age distribution by year
        $ageDistribution = [];
        for ($age = $ages->min(); $age <= $ages->max(); $age++) {
            $count = $ages->filter(function($a) use ($age) {
                return $a == $age;
            })->count();

            if ($count > 0) {
                $ageDistribution[] = [
                    'age' => $age,
                    'count' => $count
                ];
            }
        }

        // Weight statistics
        $weights = $peserta->pluck('berat_badan');

        return [
            'total_peserta' => $peserta->count(),
            'avg_age' => round($ages->avg(), 1),
            'min_age' => $ages->min(),
            'max_age' => $ages->max(),
            'avg_weight' => $weights->count() > 0 ? round($weights->avg(), 1) : 0,
            'min_weight' => $weights->count() > 0 ? $weights->min() : 0,
            'max_weight' => $weights->count() > 0 ? $weights->max() : 0,
            'age_distribution' => $ageDistribution
        ];
    }

    /**
     * Export clustering data
     */
    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');

        // Get clustering data
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->whereNotNull('berat_badan')
            ->where('berat_badan', '>', 0)
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        $clusteringData = $this->performClustering($peserta);

        if ($format === 'excel') {
            return $this->exportToExcel($clusteringData);
        } elseif ($format === 'pdf') {
            return $this->exportToPdf($clusteringData);
        }

        return back()->with('error', 'Format export tidak didukung');
    }

    /**
     * Export to Excel
     */
    private function exportToExcel($clusteringData)
    {
        try {
            $statistics = $this->getStatistics(collect($clusteringData['clusters'])->flatMap(function($cluster) {
                return collect($cluster['peserta'])->map(function($p) {
                    $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                    return $p;
                });
            }));

            $filename = 'clustering_umur_peserta_' . date('Y-m-d_H-i-s') . '.xlsx';

            return Excel::download(new ClusteringExport($clusteringData, $statistics), $filename);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengexport ke Excel: ' . $e->getMessage()]);
        }
    }

    /**
     * Export to PDF
     */
    private function exportToPdf($clusteringData)
    {
        try {
            $statistics = $this->getStatistics(collect($clusteringData['clusters'])->flatMap(function($cluster) {
                return collect($cluster['peserta'])->map(function($p) {
                    $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                    return $p;
                });
            }));

            $pdf = PDF::loadView('admin.exports.clustering-pdf', compact('clusteringData', 'statistics'));
            $pdf->setPaper('a4', 'portrait');

            $filename = 'clustering_umur_peserta_' . date('Y-m-d_H-i-s') . '.pdf';

            return $pdf->download($filename);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengexport ke PDF: ' . $e->getMessage()]);
        }
    }

    /**
     * Get clustering data for AJAX requests
     */
    public function getClusteringData(Request $request)
    {
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->whereNotNull('berat_badan')
            ->where('berat_badan', '>', 0)
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        $clusteringData = $this->performClustering($peserta);
        $statistics = $this->getStatistics($peserta);

        return response()->json([
            'clustering' => $clusteringData,
            'statistics' => $statistics,
            'peserta' => $peserta
        ]);
    }

    /**
     * Display weight-based clustering analysis
     */
    public function indexBerat(Request $request)
    {
        // Get all peserta with their weight data
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->whereNotNull('berat_badan')
            ->where('berat_badan', '>', 0)
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        // Perform weight clustering analysis
        $clusteringData = $this->performWeightClustering($peserta);

        // Get weight statistics
        $statistics = $this->getWeightStatistics($peserta);

        return view('admin.clustering.berat', compact('clusteringData', 'statistics', 'peserta'));
    }

    /**
     * Perform clustering based on weight categories
     */
    private function performWeightClustering($peserta)
    {
        if ($peserta->isEmpty()) {
            return [
                'clusters' => [],
                'method' => 'none',
                'summary' => 'Tidak ada data peserta untuk dianalisis'
            ];
        }

        // Define weight ranges for karate competition (in kg)
        $clusters = [
            'Kelas Ringan' => ['min' => 0, 'max' => 45, 'color' => '#10B981', 'peserta' => []],
            'Kelas Menengah Bawah' => ['min' => 45.01, 'max' => 55, 'color' => '#3B82F6', 'peserta' => []],
            'Kelas Menengah' => ['min' => 55.01, 'max' => 65, 'color' => '#8B5CF6', 'peserta' => []],
            'Kelas Menengah Atas' => ['min' => 65.01, 'max' => 75, 'color' => '#F59E0B', 'peserta' => []],
            'Kelas Berat' => ['min' => 75.01, 'max' => 1000, 'color' => '#EF4444', 'peserta' => []]
        ];

        // Assign peserta to weight clusters
        foreach ($peserta as $p) {
            $weight = floatval($p->berat_badan);
            foreach ($clusters as $clusterName => &$cluster) {
                if ($weight >= $cluster['min'] && $weight <= $cluster['max']) {
                    $cluster['peserta'][] = $p;
                    break;
                }
            }
        }

        // Calculate cluster statistics
        foreach ($clusters as $name => &$cluster) {
            $cluster['count'] = count($cluster['peserta']);
            $cluster['percentage'] = $peserta->count() > 0 ? round(($cluster['count'] / $peserta->count()) * 100, 1) : 0;

            if ($cluster['count'] > 0) {
                $weights = collect($cluster['peserta'])->pluck('berat_badan');
                $cluster['avg_weight'] = round($weights->avg(), 1);
                $cluster['min_weight'] = $weights->min();
                $cluster['max_weight'] = $weights->max();
            } else {
                $cluster['avg_weight'] = 0;
                $cluster['min_weight'] = 0;
                $cluster['max_weight'] = 0;
            }
        }

        return [
            'clusters' => $clusters,
            'method' => 'weight_range',
            'summary' => 'Clustering berdasarkan rentang berat badan standar karate'
        ];
    }

    /**
     * Get weight-specific statistics
     */
    private function getWeightStatistics($peserta)
    {
        if ($peserta->isEmpty()) {
            return [
                'total_peserta' => 0,
                'avg_weight' => 0,
                'min_weight' => 0,
                'max_weight' => 0,
                'avg_age' => 0,
                'weight_distribution' => []
            ];
        }

        $weights = $peserta->pluck('berat_badan');
        $ages = $peserta->pluck('umur_calculated');

        // Weight distribution by ranges
        $weightDistribution = [];
        $ranges = [
            '< 40 kg' => [0, 40],
            '40-50 kg' => [40, 50],
            '50-60 kg' => [50, 60],
            '60-70 kg' => [60, 70],
            '70-80 kg' => [70, 80],
            '> 80 kg' => [80, 1000]
        ];

        foreach ($ranges as $label => $range) {
            $count = $weights->filter(function($w) use ($range) {
                return $w >= $range[0] && $w < $range[1];
            })->count();

            if ($count > 0) {
                $weightDistribution[] = [
                    'range' => $label,
                    'count' => $count
                ];
            }
        }

        return [
            'total_peserta' => $peserta->count(),
            'avg_weight' => round($weights->avg(), 1),
            'min_weight' => $weights->min(),
            'max_weight' => $weights->max(),
            'avg_age' => round($ages->avg(), 1),
            'weight_distribution' => $weightDistribution
        ];
    }

    /**
     * Export weight clustering data
     */
    public function exportBerat(Request $request)
    {
        $format = $request->get('format', 'excel');

        // Get clustering data
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->whereNotNull('berat_badan')
            ->where('berat_badan', '>', 0)
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        $clusteringData = $this->performWeightClustering($peserta);

        if ($format === 'excel') {
            return $this->exportWeightToExcel($clusteringData);
        } elseif ($format === 'pdf') {
            return $this->exportWeightToPdf($clusteringData);
        }

        return back()->with('error', 'Format export tidak didukung');
    }

    /**
     * Export weight clustering to Excel
     */
    private function exportWeightToExcel($clusteringData)
    {
        try {
            $statistics = $this->getWeightStatistics(collect($clusteringData['clusters'])->flatMap(function($cluster) {
                return collect($cluster['peserta'])->map(function($p) {
                    $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                    return $p;
                });
            }));

            $filename = 'clustering_berat_peserta_' . date('Y-m-d_H-i-s') . '.xlsx';

            return Excel::download(new \App\Exports\ClusteringBeratExport($clusteringData, $statistics), $filename);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengexport ke Excel: ' . $e->getMessage()]);
        }
    }

    /**
     * Export weight clustering to PDF
     */
    private function exportWeightToPdf($clusteringData)
    {
        try {
            $statistics = $this->getWeightStatistics(collect($clusteringData['clusters'])->flatMap(function($cluster) {
                return collect($cluster['peserta'])->map(function($p) {
                    $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                    return $p;
                });
            }));

            $pdf = PDF::loadView('admin.exports.clustering-berat-pdf', compact('clusteringData', 'statistics'));
            $pdf->setPaper('a4', 'portrait');

            $filename = 'clustering_berat_peserta_' . date('Y-m-d_H-i-s') . '.pdf';

            return $pdf->download($filename);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengexport ke PDF: ' . $e->getMessage()]);
        }
    }

    /**
     * Get weight clustering data for AJAX requests
     */
    public function getClusteringBeratData(Request $request)
    {
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->whereNotNull('berat_badan')
            ->where('berat_badan', '>', 0)
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        $clusteringData = $this->performWeightClustering($peserta);
        $statistics = $this->getWeightStatistics($peserta);

        return response()->json([
            'clustering' => $clusteringData,
            'statistics' => $statistics,
            'peserta' => $peserta
        ]);
    }
}
