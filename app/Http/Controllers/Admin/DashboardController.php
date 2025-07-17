<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Ranting;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_peserta' => Peserta::count(),
            'peserta_pending' => Peserta::pending()->count(),
            'peserta_approved' => Peserta::approved()->count(),
            'peserta_rejected' => Peserta::rejected()->count(),
            'pembayaran_pending' => Pembayaran::pending()->count(),
            'total_revenue' => Pembayaran::paid()->sum('jumlah_bayar'),
            'pending_revenue' => Pembayaran::pending()->sum('jumlah_bayar'),
        ];

        // Chart data - Pendaftaran per bulan
        $monthlyRegistrations = Peserta::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        // Chart data - Peserta per ranting
        $pesertaPerRanting = Peserta::with('ranting')
            ->select('ranting_id', DB::raw('count(*) as total'))
            ->groupBy('ranting_id')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->map(function($item) {
                return [
                    'ranting' => $item->ranting->nama_ranting,
                    'total' => $item->total
                ];
            });

        // Chart data - Status pembayaran
        $paymentStatus = [
            'unpaid' => Peserta::unpaid()->count(),
            'pending' => Peserta::pendingPayment()->count(),
            'paid' => Peserta::paid()->count(),
        ];

        // Recent activities
        $recentPeserta = Peserta::with(['ranting', 'kategoriUsia'])
            ->latest()
            ->limit(5)
            ->get();

        $pendingPayments = Pembayaran::with(['peserta'])
            ->pending()
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'monthlyRegistrations',
            'pesertaPerRanting',
            'paymentStatus',
            'recentPeserta',
            'pendingPayments'
        ));
    }

    public function getChartData(Request $request)
    {
        $type = $request->get('type');

        switch ($type) {
            case 'monthly':
                $data = Peserta::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', date('Y'))
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
                break;

            case 'category':
                $data = [
                    'kumite_perorangan' => Peserta::where('kumite_perorangan', true)->count(),
                    'kata_perorangan' => Peserta::where('kata_perorangan', true)->count(),
                    'kata_beregu' => Peserta::where('kata_beregu', true)->count(),
                    'kumite_beregu' => Peserta::where('kumite_beregu', true)->count(),
                ];
                break;

            case 'payment':
                $data = [
                    'unpaid' => Peserta::unpaid()->count(),
                    'pending' => Peserta::pendingPayment()->count(),
                    'paid' => Peserta::paid()->count(),
                ];
                break;

            default:
                $data = [];
        }

        return response()->json($data);
    }
}
