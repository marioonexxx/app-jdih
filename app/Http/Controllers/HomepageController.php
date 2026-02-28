<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\ProfilHalaman;
use Illuminate\Http\Request;

class HomepageController extends Controller
{


    public function index()
    {
        // Mengambil postingan terbaru untuk section 'Latest Posts'
        // $posts = Post::latest()->take(6)->get();
        return view('guest.welcome');
    }

    public function searchPeraturan(Request $request)
    {
        $query = DokumenHukum::query();

        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        if ($request->filled('jenis')) {
            $query->where('jenis_id', $request->jenis);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $results = $query->latest()->paginate(10);

        return view('guest.hasil-pencarian', compact('results'));
    }

    public function showPeraturan($id)
    {
        // Cari peraturan atau tampilkan 404 jika tidak ada
        // Berasumsi nama model Anda adalah Peraturan
        $peraturan = DokumenHukum::findOrFail($id);

        return view('guest.hasil-pencarian', compact('peraturan'));
    }
    public function visiMisi()
    {
        $profil = ProfilHalaman::first();
        return view('guest.visi-misi', compact('profil'));
    }

    public function strukturOrganisasi()
    {
        $profil = ProfilHalaman::first();
        return view('guest.struktur-organisasi', compact('profil'));
    }

    public function dasarHukum()
    {
        $profil = ProfilHalaman::first();
        return view('guest.dasar-hukum', compact('profil'));
    }

    public function kontak()
    {
        $profil = ProfilHalaman::first();
        return view('guest.contact', compact('profil'));
    }
}
