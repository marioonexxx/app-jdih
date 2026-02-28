<?php

namespace App\Http\Controllers;

use App\Models\ProfilHalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilHalamanController extends Controller
{
    public function index()
    {
        // Mengambil data pertama. Jika tidak ada, tetap kirimkan variabel kosong agar tidak error di blade
        $profil = ProfilHalaman::first();

        return view('user-admin.profil-halaman.index', compact('profil'));
    }

    /**
     * Menyimpan atau memperbarui data profil
     */
    public function update(Request $request)
    {
        $profil = ProfilHalaman::first();

        $data = $request->except(['_token', 'struktur_organisasi']);

        if ($request->hasFile('struktur_organisasi')) {
            // Hapus foto lama jika ada
            if ($profil && $profil->struktur_organisasi) {
                Storage::delete('public/profil/' . $profil->struktur_organisasi);
            }

            // Simpan foto baru
            $file = $request->file('struktur_organisasi');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profil', $namaFile);
            $data['struktur_organisasi'] = $namaFile;
        }

        ProfilHalaman::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
