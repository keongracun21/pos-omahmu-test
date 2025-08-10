@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    @vite(['resources/css/style.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="d-flex vh-100">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column align-items-center">
        <a href="#" class="nav-link active">
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
        <a href="{{ route('barang.index') }}" class="nav-link">
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
        <!-- Left: Menu Content -->
        <div class="content-area pe-3" style="flex: 1;">
            <div class="menu-header d-flex justify-content-between align-items-center mb-3">
                <div class="menu-tabs">
                    <button onclick="filterMenu('makanan')">Makanan</button>
                    <button onclick="filterMenu('minuman')">Minuman</button>
                    <button onclick="filterMenu('snack')">Snack</button>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMenuModal"
                    style="border: none; padding: 4px 10px; border-radius: 6px; background-color: #1E2431; color: #fff; font-size: 0.8rem;">
                    <i class="bi bi-plus"></i> Tambah Menu
                </button>
            </div>

            <div class="menu-grid" id="menuGrid">
                @foreach($menus as $menu)
                    <div class="menu-item" data-kategori="{{ $menu->jenis_menu }}">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $menu->gambar_produk) }}"
                                alt="{{ $menu->nama_menu }}"
                                style="width: 100%; height: 100px; border-radius: 6px; cursor: pointer;"
                                onclick="selectMenu('{{ $menu->nama_menu }}', '{{ $menu->harga }}', '{{ asset('storage/' . $menu->gambar_produk) }}')">

                            <!-- Tombol hapus di pojok kanan atas -->
                            <button class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1"
                                style="opacity: 0.8; z-index: 10;"
                                onclick="confirmDeleteMenu({{ $menu->id_menu }}, '{{ $menu->nama_menu }}')"
                                title="Hapus Menu">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <h6 class="mt-2 text-center fw-bold" style="color: #1E2431;">{{ $menu->nama_menu }}</h6>
                        <p class="text-center">Rp
                            {{ number_format($menu->harga, 0, ',', '.') }}
                        </p>
                        <div class="text-center">
                            <span
                                class="badge bg-{{ $menu->kuantitas > 10 ? 'success' : ($menu->kuantitas > 0 ? 'warning' : 'danger') }}">
                                Stok: {{ $menu->kuantitas }} pcs
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Container Panel -->
        <div class="order-panel-container d-flex flex-column gap-3">

            <!-- Order Menu Panel -->
            <div id="orderPanel" class="order-panel">
                <div>
                    <h5>Order Menu</h5>
                    <p class="text-muted mb-2">No. Transaksi:
                        <strong>#{{ 'POS' . date('ymdHis') }}</strong>
                    </p>
                    <div id="orderContent" class="mt-3 d-flex flex-column gap-2">
                        <small class="text-muted">Silahkan pilih menu</small>
                    </div>
                </div>
                <div class="order-footer">
                    <div class="total-info">
                        <small id="totalItemsLabel">0 items</small>
                        <div id="totalHargaLabel">Rp 0</div>
                    </div>
                    <form action="{{ route('order.submit') }}" method="POST" id="orderForm">
                        @csrf
                        <input type="hidden" name="id_transaksi"
                            value="{{ 'POS' . date('ymdHis') }}">
                        <input type="hidden" name="total" id="totalInput">
                        <button type="submit" class="btn-order">
                            <i class="bi bi-save-fill"></i> Order
                        </button>
                    </form>
                </div>
            </div>

            <div id="paymentPanel" class="order-panel d-none">
                <div>
                    <h5>Payment</h5>
                    <div id="paymentOptions" class="mt-3 d-flex justify-content-between text-center">
                        <div class="payment-method" data-method="credit" onclick="selectPayment('credit')">
                            <i class="bi bi-credit-card-2-front fs-3"></i>
                            <div>Credit Card</div>
                        </div>
                        <div class="payment-method" data-method="cash" onclick="selectPayment('cash')">
                            <i class="bi bi-cash-coin fs-3"></i>
                            <div>Cash</div>
                        </div>
                        <div class="payment-method" data-method="qr" onclick="selectPayment('qr')">
                            <i class="bi bi-qr-code-scan fs-3"></i>
                            <div>Scanner</div>
                        </div>
                    </div>

                    <!-- Credit Card Form -->
                    <div id="creditCardForm" class="mt-4 d-none">
                        <h6>Credit Card Info</h6>
                        <div class="mb-2">
                            <label class="form-label">Nama Pemilik Kartu</label>
                            <input type="text" class="form-control" placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Nomor Kartu</label>
                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                        </div>
                        <div class="d-flex gap-2 mb-3">
                            <div class="flex-fill">
                                <label class="form-label">Tgl Kedaluwarsa</label>
                                <input type="month" class="form-control">
                            </div>
                            <div class="flex-fill">
                                <label class="form-label">CVV</label>
                                <input type="text" class="form-control" placeholder="123" maxlength="3">
                            </div>
                        </div>
                    </div>

                    <!-- Cash Payment Form -->
                    <div id="cashForm" class="mt-4 d-none">
                        <h6>Cash Payment</h6>
                        <div class="mb-2">
                            <label class="form-label">Jumlah Bayar</label>
                            <input type="number" class="form-control" id="jumlahBayarInput"
                                placeholder="Masukkan nominal" oninput="hitungKembalian()">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Kembalian</label>
                            <input type="text" class="form-control" id="kembalianOutput" readonly>
                        </div>
                    </div>

                    <!-- QR Code Form -->
                    <div id="qrForm" class="mt-4 d-none text-center">
                        <h6>QR Code Payment</h6>
                        <p>Silakan scan QR di bawah untuk membayar</p>
                        <img src="https://api.qrserver.com/v1/create-qr-code/?data=BayarPOSOmahMU&size=150x150"
                            alt="QR Code">
                        <p class="text-muted mt-2"><small>Setelah pembayaran berhasil, klik tombol di bawah</small></p>
                    </div>
                </div>

                <div class="order-footer mt-4">
                    <div class="total-info">
                        <small id="totalItemsLabelPayment">0 items</small>
                        <div id="totalHargaLabelPayment">Rp 0</div>
                    </div>
                    <button class="btn-order" onclick="submitPayment()">
                        <i class="bi bi-save-fill"></i> Bayar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade" id="tambahMenuModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('stok_menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Upload Gambar -->
                    <div class="mb-3 text-center">
                        <div class="image-upload-container mb-2">
                            <img id="previewGambar" src="{{ asset('img/placeholder-image.jpg') }}"
                                class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <input type="file" class="form-control d-none" id="gambarMenu" name="gambar_produk"
                            accept="image/*">
                        <button type="button" class="btn btn-sm btn-outline-secondary"
                            onclick="document.getElementById('gambarMenu').click()">
                            <i class="bi bi-image"></i> Pilih Gambar
                        </button>
                        <small class="text-muted d-block mt-1">Format: JPG/PNG (Maks. 2MB)</small>
                    </div>

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="jenis_menu" required>
                            <option value="" selected disabled>Pilih Kategori</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>

                    <!-- Nama Menu -->
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu"
                            placeholder="Contoh: Nasi Goreng Spesial" required>
                    </div>

                    <!-- Kuantitas -->
                    <div class="mb-3">
                        <label class="form-label">Kuantitas</label>
                        <input type="number" class="form-control" name="kuantitas" min="1" placeholder="Contoh: 50"
                            required>
                    </div>


                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga" min="1000" step="500" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Menu</button>
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

<!-- JS -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    document.getElementById('orderForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Cegah submit form
        const totalLabel = document.getElementById('totalHargaLabel').textContent;
        const totalNumber = parseInt(totalLabel.replace(/[^\d]/g, '')) || 0;
        document.getElementById('totalInput').value = totalNumber;
        goToPayment(); // Pindah ke panel payment
    });

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

</script>

@endsection
