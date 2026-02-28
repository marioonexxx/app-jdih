@extends('layouts.navbar')

@section('title', 'Edit Produk Hukum - JDIH MBD')

@section('content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                                Edit {{ $dokumen->singkatan_jenis }} No {{ $dokumen->nomor }} Th {{ $dokumen->tahun }}
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary border" href="{{ route('produk-hukum.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-4">
            {{-- ALERT OTOMATIS JIKA DOKUMEN INI ADALAH TARGET (OBJEK) DARI PERATURAN LAIN --}}
            @if ($terkenaDampak->count() > 0)
                @foreach ($terkenaDampak as $td)
                    <div class="alert alert-danger shadow-sm border-start-lg mb-4 d-flex align-items-center" role="alert">
                        <i data-feather="alert-triangle" class="me-3"></i>
                        <div>
                            <strong>DOKUMEN TERIKAT:</strong>
                            {{-- Logika: [Peraturan Baru] telah [Mencabut/Mengubah] [Dokumen Ini] --}}
                            <a href="{{ route('produk-hukum.edit', $td->dokumen->id) }}" class="fw-bold text-danger">
                                {{ $td->dokumen->singkatan_jenis }} Nomor {{ $td->dokumen->nomor }} Tahun
                                {{ $td->dokumen->tahun }}
                            </a>
                            telah <span class="badge bg-danger">{{ $td->tipe_relasi }}</span> dokumen ini.

                            @if ($td->catatan)
                                <div class="small mt-1 text-muted">Catatan: <em>"{{ $td->catatan }}"</em></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

            <form id="formEditProduk" action="{{ route('produk-hukum.update', $dokumen->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xl-8">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white text-primary fw-bold">Informasi Dokumen</div>
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Tipe Dokumen</label>
                                        <input class="form-control" name="tipe_dokumen"
                                            value="{{ $dokumen->tipe_dokumen }}" readonly bg-light>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Jenis Produk Hukum</label>
                                        <select class="form-select" name="jenis" id="jenis_select"
                                            onchange="setSingkatan()">
                                            @foreach (['Peraturan Daerah' => 'PERDA', 'Peraturan Bupati' => 'PERBUP', 'Keputusan Bupati' => 'KEP'] as $val => $singkat)
                                                <option value="{{ $val }}" data-singkat="{{ $singkat }}"
                                                    {{ $dokumen->jenis == $val ? 'selected' : '' }}>{{ $val }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="singkatan_jenis" id="singkatan_jenis_hidden"
                                            value="{{ $dokumen->singkatan_jenis }}">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="small mb-1">Nomor</label>
                                        <input class="form-control" name="nomor" type="text"
                                            value="{{ old('nomor', $dokumen->nomor) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Tahun</label>
                                        <input class="form-control" name="tahun" type="number"
                                            value="{{ old('tahun', $dokumen->tahun) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="small mb-1">Bahasa</label>
                                        <input class="form-control" name="bahasa"
                                            value="{{ old('bahasa', $dokumen->bahasa) }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Judul Lengkap</label>
                                    <textarea class="form-control" name="judul" rows="3" required>{{ old('judul', $dokumen->judul) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 border-start-lg border-warning shadow-sm">
                            <div class="card-header text-warning fw-bold bg-white">Hubungan Relasi (Dokumen ini
                                Mengubah/Mencabut Aturan Lain)</div>
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-4">
                                        <label class="small mb-1">Tipe Relasi</label>
                                        <select class="form-select" name="tipe_relasi">
                                            <option value="">-- Tidak Ada Relasi --</option>
                                            @foreach (['Mengubah', 'Mencabut'] as $rel)
                                                <option value="{{ $rel }}"
                                                    {{ optional($riwayatAktif)->tipe_relasi == $rel ? 'selected' : '' }}>
                                                    {{ $rel }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label class="small mb-1">Peraturan Target (Yang Dicabut/Diubah)</label>
                                        <select class="form-select select2" name="target_dokumen_id">
                                            <option value="">Pilih Peraturan Lama...</option>
                                            @foreach ($semuaDokumen as $sd)
                                                <option value="{{ $sd->id }}"
                                                    {{ optional($riwayatAktif)->target_dokumen_id == $sd->id ? 'selected' : '' }}>
                                                    [{{ $sd->singkatan_jenis }} No {{ $sd->nomor }} Th
                                                    {{ $sd->tahun }}] {{ Str::limit($sd->judul, 60) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="small mb-1">Catatan Relasi</label>
                                    <textarea class="form-control" name="catatan_riwayat" rows="2"
                                        placeholder="Misal: Mencabut sebagian isi pasal...">{{ optional($riwayatAktif)->catatan }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white text-primary fw-bold">Penetapan & Detail Klasifikasi</div>
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Tanggal Ditetapkan</label>
                                        <input class="form-control" type="date" name="tanggal_ditetapkan"
                                            value="{{ $dokumen->tanggal_ditetapkan }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Tanggal Diundangkan</label>
                                        <input class="form-control" type="date" name="tanggal_diundangkan"
                                            value="{{ $dokumen->tanggal_diundangkan }}">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Bidang Hukum</label>
                                        <input class="form-control" name="bidang_hukum"
                                            value="{{ $dokumen->bidang_hukum }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Urusan Pemerintah</label>
                                        <input class="form-control" name="urusan_pemerintah"
                                            value="{{ $dokumen->urusan_pemerintah }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Subjek / Kata Kunci</label>
                                    <input class="form-control" name="subjek" value="{{ $dokumen->subjek }}">
                                </div>
                                <div class="mb-0">
                                    <label class="small mb-1">Sumber (Misal: LD Kab. MBD Tahun 2025 No. 1)</label>
                                    <input class="form-control" name="sumber" value="{{ $dokumen->sumber }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card mb-4 shadow-sm border-start-lg border-info">
                            <div class="card-header bg-white text-info fw-bold">Status Keberlakuan</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1">Status Saat Ini</label>
                                    <select class="form-select fw-bold text-primary" name="status">
                                        @foreach (['Berlaku', 'Berlaku (Diubah)', 'Tidak Berlaku (Dicabut)', 'Tetap'] as $s)
                                            <option value="{{ $s }}"
                                                {{ $dokumen->status == $s ? 'selected' : '' }}>{{ $s }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-0">
                                    <label class="small mb-1">Keterangan Status</label>
                                    <textarea class="form-control" name="keterangan_status" rows="3">{{ $dokumen->keterangan_status }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-white fw-bold">Metadata Lokasi</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1">Pemrakarsa</label>
                                    <input class="form-control" name="pemrakarsa" value="{{ $dokumen->pemrakarsa }}">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Penandatangan</label>
                                    <input class="form-control" name="penandatangan"
                                        value="{{ $dokumen->penandatangan }}">
                                </div>
                                <hr>
                                <div class="small text-muted">
                                    <p class="mb-1"><strong>Lokasi:</strong> {{ $dokumen->lokasi }}</p>
                                    <p class="mb-1"><strong>Tempat:</strong> {{ $dokumen->tempat_penetapan }}</p>
                                    <p class="mb-0"><strong>TEU:</strong> {{ $dokumen->teu_badan_orang }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 shadow-sm border-start-lg border-danger">
                            <div class="card-header bg-white text-danger fw-bold">File Dokumen (PDF)</div>
                            <div class="card-body text-center">
                                @if ($dokumen->file_pdf)
                                    <div class="mb-3">
                                        <i data-feather="file-text" class="text-danger mb-2"
                                            style="width: 48px; height: 48px;"></i>
                                        <div class="small text-truncate">{{ $dokumen->file_pdf }}</div>
                                        <a href="{{ asset('storage/produk-hukum/' . $dokumen->file_pdf) }}"
                                            target="_blank" class="btn btn-xs btn-outline-danger mt-2">Pratinjau PDF</a>
                                    </div>
                                @endif
                                <input type="file" name="file_pdf" class="form-control form-control-sm"
                                    accept=".pdf">
                                <div class="x-small text-muted mt-2">Maks: 20MB (Kosongkan jika tidak ganti)</div>
                            </div>
                        </div>

                        <button type="button" onclick="confirmUpdate()"
                            class="btn btn-primary w-100 shadow-sm py-3 fw-bold">
                            <i data-feather="save" class="me-1"></i> SIMPAN PERUBAHAN
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // 1. Notifikasi Flash Message (Sukses/Error)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Ups!',
                text: "{{ session('error') }}",
            });
        @endif

        // 2. Konfirmasi Sebelum Submit
        function confirmUpdate() {
            Swal.fire({
                title: 'Simpan Perubahan?',
                text: "Pastikan semua data sudah benar sebelum memperbarui sistem.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0061f2',
                cancelButtonColor: '#69707a',
                confirmButtonText: 'Ya, Update!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading state
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Harap tunggu sebentar',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    document.getElementById('formEditProduk').submit();
                }
            });
        }

        // 3. Helper Singkatan
        function setSingkatan() {
            const select = document.getElementById('jenis_select');
            const singkatan = select.options[select.selectedIndex].getAttribute('data-singkat');
            document.getElementById('singkatan_jenis_hidden').value = singkatan;
        }
    </script>
@endpush
