<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriUsia;
use App\Models\Ranting;
use App\Models\BiayaKategori;
use App\Models\Setting;

class MasterDataController extends Controller
{
    // =============== KATEGORI USIA ===============
    public function indexKategoriUsia()
    {
        $kategoris = KategoriUsia::withCount('peserta')->latest()->get();
        return view('admin.master.kategori-usia.index', compact('kategoris'));
    }

    public function createKategoriUsia()
    {
        return view('admin.master.kategori-usia.create');
    }

    public function storeKategoriUsia(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'rentang_usia' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriUsia::create($validated);

        return redirect()->route('admin.master.kategori-usia.index')
            ->with('success', 'Kategori usia berhasil ditambahkan');
    }

    public function showKategoriUsia($id)
    {
        $kategori = KategoriUsia::withCount('peserta')->findOrFail($id);
        return view('admin.master.kategori-usia.show', compact('kategori'));
    }

    public function editKategoriUsia($id)
    {
        $kategori = KategoriUsia::findOrFail($id);
        return view('admin.master.kategori-usia.edit', compact('kategori'));
    }

    public function updateKategoriUsia(Request $request, $id)
    {
        $kategori = KategoriUsia::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'rentang_usia' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.master.kategori-usia.index')
            ->with('success', 'Kategori usia berhasil diupdate');
    }

    public function destroyKategoriUsia($id)
    {
        $kategori = KategoriUsia::findOrFail($id);

        if ($kategori->peserta()->count() > 0) {
            return back()->withErrors(['error' => 'Kategori tidak dapat dihapus karena masih digunakan peserta']);
        }

        $kategori->delete();

        return redirect()->route('admin.master.kategori-usia.index')
            ->with('success', 'Kategori usia berhasil dihapus');
    }

    // =============== RANTING ===============
    public function indexRanting()
    {
        $rantings = Ranting::withCount('peserta')->latest()->get();
        return view('admin.master.ranting.index', compact('rantings'));
    }

    public function createRanting()
    {
        return view('admin.master.ranting.create');
    }

    public function storeRanting(Request $request)
    {
        $validated = $request->validate([
            'nama_ranting' => 'required|string|max:150',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
        ]);

        Ranting::create($validated);

        return redirect()->route('admin.master.ranting.index')
            ->with('success', 'Ranting berhasil ditambahkan');
    }

    public function showRanting($id)
    {
        $ranting = Ranting::withCount('peserta')->findOrFail($id);
        $recentPeserta = $ranting->peserta()->latest()->limit(10)->get();

        return view('admin.master.ranting.show', compact('ranting', 'recentPeserta'));
    }

    public function editRanting($id)
    {
        $ranting = Ranting::findOrFail($id);
        return view('admin.master.ranting.edit', compact('ranting'));
    }

    public function updateRanting(Request $request, $id)
    {
        $ranting = Ranting::findOrFail($id);

        $validated = $request->validate([
            'nama_ranting' => 'required|string|max:150',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
        ]);

        $ranting->update($validated);

        return redirect()->route('admin.master.ranting.index')
            ->with('success', 'Ranting berhasil diupdate');
    }

    public function destroyRanting($id)
    {
        $ranting = Ranting::findOrFail($id);

        if ($ranting->peserta()->count() > 0) {
            return back()->withErrors(['error' => 'Ranting tidak dapat dihapus karena masih digunakan peserta']);
        }

        $ranting->delete();

        return redirect()->route('admin.master.ranting.index')
            ->with('success', 'Ranting berhasil dihapus');
    }

    // =============== BIAYA KATEGORI ===============
    public function indexBiayaKategori()
    {
        $biayas = BiayaKategori::latest()->get();
        return view('admin.master.biaya-kategori.index', compact('biayas'));
    }

    public function createBiayaKategori()
    {
        return view('admin.master.biaya-kategori.create');
    }

    public function storeBiayaKategori(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'biaya_kumite' => 'required|numeric|min:0',
            'biaya_kata' => 'required|numeric|min:0',
            'biaya_beregu' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // Jika status active, set yang lain menjadi inactive
        if ($validated['status'] === 'active') {
            BiayaKategori::where('status', 'active')->update(['status' => 'inactive']);
        }

        BiayaKategori::create($validated);

        return redirect()->route('admin.master.biaya-kategori.index')
            ->with('success', 'Biaya kategori berhasil ditambahkan');
    }

