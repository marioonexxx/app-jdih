@extends('layouts.navbar')

@section('title', 'Manajemen Kategori - JDIH')

@section('content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="grid"></i></div>
                                Kategori Blog
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-light text-primary shadow-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalTambah">
                                <i class="me-1" data-feather="plus"></i> Tambah Kategori
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Kategori</th>
                                <th>Slug</th>
                                <th>Deskripsi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="fw-bold text-dark">{{ $cat->name }}</span></td>
                                    <td><code class="text-pink">{{ $cat->slug }}</code></td>
                                    <td>{{ Str::limit($cat->description ?? '-', 50) }}</td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $cat->id }}"
                                            title="Edit">
                                            <i data-feather="edit"></i>
                                        </button>

                                        <button class="btn btn-datatable btn-icon btn-transparent-dark btn-delete"
                                            data-id="{{ $cat->id }}" data-name="{{ $cat->name }}" title="Hapus">
                                            <i data-feather="trash-2"></i>
                                        </button>

                                        <form id="delete-form-{{ $cat->id }}"
                                            action="{{ route('category.destroy', $cat->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="modalEdit{{ $cat->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editModalLabel{{ $cat->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title text-white" id="editModalLabel{{ $cat->id }}">
                                                    Edit
                                                    Kategori: {{ $cat->name }}</h5>
                                                <button class="btn-close btn-close-white" type="button"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('category.update', $cat->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Nama Kategori <span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" name="name"
                                                            value="{{ $cat->name }}" required>
                                                    </div>
                                                    <div class="mb-0">
                                                        <label class="small mb-1">Deskripsi</label>
                                                        <textarea class="form-control" name="description" rows="3">{{ $cat->description }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-light" type="button"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white" id="tambahModalLabel">Tambah Kategori Baru</h5>
                    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small mb-1">Nama Kategori <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" placeholder="Masukkan nama kategori..." required>
                        </div>
                        <div class="mb-0">
                            <label class="small mb-1">Deskripsi</label>
                            <textarea class="form-control" name="description" placeholder="Penjelasan singkat kategori..." rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan Kategori</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Notifikasi Sukses
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Notifikasi Error Validasi
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: "{{ $errors->first() }}"
                });
            @endif

            // Konfirmasi Hapus Data
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');

                    Swal.fire({
                        title: 'Hapus Kategori?',
                        text: `Kategori "${name}" akan dihapus permanen.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e81500',
                        cancelButtonColor: '#69707a',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`delete-form-${id}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
