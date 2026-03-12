@extends('layouts.navbar')

@section('title', 'Detail Produk Hukum - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Detail Produk Hukum
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary me-2" href="{{ route('produk-hukum.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i> Kembali ke Daftar
                            </a>
                            <a class="btn btn-sm btn-warning shadow-sm"
                                href="{{ route('produk-hukum.edit', $produk_hukum->id) }}">
                                <i class="me-1" data-feather="edit"></i> Edit Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-4">
            <div class="row">
                {{-- KOLOM KIRI: DETAIL INFORMASI --}}
                <div class="col-xl-5">
                    {{-- KARTU STATUS --}}
                    <div
                        class="card mb-4 border-start-lg {{ $produk_hukum->status == 'Berlaku' ? 'border-success' : 'border-danger' }} shadow-sm">
                        <div class="card-body">
                            <div class="small text-muted mb-1">Status Peraturan:</div>
                            <div
                                class="h4 fw-bold {{ $produk_hukum->status == 'Berlaku' ? 'text-success' : 'text-danger' }}">
                                {{ $produk_hukum->status }}
                            </div>
                            @if ($produk_hukum->keterangan_status)
                                <div class="small text-gray-600 mt-2 italic">"{{ $produk_hukum->keterangan_status }}"</div>
                            @endif
                        </div>
                    </div>

                    {{-- INFORMASI UTAMA --}}
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header text-primary fw-bold">Informasi Dokumen</div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <tbody>
                                    <tr>
                                        <td class="bg-light ps-4 small fw-bold" style="width: 35%;">Jenis</td>
                                        <td class="ps-4">{{ $produk_hukum->jenis }} ({{ $produk_hukum->singkatan_jenis }})
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light ps-4 small fw-bold">Nomor / Tahun</td>
                                        <td class="ps-4">Nomor {{ $produk_hukum->nomor }} Tahun {{ $produk_hukum->tahun }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light ps-4 small fw-bold">Judul / Tentang</td>
                                        <td class="ps-4 fw-500">{{ $produk_hukum->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light ps-4 small fw-bold">Bidang Hukum</td>
                                        <td class="ps-4">{{ $produk_hukum->bidang_hukum }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light ps-4 small fw-bold">Urusan</td>
                                        <td class="ps-4">{{ $produk_hukum->urusan_pemerintah }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light ps-4 small fw-bold">Ditetapkan</td>
                                        <td class="ps-4 text-muted">
                                            {{ \Carbon\Carbon::parse($produk_hukum->tanggal_ditetapkan)->isoFormat('D MMMM Y') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- RIWAYAT HUBUNGAN --}}
                    @if ($produk_hukum->tipe_relasi)
                        <div class="card mb-4 border-start-lg border-warning shadow-sm">
                            <div class="card-header text-warning fw-bold">Riwayat Relasi</div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning-soft p-3 rounded me-3 text-warning">
                                        <i data-feather="repeat"></i>
                                    </div>
                                    <div>
                                        <div class="small text-muted">{{ $produk_hukum->tipe_relasi }} Terhadap:</div>
                                        <div class="fw-bold">ID Dokumen: #{{ $produk_hukum->target_dokumen_id }}</div>
                                        <p class="small mb-0 mt-1">{{ $produk_hukum->catatan_riwayat }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- KOLOM KANAN: PREVIEW PDF --}}
              
                <div class="col-xl-7">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">Pratinjau Salinan Dokumen</span>
                            @if ($produk_hukum->file_pdf)
                                <a href="{{ route('operator.produk-hukum.preview', $produk_hukum->id) }}" target="_blank"
                                    class="btn btn-sm btn-primary-soft">
                                    <i data-feather="external-link" class="me-1"></i> Buka Fullscreen
                                </a>
                            @endif
                        </div>
                        <div class="card-body p-0">
                            @if ($produk_hukum->file_pdf)
                                {{-- Menggunakan iframe agar lebih stabil dan mendukung toolbar PDF --}}
                                <div class="ratio ratio-16x9 h-100" style="min-height: 800px;">
                                    <iframe src="{{ route('operator.produk-hukum.preview', $produk_hukum->id) }}#toolbar=1"
                                        frameborder="0" width="100%" height="100%">
                                        Browser Anda tidak mendukung pratinjau PDF.
                                    </iframe>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="text-gray-300 mb-3" data-feather="file-minus"
                                        style="width: 4rem; height: 4rem;"></i>
                                    <p class="text-muted">File PDF tidak tersedia.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
