@extends('layouts.navbar-guest')
@section('title', 'Detail Produk Hukum - ' . $dokumen->judul)

@section('content')
    <main class="main">
        {{-- Breadcrumbs --}}
        <div class="page-title" data-aos="fade">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li><a href="{{ route('guest.peraturan.search') }}">Produk Hukum</a></li>
                        <li class="current">Detail Dokumen</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section class="section bg-light">
            <div class="container" data-aos="fade-up">

                {{-- Tombol Kembali --}}
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <a href="{{ url()->previous() }}"
                        class="btn btn-white shadow-sm rounded-pill px-4 text-primary fw-bold">
                        <i class="bi bi-arrow-left me-2"></i> Kembali ke Hasil Pencarian
                    </a>
                    <div class="d-none d-md-block text-muted small">
                        ID Dokumen: #{{ $dokumen->id }}
                    </div>
                </div>

                <div class="row gy-4">
                    {{-- Judul Besar --}}
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4 border-start border-primary border-5">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span
                                    class="badge bg-primary-subtle text-primary px-3 rounded-pill">{{ $dokumen->tipe_dokumen }}</span>
                                    
                                <span
                                    class="badge bg-dark-subtle text-dark px-3 rounded-pill">{{ $dokumen->singkatan_jenis }}</span>
                            </div>
                            <h3 class="fw-bold text-dark mb-0 lh-base">{{ $dokumen->judul }}</h3>
                        </div>
                    </div>

                    {{-- Metadata Table (Lengkap) --}}
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header bg-white border-bottom p-3">
                                <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-list-columns-reverse me-2"></i>Atribut
                                    / Metadata Peraturan</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    {{-- Kolom Kiri --}}
                                    <div class="col-md-6 border-end">
                                        <table class="table table-hover mb-0 h-100">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle" style="width: 40%;">Jenis
                                                        Peraturan</th>
                                                    <td class="py-3">{{ $dokumen->jenis }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Nomor / Tahun</th>
                                                    <td class="py-3">{{ $dokumen->nomor }} / {{ $dokumen->tahun }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Tgl. Ditetapkan</th>
                                                    <td class="py-3">
                                                        {{ $dokumen->tanggal_ditetapkan ? \Carbon\Carbon::parse($dokumen->tanggal_ditetapkan)->translatedFormat('d F Y') : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Tgl. Diundangkan</th>
                                                    <td class="py-3">
                                                        {{ $dokumen->tanggal_diundangkan ? \Carbon\Carbon::parse($dokumen->tanggal_diundangkan)->translatedFormat('d F Y') : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Penandatangan</th>
                                                    <td class="py-3">{{ $dokumen->penandatangan ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Tempat Penetapan</th>
                                                    <td class="py-3">{{ $dokumen->tempat_penetapan }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Bidang Hukum</th>
                                                    <td class="py-3">{{ $dokumen->bidang_hukum ?? '-' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Kolom Kanan --}}
                                    <div class="col-md-6">
                                        <table class="table table-hover mb-0 h-100">
                                            <tbody>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle" style="width: 40%;">Status
                                                        Hukum</th>
                                                    <td class="py-3">
                                                        @if (in_array($dokumen->status, ['Berlaku', 'Tetap']))
                                                            <span class="badge bg-success shadow-sm rounded-pill px-3"><i
                                                                    class="bi bi-check-circle me-1"></i>{{ $dokumen->status }}</span>
                                                        @elseif($dokumen->status == 'Berlaku (Diubah)')
                                                            <span class="badge bg-primary shadow-sm rounded-pill px-3"><i
                                                                    class="bi bi-info-circle me-1"></i>{{ $dokumen->status }}</span>
                                                        @else
                                                            <span class="badge bg-danger shadow-sm rounded-pill px-3"><i
                                                                    class="bi bi-x-circle me-1"></i>{{ $dokumen->status }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Subjek</th>
                                                    <td class="py-3">{{ $dokumen->subjek ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Urusan Pemerintah</th>
                                                    <td class="py-3">{{ $dokumen->urusan_pemerintah ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Pemrakarsa</th>
                                                    <td class="py-3">{{ $dokumen->pemrakarsa ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">T.E.U Badan</th>
                                                    <td class="py-3">{{ $dokumen->teu_badan_orang }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Sumber / Lokasi</th>
                                                    <td class="py-3">
                                                        <div class="text-uppercase small fw-bold text-muted">
                                                            {{ $dokumen->sumber ?? '-' }}</div>
                                                        <div class="small text-primary">{{ $dokumen->lokasi }}</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-4 bg-light-subtle align-middle">Bahasa / Statistik</th>
                                                    <td class="py-3">
                                                        <span
                                                            class="badge bg-secondary-subtle text-secondary me-2">{{ $dokumen->bahasa }}</span>
                                                        <span class="me-2" title="Dilihat"><i
                                                                class="bi bi-eye text-primary"></i>
                                                            {{ $dokumen->diakses }}</span>
                                                        <span title="Diunduh"><i class="bi bi-download text-danger"></i>
                                                            {{ $dokumen->diunduh }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- Keterangan Status tetap di bawah jika ada --}}
                            @if ($dokumen->keterangan_status)
                                <div class="card-footer bg-warning-subtle border-0 p-3">
                                    <div class="d-flex gap-2">
                                        <i class="bi bi-info-circle-fill text-warning"></i>
                                        <div>
                                            <small class="fw-bold d-block text-uppercase">Catatan Status:</small>
                                            <p class="mb-0 small text-dark">{{ $dokumen->keterangan_status }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Preview PDF --}}
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm rounded-4 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold mb-0 text-dark"><i
                                        class="bi bi-file-earmark-pdf text-danger me-2"></i>Pratinjau Dokumen PDF</h5>
                                <a href="{{ route('guest.peraturan.download', $dokumen->id) }}"
                                    class="btn btn-danger rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-cloud-arrow-down-fill me-2"></i> Unduh Sekarang
                                </a>
                            </div>
                            {{-- Frame PDF --}}
                            {{-- Bagian Frame PDF --}}
                            <div class="ratio ratio-16x9 rounded-4 overflow-hidden border bg-light"
                                style="min-height: 800px;">
                                <iframe src="{{ route('guest.peraturan.preview', $dokumen->id) }}#toolbar=1"
                                    title="Pratinjau PDF" width="100%" height="100%">
                                    Browser Anda tidak mendukung pratinjau PDF.
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        /* Styling khusus untuk tabel metadata */
        .bg-light-subtle {
            background-color: #f8fafc;
        }

        .table th {
            font-weight: 600;
            color: #64748b;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table td {
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            font-weight: 500;
        }

        .btn-white {
            background-color: #fff;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .btn-white:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
        }

        .card {
            transition: transform 0.3s ease;
        }

        /* Responsivitas untuk mobile */
        @media (max-width: 767.98px) {
            .col-md-6.border-end {
                border-end: none !important;
                border-bottom: 1px solid #e2e8f0;
            }

            .table th {
                width: 45% !important;
            }

            iframe {
                min-height: 500px !important;
            }
        }
    </style>
@endsection
