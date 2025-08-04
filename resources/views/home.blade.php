<<<<<<< HEAD
=======
@extends('layouts.app')

@section('title', 'Aplikasi Point Of Sale ')

@section('content')
>>>>>>> dcacef8 (Update total)
<style>
html,
body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    scroll-behavior: smooth;
}

.landing-bg {
    min-height: 100vh;
    width: 100vw;
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    font-family: 'Inter', 'Poppins', Arial, sans-serif;
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
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.navbar-landing .brand {
    font-weight: 800;
    font-size: 1.5rem;
    letter-spacing: 1px;
    color: #fff;
    margin-left: 2.5rem;
    background: linear-gradient(45deg, #fff, #f0f0f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.navbar-landing .nav-menu {
    display: flex;
    gap: 2.5rem;
    margin-right: 2.5rem;
    align-items: center;
}

.navbar-landing .nav-menu a {
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
}

.navbar-landing .nav-menu a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    left: 0;
    background: linear-gradient(45deg, #fff, #f0f0f0);
    transition: width 0.3s ease;
}

.navbar-landing .nav-menu a:hover::after {
    width: 100%;
}

.navbar-landing .nav-icons {
    display: flex;
    gap: 1.5rem;
    margin-left: 1.5rem;
}

.navbar-landing .nav-icons a {
    color: #fff;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.navbar-landing .nav-icons a:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.hero-section {
    min-height: 100vh;
    width: 100vw;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-top: 8rem;
    padding-bottom: 2rem;
    box-sizing: border-box;
    position: relative;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 900;
    background: linear-gradient(45deg, #fff, #f0f0f0, #e0e0e0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    letter-spacing: 2px;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-subtitle {
    font-size: 2.5rem;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 1.5rem;
    letter-spacing: 3px;
    position: relative;
    z-index: 2;
}

.hero-desc {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.2rem;
    max-width: 600px;
    margin: 0 auto 3rem auto;
    line-height: 1.8;
    text-align: center;
    position: relative;
    z-index: 2;
}

.hero-btns {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.hero-btn {
    padding: 1rem 2.5rem;
    border-radius: 50px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    cursor: pointer;
    outline: none;
    text-decoration: none;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
}

.hero-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.hero-btn:hover::before {
    left: 100%;
}

.hero-btn.primary {
    background: linear-gradient(45deg, #667eea, #764ba2);
    border: none;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
}

.hero-btn.primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
}

.hero-btn.secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
    border-color: rgba(255, 255, 255, 0.5);
}

.hero-logo {
    margin-top: 3rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
}

.hero-logo img {
    width: 200px;
    max-width: 80vw;
    opacity: 0.95;
    margin-bottom: 1rem;
    filter: drop-shadow(0 8px 32px rgba(0, 0, 0, 0.3));
    transition: all 0.3s ease;
}

.hero-logo img:hover {
    transform: scale(1.05);
}

.hero-logo span {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.8);
    letter-spacing: 3px;
    font-weight: 600;
}

.section {
    padding: 5rem 0;
    position: relative;
}

.section-about {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.section-features {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.section-screenshots {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

.section-subscribe {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.section-team {
    background: linear-gradient(135deg, #a8edea 10%, #fed6e3 100%);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 2rem;
    text-align: center;
    letter-spacing: 2px;
}

.section-desc {
    max-width: 700px;
    margin: 0 auto 3rem auto;
    color: rgba(255, 255, 255, 0.9);
    font-size: 1.2rem;
    line-height: 1.8;
    text-align: center;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2.5rem;
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 2rem;
}

.team-card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.team-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.team-card:hover::before {
    transform: translateX(100%);
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.team-photo {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    margin: 0 auto 1.5rem auto;
    border: 4px solid rgba(255, 255, 255, 0.3);
    overflow: hidden;
    transition: all 0.3s ease;
}

.team-card:hover .team-photo {
    transform: scale(1.1);
    border-color: rgba(255, 255, 255, 0.6);
}

.team-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-name {
    color: #fff;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.team-role {
    color: grey;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.team-social {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
}

.team-social a {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.2rem;
    transition: all 0.3s ease;
    padding: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
}

.team-social a:hover {
    color: #fff;
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.feature-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.feature-card:hover::before {
    transform: translateX(100%);
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.feature-icon {
    font-size: 3rem;
    color: #fff;
    margin-bottom: 1.5rem;
    display: block;
}

.feature-title {
    color: #fff;
    font-size: 1.4rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.feature-desc {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1rem;
    line-height: 1.6;
}

.screenshots-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.screenshot-item {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.screenshot-item:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
}

.screenshot-item img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 20px;
}

.subscribe-container {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.subscribe-btn {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: #fff;
    padding: 1.2rem 3rem;
    border: none;
    border-radius: 50px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
}

.subscribe-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
}

<blade media|%20(max-width%3A%20768px)%20%7B%0D>.navbar-landing .brand {
    margin-left: 1rem;
}

.navbar-landing .nav-menu {
    margin-right: 1rem;
    gap: 1.5rem;
}

.hero-title {
    font-size: 2.5rem;
}

.hero-subtitle {
    font-size: 1.8rem;
}

.hero-section {
    padding-top: 6rem;
}

.hero-logo img {
    width: 150px;
}

.section-title {
    font-size: 2rem;
}

.features-grid {
    grid-template-columns: 1fr;
    padding: 0 1rem;
}

.screenshots-grid {
    grid-template-columns: 1fr;
    padding: 0 1rem;
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
    <nav class="navbar-landing">
        <div class="brand">POS</div>
        <div class="nav-menu">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#features">Features</a>
            <a href="#team">Team</a>
            <a href="#screenshots">Screenshots</a>
            <div class="nav-icons">
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-github"></i></a>
            </div>
        </div>
    </nav>

    <section id="home" class="hero-section">
        <div class="hero-title">Aplikasi <span
                style="background: linear-gradient(45deg, #fff, #f0f0f0); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Point
                Of Sale</span></div>
        <div class="hero-subtitle">POS</div>
        <div class="hero-desc">
            Sekarang saatnya pindah ke sistem kasir online yang praktis!<br>
            Aplikasi POS Angkringan bantu kelola penjualan, stok, laporan, sampai pemesanan online—all in one.
            Cepat, rapi, dan nggak bikin pusing!
        </div>
        <div class="hero-btns">
            <a href="{{ route('login') }}" class="hero-btn primary">Get Started</a>
            <a href="#about" class="hero-btn secondary">Learn More</a>
        </div>

    </section>

    <section id="about" class="section section-about">
        <div class="section-title">Tentang Aplikasi</div>
        <div class="section-desc">
            Aplikasi POS adalah aplikasi kasir online yang dirancang khusus untuk UMKM, angkringan, dan bisnis kuliner.
            Dengan sistem berbasis web yang modern dan responsif, Anda dapat mengelola penjualan, stok barang,
            laporan keuangan, hingga pemesanan online secara praktis dan efisien, kapan saja dan di mana saja.
        </div>
    </section>

    <section id="features" class="section section-features">
        <div class="section-title">Keunggulan Aplikasi POS</div>
        <div class="features-grid">
            <div class="feature-card">
                <i class="bi bi-cloud-check feature-icon"></i>
                <h3 class="feature-title">Akses Online & Real-time</h3>
                <p class="feature-desc">Kelola bisnis dari mana saja, data tersimpan aman di cloud dengan sinkronisasi
                    real-time.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-bar-chart-line feature-icon"></i>
                <h3 class="feature-title">Laporan Otomatis</h3>
                <p class="feature-desc">Dapatkan laporan penjualan & stok secara instan dan detail dengan visualisasi
                    yang menarik.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-phone feature-icon"></i>
                <h3 class="feature-title">Mudah Digunakan</h3>
                <p class="feature-desc">Tampilan simpel dan intuitif, cocok untuk semua kalangan tanpa pelatihan khusus.
                </p>
            </div>
            <div class="feature-card">
                <i class="bi bi-cash-coin feature-icon"></i>
                <h3 class="feature-title">Hemat Biaya</h3>
                <p class="feature-desc">Tanpa instalasi mahal, cukup langganan bulanan yang terjangkau untuk semua fitur
                    premium.</p>
            </div>
        </div>
    </section>

    <section id="team" class="section section-team">
        <div class="section-title">Tim Pengembang</div>
        <div class="section-desc">
            Kenali tim developer yang telah mengembangkan aplikasi POS dengan dedikasi dan keahlian tinggi.
        </div>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-photo">
                    <img src="img/frans.jpg" alt="Developer 1">
                </div>
                <div class="team-name">Fransiskus Zedekia Situmorang</div>
                <div class="team-role">Backend Developer</div>
                <div class="team-social">
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="team-card">
                <div class="team-photo">
                    <img src="img/anneke.jpg" alt="Developer 2">
                </div>
                <div class="team-name">Tri Anneke Sibagariang</div>
                <div class="team-role">Analis</div>
                <div class="team-social">
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="team-card">
                <div class="team-photo">
                    <img src="img/pieter.jpg" alt="Developer 3">
                </div>
                <div class="team-name">Pieter Christian</div>
                <div class="team-role">Analis</div>
                <div class="team-social">
                    <a href="#"><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="team-card">
                <div class="team-photo">
                    <img src="img/erick.jpg" alt="Developer 4">
                </div>
                <div class="team-name">Erick Paskah Bawoleh</div>
                <div class="team-role">Frontend Developer</div>
                <div class="team-social">
                    <a href=""><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="team-card">
                <div class="team-photo">
                    <img src="img/topan.jpg" alt="Developer 4">
                </div>
                <div class="team-name">Muhammad Topan</div>
                <div class="team-role">Analis</div>
                <div class="team-social">
                    <a href=""><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
            <div class="team-card">
                <div class="team-photo">
                    <img src="img/radiman.jpg" alt="Developer 4">
                </div>
                <div class="team-name">Radiman</div>
                <div class="team-role">Designer</div>
                <div class="team-social">
                    <a href=""><i class="bi bi-github"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                    <a href="#"><i class="bi bi-envelope"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section id="screenshots" class="section section-screenshots">
        <div class="section-title">Tampilan Aplikasi</div>
        <div class="screenshots-grid">
            <div class="screenshot-item">
                <img src="img/tampilan.png" alt="Dashboard Aplikasi">
            </div>
            <div class="screenshot-item">
                <img src="img/penjualan.png" alt="Halaman Penjualan">
            </div>
            <div class="screenshot-item">
                <img src="img/barang.png" alt="Manajemen Barang">
            </div>
            <div class="screenshot-item">
                <img src="img/bahan.png" alt="Manajemen Bahan">
            </div>
        </div>
    </section>

    <section id="subscribe" class="section section-subscribe">
        <div class="subscribe-container">
            <div class="section-title">Berlangganan Aplikasi POS</div>
            <div class="section-desc">
                Dapatkan akses penuh ke semua fitur premium dan dukungan prioritas.
                Daftar sekarang untuk mencoba gratis selama 14 hari!
            </div>
            <a href="#" class="subscribe-btn" id="openSubscribeModal">Berlangganan Sekarang</a>
        </div>
    </section>
    <!-- Modal Subscribe -->
    <div id="subscribeModal"
        style="display:none; position:fixed; z-index:2000; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.45); align-items:center; justify-content:center;">
        <div
            style="background:#fff; color:#23243a; border-radius:18px; max-width:95vw; width:400px; padding:2.5rem 2rem; box-shadow:0 8px 32px rgba(0,0,0,0.18); position:relative;">
            <button id="closeSubscribeModal"
                style="position:absolute; top:1rem; right:1rem; background:none; border:none; font-size:1.5rem; color:#764ba2; cursor:pointer;">&times;</button>
            <h3 style="font-size:1.3rem; font-weight:700; margin-bottom:1.2rem; color:#764ba2; text-align:center;">
                Berlangganan Aplikasi POS</h3>
            <form id="subscribeForm">
                <div style="margin-bottom:1.2rem;">
                    <label for="subscriberName" style="font-weight:600;">Nama</label>
                    <input type="text" id="subscriberName" name="name" required
                        style="width:100%; padding:0.7rem; border-radius:8px; border:1px solid #ccc; margin-top:0.3rem;">
                </div>
                <div style="margin-bottom:1.2rem;">
                    <label for="subscriberEmail" style="font-weight:600;">Email</label>
                    <input type="email" id="subscriberEmail" name="email" required
                        style="width:100%; padding:0.7rem; border-radius:8px; border:1px solid #ccc; margin-top:0.3rem;">
                </div>
                <div style="margin-bottom:1.2rem;">
                    <label for="subscriberPhone" style="font-weight:600;">No. HP</label>
                    <input type="tel" id="subscriberPhone" name="no_hp " maxlength="15" required
                        style="width:100%; padding:0.7rem; border-radius:8px; border:1px solid #ccc; margin-top:0.3rem;">
                </div>
                <button type="submit"
                    style="width:100%; background:linear-gradient(45deg,#667eea,#764ba2); color:#fff; font-weight:700; border:none; border-radius:8px; padding:0.9rem; font-size:1.1rem; cursor:pointer;">Kirim</button>
                <div id="subscribeMsg" style="margin-top:1rem; font-size:1rem;"></div>
            </form>
        </div>
    </div>
    <script>
    document.getElementById('openSubscribeModal').onclick = function(e) {
        e.preventDefault();
        document.getElementById('subscribeModal').style.display = 'flex';
    };
    document.getElementById('closeSubscribeModal').onclick = function() {
        document.getElementById('subscribeModal').style.display = 'none';
        document.getElementById('subscribeMsg').innerHTML = '';
        document.getElementById('subscribeForm').reset();
    };
    document.getElementById('subscribeForm').onsubmit = function(e) {
        e.preventDefault();
        var name = document.getElementById('subscriberName').value;
        var email = document.getElementById('subscriberEmail').value;
        var no_hp = document.getElementById('subscriberPhone').value;
        var msg = document.getElementById('subscribeMsg');
        msg.innerHTML = 'Mengirim...';
        fetch('/subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content')
            },
            body: JSON.stringify({
                name: name,
                email: email,
                no_hp: no_hp
            })
        }).then(res => res.json()).then(data => {
            if (data.success) {
                msg.style.color = 'green';
                msg.innerHTML =
                    'Terima kasih sudah berlangganan,akun anda akan dikirimkan ke email anda maksimal 3 jam kedepan.Silahkan cek email anda secara berkala !';
                setTimeout(() => {
                    document.getElementById('subscribeModal').style.display = 'none';
                    msg.innerHTML = '';
                    document.getElementById('subscribeForm').reset();
                }, 2000);
            } else {
                msg.style.color = 'red';
                msg.innerHTML = data.message || 'Gagal mengirim.';
            }
        }).catch(() => {
            msg.style.color = 'red';
            msg.innerHTML = 'Gagal mengirim.';
        });
    };
    </script>
</div>
<<<<<<< HEAD
<!-- Pastikan Bootstrap Icons sudah di-load di layout utama -->
=======
@endsection
>>>>>>> dcacef8 (Update total)
