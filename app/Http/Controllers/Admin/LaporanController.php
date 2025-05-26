<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Pembayaran;
use App\Models\Ranting;
use App\Models\KategoriUsia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function peserta(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        // Statistics
        $stats = [
            'total_peserta' => Peserta::whereBetween('created_at', [$startDate, $endDate])->count(),
            'peserta_approved' => Peserta::approved()->whereBetween('created_at', [$startDate, $endDate])->count(),
            'peserta_pending' => Peserta::pending()->whereBetween('created_at', [$startDate, $endDate])->count(),
            'peserta_rejected' => Peserta::rejected()->whereBetween('created_at', [$startDate, $endDate])->count(),
        ];

        // Data per ranting
        $pesertaPerRanting = Peserta::with('ranting')
            ->select('ranting_id', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('ranting_id')
            ->orderByDesc('total')
            ->get();

        // Data per kategori usia
        $pesertaPerKategori = Peserta::with('kategoriUsia')
            ->select('kategori_usia_id', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('kategori_usia_id')
            ->orderByDesc('total')
            ->get();

        // Data per jenis kelamin
        $pesertaPerGender = Peserta::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('jenis_kelamin')
            ->get();

        // Data kategori pertandingan
        $kategoriStats = [
            'kumite_perorangan' => Peserta::where('kumite_perorangan', true)
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'kata_perorangan' => Peserta::where('kata_perorangan', true)
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'kata_beregu' => Peserta::where('kata_beregu', true)
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'kumite_beregu' => Peserta::where('kumite_beregu', true)
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
        ];

        // Trend pendaftaran harian
        $trendHarian = Peserta::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.laporan.peserta', compact(
            'stats', 'pesertaPerRanting', 'pesertaPerKategori',
            'pesertaPerGender', 'kategoriStats', 'trendHarian',
            'startDate', 'endDate'
        ));
    }

    public function pembayaran(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        // Statistics
        $stats = [
            'total_pembayaran' => Pembayaran::whereBetween('created_at', [$startDate, $endDate])->count(),
            'pembayaran_lunas' => Pembayaran::paid()->whereBetween('created_at', [$startDate, $endDate])->count(),
            'pembayaran_pending' => Pembayaran::pending()->whereBetween('created_at', [$startDate, $endDate])->count(),
            'pembayaran_gagal' => Pembayaran::where('status_bayar', 'failed')
                ->whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_revenue' => Pembayaran::paid()->whereBetween('created_at', [$startDate, $endDate])->sum('jumlah_bayar'),
            'pending_revenue' => Pembayaran::pending()->whereBetween('created_at', [$startDate, $endDate])->sum('jumlah_bayar'),
        ];

        // Data per metode pembayaran
        $pembayaranPerMetode = Pembayaran::select('metode_pembayaran', 'status_bayar', DB::raw('count(*) as total'), DB::raw('sum(jumlah_bayar) as amount'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('metode_pembayaran', 'status_bayar')
            ->get()
            ->groupBy('metode_pembayaran');

        // Trend pembayaran harian
        $trendPembayaran = Pembayaran::selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(jumlah_bayar) as amount')
            ->where('status_bayar', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top 10 ranting dengan pembayaran terbanyak
        $topRanting = DB::table('pembayaran')
            ->join('peserta', 'pembayaran.peserta_id', '=', 'peserta.id')
            ->join('ranting', 'peserta.ranting_id', '=', 'ranting.id')
            ->select('ranting.nama_ranting',
                    DB::raw('COUNT(*) as total_payments'),
                    DB::raw('SUM(pembayaran.jumlah_bayar) as total_amount'))
            ->where('pembayaran.status_bayar', 'paid')
            ->whereBetween('pembayaran.created_at', [$startDate, $endDate])
            ->groupBy('ranting.id', 'ranting.nama_ranting')
            ->orderByDesc('total_amount')
            ->limit(10)
            ->get();

        return view('admin.laporan.pembayaran', compact(
            'stats', 'pembayaranPerMetode', 'trendPembayaran',
            'topRanting', 'startDate', 'endDate'
        ));
    }

    public function keuangan(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        // Revenue statistics
        $revenueStats = [
            'total_revenue' => Pembayaran::paid()->whereBetween('verified_at', [$startDate, $endDate])->sum('jumlah_bayar'),
            'pending_revenue' => Pembayaran::pending()->whereBetween('created_at', [$startDate, $endDate])->sum('jumlah_bayar'),
            'this_month' => Pembayaran::paid()->whereMonth('verified_at', now()->month)->sum('jumlah_bayar'),
            'last_month' => Pembayaran::paid()->whereMonth('verified_at', now()->subMonth()->month)->sum('jumlah_bayar'),
        ];

        // Revenue per kategori
        $revenuePerKategori = [
            'kumite_perorangan' => Pembayaran::paid()
                ->whereHas('peserta', fn($q) => $q->where('kumite_perorangan', true))
                ->whereBetween('verified_at', [$startDate, $endDate])
                ->count() * 50000,
            'kata_perorangan' => Pembayaran::paid()
                ->whereHas('peserta', fn($q) => $q->where('kata_perorangan', true))
                ->whereBetween('verified_at', [$startDate, $endDate])
                ->count() * 40000,
            'kata_beregu' => Pembayaran::paid()
                ->whereHas('peserta', fn($q) => $q->where('kata_beregu', true))
                ->whereBetween('verified_at', [$startDate, $endDate])
                ->count() * 75000,
            'kumite_beregu' => Pembayaran::paid()
                ->whereHas('peserta', fn($q) => $q->where('kumite_beregu', true))
                ->whereBetween('verified_at', [$startDate, $endDate])
                ->count() * 75000,
        ];

        // Monthly revenue trend (12 months)
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthlyRevenue[] = [
                'month' => $month->format('M Y'),
                'revenue' => Pembayaran::paid()
                    ->whereYear('verified_at', $month->year)
                    ->whereMonth('verified_at', $month->month)
                    ->sum('jumlah_bayar')
            ];
        }

        // Daily revenue in selected period
        $dailyRevenue = Pembayaran::selectRaw('DATE(verified_at) as date, SUM(jumlah_bayar) as revenue')
            ->where('status_bayar', 'paid')
            ->whereBetween('verified_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.laporan.keuangan', compact(
            'revenueStats', 'revenuePerKategori', 'monthlyRevenue',
            'dailyRevenue', 'startDate', 'endDate'
        ));
    }

    public function statistik()
    {
        // General statistics
        $generalStats = [
            'total_peserta' => Peserta::count(),
            'total_ranting' => Ranting::count(),
            'total_kategori' => KategoriUsia::count(),
            'total_revenue' => Pembayaran::paid()->sum('jumlah_bayar'),
            'avg_age' => $this->calculateAverageAge(),
            'conversion_rate' => Peserta::count() > 0 ? round((Peserta::paid()->count() / Peserta::count()) * 100, 1) : 0,
        ];

        // Registration trend (last 6 months)
        $registrationTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $registrationTrend[] = [
                'month' => $month->format('M Y'),
                'count' => Peserta::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            ];
        }

        // Age distribution
        $ageDistribution = KategoriUsia::withCount('peserta')->get();

        // Gender distribution
        $genderDistribution = Peserta::select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get();

        // Top performing ranting
        $topRanting = Ranting::withCount(['peserta' => function($query) {
                $query->where('status_pendaftaran', 'approved');
            }])
            ->having('peserta_count', '>', 0)
            ->orderByDesc('peserta_count')
            ->limit(10)
            ->get();

        // Payment method distribution
        $paymentMethods = Pembayaran::select('metode_pembayaran', DB::raw('count(*) as total'))
            ->groupBy('metode_pembayaran')
            ->get();

        // Status distribution
        $statusDistribution = [
            'pendaftaran' => Peserta::select('status_pendaftaran', DB::raw('count(*) as total'))
                ->groupBy('status_pendaftaran')->get(),
            'pembayaran' => Peserta::select('status_bayar', DB::raw('count(*) as total'))
                ->groupBy('status_bayar')->get(),
        ];

        return view('admin.laporan.statistik', compact(
            'generalStats', 'registrationTrend', 'ageDistribution',
            'genderDistribution', 'topRanting', 'paymentMethods',             'statusDistribution'
        ));
    }

    /**
     * Calculate average age using Carbon
     */
    private function calculateAverageAge()
    {
        $peserta = Peserta::select('tanggal_lahir')->get();

        if ($peserta->isEmpty()) {
            return 0;
        }

        $totalAge = $peserta->sum(function($item) {
            return Carbon::parse($item->tanggal_lahir)->age;
        });

        return round($totalAge / $peserta->count(), 1);
    }
}
