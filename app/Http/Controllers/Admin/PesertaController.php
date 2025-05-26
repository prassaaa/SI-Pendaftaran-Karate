<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\KategoriUsia;
use App\Models\Ranting;
use App\Models\Notification;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $query = Peserta::with(['ranting', 'kategoriUsia', 'user']);

        // Filter berdasarkan status pendaftaran
        if ($request->has('status_pendaftaran') && $request->status_pendaftaran != '') {
            $query->where('status_pendaftaran', $request->status_pendaftaran);
        }

        // Filter berdasarkan status bayar
        if ($request->has('status_bayar') && $request->status_bayar != '') {
            $query->where('status_bayar', $request->status_bayar);
        }

        // Filter berdasarkan ranting
        if ($request->has('ranting_id') && $request->ranting_id != '') {
            $query->where('ranting_id', $request->ranting_id);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('kode_pendaftaran', 'like', "%{$search}%")
                  ->orWhere('no_telepon', 'like', "%{$search}%");
            });
        }

        $peserta = $query->latest()->paginate(20);

        $ranting = Ranting::orderBy('nama_ranting')->get();

        return view('admin.peserta.index', compact('peserta', 'ranting'));
    }

    public function show($id)
    {
        $peserta = Peserta::with(['ranting', 'kategoriUsia', 'user', 'pembayaran.verifiedBy'])
            ->findOrFail($id);

        return view('admin.peserta.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        $ranting = Ranting::orderBy('nama_ranting')->get();
        $kategori_usia = KategoriUsia::all();

        return view('admin.peserta.edit', compact('peserta', 'ranting', 'kategori_usia'));
    }

    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'ranting_id' => 'required|exists:ranting,id',
            'kategori_usia_id' => 'required|exists:kategori_usia,id',
            'berat_badan' => 'required|numeric|min:20|max:200',
            'kumite_perorangan' => 'boolean',
            'kata_perorangan' => 'boolean',
            'kata_beregu' => 'boolean',
            'kumite_beregu' => 'boolean',
        ]);

        // Recalculate total biaya
        $validated['total_biaya'] = $peserta->calculateTotalBiaya();

        $peserta->update($validated);

        return redirect()->route('admin.peserta.show', $peserta->id)
            ->with('success', 'Data peserta berhasil diupdate');
    }

    public function approve($id)
    {
        $peserta = Peserta::findOrFail($id);

        $peserta->update(['status_pendaftaran' => 'approved']);

        // Kirim notifikasi ke peserta
        Notification::create([
            'user_id' => $peserta->user_id,
            'title' => 'Pendaftaran Disetujui',
            'message' => 'Pendaftaran Anda telah disetujui. Silakan lakukan pembayaran jika belum.',
            'type' => 'success',
        ]);

        return back()->with('success', 'Peserta berhasil disetujui');
    }

    public function reject(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        $peserta->update([
            'status_pendaftaran' => 'rejected'
        ]);

        // Kirim notifikasi ke peserta
        Notification::create([
            'user_id' => $peserta->user_id,
            'title' => 'Pendaftaran Ditolak',
            'message' => $request->reason ?? 'Pendaftaran Anda ditolak. Silakan hubungi admin untuk informasi lebih lanjut.',
            'type' => 'error',
        ]);

        return back()->with('success', 'Peserta berhasil ditolak');
    }

    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);

        // Delete related user account
        if ($peserta->user) {
            $peserta->user->delete();
        }

        $peserta->delete();

        return redirect()->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil dihapus');
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:approve,reject,delete',
            'selected_peserta' => 'required|array',
            'selected_peserta.*' => 'exists:peserta,id',
            'reason' => 'nullable|string', // untuk reject
        ]);

        $pesertaIds = $validated['selected_peserta'];
        $action = $validated['action'];

        switch ($action) {
            case 'approve':
                Peserta::whereIn('id', $pesertaIds)->update(['status_pendaftaran' => 'approved']);
                $message = 'Peserta terpilih berhasil disetujui';
                break;

            case 'reject':
                Peserta::whereIn('id', $pesertaIds)->update(['status_pendaftaran' => 'rejected']);
                $message = 'Peserta terpilih berhasil ditolak';
                break;

            case 'delete':
                $peserta = Peserta::whereIn('id', $pesertaIds)->get();
                foreach ($peserta as $p) {
                    if ($p->user) {
                        $p->user->delete();
                    }
                    $p->delete();
                }
                $message = 'Peserta terpilih berhasil dihapus';
                break;
        }

        return back()->with('success', $message);
    }
}
