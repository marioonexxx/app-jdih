<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisProdukHukum;
use App\Models\Post;
use App\Models\ProfilHalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomepageController extends Controller
{


    public function index()
    {
        // 1. Ambil Berita Terbaru
        $posts = Post::with(['category', 'author'])
            ->where('status', 'published')
            ->latest()
            ->take(7)
            ->get();

        // 2. Ambil data jenis untuk dropdown pencarian
        $listJenis = JenisProdukHukum::orderBy('kelompok')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kelompok');

        // 3. Ambil 5 Peraturan Terbaru tanpa with()
        $latestRegulations = DokumenHukum::latest()
            ->take(5)
            ->get();

        // 4. Hitung Statistik (Sesuaikan 'jenis_id' atau 'jenis' dengan kolom di tabel Anda)
        // Jika kolomnya berisi nama teks (misal: "Peraturan Daerah")
        $totalPerda = DokumenHukum::where('jenis', 'LIKE', '%Peraturan Daerah%')->count();
        $totalPerbup = DokumenHukum::where('jenis', 'LIKE', '%Peraturan Bupati%')->count();
        $totalSkBupati = DokumenHukum::where('jenis', 'LIKE', '%Keputusan Bupati%')->count();

        // Jika tabel Anda menggunakan 'jenis_id', gunakan angka ID-nya:
        // $totalPerda = DokumenHukum::where('jenis_id', 1)->count();

        $totalPengunjung = 1250; // Dummy sementara

        return view('guest.welcome', compact(
            'posts',
            'listJenis',
            'latestRegulations',
            'totalPerda',
            'totalPerbup',
            'totalSkBupati',
            'totalPengunjung'
        ));
    }


    public function search(Request $request)
    {
        $query = DokumenHukum::query();

        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $results = $query->latest()->paginate(10)->withQueryString();

        // Kirim listJenis juga agar dropdown filter di halaman hasil pencarian tidak kosong
        $listJenis = JenisProdukHukum::orderBy('kelompok')->orderBy('urutan')->get()->groupBy('kelompok');

        return view('guest.peraturan.index', compact('results', 'listJenis'));
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
