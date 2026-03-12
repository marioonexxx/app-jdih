@extends('layouts.navbar')

@section('title', 'Manajemen Slider - JDIH')

@section('content')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-xl px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="image"></i></div>
                                Image Slider Dashboard
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-primary shadow-sm" type="button" data-bs-toggle="modal"
                                data-bs-target="#modalTambah">
                                <i class="me-1" data-feather="plus"></i> Tambah Slider
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Gambar</th>
                                <th>Informasi Slider</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slide)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/public/sliders/' . $slide->image) }}"
                                            class="img-thumbnail rounded"
                                            style="width: 150px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $slide->title }}</div>
                                        <div class="small text-muted">{{ Str::limit($slide->description, 60) }}</div>
                                        @if ($slide->button_link)
                                            <span class="badge bg-light text-primary border mt-1">
                                                <i class="me-1" data-feather="link-2" style="width: 12px;"></i>
                                                {{ $slide->button_text }}
                                            </span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-gray-200 text-dark">{{ $slide->order }}</span></td>
                                    <td>
                                        @if ($slide->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $slide->id }}"
                                            title="Edit">
                                            <i data-feather="edit"></i>
                                        </button>

                                        <button class="btn btn-datatable btn-icon btn-transparent-dark btn-delete"
                                            data-id="{{ $slide->id }}" data-name="{{ $slide->title }}" title="Hapus">
                                            <i data-feather="trash-2"></i>
                                        </button>

                                        <form id="delete-form-{{ $slide->id }}"
                                            action="{{ route('slider.destroy', $slide->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal fade" id="modalEdit{{ $slide->id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header bg-dark text-white">
                                                <h5 class="modal-title text-white">Edit Slider: {{ $slide->title }}</h5>
                                                <button class="btn-close btn-close-white" type="button"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('slider.update', $slide->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="small mb-1">Judul Utama <span
                                                                    class="text-danger">*</span></label>
                                                            <input class="form-control" name="title"
                                                                value="{{ $slide->title }}" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="small mb-1">Urutan Tampil</label>
                                                            <input type="number" class="form-control" name="order"
                                                                value="{{ $slide->order }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Deskripsi/Sub-teks</label>
                                                        <textarea class="form-control" name="description" rows="2">{{ $slide->description }}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="small mb-1">Teks Tombol</label>
                                                            <input class="form-control" name="button_text"
                                                                value="{{ $slide->button_text }}">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="small mb-1">Link Tombol (URL)</label>
                                                            <input class="form-control" name="button_link"
                                                                value="{{ $slide->button_link }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="small mb-1">Ganti Gambar (Biarkan kosong jika tidak
                                                            diubah)</label>
                                                        <input type="file" class="form-control" name="image"
                                                            accept="image/*">
                                                        <div class="form-text">Rekomendasi ukuran: 1920x1080px (Lanskap)
                                                        </div>
                                                    </div>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" name="is_active"
                                                            value="1" {{ $slide->is_active ? 'checked' : '' }}>
                                                        <label class="form-check-label">Status Aktif</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-light" type="button"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button class="btn btn-primary" type="submit">Update Slider</button>
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
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title text-white">Tambah Slider Baru</h5>
                    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small mb-1">Judul Utama <span class="text-danger">*</span></label>
                                <input class="form-control" name="title" placeholder="Contoh: JDIH Kabupaten MBD"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small mb-1">Urutan Tampil</label>
                                <input type="number" class="form-control" name="order" value="0">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Deskripsi/Sub-teks</label>
                            <textarea class="form-control" name="description" placeholder="Masukkan penjelasan singkat..." rows="2"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small mb-1">Teks Tombol</label>
                                <input class="form-control" name="button_text" placeholder="Contoh: Cari Produk Hukum">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small mb-1">Link Tombol (URL)</label>
                                <input class="form-control" name="button_link" placeholder="Contoh: /produk-hukum">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Gambar Slider <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="image" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan Slider</button>
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

            // Konfirmasi Hapus
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    Swal.fire({
                        title: 'Hapus Slider?',
                        text: `Slider "${name}" akan dihapus permanen.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#e81500',
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
