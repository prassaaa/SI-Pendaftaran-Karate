<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Ranting;
use App\Models\KategoriUsia;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return redirect()->route('peserta.dashboard')
                ->with('error', 'Data peserta tidak ditemukan');
        }

        $peserta->load(['ranting', 'kategoriUsia']);
        $rantings = Ranting::orderBy('nama_ranting')->get();
        $kategoris = KategoriUsia::all();

        return view('peserta.profile.edit', compact('peserta', 'rantings', 'kategoris'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan']);
        }

        // Validasi: hanya bisa update data tertentu jika belum approved
        if ($peserta->status_pendaftaran === 'approved') {
            $validated = $request->validate([
                'alamat' => 'required|string',
                'no_telepon' => 'required|string|max:20',
                'berat_badan' => 'required|numeric|min:20|max:200',
            ]);

            $peserta->update($validated);
            $message = 'Data kontak berhasil diupdate';
        } else {
            // Jika belum approved, bisa update lebih banyak field
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

            // Minimal satu kategori harus dipilih
            $kategoriSelected = array_filter([
                $validated['kumite_perorangan'] ?? false,
                $validated['kata_perorangan'] ?? false,
                $validated['kata_beregu'] ?? false,
                $validated['kumite_beregu'] ?? false,
            ]);

            if (empty($kategoriSelected)) {
                return back()->withErrors(['kategori' => 'Pilih minimal satu kategori pertandingan']);
            }

            // Recalculate total biaya
            $validated['total_biaya'] = $peserta->calculateTotalBiaya();

            $peserta->update($validated);

            // Update user name jika berubah
            if ($user->name !== $validated['nama_lengkap']) {
                $user->update(['name' => $validated['nama_lengkap']]);
            }

            $message = 'Profil berhasil diupdate';
        }

        return back()->with('success', $message);
    }

    public function uploadFoto(Request $request)
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return response()->json(['success' => false, 'message' => 'Data peserta tidak ditemukan']);
        }

        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // Hapus foto lama jika ada
            if ($peserta->foto_path) {
                Storage::disk('public')->delete($peserta->foto_path);
            }

            // Upload foto baru
            $file = $request->file('foto');
            $filename = time() . '_' . $peserta->kode_pendaftaran . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/fotos', $filename, 'public');

            $peserta->update(['foto_path' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil diupload',
                'foto_url' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mengupload foto: ' . $e->getMessage()]);
        }
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Cek password lama
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak benar']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }

    public function updateEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'required',
        ]);

        $user = auth()->user();

        // Cek password
        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['password' => 'Password tidak benar']);
        }

        // Update email
        $user->update([
            'email' => $validated['email'],
            'email_verified_at' => null, // Reset email verification
        ]);

        return back()->with('success', 'Email berhasil diubah. Silakan verifikasi email baru Anda.');
    }

    public function deleteAccount(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required',
            'confirmation' => 'required|in:DELETE',
        ]);

        $user = auth()->user();
        $peserta = $user->peserta;

        // Cek password
        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['password' => 'Password tidak benar']);
        }

        // Cek apakah masih bisa dihapus
        if ($peserta && $peserta->status_pendaftaran === 'approved' && $peserta->status_bayar === 'paid') {
            return back()->withErrors(['error' => 'Akun tidak dapat dihapus karena pendaftaran sudah disetujui dan pembayaran sudah lunas']);
        }

        try {
            // Hapus foto jika ada
            if ($peserta && $peserta->foto_path) {
                Storage::disk('public')->delete($peserta->foto_path);
            }

            // Hapus bukti pembayaran jika ada
            if ($peserta) {
                foreach ($peserta->pembayaran as $pembayaran) {
                    if ($pembayaran->bukti_bayar_path) {
                        Storage::disk('public')->delete($pembayaran->bukti_bayar_path);
                    }
                }
            }

            // Logout user
            auth()->logout();

            // Hapus akun (cascade delete akan menghapus peserta dan pembayaran)
            $user->delete();

            return redirect()->route('welcome')->with('success', 'Akun berhasil dihapus');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus akun: ' . $e->getMessage()]);
        }
    }

    public function downloadData()
    {
        $user = auth()->user();
        $peserta = $user->peserta;

        if (!$peserta) {
            return back()->withErrors(['error' => 'Data peserta tidak ditemukan']);
        }

        // Load relationships
        $peserta->load(['ranting', 'kategoriUsia', 'pembayaran']);

        // Compile data
        $data = [
            'user_info' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'created_at' => $user->created_at->format('d/m/Y H:i:s'),
            ],
            'peserta_info' => [
                'kode_pendaftaran' => $peserta->kode_pendaftaran,
                'nama_lengkap' => $peserta->nama_lengkap,
                'tempat_lahir' => $peserta->tempat_lahir,
                'tanggal_lahir' => $peserta->tanggal_lahir->format('d/m/Y'),
                'alamat' => $peserta->alamat,
                'no_telepon' => $peserta->no_telepon,
                'jenis_kelamin' => $peserta->jenis_kelamin,
                'golongan_darah' => $peserta->golongan_darah,
                'berat_badan' => $peserta->berat_badan,
                'ranting' => $peserta->ranting->nama_ranting,
                'kategori_usia' => $peserta->kategoriUsia->nama_kategori,
                'kategori_pertandingan' => $peserta->kategori_dipilih,
                'total_biaya' => $peserta->formatted_total_biaya,
                'status_pendaftaran' => $peserta->status_pendaftaran,
                'status_bayar' => $peserta->status_bayar,
                'created_at' => $peserta->created_at->format('d/m/Y H:i:s'),
            ],
            'pembayaran_info' => $peserta->pembayaran->map(function($pembayaran) {
                return [
                    'kode_pembayaran' => $pembayaran->kode_pembayaran,
                    'jumlah_bayar' => $pembayaran->formatted_jumlah_bayar,
                    'metode_pembayaran' => $pembayaran->metode_pembayaran_formatted,
                    'status_bayar' => $pembayaran->status_bayar,
                    'tanggal_bayar' => $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d/m/Y H:i:s') : null,
                    'verified_at' => $pembayaran->verified_at ? $pembayaran->verified_at->format('d/m/Y H:i:s') : null,
                    'created_at' => $pembayaran->created_at->format('d/m/Y H:i:s'),
                ];
            })->toArray(),
        ];

        // Generate JSON file
        $filename = 'data_peserta_' . $peserta->kode_pendaftaran . '_' . date('Y-m-d_H-i-s') . '.json';

        return response()->json($data)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
