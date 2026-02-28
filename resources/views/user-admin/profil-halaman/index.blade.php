@extends('layouts.navbar')
@section('title', 'Manajemen Profil Halaman JDIH Kabupaten Maluku Barat Daya')

@section('content')
    <div class="bg-light min-vh-100">
        <header class="page-header page-header-compact page-header-light border-bottom bg-white">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Pengaturan Profil Halaman
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 pt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card shadow-sm border-0">
                    <div class="card-header border-bottom bg-white">
                        <ul class="nav nav-tabs card-header-tabs" id="profilTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-visi">Visi</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-misi">Misi</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-struktur">Struktur</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-hukum">Hukum</a></li>
                        </ul>
                    </div>

                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-visi" role="tabpanel">
                                <label class="small mb-2 fw-bold text-primary">VISI INSTANSI</label>
                                <textarea name="visi" class="editor-kantor">{{ $profil->visi ?? '' }}</textarea>
                            </div>
                            <div class="tab-pane fade" id="tab-misi" role="tabpanel">
                                <label class="small mb-2 fw-bold text-primary">MISI INSTANSI</label>
                                <textarea name="misi" class="editor-kantor">{{ $profil->misi ?? '' }}</textarea>
                            </div>

                            <div class="tab-pane fade" id="tab-struktur" role="tabpanel">
                                <label class="small mb-2 fw-bold text-primary">UNGGAH GAMBAR STRUKTUR ORGANISASI</label>
                                <div class="mb-3">
                                    <input type="file" name="struktur_organisasi" class="form-control" id="imgInput"
                                        accept="image/*">
                                    <div class="form-text text-muted">Format: JPG, PNG, atau WEBP. Rekomendasi lebar 1200px.
                                    </div>
                                </div>

                                <div class="border rounded p-3 text-center bg-light" style="min-height: 200px;">
                                    <p class="small text-muted mb-2">Pratinjau Gambar:</p>
                                    @if ($profil && $profil->struktur_organisasi)
                                        <img src="{{ asset('storage/profil/' . $profil->struktur_organisasi) }}"
                                            id="imgPreview" class="img-fluid rounded shadow-sm" style="max-height: 500px;">
                                    @else
                                        <img src="" id="imgPreview" class="img-fluid rounded shadow-sm d-none"
                                            style="max-height: 500px;">
                                        <div id="no-img" class="py-5 text-muted">
                                            <i data-feather="image" style="width: 50px; height: 50px;"></i>
                                            <p>Belum ada gambar yang diunggah.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-hukum" role="tabpanel">
                                <label class="small mb-2 fw-bold text-primary">DASAR HUKUM</label>
                                <textarea name="dasar_hukum" class="editor-kantor">{{ $profil->dasar_hukum ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-light text-end">
                        <button class="btn btn-primary px-4 shadow-sm fw-600" type="submit">
                            <i data-feather="save" class="me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .tab-content>.tab-pane {
            display: block !important;
            visibility: hidden;
            height: 0;
            overflow: hidden;
        }

        .tab-content>.active {
            visibility: visible;
            height: auto;
        }

        .ck-editor__editable {
            min-height: 350px !important;
        }

        .nav-tabs .nav-link {
            font-weight: 600;
            color: #69707a;
            border: none;
            padding: 1rem 1.25rem;
        }

        .nav-tabs .nav-link.active {
            color: #0061f2;
            border-bottom: 3px solid #0061f2;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        // Preview Image Script
        imgInput.onchange = evt => {
            const [file] = imgInput.files
            if (file) {
                imgPreview.src = URL.createObjectURL(file)
                imgPreview.classList.remove('d-none');
                if (document.getElementById('no-img')) document.getElementById('no-img').classList.add('d-none');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.editor-kantor').forEach(el => {
                ClassicEditor.create(el, {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList',
                        'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo'
                    ],
                }).then(editor => {
                    document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(tabEl => {
                        tabEl.addEventListener('shown.bs.tab', () => {
                            editor.ui.view.editable.element.style.minHeight =
                                "350px";
                        });
                    });
                });
            });
        });
    </script>
@endpush
