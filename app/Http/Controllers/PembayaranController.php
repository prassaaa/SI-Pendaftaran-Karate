<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Setting;

class PembayaranController extends Controller
{
    public function info()
    {
        $bankAccounts = [
            [
                'bank' => 'BCA',
                'account' => Setting::get('bank_bca_account', '1234567890'),
                'holder' => Setting::get('bank_bca_holder', 'INKAI Kediri'),
            ],
            [
                'bank' => 'Mandiri',
                'account' => Setting::get('bank_mandiri_account', '0987654321'),
                'holder' => Setting::get('bank_mandiri_holder', 'INKAI Kediri'),
            ]
        ];

        $qrisImage = Setting::get('qris_image', asset('images/qris-default.png'));
        $officeInfo = [
            'address' => Setting::get('office_address', 'Jl. Brawijaya No. 123, Kediri'),
            'phone' => Setting::get('office_phone', '0354-123456'),
            'hours' => Setting::get('office_hours', 'Senin-Jumat: 08:00-16:00, Sabtu: 08:00-12:00')
        ];

        return view('pembayaran.info', compact('bankAccounts', 'qrisImage', 'officeInfo'));
    }

    public function checkStatus(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string',
        ]);

        $kode = $validated['kode'];

        // Cari berdasarkan kode pendaftaran atau kode pembayaran
        $pembayaran = Pembayaran::whereHas('peserta', function($query) use ($kode) {
            $query->where('kode_pendaftaran', $kode);
        })->orWhere('kode_pembayaran', $kode)->first();

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Kode tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'kode_pendaftaran' => $pembayaran->peserta->kode_pendaftaran,
                'kode_pembayaran' => $pembayaran->kode_pembayaran,
                'nama_peserta' => $pembayaran->peserta->nama_lengkap,
                'jumlah_bayar' => $pembayaran->formatted_jumlah_bayar,
                'status_bayar' => $pembayaran->status_bayar,
                'status_badge' => $pembayaran->status_badge,
                'metode_pembayaran' => $pembayaran->metode_pembayaran_formatted,
                'tanggal_bayar' => $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d/m/Y H:i') : null,
                'verified_at' => $pembayaran->verified_at ? $pembayaran->verified_at->format('d/m/Y H:i') : null,
                'verified_by' => $pembayaran->verifiedBy ? $pembayaran->verifiedBy->name : null,
            ]
        ]);
    }

    public function webhook(Request $request)
    {
        // Implementasi webhook untuk payment gateway jika diperlukan
        // Contoh: notifikasi dari payment gateway untuk auto-verify

        $validated = $request->validate([
            'order_id' => 'required|string',
            'status_code' => 'required|string',
            'transaction_status' => 'required|string',
            'signature_key' => 'required|string',
        ]);

        // Verifikasi signature key (implementasi sesuai payment gateway)

        $pembayaran = Pembayaran::where('kode_pembayaran', $validated['order_id'])->first();

        if (!$pembayaran) {
            return response()->json(['status' => 'failed', 'message' => 'Order not found']);
        }

        if ($validated['transaction_status'] === 'settlement' && $validated['status_code'] === '200') {
            // Payment berhasil
            $pembayaran->markAsVerified(1); // System auto-verify

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'pending']);
    }
}
