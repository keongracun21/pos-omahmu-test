@extends('layouts.layout')

@section('title', 'Barang')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link href="{{ secure_asset('css/style.css') }}" rel="stylesheet">

<div class="d-flex vh-100">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="bi bi-card-image fs-5"></i>
            <span>Menu</span>
        </a>
        <a href="#" class="nav-link">
            <i class="bi bi-cursor fs-5"></i>
            <span>PO</span>
        </a>
        <a href="{{ route('laporan.index') }}" class="nav-link">
            <i class="bi bi-file-earmark-bar-graph fs-5"></i>
            <span>Laporan</span>
        </a>
        <a href="{{ route('barang.index') }}" class="nav-link active">
            <i class="bi bi-pie-chart fs-5"></i>
            <span>Barang</span>
        </a>
        @if(Auth::user() && Auth::user()->role === 'admin')
        <a href="{{ route('pengaturan') }}" class="nav-link">
            <i class="bi bi-gear fs-5"></i> Pengaturan
        </a>
        @endif
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
    <div class="d-flex flex-grow-1 ms-4 ps-2">
        <div class="content-area pe-3" style="flex: 1;">
            <h4 class="mb-4 fw-bold" style="color: #1E2431;">Barang</h4>

            <!-- Notifikasi Menu Perlu Restok -->
            @if($lowStockMenus->count() > 0)
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <strong>Perhatian!</strong> Ada {{ $lowStockMenus->count() }} menu yang perlu restok:
                @foreach($lowStockMenus->take(3) as $menu)
                <span class="badge bg-warning text-dark me-1">{{ $menu->nama_menu }} ({{ $menu->kuantitas }}
                    pcs)</span>
                @endforeach
                @if($lowStockMenus->count() > 3)
                <span class="text-muted">dan {{ $lowStockMenus->count() - 3 }} menu lainnya</span>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-4" id="barangTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="stok-menu-tab" data-bs-toggle="tab" data-bs-target="#stok-menu"
                        type="button" role="tab" aria-controls="stok-menu" aria-selected="true">
                        <i class="bi bi-list-ul me-2"></i>Stok Menu
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="restok-menu-tab" data-bs-toggle="tab" data-bs-target="#restok-menu"
                        type="button" role="tab" aria-controls="restok-menu" aria-selected="false">
                        <i class="bi bi-arrow-clockwise me-2"></i>Restok Menu
                        @if($lowStockMenus->count() > 0)
                        <span class="badge bg-danger ms-1">{{ $lowStockMenus->count() }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="stok-bahan-tab" data-bs-toggle="tab" data-bs-target="#stok-bahan"
                        type="button" role="tab" aria-controls="stok-bahan" aria-selected="false">
                        <i class="bi bi-box-seam me-2"></i>Stok Bahan Baku
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="barangTabContent">
                <!-- Tab Stok Menu -->
                <div class="tab-pane fade show active" id="stok-menu" role="tabpanel" aria-labelledby="stok-menu-tab">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-bold" style="color: #1E2431;">
                                <i class="bi bi-list-ul me-2"></i>Stok Menu
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3">ID</th>
                                            <th>Nama Product</th>
                                            <th>Harga Jual</th>
                                            <th>Kuantitas</th>
                                            <th>Kategori</th>
                                            <th>Ketersediaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($menus as $menu)
                                        <tr>
                                            <td class="px-3">{{ $menu->id_menu }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $menu->gambar_produk) }}"
                                                        alt="{{ $menu->nama_menu }}" class="rounded me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                    <span class="fw-medium">{{ $menu->nama_menu }}</span>
                                                </div>
                                            </td>
                                            <td>Rp
                                                {{ number_format($menu->harga, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $menu->kuantitas > 10 ? 'success' : ($menu->kuantitas > 0 ? 'warning' : 'danger') }}">
                                                    {{ $menu->kuantitas }} pcs
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($menu->jenis_menu) }}</span>
                                            </td>
                                            <td>
                                                @if($menu->kuantitas > 10)
                                                <span class="badge bg-success">Tersedia</span>
                                                @elseif($menu->kuantitas > 0)
                                                <span class="badge bg-warning">Hampir Habis</span>
                                                @else
                                                <span class="badge bg-danger">Habis</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-outline-primary"
                                                        onclick="openRestokModal({{ $menu->id_menu }}, '{{ $menu->nama_menu }}', {{ $menu->kuantitas }})">
                                                        <i class="bi bi-plus-circle"></i> Restok
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="confirmDeleteMenu({{ $menu->id_menu }}, '{{ $menu->nama_menu }}')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4 text-muted">
                                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                                Belum ada data menu
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Restok Menu -->
                <div class="tab-pane fade" id="restok-menu" role="tabpanel" aria-labelledby="restok-menu-tab">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold" style="color: #1E2431;">
                                <i class="bi bi-arrow-clockwise me-2"></i>Restok Menu
                            </h5>
                            <button type="button" class="btn btn-sm btn-success" onclick="openBatchRestokModal()">
                                <i class="bi bi-plus-circle"></i> Restok Batch
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3">ID</th>
                                            <th>Nama Menu</th>
                                            <th>Stok Saat Ini</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($lowStockMenus as $menu)
                                        <tr class="{{ $menu->kuantitas == 0 ? 'table-danger' : 'table-warning' }}">
                                            <td class="px-3">{{ $menu->id_menu }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $menu->gambar_produk) }}"
                                                        alt="{{ $menu->nama_menu }}" class="rounded me-2"
                                                        style="width: 40px; height: 40px; object-fit: cover;">
                                                    <span class="fw-medium">{{ $menu->nama_menu }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $menu->kuantitas == 0 ? 'danger' : 'warning' }}">
                                                    {{ $menu->kuantitas }} pcs
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($menu->jenis_menu) }}</span>
                                            </td>
                                            <td>
                                                @if($menu->kuantitas == 0)
                                                <span class="badge bg-danger">Habis</span>
                                                @else
                                                <span class="badge bg-warning">Hampir Habis</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-primary"
                                                        onclick="openRestokModal({{ $menu->id_menu }}, '{{ $menu->nama_menu }}', {{ $menu->kuantitas }})">
                                                        <i class="bi bi-plus-circle"></i> Restok
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger"
                                                        onclick="confirmDeleteMenu({{ $menu->id_menu }}, '{{ $menu->nama_menu }}')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4 text-muted">
                                                <i class="bi bi-check-circle fs-3 d-block mb-2"></i>
                                                Semua menu tersedia dengan stok yang cukup
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Stok Bahan Baku -->
                <div class="tab-pane fade" id="stok-bahan" role="tabpanel" aria-labelledby="stok-bahan-tab">
                    <div class="mb-3 mt-2">
                        <form method="GET" class="row g-2 align-items-end">
                            <div class="col-auto">
                                <label for="tanggal_mulai" class="form-label mb-0">Dari Tanggal</label>
                                <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control"
                                    value="{{ request('tanggal_mulai') }}">
                            </div>
                            <div class="col-auto">
                                <label for="tanggal_selesai" class="form-label mb-0">Sampai Tanggal</label>
                                <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control"
                                    value="{{ request('tanggal_selesai') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-2">
                        <strong>Total Harga Bahan Baku Ditambahkan:</strong>
                        Rp
                        {{ number_format($totalHarga, 0, ',', '.') }}
                    </div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold" style="color: #1E2431;">
                                <i class="bi bi-box-seam me-2"></i>Stok Bahan Baku
                            </h5>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahBahanModal">
                                <i class="bi bi-plus"></i> Tambah Bahan
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="px-3">ID</th>
                                            <th>Nama Bahan</th>
                                            <th>Stok</th>
                                            <th>Satuan</th>
                                            <th>Total Harga</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Ditambahkan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bahanBakus as $bahan)
                                        <tr>
                                            <td class="px-3">{{ $bahan->id_bahan }}</td>
                                            <td class="fw-medium">{{ $bahan->nama_bahan }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $bahan->kuantitas > 10 ? 'success' : ($bahan->kuantitas > 0 ? 'warning' : 'danger') }}">
                                                    {{ $bahan->kuantitas }}
                                                </span>
                                            </td>
                                            </td>
                                            <td>{{ $bahan->satuan }}</td>
                                            <td>Rp
                                                {{ number_format($bahan->harga_total ?? 0, 0, ',', '.') }}
                                            </td>
                                            <td>{{ $bahan->keterangan ?: '-' }}</td>
                                            <td>{{ $bahan->created_at ? $bahan->created_at->format('d-m-Y H:i') : '-' }}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4 text-muted">
                                                <i class="bi bi-box-seam fs-3 d-block mb-2"></i>
                                                Belum ada data bahan baku
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Restok Individual -->
<div class="modal fade" id="restokModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Restok Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="restokForm">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="menuId" name="menu_id">
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="menuNama" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok Saat Ini</label>
                        <input type="number" class="form-control" id="stokSaatIni" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah yang Ditambahkan</label>
                        <input type="number" class="form-control" id="jumlahRestok" name="kuantitas" min="1" required>
                        <small class="text-muted">Masukkan jumlah yang akan ditambahkan ke stok saat ini (minimal
                            1)</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan (Opsional)</label>
                        <textarea class="form-control" name="keterangan" rows="2"
                            placeholder="Contoh: Restok dari supplier"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Restok</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Restok Batch -->
