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
    public function pesertaExcel()
    {
        try {
            $peserta = Peserta::with(['ranting', 'kategoriUsia', 'user'])
                             ->latest()
                             ->get();

            return Excel::download(new PesertaExport($peserta), 'peserta_' . date('Y-m-d') . '.xlsx');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh data peserta: ' . $e->getMessage()]);
        }
    }

    public function pesertaPdf()
    {
        try {
            $peserta = Peserta::with(['ranting', 'kategoriUsia'])
                             ->approved()
                             ->get();

            $pdf = Pdf::loadView('admin.exports.peserta-pdf', compact('peserta'));
            $pdf->setPaper('a4', 'landscape');

            return $pdf->download('daftar_peserta_' . date('Y-m-d') . '.pdf');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh PDF peserta: ' . $e->getMessage()]);
        }
    }

    public function pembayaranExcel()
    {
        try {
            $pembayaran = Pembayaran::with(['peserta.ranting', 'peserta.kategoriUsia'])
                                   ->latest()
                                   ->get();

            return Excel::download(new PembayaranExport($pembayaran), 'pembayaran_' . date('Y-m-d') . '.xlsx');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh data pembayaran: ' . $e->getMessage()]);
        }
    }

    public function laporanKeuangan(Request $request)
    {
        try {
            $startDate = $request->get('start_date', now()->startOfMonth());
            $endDate = $request->get('end_date', now()->endOfMonth());

            $pembayaran = Pembayaran::with(['peserta'])
                                   ->whereBetween('created_at', [$startDate, $endDate])
                                   ->get();

            $pdf = Pdf::loadView('admin.exports.laporan-keuangan', compact('pembayaran', 'startDate', 'endDate'));
            $pdf->setPaper('a4', 'portrait');

            return $pdf->download('laporan_keuangan_' . date('Y-m-d') . '.pdf');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh laporan keuangan: ' . $e->getMessage()]);
        }
    }

    public function sertifikatPeserta($id)
    {
        try {
            $peserta = Peserta::with(['ranting', 'kategoriUsia'])
                             ->findOrFail($id);

            // Cek apakah peserta eligible untuk sertifikat
            if ($peserta->status_pendaftaran !== 'approved' || $peserta->status_bayar !== 'paid') {
                return back()->withErrors(['error' => 'Peserta belum memenuhi syarat untuk mendapatkan sertifikat']);
            }

            $pdf = Pdf::loadView('admin.exports.sertifikat', compact('peserta'));
            $pdf->setPaper('a4', 'landscape');

            $filename = "Sertifikat_{$peserta->nama_lengkap}_{$peserta->kode_pendaftaran}.pdf";

            return $pdf->download($filename);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh sertifikat: ' . $e->getMessage()]);
        }
    }

    public function daftarHadir()
    {
        try {
            $peserta = Peserta::with(['ranting', 'kategoriUsia'])
                             ->approved()
                             ->paid()
                             ->orderBy('nama_lengkap')
                             ->get();

            $pdf = Pdf::loadView('admin.exports.daftar-hadir', compact('peserta'));
            $pdf->setPaper('a4', 'portrait');

            return $pdf->download('daftar_hadir_' . date('Y-m-d') . '.pdf');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh daftar hadir: ' . $e->getMessage()]);
        }
    }

    public function pembayaranDetail($id)
    {
        try {
            $pembayaran = Pembayaran::with(['peserta.ranting', 'peserta.kategoriUsia', 'verifiedBy'])
                                   ->findOrFail($id);

            $pdf = Pdf::loadView('admin.exports.pembayaran-detail', compact('pembayaran'));
            $pdf->setPaper('a4', 'portrait');

            $filename = "Detail_Pembayaran_{$pembayaran->kode_pembayaran}_{$pembayaran->peserta->kode_pendaftaran}.pdf";

            return $pdf->download($filename);

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengunduh detail pembayaran: ' . $e->getMessage()]);
        }
    }
}
