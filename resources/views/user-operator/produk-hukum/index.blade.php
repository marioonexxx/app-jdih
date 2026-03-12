@extends('layouts.navbar')

@section('title', 'Daftar Produk Hukum - JDIH MBD')

@section('content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="database"></i></div>
                                Database Produk Hukum
                            </h1>
                            <div class="page-header-subtitle">Kelola semua dokumen peraturan daerah dan keputusan bupati
                            </div>
                        </div>
                        <div class="col-12 col-xl-auto mt-4">
                            <a class="btn btn-white text-primary shadow-sm" href="{{ route('produk-hukum.create') }}">
                                <i class="me-1" data-feather="plus"></i> Tambah Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <div class="card card-header-actions mb-4">
                <div class="card-header">
                    Daftar Produk Hukum
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton"
                            type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                data-feather="more-vertical"></i></button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                            aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-url" href="#!">Export Excel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Jenis & Nomor</th>
                                    <th>Judul / Tentang</th>
                                    <th>Status</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dokumen as $index => $item)
                                    <tr>
                                        <td>{{ $dokumen->firstItem() + $index }}</td>
                                        <td>
                                            <div class="fw-bold text-primary">{{ $item->singkatan_jenis }}</div>
                                            <div class="small text-muted">No. {{ $item->nomor }} Th {{ $item->tahun }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-xs fw-700 text-uppercase text-muted mb-1">Judul:</div>
                                            <div class="small fw-500">{{ Str::limit($item->judul, 150) }}</div>
                                        </td>
                                        <td>
                                            @if ($item->status == 'Berlaku')
                                                <span class="badge bg-green-soft text-green">Berlaku</span>
                                            @elseif($item->status == 'Tidak Berlaku')
                                                <span class="badge bg-red-soft text-red">Tidak Berlaku</span>
                                            @else
                                                <span class="badge bg-blue-soft text-blue">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->file_pdf)
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                    href="{{ asset('storage/produk-hukum/' . $item->file_pdf) }}"
                                                    target="_blank">
                                                    <i class="text-danger" data-feather="file-text"></i>
                                                </a>
                                            @else
                                                <span class="text-muted small italic">No File</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                {{-- Tombol Preview (Show) --}}
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                    href="{{ route('produk-hukum.show', $item->id) }}"
                                                    title="Preview Dokumen">
                                                    <i data-feather="eye"></i>
                                                </a>

                                                {{-- Tombol Edit --}}
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                    href="{{ route('produk-hukum.edit', $item->id) }}" title="Edit Data">
                                                    <i data-feather="edit"></i>
                                                </a>

                                                {{-- Form Delete --}}
                                                <form id="delete-form-{{ $item->id }}"
                                                    action="{{ route('produk-hukum.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-datatable btn-icon btn-transparent-dark btn-delete"
                                                        data-id="{{ $item->id }}" title="Hapus Data">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data produk hukum.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $dokumen->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Konfirmasi Hapus dengan SweetAlert2
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Hapus Dokumen?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e81500',
                    cancelButtonColor: '#69707a',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });

        // Notifikasi Sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
@endpush