<div class="modal fade" id="batchRestokModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Restok Batch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="batchRestokForm">
                @csrf
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Stok Saat Ini</th>
                                    <th>Jumlah yang Ditambahkan</th>
                                </tr>
                            </thead>
                            <tbody id="batchRestokTableBody">
                                @foreach($lowStockMenus as $menu)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $menu->gambar_produk) }}"
                                                alt="{{ $menu->nama_menu }}" class="rounded me-2"
                                                style="width: 30px; height: 30px; object-fit: cover;">
                                            <span class="fw-medium">{{ $menu->nama_menu }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $menu->kuantitas == 0 ? 'danger' : 'warning' }}">
                                            {{ $menu->kuantitas }} pcs
                                        </span>
                                    </td>
                                    <td>
                                        <input type="hidden" name="restok_items[{{ $loop->index }}][id]"
                                            value="{{ $menu->id_menu }}">
                                        <input type="number" class="form-control form-control-sm"
                                            name="restok_items[{{ $loop->index }}][kuantitas]" min="1" value="0"
                                            style="width: 80px;"
                                            title="Masukkan jumlah yang akan ditambahkan (minimal 1)">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Semua Restok</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus Menu -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>Konfirmasi Hapus Menu
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="bi bi-exclamation-triangle text-danger" style="font-size: 3rem;"></i>
                </div>
                <p class="text-center mb-0">
                    Apakah Anda yakin ingin menghapus menu <strong id="menuNameToDelete"></strong>?
                </p>
                <div class="alert alert-warning mt-3">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Perhatian:</strong> Tindakan ini tidak dapat dibatalkan. Menu dan gambar terkait akan
                    dihapus secara permanen.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Batal
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteMenu()">
                    <i class="bi bi-trash me-1"></i>Hapus Menu
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Bahan Baku -->
<div class="modal fade" id="tambahBahanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Bahan Baku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bahan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Bahan</label>
                        <input type="text" class="form-control" name="nama_bahan" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" class="form-control" name="kuantitas" min="0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Total Harga Stok Bahan Baku</label>
                                <input type="number" class="form-control" name="harga_total" min="0" required
                                    placeholder="Masukkan total harga (Rp)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Satuan</label>
                                <select class="form-select" name="satuan" required>
                                    <option value="">Pilih Satuan</option>
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="gram">Gram (g)</option>
                                    <option value="liter">Liter (L)</option>
                                    <option value="ml">Mililiter (ml)</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                    <option value="pack">Pack</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JS -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
