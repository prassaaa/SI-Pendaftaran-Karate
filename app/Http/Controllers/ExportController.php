<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Pembayaran;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PesertaExport;
use App\Exports\PembayaranExport;
use PDF;

class ExportController extends Controller
{
    public function pesertaExcel(Request $request)
    {
        $filename = 'Data_Peserta_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new PesertaExport($request->all()), $filename);
    }

    public function pesertaPdf(Request $request)
    {
        $query = Peserta::with(['ranting', 'kategoriUsia']);

        // Apply filters (sama seperti di PesertaController)
        if ($request->status_pendaftaran) {
            $query->where('status_pendaftaran', $request->status_pendaftaran);
        }

        if ($request->status_bayar) {
            $query->where('status_bayar', $request->status_bayar);
        }

        if ($request->ranting_id) {
            $query->where('ranting_id', $request->ranting_id);
        }

        $peserta = $query->get();

        $pdf = PDF::loadView('exports.peserta-pdf', compact('peserta'));
        $pdf->setPaper('a4', 'landscape');

        $filename = 'Data_Peserta_' . date('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($filename);
    }

    public function pembayaranExcel(Request $request)
    {
        $filename = 'Data_Pembayaran_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new PembayaranExport($request->all()), $filename);
    }

    public function laporanKeuangan(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->endOfMonth()->format('Y-m-d');

        // Data pembayaran dalam periode
        $pembayaran = Pembayaran::with(['peserta.ranting'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Statistik
        $stats = [
            'total_pendaftaran' => $pembayaran->count(),
            'total_revenue' => $pembayaran->where('status_bayar', 'paid')->sum('jumlah_bayar'),
            'pending_revenue' => $pembayaran->where('status_bayar', 'pending')->sum('jumlah_bayar'),
            'failed_count' => $pembayaran->where('status_bayar', 'failed')->count(),
        ];

        // Group by metode pembayaran
        $byMetode = $pembayaran->groupBy('metode_pembayaran')->map(function($group) {
            return [
                'count' => $group->count(),
                'paid_count' => $group->where('status_bayar', 'paid')->count(),
                'pending_count' => $group->where('status_bayar', 'pending')->count(),
                'total_amount' => $group->where('status_bayar', 'paid')->sum('jumlah_bayar'),
            ];
        });

        // Group by ranting
        $byRanting = $pembayaran->groupBy('peserta.ranting.nama_ranting')->map(function($group) {
            return [
                'count' => $group->count(),
                'total_amount' => $group->where('status_bayar', 'paid')->sum('jumlah_bayar'),
            ];
        });

        $pdf = PDF::loadView('exports.laporan-keuangan', compact(
            'pembayaran', 'stats', 'byMetode', 'byRanting', 'startDate', 'endDate'
        ));

        $filename = 'Laporan_Keuangan_' . $startDate . '_to_' . $endDate . '.pdf';

        return $pdf->download($filename);
    }

    public function sertifikatPeserta($id)
    {
        $peserta = Peserta::with(['ranting', 'kategoriUsia'])->findOrFail($id);

        if ($peserta->status_pendaftaran !== 'approved' || $peserta->status_bayar !== 'paid') {
            return back()->withErrors(['error' => 'Peserta belum memenuhi syarat untuk mencetak sertifikat']);
        }

        $pdf = PDF::loadView('exports.sertifikat', compact('peserta'));
        $pdf->setPaper('a4', 'landscape');

        $filename = 'Sertifikat_' . $peserta->kode_pendaftaran . '.pdf';

        return $pdf->download($filename);
    }

    public function daftarHadir(Request $request)
    {
        $query = Peserta::with(['ranting', 'kategoriUsia'])
            ->where('status_pendaftaran', 'approved')
            ->where('status_bayar', 'paid');

        // Filter by kategori
        if ($request->kategori) {
            switch ($request->kategori) {
                case 'kumite_perorangan':
                    $query->where('kumite_perorangan', true);
                    break;
                case 'kata_perorangan':
                    $query->where('kata_perorangan', true);
                    break;
                case 'kata_beregu':
                    $query->where('kata_beregu', true);
                    break;
                case 'kumite_beregu':
                    $query->where('kumite_beregu', true);
                    break;
            }
        }

        // Filter by ranting
        if ($request->ranting_id) {
            $query->where('ranting_id', $request->ranting_id);
        }

        $peserta = $query->orderBy('nama_lengkap')->get();

        $pdf = PDF::loadView('exports.daftar-hadir', compact('peserta', 'request'));

        $filename = 'Daftar_Hadir_' . ($request->kategori ?? 'Semua') . '_' . date('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}
