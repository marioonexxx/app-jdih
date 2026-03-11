<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisProdukHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PencarianController extends Controller
{
    public function searchPeraturan(Request $request)
    {
        $query = DokumenHukum::query();

        // Modifikasi bagian ini
        if ($request->filled('judul')) {
            $keyword = $request->judul;
            $query->where(function ($q) use ($keyword) {
                $q->where('judul', 'like', '%' . $keyword . '%')
                    ->orWhere('nomor', 'like', '%' . $keyword . '%'); // Cari juga di kolom nomor
            });
        }

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        // Gunakan withQueryString agar filter tidak hilang saat pindah halaman pagination
        $results = $query->latest()->paginate(10)->withQueryString();

        $listJenis = JenisProdukHukum::orderBy('kelompok')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kelompok');

        return view('guest.hasil-pencarian', compact('results', 'listJenis'));
    }

    /**
     * Menampilkan detail produk hukum
     * Method ini menangani route name: guest.peraturan.show
     */
    public function showPeraturan($id)
    {
        // 1. Ambil data dokumen berdasarkan ID
        // Jika tidak ada, otomatis memicu error 404
        $dokumen = DokumenHukum::findOrFail($id);

        // 2. Tambah statistik jumlah akses/view (opsional tapi disarankan)
        $dokumen->increment('diakses');

        // 3. Return view ke file blade yang Anda tunjukkan tadi
        // Pastikan path view-nya sesuai (misal: guest/peraturan/detail.blade.php)
        return view('guest.detail-pencarian', compact('dokumen'));
    }

    public function downloadPeraturan($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        // Sesuaikan dengan Folder di method store: 'public/produk-hukum'
        // Di storage disk 'public', pathnya menjadi 'produk-hukum/namafile'
        $filePath = 'produk-hukum/' . $dokumen->file_pdf;

        if ($dokumen->file_pdf && Storage::disk('public')->exists($filePath)) {
            $dokumen->increment('diunduh');

            // Beri nama file yang rapi saat didownload
            $namaDownload = Str::slug($dokumen->singkatan_jenis . '-' . $dokumen->nomor . '-' . $dokumen->tahun) . '.pdf';

            return Storage::disk('public')->download($filePath, $namaDownload);
        }

        return back()->with('error', 'Maaf, file fisik dokumen tidak ditemukan.');
    }

    public function previewPdf($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        // Kita cari file di storage/app/public/....
        // Sesuai controller store Anda, pathnya adalah 'produk-hukum/namafile.pdf'
        $path = storage_path('app/public/' . $dokumen->file_pdf);

        if (!file_exists($path)) {
            // Jika tidak ketemu, coba cek tanpa subfolder (siapa tahu tersimpan di root public)
            $pathAlt = storage_path('app/public/produk-hukum/' . $dokumen->file_pdf);
            if (file_exists($pathAlt)) {
                $path = $pathAlt;
            } else {
                abort(404, 'File PDF tidak ditemukan di server.');
            }
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
        ]);
    }
}
