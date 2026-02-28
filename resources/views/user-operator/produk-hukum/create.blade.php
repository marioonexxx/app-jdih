@extends('layouts.navbar')

@section('title', 'Tambah Produk Hukum - JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-plus"></i></div>
                                Tambah Produk Hukum Baru
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('produk-hukum.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-4">
            {{-- Alert untuk menampilkan error validasi jika ada yang terlewat --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">Terjadi Kesalahan!</h5>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="formProdukHukum" action="{{ route('produk-hukum.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-8">
                        {{-- KARTU 1: INFORMASI UTAMA --}}
                        <div class="card mb-4">
                            <div class="card-header text-primary fw-bold">Informasi Umum</div>
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="jenis">Jenis Produk Hukum <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('jenis') is-invalid @enderror" name="jenis"
                                            id="jenis_select" required onchange="setSingkatan()">
                                            <option value="" selected disabled>Pilih Jenis...</option>
                                            <option value="Peraturan Daerah" data-singkat="PERDA"
                                                {{ old('jenis') == 'Peraturan Daerah' ? 'selected' : '' }}>Peraturan Daerah
                                                (PERDA)</option>
                                            <option value="Peraturan Bupati" data-singkat="PERBUP"
                                                {{ old('jenis') == 'Peraturan Bupati' ? 'selected' : '' }}>Peraturan Bupati
                                                (PERBUP)</option>
                                            <option value="Keputusan Bupati" data-singkat="KEP"
                                                {{ old('jenis') == 'Keputusan Bupati' ? 'selected' : '' }}>Keputusan Bupati
                                                (KEP)</option>
                                        </select>
                                        <input type="hidden" name="singkatan_jenis" id="singkatan_jenis_hidden"
                                            value="{{ old('singkatan_jenis') }}">
                                        @error('jenis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Nomor <span class="text-danger">*</span></label>
                                        <input class="form-control @error('nomor') is-invalid @enderror" name="nomor"
                                            type="text" placeholder="Contoh: 14" value="{{ old('nomor') }}" required>
                                        @error('nomor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label class="small mb-1">Tahun <span class="text-danger">*</span></label>
                                        <input class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                            type="number" value="{{ old('tahun', date('Y')) }}" required>
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Judul / Tentang <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('judul') is-invalid @enderror" name="judul" rows="3"
                                        placeholder="Masukkan judul lengkap peraturan..." required>{{ old('judul') }}</textarea>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- KARTU 2: RIWAYAT (Sangat penting untuk status Dicabut/Diubah) --}}
                        <div class="card mb-4 border-start-lg border-warning shadow-sm">
                            <div class="card-header text-warning fw-bold">Hubungan Riwayat Peraturan (Opsional)</div>
                            <div class="card-body">
                                <div class="alert alert-yellow small mb-3">
                                    Isi bagian ini <strong>hanya jika</strong> peraturan baru ini mencabut atau mengubah
                                    peraturan yang sudah ada di database.
                                </div>
                                <div class="row gx-3">
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1">Tipe Relasi</label>
                                        <select class="form-select @error('tipe_relasi') is-invalid @enderror"
                                            name="tipe_relasi">
                                            <option value="">-- Tidak Ada Relasi --</option>
                                            <option value="Mencabut"
                                                {{ old('tipe_relasi') == 'Mencabut' ? 'selected' : '' }}>Mencabut</option>
                                            <option value="Mengubah"
                                                {{ old('tipe_relasi') == 'Mengubah' ? 'selected' : '' }}>Mengubah</option>
                                        </select>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="small mb-1">Peraturan Target (Yang Dicabut/Diubah)</label>
                                        <select class="form-select select2" name="target_dokumen_id">
                                            <option value="">Cari & Pilih Peraturan Lama...</option>
                                            @foreach ($semuaDokumen as $doc)
                                                <option value="{{ $doc->id }}"
                                                    {{ old('target_dokumen_id') == $doc->id ? 'selected' : '' }}>
                                                    [{{ $doc->singkatan_jenis }} No. {{ $doc->nomor }} Th
                                                    {{ $doc->tahun }}] {{ Str::limit($doc->judul, 80) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="small mb-1">Catatan Riwayat</label>
                                    <textarea class="form-control" name="catatan_riwayat" rows="2"
                                        placeholder="Contoh: Mencabut seluruh isi Perda No. 1 Tahun 2010">{{ old('catatan_riwayat') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- KARTU 3: DATA TAMBAHAN --}}
                        <div class="card mb-4">
                            <div class="card-header text-primary fw-bold">Data Teknis & Klasifikasi</div>
                            <div class="card-body">
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Tanggal Ditetapkan</label>
                                        <input class="form-control" name="tanggal_ditetapkan" type="date"
                                            value="{{ old('tanggal_ditetapkan') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Tanggal Diundangkan</label>
                                        <input class="form-control" name="tanggal_diundangkan" type="date"
                                            value="{{ old('tanggal_diundangkan') }}">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Bidang Hukum</label>
                                        <input class="form-control" name="bidang_hukum" type="text"
                                            placeholder="Contoh: Hukum Administrasi Negara"
                                            value="{{ old('bidang_hukum') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Urusan Pemerintah</label>
                                        <input class="form-control" name="urusan_pemerintah" type="text"
                                            value="{{ old('urusan_pemerintah', '-') }}">
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label class="small mb-1">Sumber</label>
                                    <input class="form-control" name="sumber" type="text"
                                        placeholder="Contoh: LD Kab. MBD Tahun 2024 No. 14" value="{{ old('sumber') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN (SIDEBAR) --}}
                    <div class="col-xl-4">
                        {{-- UPLOAD FILE --}}
                        <div class="card mb-4">
                            <div class="card-header text-primary fw-bold">File Dokumen (PDF) <span
                                    class="text-danger">*</span></div>
                            <div class="card-body text-center p-4">
                                <i class="text-gray-400 mb-2" data-feather="file-text"
                                    style="width: 3rem; height: 3rem;"></i>
                                <input class="form-control @error('file_pdf') is-invalid @enderror" type="file"
                                    name="file_pdf" accept="application/pdf" required>
                                @error('file_pdf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="small text-muted mt-2">Format PDF, Maksimal 20MB</div>
                            </div>
                        </div>

                        {{-- STATUS PERATURAN --}}
                        <div class="card mb-4">
                            <div class="card-header text-primary fw-bold">Status & Pengesahan</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1">Status Peraturan <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status"
                                        required>
                                        {{-- Sesuaikan value dengan Enum di Database Anda --}}
                                        <option value="Berlaku" {{ old('status') == 'Berlaku' ? 'selected' : '' }}>Berlaku
                                        </option>
                                        <option value="Berlaku (Diubah)"
                                            {{ old('status') == 'Berlaku (Diubah)' ? 'selected' : '' }}>Berlaku (Diubah)
                                        </option>
                                        <option value="Tidak Berlaku (Dicabut)"
                                            {{ old('status') == 'Tidak Berlaku (Dicabut)' ? 'selected' : '' }}>Tidak
                                            Berlaku (Dicabut)</option>
                                        <option value="Tetap" {{ old('status') == 'Tetap' ? 'selected' : '' }}>Tetap
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Pemrakarsa / OPD</label>
                                    <input class="form-control" name="pemrakarsa" type="text"
                                        placeholder="Contoh: Bagian Hukum" value="{{ old('pemrakarsa') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Penandatangan</label>
                                    <input class="form-control" name="penandatangan" type="text"
                                        placeholder="Nama Bupati / Sekda" value="{{ old('penandatangan') }}">
                                </div>
                                <div class="mb-0">
                                    <label class="small mb-1">Keterangan Status</label>
                                    <textarea class="form-control" name="keterangan_status" rows="2" placeholder="Catatan tambahan status...">{{ old('keterangan_status') }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ENTITAS (HIDDEN/DEFAULT) --}}
                        <input type="hidden" name="lokasi" value="Kabupaten Maluku Barat Daya">
                        <input type="hidden" name="teu_badan_orang" value="Maluku Barat Daya(Kabupaten)">
                        <input type="hidden" name="tempat_terbit" value="Tiakur">
                        <input type="hidden" name="bahasa" value="Indonesia">

                        <button class="btn btn-primary w-100 shadow-sm py-3" type="submit">
                            <i data-feather="save" class="me-1"></i> <strong>SIMPAN DOKUMEN</strong>
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
        // Fungsi Otomatisasi Singkatan
        function setSingkatan() {
            const select = document.getElementById('jenis_select');
            const singkatan = select.options[select.selectedIndex].getAttribute('data-singkat');
            document.getElementById('singkatan_jenis_hidden').value = singkatan;
        }

        // Jalankan saat load jika ada data lama
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('jenis_select').value) {
                setSingkatan();
            }
        });

        // SweetAlert Konfirmasi
        document.getElementById('formProdukHukum').addEventListener('submit', function(e) {
            e.preventDefault();

            // Cek apakah file sudah dipilih
            const fileInput = this.querySelector('input[type="file"]');
            if (!fileInput.value) {
                Swal.fire('Error', 'Silakan pilih file PDF terlebih dahulu!', 'error');
                return;
            }

            Swal.fire({
                title: 'Simpan Produk Hukum?',
                text: "Pastikan nomor, tahun, dan file sudah sesuai.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0061f2',
                cancelButtonColor: '#69707a',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan loading saat proses upload
                    Swal.fire({
                        title: 'Sedang Menyimpan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    this.submit();
                }
            });
        });
    </script>
@endpush
