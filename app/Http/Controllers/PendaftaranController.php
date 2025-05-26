<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Peserta;
use App\Models\KategoriUsia;
use App\Models\Ranting;
use App\Models\BiayaKategori;
use App\Models\Pembayaran;
use App\Models\Notification;

class PendaftaranController extends Controller
{
    public function step1()
    {
        $data = [
            'kategori_usia' => KategoriUsia::all(),
            'ranting' => Ranting::orderBy('nama_ranting')->get(),
        ];

        return view('pendaftaran.step1', $data);
    }

    public function postStep1(Request $request)
    {
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
        ]);

        session(['step1_data' => $validated]);

        return redirect()->route('pendaftaran.step2');
    }

    public function step2()
    {
        if (!session('step1_data')) {
            return redirect()->route('pendaftaran.step1');
        }

        $biaya = BiayaKategori::active()->first();

        return view('pendaftaran.step2', compact('biaya'));
    }

    public function postStep2(Request $request)
    {
        if (!session('step1_data')) {
            return redirect()->route('pendaftaran.step1');
        }

        $validated = $request->validate([
            'kumite_perorangan' => 'boolean',
            'kata_perorangan' => 'boolean',
            'kata_beregu' => 'boolean',
            'kumite_beregu' => 'boolean',
        ]);

        // Minimal satu kategori harus dipilih
        if (!array_filter($validated)) {
            return back()->withErrors(['kategori' => 'Pilih minimal satu kategori pertandingan']);
        }

        // Hitung total biaya
        $biaya = BiayaKategori::active()->first();
        $total = 0;

        if ($validated['kumite_perorangan']) $total += $biaya->biaya_kumite;
        if ($validated['kata_perorangan']) $total += $biaya->biaya_kata;
        if ($validated['kata_beregu']) $total += $biaya->biaya_beregu;
        if ($validated['kumite_beregu']) $total += $biaya->biaya_beregu;

        $validated['total_biaya'] = $total;

        session(['step2_data' => $validated]);

        return redirect()->route('pendaftaran.step3');
    }

    public function step3()
    {
        if (!session('step1_data') || !session('step2_data')) {
            return redirect()->route('pendaftaran.step1');
        }

        return view('pendaftaran.step3');
    }

    public function postStep3(Request $request)
    {
        if (!session('step1_data') || !session('step2_data')) {
            return redirect()->route('pendaftaran.step1');
        }

        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = time() . '_' . $foto->getClientOriginalName();
            $path = $foto->storeAs('uploads/fotos', $filename, 'public');
            $validated['foto_path'] = $path;
        }

        session(['step3_data' => $validated]);

        return redirect()->route('pendaftaran.step4');
    }

    public function step4()
    {
        if (!session('step1_data') || !session('step2_data') || !session('step3_data')) {
            return redirect()->route('pendaftaran.step1');
        }

        $step1 = session('step1_data');
        $step2 = session('step2_data');
        $step3 = session('step3_data');

        $ranting = Ranting::find($step1['ranting_id']);
        $kategori_usia = KategoriUsia::find($step1['kategori_usia_id']);

        return view('pendaftaran.step4', compact('step1', 'step2', 'step3', 'ranting', 'kategori_usia'));
    }

    public function submit(Request $request)
    {
        if (!session('step1_data') || !session('step2_data') || !session('step3_data')) {
            return redirect()->route('pendaftaran.step1');
        }

        try {
            DB::beginTransaction();

            $step1 = session('step1_data');
            $step2 = session('step2_data');
            $step3 = session('step3_data');

            // Buat user account
            $user = User::create([
                'name' => $step1['nama_lengkap'],
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'peserta',
            ]);

            // Generate kode pendaftaran
            $kode_pendaftaran = Peserta::generateKodePendaftaran();

            // Buat data peserta
            $peserta = Peserta::create(array_merge($step1, $step2, $step3, [
                'user_id' => $user->id,
                'kode_pendaftaran' => $kode_pendaftaran,
                'total_biaya' => $step2['total_biaya'],
            ]));

            // Buat record pembayaran
            $pembayaran = Pembayaran::create([
                'peserta_id' => $peserta->id,
                'kode_pembayaran' => Pembayaran::generateKodePembayaran(),
                'jumlah_bayar' => $step2['total_biaya'],
                'metode_pembayaran' => 'transfer',
                'status_bayar' => 'pending',
                'tanggal_expired' => now()->addDays(3),
            ]);

            // Buat notifikasi
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Pendaftaran Berhasil',
                'message' => "Pendaftaran Anda dengan kode {$kode_pendaftaran} berhasil. Silakan lakukan pembayaran.",
                'type' => 'success',
            ]);

            // Clear session
            session()->forget(['step1_data', 'step2_data', 'step3_data']);

            DB::commit();

            // Auto login
            auth()->login($user);

            return redirect()->route('peserta.dashboard')
                ->with('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function calculateBiaya(Request $request)
    {
        $biaya = BiayaKategori::active()->first();
        $total = 0;

        if ($request->kumite_perorangan) $total += $biaya->biaya_kumite;
        if ($request->kata_perorangan) $total += $biaya->biaya_kata;
        if ($request->kata_beregu) $total += $biaya->biaya_beregu;
        if ($request->kumite_beregu) $total += $biaya->biaya_beregu;

        return response()->json([
            'total' => $total,
            'formatted' => 'Rp ' . number_format($total, 0, ',', '.')
        ]);
    }
}
