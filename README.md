# Dokumentasi Aplikasi MyCashiery

## Spesifikasi Aplikasi
- **Bahasa Pemrograman**: PHP (Versi 8.2)
- **Database**: PostgreSQL

---

## Persiapan dan Instalasi

### 1. Mengaktifkan PostgreSQL Driver pada php.ini
1. Buka file `php.ini` yang ada di direktori instalasi PHP Anda.
2. Cari dan aktifkan ekstensi berikut:
   ```ini
   extension=pgsql
   extension=pdo_pgsql
   ```
3. Simpan perubahan pada file `php.ini`.

### 2. Instalasi Proyek
Ikuti langkah-langkah berikut untuk menjalankan proyek:

1. Clone repository Git:
   ```bash
   git clone [url_repository]
   ```
2. Buat branch baru:
   ```bash
   git branch branch_name
   ```
3. Pindah ke branch yang telah dibuat:
   ```bash
   git checkout branch_name
   ```
4. Jalankan perintah untuk memperbarui dependensi:
   ```bash
   composer update
   ```
5. Ubah nama file `.env.example` menjadi `.env`.
6. Atur konfigurasi database pada file `.env`:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=localhost
   DB_PORT=5432
   DB_DATABASE=your_db_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
7. Jalankan proyek menggunakan perintah:
   ```bash
   php artisan serve
   ```

---

## Konfigurasi Midtrans

### 1. Informasi Kredensial

#### a. Produksi
Gunakan konfigurasi berikut untuk mode **produksi**:
```env
MIDTRANS_MERCHANT_ID=your_midtrans_merchant_id
MIDTRANS_CLIENT_KEY=your_midtrans_client_key
MIDTRANS_SERVER_KEY=your_midtrans_server_key
MIDTRANS_IS_PRODUCTION=true
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

#### b. Sandbox (Pengembangan)
Gunakan konfigurasi berikut untuk mode **sandbox**:
```env
MIDTRANS_MERCHANT_ID=your_midtrans_merchant_id
MIDTRANS_CLIENT_KEY=your_midtrans_client_key
MIDTRANS_SERVER_KEY=your_midtrans_server_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 2. Mengubah Mode Produksi ke Sandbox
1. Buka file `Midtrans.php` dan pastikan kode berikut telah dikonfigurasi dengan benar:
   ```php
   return [
       'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
       'client_key' => env('MIDTRANS_CLIENT_KEY'),
       'server_key' => env('MIDTRANS_SERVER_KEY'),
       'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
       'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
       'is_3ds' => env('MIDTRANS_IS_3DS', true),
   ];
   ```
   - Ubah `is_production` menjadi `false` untuk mode sandbox.

2. Untuk menggunakan Snap pada mode sandbox, ubah URL skrip berikut:
   ```html
   <script src="https://app.stg.midtrans.com/snap/snap.js"></script>
   ```
   **Catatan**: URL untuk mode produksi adalah:
   ```html
   <script src="https://app.midtrans.com/snap/snap.js"></script>
   ```

---

## Catatan Penting
- **Database**: Pastikan database PostgreSQL telah dikonfigurasi dengan kredensial yang benar di file `.env`.
- **Composer**: Pastikan `composer` telah terinstal di sistem Anda sebelum menjalankan perintah terkait.
- **Midtrans**: Gunakan mode produksi hanya jika aplikasi telah siap untuk digunakan secara live.

Dokumentasi ini diharapkan mempermudah proses instalasi dan konfigurasi aplikasi **MyCashiery**. Jika ada kendala, silakan periksa log error atau hubungi tim pengembang.