// Fungsi untuk membuka modal restok individual
function openRestokModal(id, nama, stokSaatIni) {
    document.getElementById('menuId').value = id;
    document.getElementById('menuNama').value = nama;
    document.getElementById('stokSaatIni').value = stokSaatIni;
    document.getElementById('jumlahRestok').value = '';

    // Set min value untuk input jumlah restok
    const jumlahRestokInput = document.getElementById('jumlahRestok');
    jumlahRestokInput.min = 1;
    jumlahRestokInput.placeholder = `Masukkan jumlah yang akan ditambahkan (stok saat ini: ${stokSaatIni} pcs)`;

    // Reset preview
    const previewElement = document.getElementById('totalStokPreview');
    if (previewElement) {
        previewElement.textContent = '';
    }

    const modal = new bootstrap.Modal(document.getElementById('restokModal'));
    modal.show();
}

// Fungsi untuk membuka modal restok batch
function openBatchRestokModal() {
    const modal = new bootstrap.Modal(document.getElementById('batchRestokModal'));
    modal.show();
}

// Handle form restok individual
document.getElementById('restokForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const menuId = document.getElementById('menuId').value;
    const jumlahRestok = parseInt(document.getElementById('jumlahRestok').value);
    const stokSaatIni = parseInt(document.getElementById('stokSaatIni').value);

    // Validasi jumlah restok
    if (jumlahRestok <= 0) {
        showAlert('warning', 'Jumlah restok harus lebih dari 0');
        return;
    }

    fetch(`/stok_menu/${menuId}/update-stok`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                kuantitas: jumlahRestok, // Jumlah yang ditambahkan
                keterangan: formData.get('keterangan')
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                bootstrap.Modal.getInstance(document.getElementById('restokModal')).hide();
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showAlert('danger', data.message || 'Gagal melakukan restok');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Terjadi kesalahan saat melakukan restok');
        });
});

