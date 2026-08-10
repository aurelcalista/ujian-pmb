# Sistem Ujian CBT PMB UCIC

Sistem **Computer Based Test (CBT)** untuk Seleksi Penerimaan Mahasiswa Baru (PMB) di **Universitas Catur Insan Cendekia (UCIC)**. Aplikasi ini dibangun menggunakan framework **Laravel** untuk memfasilitasi ujian daring secara aman, interaktif, dan modern.

## 🌟 Fitur Utama

### 1. Fitur Ujian Calon Mahasiswa (CBT)
* **Real-time Auto Save**: Jawaban peserta ujian akan otomatis tersimpan setiap kali peserta memilih opsi jawaban.
* **Smart Timer**: Waktu pengerjaan akan dihitung mundur secara otomatis (durasi ujian: 150 menit).
* **Anti-Cheat System**: Sistem mendeteksi apabila peserta keluar dari mode *fullscreen*, membuka tab baru, atau berpindah browser. Peringatan akan dicatat secara otomatis.
* **Status "Ragu-ragu"**: Memudahkan peserta menandai soal yang ingin ditinjau kembali sebelum waktu habis.
* **Desain Responsif & Modern**: UI/UX dirancang dengan estetika *premium* dan *user-friendly* menggunakan *glassmorphism* dan animasi transisi halus.

### 2. Bank Soal & Materi Ujian
* Menggunakan 60 soal baku yang sudah disesuaikan, terbagi atas:
  * **Bagian I:** Logika dan Penalaran (40 Soal)
  * **Bagian III:** Literasi Digital (20 Soal)
* Opsi jawaban diacak (*shuffle options*) untuk mencegah kecurangan.

## 🛠️ Persyaratan Sistem (Tech Stack)
* **PHP** >= 8.1
* **Composer**
* **MySQL** / MariaDB
* **Laravel** Framework
* **Bootstrap 5** & CSS Vanilla untuk styling (menggunakan file kustom `ucic-cbt.css`)

---

## 🚀 Cara Instalasi dan Setup Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi di *local environment* Anda:

**1. Salin repositori / Buka folder project**
```bash
cd d:\ujian-pmb
```

**2. Instalasi dependensi PHP (Composer)**
```bash
composer install
```

**3. Konfigurasi Environment**
Salin file `.env.example` menjadi `.env` (atau buat file `.env` baru). Sesuaikan konfigurasi database Anda, misalnya:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ujian-pmb
DB_USERNAME=root
DB_PASSWORD=
```

**4. Generate Application Key**
```bash
php artisan key:generate
```

**5. Jalankan Migrasi & Seeder**
Perintah ini akan membuat semua struktur tabel database dan memasukkan data **Admin** beserta **60 Soal Ujian** bawaan aplikasi.
```bash
php artisan migrate:fresh --seed
```

**6. Jalankan Local Development Server**
```bash
php artisan serve
```
Aplikasi sekarang dapat diakses melalui browser pada alamat: `http://127.0.0.1:8000`

---

## 🔐 Akun Akses Default

Setelah menjalankan seeder di atas, Anda dapat masuk ke dasbor menggunakan kredensial bawaan berikut:

### Akun Administrator
* **Email:** `admin@cic.ac.id`
* **Password:** `admin123`

---

## 📂 Struktur Penting
* **Seeder Utama Soal:** `database/seeders/CbtPmbSeeder.php`
* **CSS & JS Kustom:** `public/css/ucic-cbt.css` dan `public/js/ucic-cbt.js`
* **Tampilan Ujian (Blade):** `resources/views/student/`

## 💡 Bantuan & Pengembangan Lanjutan
Jika ada kendala, pastikan versi PHP dan dependensi server Anda (seperti ekstensi PHP) sudah memadai sesuai dengan standar dokumentasi Laravel.
