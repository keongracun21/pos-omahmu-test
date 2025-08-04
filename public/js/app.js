let orders = {};

function selectMenu(nama, harga, imgPath) {
    // Cek apakah menu sudah ada di order
    if (orders[nama]) {
        // Jika sudah ada, cek stok tersedia
        const currentQty = orders[nama].qty;
        const availableStock = getMenuStock(nama); // Fungsi untuk cek stok dari DOM

        if (currentQty >= availableStock) {
            showAlert("warning", `Stok ${nama} hanya tersedia ${availableStock} pcs`);
            return;
        }

        orders[nama].qty += 1;
    } else {
        // Jika menu baru, cek stok tersedia
        const availableStock = getMenuStock(nama);

        if (availableStock <= 0) {
            showAlert("warning", `${nama} sedang tidak tersedia`);
            return;
        }

        orders[nama] = {
            nama: nama,
            harga: harga,
            qty: 1,
            img: imgPath,
        };
    }
    renderOrderPanel();
}

function changeQty(nama, delta) {
    if (orders[nama]) {
        orders[nama].qty += delta;
        if (orders[nama].qty <= 0) {
            delete orders[nama];
        }
        renderOrderPanel();
    }
}

function renderOrderPanel() {
    const container = document.getElementById("orderContent");
    container.innerHTML = "";

    let totalItems = 0;
    let totalHarga = 0;

    for (let key in orders) {
        const item = orders[key];
        totalItems += item.qty;
        totalHarga += item.harga * item.qty;

        const element = document.createElement("div");
        element.className =
            "d-flex align-items-center border rounded p-2 position-relative";
        element.innerHTML = `
            <div style="width: 5px; height: 100%; background-color: #1E293B; position: absolute; left: 0; top: 0; border-top-left-radius: 6px; border-bottom-left-radius: 6px;"></div>
            <img src="${item.img}" alt="${
            item.nama
        }" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px; margin-left: 10px; margin-right: 10px;">
            <div class="flex-grow-1">
                <div class="fw-bold">${item.nama}</div>
                <div>Rp ${item.harga.toLocaleString()}</div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm px-2" style="background-color:#1E293B; color:white;" onclick="changeQty('${
                    item.nama
                }', -1)">-</button>
                <span>${item.qty}</span>
                <button class="btn btn-sm px-2" style="background-color:#1E293B; color:white;" onclick="changeQty('${
                    item.nama
                }', 1)">+</button>
            </div>
        `;
        container.appendChild(element);
    }

    if (totalItems === 0) {
        container.innerHTML =
            '<small class="text-muted">Silahkan pilih menu</small>';
    }

    document.getElementById(
        "totalItemsLabel"
    ).innerText = `${totalItems} items`;
    document.getElementById(
        "totalHargaLabel"
    ).innerText = `Rp ${totalHarga.toLocaleString()}`;
}

function filterMenu(kategori) {
    const allMenuItems = document.querySelectorAll(".menu-item");
    allMenuItems.forEach((item) => {
        item.style.display =
            item.getAttribute("data-kategori") === kategori ? "block" : "none";
    });

    // Tambahkan highlight ke tombol aktif
    document
        .querySelectorAll(".menu-tabs button")
        .forEach((btn) => btn.classList.remove("active"));
    event.target.classList.add("active");
}

function goToPayment() {
    const totalItems = document.getElementById("totalItemsLabel").innerText;
    const totalHarga = document.getElementById("totalHargaLabel").innerText;

    if (totalItems === "0 items") {
        alert("Silakan pilih menu terlebih dahulu!");
        return;
    }

    document.getElementById("orderPanel").classList.add("d-none");
    document.getElementById("paymentPanel").classList.remove("d-none");

    document.getElementById("totalItemsLabelPayment").innerText = totalItems;
    document.getElementById("totalHargaLabelPayment").innerText = totalHarga;
}

function goBackToOrder() {
    document.getElementById("paymentPanel").classList.add("d-none");
    document.getElementById("orderPanel").classList.remove("d-none");
}

function handlePayment(method) {
    const metode =
        method === "credit" ?
        "Credit Card" :
        method === "cash" ?
        "Cash" :
        "QR Code";
    alert(`Pembayaran dengan ${metode} berhasil!`);

    // Reset order
    document.getElementById("orderContent").innerHTML =
        '<small class="text-muted">Silahkan pilih menu</small>';
    document.getElementById("totalItemsLabel").innerText = "0 items";
    document.getElementById("totalHargaLabel").innerText = "Rp 0";

    goBackToOrder();
}

function selectPayment(method) {
    const creditForm = document.getElementById("creditCardForm");
    const cashForm = document.getElementById("cashForm");
    const qrForm = document.getElementById("qrForm");
    const methods = document.querySelectorAll(".payment-method");

    // Reset tampilan semua metode
    methods.forEach((el) => el.classList.remove("selected"));
    creditForm.classList.add("d-none");
    cashForm.classList.add("d-none");
    qrForm.classList.add("d-none");

    // Tampilkan form sesuai metode
    if (method === "credit") {
        creditForm.classList.remove("d-none");
    } else if (method === "cash") {
        cashForm.classList.remove("d-none");
    } else if (method === "qr") {
        qrForm.classList.remove("d-none");
    }

    // Tandai metode yang dipilih
    document
        .querySelector(`.payment-method[onclick="selectPayment('${method}')"]`)
        .classList.add("selected");
}

