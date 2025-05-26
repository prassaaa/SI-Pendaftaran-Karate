<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Notification;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['peserta.ranting']);

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status_bayar', $request->status);
        } else {
            // Default tampilkan yang pending
            $query->where('status_bayar', 'pending');
        }

        // Filter berdasarkan metode pembayaran
        if ($request->has('metode') && $request->metode != '') {
            $query->where('metode_pembayaran', $request->metode);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('peserta', function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('kode_pendaftaran', 'like', "%{$search}%");
            })->orWhere('kode_pembayaran', 'like', "%{$search}%");
        }

        $pembayaran = $query->latest()->paginate(20);

        return view('admin.verifikasi.index', compact('pembayaran'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['peserta.ranting', 'peserta.kategoriUsia', 'verifiedBy'])
            ->findOrFail($id);

        return view('admin.verifikasi.show', compact('pembayaran'));
    }

    public function approve(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Verifikasi pembayaran
        $pembayaran->markAsVerified(auth()->id());

        if ($validated['keterangan']) {
            $pembayaran->update(['keterangan' => $validated['keterangan']]);
        }

        // Update status peserta
        $pembayaran->peserta->update([
            'status_pendaftaran' => 'approved'
        ]);

        // Kirim notifikasi ke peserta
        Notification::create([
            'user_id' => $pembayaran->peserta->user_id,
            'title' => 'Pembayaran Berhasil Diverifikasi',
            'message' => 'Pembayaran Anda telah diverifikasi. Pendaftaran Anda telah selesai.',
            'type' => 'success',
        ]);

        return back()->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function reject(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $pembayaran->update([
            'status_bayar' => 'failed',
            'keterangan' => $validated['reason'],
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        // Update status peserta kembali ke unpaid
        $pembayaran->peserta->update([
            'status_bayar' => 'unpaid'
        ]);

        // Kirim notifikasi ke peserta
        Notification::create([
            'user_id' => $pembayaran->peserta->user_id,
            'title' => 'Pembayaran Ditolak',
            'message' => 'Pembayaran Anda ditolak. Alasan: ' . $validated['reason'],
            'type' => 'error',
        ]);

        return back()->with('success', 'Pembayaran berhasil ditolak');
    }

    public function bulkApprove(Request $request)
    {
        $validated = $request->validate([
            'selected_pembayaran' => 'required|array',
            'selected_pembayaran.*' => 'exists:pembayaran,id',
        ]);

        $pembayaranIds = $validated['selected_pembayaran'];
        $pembayaranList = Pembayaran::whereIn('id', $pembayaranIds)->get();

        foreach ($pembayaranList as $pembayaran) {
            $pembayaran->markAsVerified(auth()->id());

            // Update status peserta
            $pembayaran->peserta->update([
                'status_pendaftaran' => 'approved'
            ]);

            // Kirim notifikasi
            Notification::create([
                'user_id' => $pembayaran->peserta->user_id,
                'title' => 'Pembayaran Berhasil Diverifikasi',
                'message' => 'Pembayaran Anda telah diverifikasi. Pendaftaran Anda telah selesai.',
                'type' => 'success',
            ]);
        }

        return back()->with('success', count($pembayaranList) . ' pembayaran berhasil diverifikasi');
    }

    public function statistics()
    {
        $stats = [
            'total_pembayaran' => Pembayaran::count(),
            'pending_verifikasi' => Pembayaran::pending()->count(),
            'berhasil_verifikasi' => Pembayaran::paid()->count(),
            'ditolak' => Pembayaran::where('status_bayar', 'failed')->count(),
            'expired' => Pembayaran::expired()->count(),
            'total_revenue' => Pembayaran::paid()->sum('jumlah_bayar'),
            'pending_revenue' => Pembayaran::pending()->sum('jumlah_bayar'),
        ];

        // Data per metode pembayaran
        $metodeStats = Pembayaran::selectRaw('metode_pembayaran, status_bayar, COUNT(*) as total, SUM(jumlah_bayar) as amount')
            ->groupBy('metode_pembayaran', 'status_bayar')
            ->get()
            ->groupBy('metode_pembayaran');

        return view('admin.verifikasi.statistics', compact('stats', 'metodeStats'));
    }
}