    public function showBiayaKategori($id)
    {
        $biaya = BiayaKategori::findOrFail($id);
        return view('admin.master.biaya-kategori.show', compact('biaya'));
    }

    public function editBiayaKategori($id)
    {
        $biaya = BiayaKategori::findOrFail($id);
        return view('admin.master.biaya-kategori.edit', compact('biaya'));
    }

    public function updateBiayaKategori(Request $request, $id)
    {
        $biaya = BiayaKategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'biaya_kumite' => 'required|numeric|min:0',
            'biaya_kata' => 'required|numeric|min:0',
            'biaya_beregu' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ]);

        // Jika status active, set yang lain menjadi inactive
        if ($validated['status'] === 'active') {
            BiayaKategori::where('status', 'active')->where('id', '!=', $id)->update(['status' => 'inactive']);
        }

        $biaya->update($validated);

        return redirect()->route('admin.master.biaya-kategori.index')
            ->with('success', 'Biaya kategori berhasil diupdate');
    }

    public function destroyBiayaKategori($id)
    {
        $biaya = BiayaKategori::findOrFail($id);
        $biaya->delete();

        return redirect()->route('admin.master.biaya-kategori.index')
            ->with('success', 'Biaya kategori berhasil dihapus');
    }

    // =============== SETTINGS ===============
    public function settings()
    {
        $settings = Setting::orderBy('key')->get()->groupBy(function($item) {
            $key = explode('_', $item->key)[0];
            return match($key) {
                'app' => 'Aplikasi',
                'event' => 'Event/Kejuaraan',
                'registration' => 'Pendaftaran',
                'office' => 'Kontak',
                'bank' => 'Bank',
                'email' => 'Email',
                'max', 'allowed' => 'Upload File',
                default => 'Lainnya'
            };
        });

        return view('admin.master.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($validated['settings'] as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value ?? '']);
        }

        return back()->with('success', 'Settings berhasil diupdate');
    }

    // =============== DYNAMIC ROUTING ===============
    public function index($type)
    {
        return match($type) {
            'kategori-usia' => $this->indexKategoriUsia(),
            'ranting' => $this->indexRanting(),
            'biaya-kategori' => $this->indexBiayaKategori(),
            default => abort(404)
        };
    }

    public function create($type)
    {
        return match($type) {
            'kategori-usia' => $this->createKategoriUsia(),
            'ranting' => $this->createRanting(),
            'biaya-kategori' => $this->createBiayaKategori(),
            default => abort(404)
        };
    }

    public function store(Request $request, $type)
    {
        return match($type) {
            'kategori-usia' => $this->storeKategoriUsia($request),
            'ranting' => $this->storeRanting($request),
            'biaya-kategori' => $this->storeBiayaKategori($request),
            default => abort(404)
        };
    }

    public function show($type, $id)
    {
        return match($type) {
            'kategori-usia' => $this->showKategoriUsia($id),
            'ranting' => $this->showRanting($id),
            'biaya-kategori' => $this->showBiayaKategori($id),
            default => abort(404)
        };
    }

    public function edit($type, $id)
    {
        return match($type) {
            'kategori-usia' => $this->editKategoriUsia($id),
            'ranting' => $this->editRanting($id),
            'biaya-kategori' => $this->editBiayaKategori($id),
            default => abort(404)
        };
    }

    public function update(Request $request, $type, $id)
    {
        return match($type) {
            'kategori-usia' => $this->updateKategoriUsia($request, $id),
            'ranting' => $this->updateRanting($request, $id),
            'biaya-kategori' => $this->updateBiayaKategori($request, $id),
            default => abort(404)
        };
    }

    public function destroy($type, $id)
    {
        return match($type) {
            'kategori-usia' => $this->destroyKategoriUsia($id),
            'ranting' => $this->destroyRanting($id),
            'biaya-kategori' => $this->destroyBiayaKategori($id),
            default => abort(404)
        };
    }
}
