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
        // Get all peserta with their age
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
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

        return [
            'total_peserta' => $peserta->count(),
            'avg_age' => round($ages->avg(), 1),
            'min_age' => $ages->min(),
            'max_age' => $ages->max(),
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
            ->get()
            ->map(function ($p) {
                $p->umur_calculated = Carbon::parse($p->tanggal_lahir)->age;
                return $p;
            });

        $clusteringData = $this->performClustering($peserta);
        $statistics = $this->getStatistics($peserta);

        return response()->json([
            'clustering' => $clusteringData,
            'statistics' => $statistics
        ]);
    }
}
