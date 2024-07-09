# MyCashier

MyCashier adalah aplikasi pembayaran tagihan berbasis web yang dapat digunakan oleh masyarakat miskin untuk membayar tagihan elektronik, listrik, air, dll.

## Instalasi

1. Clone repository ini ke komputer anda
2. Buat database baru di MySQL
3. Sesuaikan konfigurasi database di file `.env`
4. Jalankan perintah `composer install`
5. Jalankan perintah `php artisan migrate` untuk migrasi database
6. Jalankan perintah `php artisan db:seed` untuk mengisi data contoh
7. Jalankan perintah `php artisan serve` untuk menjalankan aplikasi

## Fitur

- Manajemen pengguna
- Manajemen kategori tagihan
- Manajemen tagihan
- Manajemen pembayaran
- Laporan

## Lisensi

MyCashier dilisensikan di bawah [MIT License](LICENSE).
