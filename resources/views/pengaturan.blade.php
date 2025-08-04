@extends('layouts.layout')

@section('title', 'Pengaturan Profil')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">

<div class="d-flex vh-100">
    <!-- Sidebar Utama -->
    <div class="sidebar d-flex flex-column align-items-center">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="bi bi-card-image fs-5"></i>
            <span>Menu</span>
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-cursor fs-5"></i>
            <span>PO</span>
        </a>
        <a href="laporan" class="nav-link">
            <i class="bi bi-file-earmark-bar-graph fs-5"></i>
            <span>Laporan</span>
        </a>
        <a href="{{ route('barang.index') }}" class="nav-link">
            <i class="bi bi-pie-chart fs-5"></i>
            <span>Barang</span>
        </a>
        <a href="{{ route('pengaturan') }}" class="nav-link active">
            <i class="bi bi-gear fs-5"></i>
            <span>Pengaturan</span>
        </a>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link text-danger"
                style="background:none; border:none; padding:0; width:70px;">
                <i class="bi bi-box-arrow-right fs-5"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="d-flex flex-grow-1">
        <!-- Sidebar Pengaturan Minimalis -->
        <div class="settings-sidebar bg-white" style="width: 180px; border-right: 1px solid #e5e7eb;">
            <div class="p-2">
                <ul class="nav flex-column settings-nav gap-1">
                    <li class="nav-item">
                        <a class="nav-link active" href="#profile" data-bs-toggle="tab">
                            Profil Saya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#access" data-bs-toggle="tab">
                            Management Akses
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content Area dengan padding kiri lebih besar -->
        <div class="content-area ps-5 pe-4 py-4 flex-grow-1" style="margin-left: 15px; background-color: #f8f9fa;">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="tab-content">
                <!-- Tab Profil Saya -->
                <div class="tab-pane fade show active" id="profile">
                    <!-- Profile Header -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="position-relative">
                            <img src="{{ asset('img/profile-picture.jpg') }}" class="rounded-circle"
                                style="width: 80px; height: 80px; object-fit: cover;" alt="Profile Picture">
                            <button
                                class="btn btn-sm btn-secondary position-absolute bottom-0 end-0 rounded-circle p-1">
                                <i class="bi bi-camera-fill"></i>
                            </button>
                        </div>
                        <div class="ms-4">
                            <h4 class="mb-1">{{ $user->name }}</h4>
                            <span class="badge bg-primary">{{ $user->role ?? 'User' }}</span>
                        </div>
                    </div>

                    <h4 class="mb-4">Informasi Personal</h4>

                    <form action="{{ route('pengaturan.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control input-custom-plain"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control input-custom-plain"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Password Baru dan Konfirmasi Password (Bersampingan) -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-control input-custom-plain">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control input-custom-plain">
                            </div>
                        </div>
                        <small class="text-muted d-block mb-4">Kosongkan jika tidak ingin mengubah password.</small>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-cancel">
                                <i class="bi bi-x-lg me-2"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-save">
                                <i class="bi bi-save-fill me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tab Management Akses -->
                <div class="tab-pane fade" id="access">
                    <div class="card shadow-sm p-4">
                        <h4 class="mb-4">Management Akses</h4>

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <!-- Form Tambah User Baru -->
                        <div class="mb-5">
                            <h5 class="mb-3">Tambah User Baru</h5>
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf

                                <div class="row g-3">
                                    <!-- Nama -->
                                    <div class="col-md-6">
                                        <label for="new_name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="new_name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="new_email" class="form-label">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="new_email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Role -->
                                    <div class="col-md-6">
                                        <label for="new_role" class="form-label">Role</label>
                                        <select class="form-select @error('role') is-invalid @enderror" id="new_role"
                                            name="role" required>
                                            <option value="" selected disabled>Pilih Role</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>
                                                Kasir</option>
                                        </select>
                                        @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <label for="new_password" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="new_password" name="password" required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password Confirmation -->
                                    <div class="col-md-6">
                                        <label for="password_confirmation" class="form-label">Konfirmasi
                                            Password</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                    </div>
                                </div>

                                <!-- Tombol Submit -->
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i> Tambah User
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Daftar User -->
                        <div class="mt-5">
                            <h5 class="mb-3">Daftar Pengguna</h5>
                            @if($users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'primary' }}">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning"
                                                    onclick="openEditUserModal({{ $user->user_id }})">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <form action="{{ route('users.destroy', $user->user_id) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger ms-1">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-3">
                                <i class="bi bi-people fs-3 text-muted"></i>
                                <p class="text-muted mt-2">Belum ada data pengguna</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_user_id" name="user_id">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <select class="form-select" id="edit_role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Password Baru (opsional)</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
function openEditUserModal(userId) {
    fetch('/users/' + userId + '/edit')
        .then(res => res.json())
        .then(user => {
            document.getElementById('editUserForm').action = '/users/' + userId;
            document.getElementById('edit_name').value = user.name;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_role').value = user.role;
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();
        });
}
</script>

@endsection