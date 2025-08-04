<style>
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .landing-bg {
        min-height: 100vh;
        width: 100vw;
        position: relative;
        background: radial-gradient(ellipse at bottom, #23243a 0%, #18111a 100%);
        color: #fff;
        font-family: 'Poppins', Arial, sans-serif;
        box-sizing: border-box;
    }

    .navbar-landing {
        width: 100vw;
        max-width: 100vw;
        box-sizing: border-box;
        padding: 1.5rem 0 1rem 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: transparent;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 10;
    }

    .navbar-landing .brand {
        font-weight: 700;
        font-size: 1.3rem;
        letter-spacing: 1px;
        color: #fff;
        margin-left: 2.5rem;
    }

    .navbar-landing .nav-menu {
        display: flex;
        gap: 2rem;
        margin-right: 2.5rem;
        align-items: center;
    }

    .navbar-landing .nav-menu a {
        color: #fff;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .navbar-landing .nav-menu a:hover {
        color: #e0aaff;
    }

    .navbar-landing .nav-icons {
        display: flex;
        gap: 1rem;
        margin-left: 1.5rem;
    }

    .navbar-landing .nav-icons a {
        color: #fff;
        font-size: 1.1rem;
        transition: color 0.2s;
    }

    .navbar-landing .nav-icons a:hover {
        color: #e0aaff;
    }

    .hero-section {
        min-height: 100vh;
        width: 100vw;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding-top: 7rem;
        padding-bottom: 2rem;
        box-sizing: border-box;
    }

    .hero-title {
        font-size: 2.7rem;
        font-weight: 800;
        background: linear-gradient(90deg, #e040fb 20%, #7f7fd5 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-fill-color: transparent;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }

    .hero-subtitle {
        font-size: 2.2rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 1.2rem;
        letter-spacing: 2px;
    }

    .hero-desc {
        color: #e0e0e0;
        font-size: 1.08rem;
        max-width: 540px;
        margin: 0 auto 2.2rem auto;
        line-height: 1.7;
        text-align: center;
    }

    .hero-btns {
        display: flex;
        gap: 1.2rem;
        justify-content: center;
        margin-bottom: 2.5rem;
    }

    .hero-btn {
        padding: 0.7rem 2.2rem;
        border-radius: 30px;
        border: 2px solid #e0aaff;
        background: transparent;
        color: #fff;
        font-weight: 600;
        font-size: 1.08rem;
        transition: 0.2s, color 0.2s;
        cursor: pointer;
        outline: none;
    }

    .hero-btn.primary {
        background: linear-gradient(90deg, #e040fb 20%, #7f7fd5 80%);
        color: #fff;
        border: none;
        box-shadow: 0 2px 16px 0 rgba(224, 170, 255, 0.10);
    }

    .hero-btn.primary:hover {
        background: #fff;
        color: #7f7fd5;
    }

    .hero-btn.secondary:hover {
        background: #e0aaff;
        color: #23243a;
    }

    .hero-logo {
        margin-top: 2.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hero-logo img {
        width: 180px;
        max-width: 80vw;
        opacity: 0.92;
        margin-bottom: 0.7rem;
    }

    .hero-logo span {
        font-size: 1.1rem;
        color: #e0e0e0;
        letter-spacing: 2px;
    }

    @media (max-width: 600px) {
        .navbar-landing .brand {
            margin-left: 1rem;
        }
    }

    .navbar-landing .nav-menu {
        margin-right: 1rem;
        gap: 1rem;
    }

    .hero-title {
        font-size: 1.5rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
    }

    .hero-section {
        padding-top: 5rem;
    }

    .hero-logo img {
        width: 120px;
    }

    .container,
    .container-fluid {
        max-width: 100vw !important;
        width: 100vw !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    body,
    html {
        background: none !important;
    }
</style>
<div class="landing-bg">

    <section class="hero-section">
        <div class="hero-title">Aplikasi <span
                style="background: linear-gradient(90deg,#e040fb,#7f7fd5);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">Point
                Of Sale</span></div>
        <div class="hero-subtitle">POS</div>
        <div class="hero-desc">
            Sekarang saatnya pindah ke sistem kasir online yang praktis!<br>
            Aplikasi POS Angkringan bantu kelola penjualan, stok, laporan, sampai pemesanan online—all in one.
            Cepat, rapi, dan nggak bikin pusing!
        </div>
        <!-- <div class="hero-btns">
            <a href="{{ url('/login') }}" class="hero-btn primary">Get started</a>
            <a href="#about" class="hero-btn secondary">About me</a>
        </div> -->

    </section>
    <!-- About Section -->
    <section id="about" style="padding: 4rem 0 2rem 0; background: #18111a; text-align: center;">
        <h2 style="font-size: 2rem; font-weight: 700; color: #e0aaff; margin-bottom: 1.2rem; letter-spacing: 1px;">
            Tentang Aplikasi</h2>
        <p style="max-width: 700px; margin: 0 auto; color: #e0e0e0; font-size: 1.1rem; line-height: 1.7;">
            POS adalah aplikasi kasir online yang dirancang khusus untuk UMKM, angkringan, dan bisnis kuliner.
            Dengan sistem berbasis web, Anda dapat mengelola penjualan, stok barang, laporan keuangan, hingga pemesanan
            online secara praktis dan efisien, kapan saja dan di mana saja.
        </p>
    </section>
    <!-- Features Section -->
    <section id="features" style="padding: 3rem 0 2rem 0; background: #23243a; text-align: center;">
        <h2 style="font-size: 1.7rem; font-weight: 700; color: #e0aaff; margin-bottom: 1.2rem; letter-spacing: 1px;">
            Keunggulan Aplikasi</h2>
        <div
            style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2rem; max-width: 900px; margin: 0 auto;">
            <div
                style="background: #18111a; border-radius: 16px; padding: 2rem 1.5rem; min-width: 220px; max-width: 300px; flex: 1 1 220px; box-shadow: 0 2px 16px 0 rgba(224, 170, 255, 0.07);">
                <i class="bi bi-cloud-check" style="font-size: 2.2rem; color: #e0aaff;"></i>
                <h3 style="color: #fff; font-size: 1.2rem; margin: 1rem 0 0.5rem 0;">Akses Online & Real-time</h3>
                <p style="color: #e0e0e0; font-size: 1rem;">Kelola bisnis dari mana saja, data tersimpan aman di cloud.
                </p>
            </div>
            <div
                style="background: #18111a; border-radius: 16px; padding: 2rem 1.5rem; min-width: 220px; max-width: 300px; flex: 1 1 220px; box-shadow: 0 2px 16px 0 rgba(224, 170, 255, 0.07);">
                <i class="bi bi-bar-chart-line" style="font-size: 2.2rem; color: #e0aaff;"></i>
                <h3 style="color: #fff; font-size: 1.2rem; margin: 1rem 0 0.5rem 0;">Laporan Otomatis</h3>
                <p style="color: #e0e0e0; font-size: 1rem;">Dapatkan laporan penjualan & stok secara instan dan detail.
                </p>
            </div>
            <div
                style="background: #18111a; border-radius: 16px; padding: 2rem 1.5rem; min-width: 220px; max-width: 300px; flex: 1 1 220px; box-shadow: 0 2px 16px 0 rgba(224, 170, 255, 0.07);">
                <i class="bi bi-phone" style="font-size: 2.2rem; color: #e0aaff;"></i>
                <h3 style="color: #fff; font-size: 1.2rem; margin: 1rem 0 0.5rem 0;">Mudah Digunakan</h3>
                <p style="color: #e0e0e0; font-size: 1rem;">Tampilan simpel, cocok untuk semua kalangan tanpa pelatihan
                    khusus.</p>
            </div>
            <div
                style="background: #18111a; border-radius: 16px; padding: 2rem 1.5rem; min-width: 220px; max-width: 300px; flex: 1 1 220px; box-shadow: 0 2px 16px 0 rgba(224, 170, 255, 0.07);">
                <i class="bi bi-cash-coin" style="font-size: 2.2rem; color: #e0aaff;"></i>
                <h3 style="color: #fff; font-size: 1.2rem; margin: 1rem 0 0.5rem 0;">Hemat Biaya</h3>
                <p style="color: #e0e0e0; font-size: 1rem;">Tanpa instalasi mahal, cukup langganan bulanan yang
                    terjangkau.</p>
            </div>
        </div>
    </section>
    <!-- App Screenshot Section -->
    <section style="background: #23243a; text-align: center; padding: 0 0 3rem 0;">
        <img src="img/tampilan.png" alt="Demo Aplikasi POS"
            style="max-width: 90vw; width: 900px; border-radius: 18px; box-shadow: 0 4px 32px 0 rgba(32,32,32,0.18); margin: 0 auto; border: 4px solid #e0aaff;">
        <div style="color: #e0aaff; font-size: 1.05rem; margin-top: 1rem; letter-spacing: 1px;">Contoh Tampilan Aplikasi
            POS</div>
    </section>
    <!-- Subscribe Section -->
    <section id="subscribe" style="padding: 3rem 0 4rem 0; background: #18111a; text-align: center;">
        <h2 style="font-size: 1.5rem; font-weight: 700; color: #e0aaff; margin-bottom: 1.2rem; letter-spacing: 1px;">
            Berlangganan Sekarang</h2>
        <p style="color: #e0e0e0; font-size: 1.05rem; margin-bottom: 2rem;">Dapatkan akses penuh ke semua fitur premium
            dan dukungan prioritas.</p>
        <a href="{{ url('/login') }}" class="hero-btn primary"
            style="font-size: 1.15rem; padding: 0.9rem 2.5rem;">Berlangganan
            Sekarang</a>
    </section>
</div>
<!-- Pastikan Bootstrap Icons sudah di-load di layout utama -->
