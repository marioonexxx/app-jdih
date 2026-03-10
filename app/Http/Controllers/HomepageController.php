<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\Post;
use App\Models\ProfilHalaman;
use Illuminate\Http\Request;

class HomepageController extends Controller
{


    public function index()
    {
        // 1. Mengambil postingan dengan status published
        // 2. Eager Load 'category' dan 'author' (user) untuk efisiensi database (menghindari N+1 query)
        // 3. Urutkan dari yang terbaru (latest)
        // 4. Ambil 6-7 postingan saja untuk layout Latest Posts
        $posts = Post::with(['category', 'author'])
            ->where('status', 'published')
            ->latest()
            ->take(7)
            ->get();

        // Kirim variabel $posts ke view
        return view('guest.welcome', compact('posts'));
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
