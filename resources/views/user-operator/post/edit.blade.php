@extends('layouts.navbar')

@section('content')
    <main>
        <header class="page-header page-header-compact mb-4 border-bottom bg-white">
            <div class="container-xl px-4">
                <div class="page-header-content pt-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="edit-3"></i></div>
                                Edit Postingan
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a class="btn btn-sm btn-light text-primary" href="{{ route('posts.index') }}">
                                <i class="me-1" data-feather="arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4">
            <form id="editBlogForm" action="{{ route('posts.update', $post->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1">Judul Postingan</label>
                                    <input class="form-control @error('title') is-invalid @enderror" name="title"
                                        type="text" value="{{ old('title', $post->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Konten Lengkap</label>
                                    <textarea id="editor" name="content">{{ old('content', $post->content) }}</textarea>
                                    @error('content')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header">Pengaturan Publikasi</div>
                            <div class="card-body">
                                {{-- Kategori --}}
                                <div class="mb-3">
                                    <label class="small mb-1">Kategori</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id" required>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Gambar --}}
                                <div class="mb-3">
                                    <label class="small mb-1">Gambar Utama</label>
                                    @if ($post->featured_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                class="img-fluid rounded border" style="max-height: 150px;">
                                            <div class="small text-muted mt-1 italic">* Gambar saat ini</div>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                        name="featured_image" accept="image/*">
                                    <div class="small text-muted mt-1">Biarkan kosong jika tidak ingin ganti gambar.</div>
                                </div>

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label class="small mb-1">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status"
                                        required>
                                        <option value="published"
                                            {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published
                                        </option>
                                        <option value="draft"
                                            {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="archived"
                                            {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>Archived
                                        </option>
                                    </select>
                                </div>

                                <hr class="my-4">
                                <button class="btn btn-primary w-100" type="submit">
                                    <i class="me-1" data-feather="check-circle"></i> Perbarui Postingan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 400px;
        }
    </style>
@endsection

@push('scripts')
    {{-- Konsisten menggunakan CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    {{-- Tambahkan SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let editorInstance;

        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            })
            .then(editor => {
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });

        // Sinkronisasi sebelum update & Loading state
        document.getElementById('editBlogForm').addEventListener('submit', function(e) {
            if (editorInstance) {
                document.querySelector('#editor').value = editorInstance.getData();
            }

            // Tampilkan loading sederhana agar user tahu proses sedang berjalan
            Swal.fire({
                title: 'Memperbarui...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        // Notifikasi jika ada error dari validasi Laravel
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ada kesalahan pada input Anda. Silakan cek kembali.',
            });
        @endif
    </script>
@endpush
