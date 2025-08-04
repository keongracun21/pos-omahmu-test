<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## POINT OF SALE ANGKRINGAN OMAHMU

POS OmahMu, sistem kasir digital berbasis web
dirancang khusus untuk membantu UMKM seperti warung makan
(angkringan) mencatat transaksi, mengelola inventaris,
dan memantau laporan keuangan secara otomatis.

## Fitur Utama:

Manajemen pengguna dan akses berbasis peran
Transaksi penjualan
Manajemen inventaris
Laporan dan analisis keuangan

## INSTALASI

1. Clone repositori ini:
   git clone https://github.com/fransiskus15/pos-omahmu.git

2. Jalankan perintah berikut:

    cd pos-omahmu

    composer install

    cp .env.example .env

    Lalu buka file .env dan atur koneksi database:

    DB_DATABASE=pos

    DB_USERNAME=root

    DB_PASSWORD=

    php artisan key:generate

    php artisan migrate

## DATABASE

    Anda juga bisa langsung import databasenya dengan file .sql tanpa perlu migrate cukup dengan :

    1.Buat database kosong di phpMyAdmin.

    2.Import file .sql ke database tersebut.

    3.Pastikan .env sesuai nama databasenya.

    link download file .sql:
    https://drive.google.com/file/d/1w_Ar6BUsvOck4Y_2o5fD1DiEUu1mLZhl/view?usp=sharing
