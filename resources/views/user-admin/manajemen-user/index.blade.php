@extends('layouts.navbar')
@section('title', 'Manajemen Operator JDIH')

@section('content')
    <style>
        /* Mencegah icon menghalangi klik pada tombol */
        .btn-datatable i,
        .btn-datatable svg {
            pointer-events: none;
        }
    </style>

    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Manajemen Operator
                            </h1>
                            <div class="page-header-subtitle">Daftar akun petugas pengelola dokumentasi dan informasi hukum
                                JDIH.</div>
                        </div>
                        <div class="col-12 col-xl-auto mt-4">
                            <button class="btn btn-white text-primary fw-500" data-bs-toggle="modal"
                                data-bs-target="#modalTambahOperator">
                                <i class="me-1" data-feather="user-plus"></i> Tambah Operator Baru
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Daftar Operator</div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>WhatsApp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($operators as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $user->nama_lengkap }}</strong></td>
                                    <td><code class="text-primary">{{ $user->name }}</code></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_hp }}</td>
                                    <td>
                                        @if ($user->is_aktif)
                                            <span class="badge bg-green-soft text-green">Aktif</span>
                                        @else
                                            <span class="badge bg-red-soft text-red">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $user->id }}"
                                            title="Edit">
                                            <i data-feather="edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark"
                                            onclick="confirmDelete('{{ $user->id }}')" title="Hapus">
                                            <i data-feather="trash-2"></i>
                                        </button>

                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('manajemen-operator.destroy', $user->id) }}" method="POST"
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

        <div class="modal fade" id="modalTambahOperator" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Petugas Operator</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('manajemen-operator.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="small mb-1">Nama Lengkap & Gelar</label>
                                <input class="form-control" name="nama_lengkap" type="text"
                                    placeholder="Dr. John Doe, S.H." required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">Username (Login)</label>
                                <input class="form-control" name="name" type="text" placeholder="username_op"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">Email</label>
                                <input class="form-control" name="email" type="email" placeholder="name@email.com"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">Nomor WhatsApp</label>
                                <input class="form-control" name="no_hp" type="text" placeholder="0812xxxx" required>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1">Password</label>
                                <input class="form-control" name="password" type="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-primary" type="submit">Simpan Operator</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($operators as $user)
            <div class="modal fade" id="modalEdit{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Operator: {{ $user->name }}</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('manajemen-operator.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="small mb-1">Nama Lengkap & Gelar</label>
                                    <input class="form-control" name="nama_lengkap" type="text"
                                        value="{{ $user->nama_lengkap }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Username</label>
                                    <input class="form-control" name="name" type="text"
                                        value="{{ $user->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Email</label>
                                    <input class="form-control" name="email" type="email"
                                        value="{{ $user->email }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">No. WhatsApp</label>
                                    <input class="form-control" name="no_hp" type="text"
                                        value="{{ $user->no_hp }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Status Keaktifan</label>
                                    <select class="form-select" name="is_aktif">
                                        <option value="1" {{ $user->is_aktif ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ !$user->is_aktif ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="small mb-1">Password Baru (Kosongkan jika tidak ganti)</label>
                                    <input class="form-control" name="password" type="password" placeholder="********">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                <button class="btn btn-primary" type="submit">Update Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // 1. Notifikasi Sukses
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        @endif

        // 2. Notifikasi Error
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                html: '{!! implode('<br>', $errors->all()) !!}',
            });
        @endif

        // 3. Konfirmasi Hapus (Fixed)
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Operator?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e81500',
                cancelButtonColor: '#6900c7',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Pastikan form ditemukan sebelum disubmit
                    const form = document.getElementById('delete-form-' + id);
                    if (form) {
                        form.submit();
                    } else {
                        console.error('Form hapus tidak ditemukan untuk ID: ' + id);
                    }
                }
            });
        }
    </script>
@endsection
