<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Pembayaran;
use App\Models\Notification;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

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
            'bukti_bayar' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB
            'metode_pembayaran' => 'required|in:transfer,cash,qris',
            'tanggal_bayar' => 'required|date|before_or_equal:today|after:' . now()->subDays(30)->format('Y-m-d'),
            'keterangan' => 'nullable|string|max:500',
        ], [
            'bukti_bayar.required' => 'Bukti pembayaran harus diupload',
            'bukti_bayar.file' => 'File bukti pembayaran tidak valid',
            'bukti_bayar.mimes' => 'Format file harus JPG, PNG, atau PDF',
            'bukti_bayar.max' => 'Ukuran file maksimal 5MB',
            'metode_pembayaran.required' => 'Pilih metode pembayaran',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid',
            'tanggal_bayar.required' => 'Tanggal pembayaran harus diisi',
            'tanggal_bayar.before_or_equal' => 'Tanggal pembayaran tidak boleh di masa depan',
            'tanggal_bayar.after' => 'Tanggal pembayaran tidak boleh lebih dari 30 hari yang lalu',
            'keterangan.max' => 'Keterangan maksimal 500 karakter',
        ]);

        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data peserta tidak ditemukan'
                ], 404);
            }
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan']);
        }

        // Check if registration is still pending or rejected
        if ($peserta->status_pendaftaran === 'rejected') {
            $message = 'Tidak dapat upload bukti pembayaran karena pendaftaran ditolak';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return back()->withErrors(['error' => $message]);
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

            if ($pembayaran && in_array($pembayaran->status_bayar, ['pending', 'failed'])) {
                // Delete old file if exists
                if ($pembayaran->bukti_bayar_path) {
                    Storage::disk('public')->delete($pembayaran->bukti_bayar_path);
                }

                // Update existing
                $pembayaran->update([
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'tanggal_bayar' => $validated['tanggal_bayar'],
                    'bukti_bayar_path' => $validated['bukti_bayar_path'],
                    'keterangan' => $validated['keterangan'] ?? null,
                    'status_bayar' => 'pending',
                    'verified_by' => null,
                    'verified_at' => null,
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

            $message = 'Bukti pembayaran berhasil diupload dan sedang diverifikasi';

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => [
                        'kode_pembayaran' => $pembayaran->kode_pembayaran,
                        'status_bayar' => $pembayaran->status_bayar,
                        'metode_pembayaran' => $pembayaran->metode_pembayaran_formatted,
                    ]
                ]);
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            // Delete uploaded file if exists and error occurred
            if (isset($validated['bukti_bayar_path'])) {
                Storage::disk('public')->delete($validated['bukti_bayar_path']);
            }

            \Log::error('Upload bukti pembayaran error: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'peserta_id' => $peserta->id,
                'error' => $e->getTraceAsString()
            ]);

            $message = 'Gagal mengupload bukti pembayaran: ' . $e->getMessage();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message
                ], 500);
            }

            return back()->withErrors(['error' => $message]);
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

        try {
            $pdf = \PDF::loadView('peserta.invoice', compact('peserta'));
            $pdf->setPaper('a4', 'portrait');

            return $pdf->download("Invoice_{$peserta->kode_pendaftaran}.pdf");
        } catch (\Exception $e) {
            \Log::error('Download invoice error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal mendownload invoice']);
        }
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

        try {
            $pdf = \PDF::loadView('peserta.formulir', compact('peserta'));
            $pdf->setPaper('a4', 'portrait');

            return $pdf->download("Formulir_{$peserta->kode_pendaftaran}.pdf");
        } catch (\Exception $e) {
            \Log::error('Download formulir error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal mendownload formulir']);
        }
    }

    public function markNotificationAsRead($id)
    {
        try {
            $notification = auth()->user()->notifications()->findOrFail($id);
            $notification->markAsRead();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Notifikasi tidak ditemukan'], 404);
        }
    }

    public function markAllNotificationsAsRead()
    {
        try {
            auth()->user()->notifications()->unread()->update(['read_at' => now()]);

            return back()->with('success', 'Semua notifikasi telah dibaca');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menandai notifikasi sebagai dibaca']);
        }
    }

    public function getPaymentInfo()
    {
        try {
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
                'success' => true,
                'data' => [
                    'bank' => $bankInfo,
                    'qris' => $qrisInfo,
                    'cash' => $cashInfo
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil informasi pembayaran'
            ], 500);
        }
    }

    public function checkPaymentStatus()
    {
        try {
            $user = auth()->user();
            $peserta = $user->peserta;

            if (!$peserta) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data peserta tidak ditemukan'
                ], 404);
            }

            $latestPembayaran = $peserta->latestPembayaran;

            return response()->json([
                'success' => true,
                'data' => [
                    'status_pendaftaran' => $peserta->status_pendaftaran,
                    'status_bayar' => $peserta->status_bayar,
                    'pembayaran' => $latestPembayaran ? [
                        'kode_pembayaran' => $latestPembayaran->kode_pembayaran,
                        'status_bayar' => $latestPembayaran->status_bayar,
                        'metode_pembayaran' => $latestPembayaran->metode_pembayaran_formatted,
                        'jumlah_bayar' => $latestPembayaran->formatted_jumlah_bayar,
                        'tanggal_bayar' => $latestPembayaran->tanggal_bayar?->format('d/m/Y'),
                        'verified_at' => $latestPembayaran->verified_at?->format('d/m/Y H:i:s'),
                    ] : null
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran'
            ], 500);
        }
    }
}