function hitungKembalian() {
    const jumlahBayar =
        parseInt(document.getElementById("jumlahBayarInput").value) || 0;
    const totalLabel = document.getElementById(
        "totalHargaLabelPayment"
    ).innerText;
    const total = parseInt(totalLabel.replace(/[^\d]/g, ""));

    const kembalian = jumlahBayar - total;
    const kembalianOutput = document.getElementById("kembalianOutput");

    if (kembalian < 0) {
        kembalianOutput.value = "Kurang Bayar";
    } else {
        kembalianOutput.value = `Rp ${kembalian.toLocaleString()}`;
    }
}

function submitPayment() {
    const selected = document.querySelector(".payment-method.selected");

    if (!selected) {
        alert("Silakan pilih metode pembayaran!");
        return;
    }

    // Ambil data order
    const idTransaksi = document.querySelector('input[name="id_transaksi"]').value;
    const total = parseInt(
        document.getElementById("totalHargaLabelPayment").innerText.replace(/[^\d]/g, "")
    ) || 0;
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Konversi orders object ke array untuk dikirim ke backend
    const orderItems = Object.values(orders).map(item => ({
        nama: item.nama,
        harga: item.harga,
        qty: item.qty,
        img: item.img
    }));

    // Kirim ke backend via AJAX
    fetch('/submit-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                id_transaksi: idTransaksi,
                total: total,
                order_items: orderItems
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reset semua form dan order
                orders = {};
                document.getElementById("orderContent").innerHTML =
                    '<small class="text-muted">Silahkan pilih menu</small>';
                document.getElementById("totalItemsLabel").innerText = "0 items";
                document.getElementById("totalHargaLabel").innerText = "Rp 0";
                document.getElementById("jumlahBayarInput").value = "";
                document.getElementById("kembalianOutput").value = "";

                goBackToOrder();
                showAlert("success", data.message || "Transaksi berhasil! Stok telah diperbarui.");

                // Refresh halaman untuk update stok di tampilan
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                showAlert("danger", data.message || "Gagal memproses transaksi");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert("danger", "Terjadi kesalahan saat memproses transaksi");
        });
}

// Preview gambar sebelum upload
document.getElementById("gambarMenu").addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById("previewGambar").src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Handle form submission
document
    .getElementById("formTambahMenu")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        // Tampilkan loading
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';

        // Buat FormData object
        const formData = new FormData(this);

        // Kirim data via AJAX
        fetch("{{ route('menu.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    Accept: "application/json",
                },
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Tutup modal
                    const modal = bootstrap.Modal.getInstance(
                        document.getElementById("tambahMenuModal")
                    );
                    modal.hide();

                    // Tampilkan notifikasi sukses
                    showAlert("success", "Menu berhasil ditambahkan");

                    // Reset form
                    this.reset();
                    document.getElementById("previewGambar").src =
                        "{{ asset('img/placeholder-image.jpg') }}";

                    // Refresh daftar menu
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert(
                        "danger",
                        data.message || "Gagal menambahkan menu"
                    );
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                showAlert("danger", "Terjadi kesalahan saat menyimpan menu");
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = "Simpan Menu";
            });
    });

// Fungsi untuk menampilkan alert
function showAlert(type, message) {
    const alertDiv = document.createElement("div");
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.style.position = "fixed";
    alertDiv.style.top = "20px";
    alertDiv.style.right = "20px";
    alertDiv.style.zIndex = "9999";
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    document.body.appendChild(alertDiv);

    // Hilangkan alert setelah 5 detik
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// Fungsi untuk mendapatkan stok menu dari DOM
function getMenuStock(namaMenu) {
    // Cari elemen menu berdasarkan nama
    const menuItems = document.querySelectorAll('.menu-item');
    for (let item of menuItems) {
        const menuName = item.querySelector('h6').textContent.trim();
        if (menuName === namaMenu) {
            // Ambil stok dari data attribute atau dari badge
            const stockBadge = item.querySelector('.badge');
            if (stockBadge) {
                const stockText = stockBadge.textContent;
                const stockNumber = parseInt(stockText.replace(/[^\d]/g, ''));
                return stockNumber || 0;
            }
        }
    }
    return 0; // Default jika tidak ditemukan
}

// Fungsi untuk menonaktifkan menu yang stoknya habis
function disableOutOfStockMenus() {
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        const stockBadge = item.querySelector('.badge');
        if (stockBadge) {
            const stockText = stockBadge.textContent;
            const stockNumber = parseInt(stockText.replace(/[^\d]/g, ''));

            if (stockNumber <= 0) {
                item.style.opacity = '0.5';
                item.style.pointerEvents = 'none';
                item.style.cursor = 'not-allowed';

                // Tambahkan overlay "Habis"
                const overlay = document.createElement('div');
                overlay.className = 'out-of-stock-overlay';
                overlay.innerHTML = '<span class="badge bg-danger">Habis</span>';
                overlay.style.cssText = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    z-index: 10;
                `;
                item.style.position = 'relative';
                item.appendChild(overlay);
            }
        }
    });
}

// Panggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    disableOutOfStockMenus();
});
