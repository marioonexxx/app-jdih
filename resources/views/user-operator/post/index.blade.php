@extends('layouts.navbar')

@section('content')
    <main>
        <header class="page-header page-header-compact mb-4 border-bottom bg-white">
            <div class="container-xl px-4">
                <div class="page-header-content pt-3">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="list"></i></div>
                                Manajemen Konten Berita
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary shadow-sm">
                                <i class="me-1" data-feather="plus"></i> Tambah Postingan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-4">
            <div class="card card-header-actions shadow-sm">
                <div class="card-header">
                    Daftar Semua Berita
                    <i class="text-muted" data-feather="info" data-bs-toggle="tooltip" data-bs-placement="left"
                        title="Daftar berita yang telah dibuat oleh operator."></i>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover border-bottom">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Image</th>
                                <th>Judul Berita</th>
                                <th>Kategori</th>
                                <th style="width: 120px;">Status</th>
                                <th>Tanggal</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr class="align-middle">
                                    <td>
                                        @if ($post->featured_image)
                                            <img src="{{ asset('storage/' . $post->featured_image) }}"
                                                class="img-thumbnail zoom-img"
                                                style="width: 60px; height: 40px; object-fit: cover; cursor: pointer;"
                                                onclick="showPreview('{{ asset('storage/' . $post->featured_image) }}', '{{ $post->title }}')">
                                        @else
                                            <div class="bg-light text-muted d-flex align-items-center justify-content-center border rounded"
                                                style="width: 60px; height: 40px;">
                                                <i data-feather="image" style="width: 15px;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $post->title }}</div>
                                        <div class="small text-muted">Slug: {{ Str::limit($post->slug, 40) }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-blue-soft text-blue border">
                                            {{ $post->category->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($post->status == 'published')
                                            <span class="badge bg-success-soft text-success border-success">
                                                <i class="me-1 d-none d-md-inline" data-feather="check-circle"
                                                    style="width: 12px;"></i> Published
                                            </span>
                                        @elseif($post->status == 'draft')
                                            <span class="badge bg-warning-soft text-warning border-warning">
                                                <i class="me-1 d-none d-md-inline" data-feather="edit-2"
                                                    style="width: 12px;"></i> Draft
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-secondary-soft text-secondary border-secondary">Archived</span>
                                        @endif
                                    </td>
                                    <td class="small">
                                        {{ $post->created_at->translatedFormat('d F Y') }}
                                        <div class="text-muted text-xs">{{ $post->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="btn btn-icon btn-sm btn-light border text-primary me-2"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i data-feather="edit-2" style="width: 14px;"></i>
                                            </a>

                                            <button type="button"
                                                class="btn btn-icon btn-sm btn-light border text-danger btn-delete"
                                                data-id="{{ $post->id }}" data-bs-toggle="tooltip" title="Hapus">
                                                <i data-feather="trash-2" style="width: 14px;"></i>
                                            </button>
                                        </div>

                                        <form id="delete-form-{{ $post->id }}"
                                            action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Preview Gambar --}}
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="previewTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <img id="previewImg" src="" class="img-fluid rounded shadow-sm border" alt="Preview">
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Styling tambahan agar lebih "Modern Admin" */
        .bg-success-soft {
            background-color: #e1f5ea;
        }

        .bg-warning-soft {
            background-color: #fff4e1;
        }

        .bg-blue-soft {
            background-color: #e1efff;
        }

        .bg-secondary-soft {
            background-color: #f1f2f5;
        }

        .zoom-img:hover {
            transform: scale(1.1);
            transition: 0.3s ease;
        }

        .text-xs {
            font-size: 0.75rem;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi Preview Gambar dengan Modal
        function showPreview(url, title) {
            const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            document.getElementById('previewImg').src = url;
            document.getElementById('previewTitle').innerText = title;
            modal.show();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Notifikasi Sukses
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            // Konfirmasi Hapus SweetAlert
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const postId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Hapus Berita?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e81500',
                        cancelButtonColor: '#69707a',
                        confirmButtonText: 'Ya, Hapus Saja',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + postId).submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