// Handle form restok batch
document.getElementById('batchRestokForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const restokItems = [];

    // Ambil data dari form dan validasi
    const inputs = this.querySelectorAll('input[name^="restok_items"]');
    for (let i = 0; i < inputs.length; i += 2) {
        const id = inputs[i].value;
        const kuantitas = parseInt(inputs[i + 1].value);

        if (kuantitas > 0) {
            restokItems.push({
                id: id,
                kuantitas: kuantitas
            }); // Jumlah yang ditambahkan
        }
    }

    if (restokItems.length === 0) {
        showAlert('warning', 'Pilih minimal satu menu untuk direstok');
        return;
    }

    fetch('/barang/restok-batch', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                restok_items: restokItems
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                bootstrap.Modal.getInstance(document.getElementById('batchRestokModal')).hide();
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showAlert('danger', data.message || 'Gagal melakukan restok batch');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Terjadi kesalahan saat melakukan restok batch');
        });
});

// Validasi input jumlah restok secara real-time
document.getElementById('jumlahRestok').addEventListener('input', function() {
    const jumlahRestok = parseInt(this.value) || 0;
    const stokSaatIni = parseInt(document.getElementById('stokSaatIni').value) || 0;
    const totalStok = stokSaatIni + jumlahRestok;

    // Tampilkan preview total stok
    const previewElement = document.getElementById('totalStokPreview');
    if (!previewElement) {
        const preview = document.createElement('small');
        preview.id = 'totalStokPreview';
        preview.className = 'text-muted';
        this.parentNode.appendChild(preview);
    }

    if (jumlahRestok > 0) {
        document.getElementById('totalStokPreview').textContent =
            `Total stok setelah restok: ${totalStok} pcs (${stokSaatIni} + ${jumlahRestok})`;
        document.getElementById('totalStokPreview').className = 'text-success';
    } else {
        document.getElementById('totalStokPreview').textContent = '';
    }
});

// Validasi input batch restok secara real-time
document.addEventListener('input', function(e) {
    if (e.target.name && e.target.name.includes('restok_items') && e.target.name.includes('kuantitas')) {
        const kuantitas = parseInt(e.target.value) || 0;

        if (kuantitas < 0) {
            e.target.classList.add('is-invalid');
            e.target.title = 'Jumlah restok tidak boleh negatif';
        } else {
            e.target.classList.remove('is-invalid');
            e.target.title = '';
        }
    }
});

// Fungsi untuk menampilkan alert
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.style.position = 'fixed';
    alertDiv.style.top = '20px';
    alertDiv.style.right = '20px';
    alertDiv.style.zIndex = '9999';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// Variabel global untuk menyimpan ID menu yang akan dihapus
let menuIdToDelete = null;

// Fungsi untuk konfirmasi hapus menu
function confirmDeleteMenu(id, nama) {
    menuIdToDelete = id;
    document.getElementById('menuNameToDelete').textContent = nama;

    const modal = new bootstrap.Modal(document.getElementById('deleteMenuModal'));
    modal.show();
}

// Fungsi untuk menghapus menu
function deleteMenu() {
    if (!menuIdToDelete) {
        showAlert('danger', 'ID menu tidak ditemukan');
        return;
    }

    // Tampilkan loading pada tombol
    const deleteBtn = document.querySelector('#deleteMenuModal .btn-danger');
    const originalText = deleteBtn.innerHTML;
    deleteBtn.disabled = true;
    deleteBtn.innerHTML =
        '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Menghapus...';

    fetch(`/stok_menu/${menuIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert('success', data.message);
                bootstrap.Modal.getInstance(document.getElementById('deleteMenuModal')).hide();
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showAlert('danger', data.message || 'Gagal menghapus menu');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'Terjadi kesalahan saat menghapus menu');
        })
        .finally(() => {
            // Reset tombol
            deleteBtn.disabled = false;
            deleteBtn.innerHTML = originalText;
            menuIdToDelete = null;
        });
}
</script>
@endsection
