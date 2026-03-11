<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum; // Pastikan model ini sudah ada
use Illuminate\Http\Request;

class UserOperatorController extends Controller
{
    /**
     * Menampilkan Dashboard Utama Operator
     */
    public function index()
    {
        // 1. Hitung Statistik berdasarkan Nama Jenis (Case Insensitive)
        // Kita gunakan 'LIKE' untuk fleksibilitas jika ada spasi tambahan
        $totalPerda = DokumenHukum::where('jenis', 'LIKE', '%Peraturan Daerah%')->count();
        $totalPerbup = DokumenHukum::where('jenis', 'LIKE', '%Peraturan Bupati%')->count();
        $totalKepbup = DokumenHukum::where('jenis', 'LIKE', '%Keputusan Bupati%')->count();

        // 2. Ambil 5 Produk Hukum terbaru yang diinput (berdasarkan waktu pembuatan)
        // Kita gunakan latest() sebagai shortcut dari orderBy('created_at', 'desc')
        $latestDocs = DokumenHukum::latest()
            ->take(5)
            ->get();

        // 3. Kirim data ke view dashboard operator
        return view('user-operator.dashboard', compact(
            'totalPerda',
            'totalPerbup',
            'totalKepbup',
            'latestDocs'
        ));
    }
}
