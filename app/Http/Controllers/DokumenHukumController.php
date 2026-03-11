<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisProdukHukum;
use App\Models\RiwayatPeraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DokumenHukumController extends Controller
{
    public function index()
    {
        $dokumen = DokumenHukum::latest()->paginate(10);
        return view('user-operator.produk-hukum.index', compact('dokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nomor' => 'required',
            'tahun' => 'required|numeric',
            'judul' => 'required',
            'file_pdf' => 'required|mimes:pdf|max:20480',
        ]);

        DB::beginTransaction();
        try {
            // 1. Upload File
            $fileName = null;
            if ($request->hasFile('file_pdf')) {
                $file = $request->file('file_pdf');
                $fileName = $request->singkatan_jenis . '_' . Str::slug($request->nomor) . '_' . $request->tahun . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/produk-hukum', $fileName);
            }

            // 2. Simpan Dokumen Utama (Filter input agar tidak menyertakan data riwayat)
            $dataInsert = $request->except(['tipe_relasi', 'target_dokumen_id', 'catatan_riwayat']);
            $dokumen = DokumenHukum::create(array_merge($dataInsert, [
                'file_pdf' => $fileName,
                'created_by' => Auth::id(),
            ]));

            // 3. Simpan Riwayat & Update Status Target (Jika diisi)
            if ($request->filled('target_dokumen_id') && $request->filled('tipe_relasi')) {
                $this->handleRiwayatDanStatus($dokumen->id, $request);
            }

            DB::commit();
            return redirect()->route('produk-hukum.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $semuaDokumen = DokumenHukum::select('id', 'judul', 'nomor', 'tahun', 'singkatan_jenis')->get();

        // Ambil jenis produk hukum, urutkan, dan kelompokkan berdasarkan kolom 'kelompok'
        $listJenis = JenisProdukHukum::orderBy('kelompok')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kelompok');

        return view('user-operator.produk-hukum.create', compact('semuaDokumen', 'listJenis'));
    }

    public function edit($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $semuaDokumen = DokumenHukum::where('id', '!=', $id)->orderBy('tahun', 'desc')->get();

        // Tambahkan juga di edit agar dropdown jenis tetap dinamis saat update
        $listJenis = JenisProdukHukum::orderBy('kelompok')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kelompok');

        $riwayatAktif = $dokumen->riwayatKeBawah()->first();
        $terkenaDampak = $dokumen->riwayatKeAtas()->with('dokumen')->get();

        return view('user-operator.produk-hukum.edit', compact(
            'dokumen',
            'semuaDokumen',
            'listJenis', // Kirim ke view
            'riwayatAktif',
            'terkenaDampak'
        ));
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        $request->validate([
            'nomor' => 'required',
            'tahun' => 'required|numeric',
            'judul' => 'required',
            'file_pdf' => 'nullable|mimes:pdf|max:20480',
        ]);

        try {
            DB::beginTransaction();

            // Ambil semua kolom sesuai Migration
            $data = $request->only([
                'tipe_dokumen',
                'jenis',
                'singkatan_jenis',
                'nomor',
                'tahun',
                'judul',
                'tanggal_ditetapkan',
                'tanggal_diundangkan',
                'bidang_hukum',
                'sumber',
                'subjek',
                'urusan_pemerintah',
                'pemrakarsa',
                'penandatangan',
                'lokasi',
                'teu_badan_orang',
                'tempat_terbit',
                'tempat_penetapan',
                'status',
                'keterangan_status',
                'bahasa'
            ]);

            $data['updated_by'] = Auth::id();

            // Handle PDF
            if ($request->hasFile('file_pdf')) {
                if ($dokumen->file_pdf) {
                    Storage::disk('public')->delete('produk-hukum/' . $dokumen->file_pdf);
                }
                $file = $request->file('file_pdf');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('produk-hukum', $filename, 'public');
                $data['file_pdf'] = $filename;
            }

            $dokumen->update($data);

            // LOGIKA RIWAYAT (TIMBAL BALIK)
            if ($request->filled('tipe_relasi') && $request->filled('target_dokumen_id')) {
                RiwayatPeraturan::updateOrCreate(
                    ['dokumen_id' => $id],
                    [
                        'target_dokumen_id' => $request->target_dokumen_id,
                        'tipe_relasi' => $request->tipe_relasi,
                        'catatan' => $request->catatan_riwayat
                    ]
                );

                // AUTO-UPDATE Status Dokumen Target (Perda Lama)
                $statusTarget = ($request->tipe_relasi == 'Mencabut') ? 'Tidak Berlaku (Dicabut)' : 'Berlaku (Diubah)';
                DokumenHukum::where('id', $request->target_dokumen_id)->update([
                    'status' => $statusTarget,
                    'keterangan_status' => "Status berubah otomatis karena adanya peraturan baru: {$dokumen->singkatan_jenis} No {$dokumen->nomor} Tahun {$dokumen->tahun}"
                ]);
            } else {
                RiwayatPeraturan::where('dokumen_id', $id)->delete();
            }

            DB::commit();
            return redirect()->route('produk-hukum.index')->with('success', 'Data Berhasil Diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal update: ' . $e->getMessage())->withInput();
        }
    }
    public function destroy($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        DB::beginTransaction();
        try {
            // Hapus file fisik
            if ($dokumen->file_pdf && Storage::exists('public/produk-hukum/' . $dokumen->file_pdf)) {
                Storage::delete('public/produk-hukum/' . $dokumen->file_pdf);
            }

            // Hapus riwayat terkait (Jika database tidak pakai cascade delete)
            DB::table('riwayat_peraturan')->where('dokumen_id', $id)->delete();
            DB::table('riwayat_peraturan')->where('target_dokumen_id', $id)->delete();

            $dokumen->delete();

            DB::commit();
            return redirect()->route('produk-hukum.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
        }
    }

    /**
     * Helper Method: Menangani Riwayat & Sinkronisasi Status Otomatis
     */
    private function handleRiwayatDanStatus($dokumenId, $request)
    {
        DB::table('riwayat_peraturan')->insert([
            'dokumen_id'        => $dokumenId,
            'target_dokumen_id' => $request->target_dokumen_id,
            'tipe_relasi'       => $request->tipe_relasi,
            'catatan'           => $request->catatan_riwayat,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        // Sesuaikan dengan enum: 'Berlaku', 'Berlaku (Diubah)', 'Tidak Berlaku (Dicabut)', 'Tetap'
        if ($request->tipe_relasi == 'Mencabut') {
            DokumenHukum::where('id', $request->target_dokumen_id)
                ->update(['status' => 'Tidak Berlaku (Dicabut)']);
        } elseif ($request->tipe_relasi == 'Mengubah') {
            DokumenHukum::where('id', $request->target_dokumen_id)
                ->update(['status' => 'Berlaku (Diubah)']);
        }
    }
}
