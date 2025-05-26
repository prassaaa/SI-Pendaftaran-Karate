<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Pembayaran;
use App\Models\Notification;
use App\Models\Setting;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return redirect()->route('pendaftaran.step1')
                ->with('error', 'Anda belum terdaftar sebagai peserta');
        }

        // Load relationships
        $peserta->load(['ranting', 'kategoriUsia', 'pembayaran' => function($query) {
            $query->latest();
        }]);

        // Get latest pembayaran
        $latestPembayaran = $peserta->pembayaran->first();

        // Get notifications
        $notifications = $user->notifications()
            ->latest()
            ->limit(5)
            ->get();

        // Get unread notifications count
        $unreadCount = $user->notifications()
            ->unread()
            ->count();

        // Get payment deadline
        $paymentDeadline = Setting::get('payment_deadline', '3 hari setelah pendaftaran');

        return view('peserta.dashboard', compact(
            'peserta',
            'latestPembayaran',
            'notifications',
            'unreadCount',
            'paymentDeadline'
        ));
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $validated = $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB
            'metode_pembayaran' => 'required|in:transfer,cash,qris',
            'tanggal_bayar' => 'required|date',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan']);
        }

        try {
            // Upload bukti pembayaran
            if ($request->hasFile('bukti_bayar')) {
                $file = $request->file('bukti_bayar');
                $filename = time() . '_' . $peserta->kode_pendaftaran . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/bukti_bayar', $filename, 'public');
                $validated['bukti_bayar_path'] = $path;
            }

            // Update atau create pembayaran
            $pembayaran = $peserta->latestPembayaran;

            if ($pembayaran && $pembayaran->status_bayar === 'pending') {
                // Update existing
                $pembayaran->update([
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'tanggal_bayar' => $validated['tanggal_bayar'],
                    'bukti_bayar_path' => $validated['bukti_bayar_path'],
                    'keterangan' => $validated['keterangan'] ?? null,
                    'status_bayar' => 'pending',
                ]);
            } else {
                // Create new
                $pembayaran = Pembayaran::create([
                    'peserta_id' => $peserta->id,
                    'kode_pembayaran' => Pembayaran::generateKodePembayaran(),
                    'jumlah_bayar' => $peserta->total_biaya,
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'tanggal_bayar' => $validated['tanggal_bayar'],
                    'bukti_bayar_path' => $validated['bukti_bayar_path'],
                    'keterangan' => $validated['keterangan'] ?? null,
                    'status_bayar' => 'pending',
                    'tanggal_expired' => now()->addDays(7),
                ]);
            }

            // Update status bayar peserta
            $peserta->update(['status_bayar' => 'pending']);

            // Create notification untuk admin
            Notification::create([
                'user_id' => 1, // Assume admin user ID is 1
                'title' => 'Bukti Pembayaran Baru',
                'message' => "Peserta {$peserta->nama_lengkap} ({$peserta->kode_pendaftaran}) telah mengupload bukti pembayaran",
                'type' => 'info',
            ]);

            return back()->with('success', 'Bukti pembayaran berhasil diupload dan sedang diverifikasi');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengupload bukti pembayaran: ' . $e->getMessage()]);
        }
    }

    public function downloadInvoice()
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan']);
        }

        // Load relationships
        $peserta->load(['ranting', 'kategoriUsia']);

        $pdf = \PDF::loadView('peserta.invoice', compact('peserta'));

        return $pdf->download("Invoice_{$peserta->kode_pendaftaran}.pdf");
    }

    public function downloadFormulir()
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan']);
        }

        // Load relationships
        $peserta->load(['ranting', 'kategoriUsia']);

        $pdf = \PDF::loadView('peserta.formulir', compact('peserta'));

        return $pdf->download("Formulir_{$peserta->kode_pendaftaran}.pdf");
    }

    public function markNotificationAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllNotificationsAsRead()
    {
        auth()->user()->notifications()->unread()->update(['read_at' => now()]);

        return back()->with('success', 'Semua notifikasi telah dibaca');
    }

    public function getPaymentInfo()
    {
        $bankInfo = [
            'bca' => [
                'name' => 'Bank BCA',
                'account' => '1234567890',
                'holder' => 'INKAI Kediri'
            ],
            'mandiri' => [
                'name' => 'Bank Mandiri',
                'account' => '0987654321',
                'holder' => 'INKAI Kediri'
            ]
        ];

        $qrisInfo = [
            'image' => asset('images/qris-inkai.png'),
            'description' => 'Scan QR Code untuk pembayaran QRIS'
        ];

        $cashInfo = [
            'address' => Setting::get('office_address', 'Jl. Brawijaya No. 123, Kediri'),
            'phone' => Setting::get('office_phone', '0354-123456'),
            'hours' => Setting::get('office_hours', 'Senin-Jumat: 08:00-16:00')
        ];

        return response()->json([
            'bank' => $bankInfo,
            'qris' => $qrisInfo,
            'cash' => $cashInfo
        ]);
    }
}
