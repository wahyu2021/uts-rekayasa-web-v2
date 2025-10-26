# TAASHOP - E-Commerce untuk Jasa Konveksi

<p align="center">
  <img src="https://raw.githubusercontent.com/gemini-testing/gemini-project-images/main/taashop-placeholder.png" alt="TAASHOP Screenshot">
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel 12">
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php" alt="PHP 8.2">
    <img src="https://img.shields.io/badge/Vite-B73BFE?style=for-the-badge&logo=vite" alt="Vite">
    <img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap" alt="Bootstrap 5">
</p>

## Tentang Proyek

**TAASHOP** adalah aplikasi web e-commerce dan portofolio yang dirancang khusus untuk layanan konveksi. Dibangun dengan **Laravel 12**, aplikasi ini menyediakan platform yang elegan bagi pelanggan untuk menjelajahi dan memesan produk, sekaligus memberikan kemudahan bagi admin untuk mengelola konten dan pesanan melalui panel admin yang intuitif.

Proyek ini telah melalui proses refaktorisasi ekstensif untuk menerapkan prinsip-prinsip **Clean Code**, termasuk pemisahan *view components*, dokumentasi *controller* yang lengkap, dan struktur kode yang rapi untuk kemudahan pemeliharaan.

---

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Skema Database](#skema-database)
- [Panduan Instalasi](#panduan-instalasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Variabel Lingkungan](#variabel-lingkungan)
- [Lisensi](#lisensi)

---

## Fitur Utama

### 🛍️ Situs Publik
- **Katalog Produk Dinamis**: Pengguna dapat melihat produk dengan mudah, dilengkapi dengan sistem filter berdasarkan kategori.
- **Keranjang Belanja Interaktif**: Menambah, mengubah kuantitas, dan menghapus produk dari keranjang secara *real-time* melalui AJAX.
- **Alur Checkout Fleksibel**: Mendukung alur "Beli Sekarang" untuk pembelian cepat satu item, dan "Checkout Pilihan" untuk beberapa item dari keranjang.
- **Desain Responsif**: Tampilan yang optimal di berbagai perangkat, dari desktop hingga mobile.
- **Halaman Informatif**: Halaman "Tentang Kami" dan detail produk yang dirancang dengan baik.

### 🔐 Panel Admin
- **Dashboard Analitik**: Ringkasan data penjualan, total produk, kategori, dan pendapatan, dilengkapi dengan grafik penjualan 7 hari terakhir.
- **Manajemen Konten (CRUD)**: Manajemen penuh untuk Produk dan Kategori, termasuk upload gambar.
- **Fitur Unggulan**: Kemampuan untuk menandai produk sebagai "unggulan" (best seller) dengan satu kali klik.
- **Antarmuka yang Bersih**: Layout admin yang terstruktur dengan sidebar dan topbar yang terpisah untuk navigasi yang mudah.

## Teknologi yang Digunakan

| Kategori | Teknologi |
| :--- | :--- |
| **Backend** | PHP 8.2, Laravel 12 |
| **Frontend** | Vite, SCSS, Bootstrap 5, JavaScript |
| **Database** | SQLite |
| **Dev Tools** | Composer, NPM, `laravel/pint`, `concurrently` |

## Skema Database

Struktur database utama terdiri dari tabel-tabel berikut dengan relasi yang jelas:

- `users`: Menyimpan data pengguna dan admin.
- `products`: Data produk, termasuk harga, stok, dan relasi ke `categories`.
- `categories`: Kategori untuk produk.
- `carts` & `cart_items`: Menyimpan data keranjang belanja untuk pengguna yang login maupun tamu (berbasis session).
- `orders` & `order_items`: Mencatat semua pesanan yang berhasil dibuat.
- `payments`: Menyimpan detail metode dan status pembayaran untuk setiap pesanan.

## Panduan Instalasi

Proyek ini menyertakan skrip setup otomatis untuk mempermudah instalasi.

1.  **Clone Repository**
    ```bash
    git clone <URL_REPOSITORY_ANDA>
    cd praktikum_uts_v2
    ```

2.  **Jalankan Skrip Setup**
    ```bash
    composer setup
    ```
    Perintah ini akan secara otomatis menjalankan:
    - `composer install`
    - `npm install`
    - Membuat file `.env` dari `.env.example`
    - `php artisan key:generate`
    - `php artisan migrate --force`
    - `npm run build`

    > **Catatan**: Pastikan Anda memiliki **Composer** dan **Node.js/NPM** terinstal di sistem Anda.

## Menjalankan Aplikasi

Proyek ini dilengkapi skrip untuk menjalankan semua layanan pengembangan (server PHP, Vite, queue) secara bersamaan.

1.  **Jalankan Server Pengembangan**
    ```bash
    composer run-script dev
    ```

2.  **Akses Aplikasi**
    - **Situs Publik**: Buka browser dan kunjungi `http://127.0.0.1:8000`.
    - **Panel Admin**: Kunjungi `http://127.0.0.1:8000/admin`.

## Variabel Lingkungan

File `.env` akan dibuat secara otomatis. Variabel utama yang perlu diperhatikan adalah:

```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite (path absolut jika diperlukan)
```

## Lisensi

Proyek ini dilisensikan di bawah **Lisensi MIT**.
