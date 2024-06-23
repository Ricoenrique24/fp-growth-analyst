<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Panduan Penggunaan FP Growth Analyst

## 0. Persiapkan Lingkungan

- Project ini menggunakan Laravel 10 dan React. Pastikan Anda telah menginstal PHP 8.1 atau versi lebih baru serta Node.js. Untuk memudahkan pengaturan, pastikan Git juga telah terpasang.

## 1. Unduh Kode Sumber

- Akses repository ini [FP Growth Analyst](https://github.com/Ricoenrique24/fp-growth-analyst).
- Tekan tombol hijau "Code" dan salin URL repository tersebut. Jika lebih suka, Anda dapat mengunduh versi ZIP.
  
## 2. Set-up Project

- Pilih lokasi penyimpanan (misalnya, jika menggunakan Laragon, simpan di `C:\Laragon\www\`). Klik kanan di folder tersebut dan pilih 'Git Bash Here'.
- Ketikkan perintah `git clone {link yang disalin}` lalu tekan Enter.
- Sebuah folder baru akan muncul berisi proyek ini.
- Buka terminal di dalam folder proyek (bisa menggunakan Laragon atau VSCode jika PHP 8.1 atau lebih baru telah terpasang).
- Jalankan perintah `composer install` untuk mengunduh semua library yang diperlukan oleh Laravel.
- Setelah selesai, jalankan perintah `npm install` untuk menginisialisasi React.
- Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi sesuai dengan lingkungan lokal Anda.
- Setelah konfigurasi selesai, jalankan `php artisan serve` untuk menjalankan server Laravel.
- Buka terminal baru (Ctrl+Shift+`) dan jalankan `npm run dev` untuk mengaktifkan React.

## 3. Set-up Data

- Buatlah database baru dengan nama sesuai keinginan Anda di MySQL atau platform database lainnya.
- Konfigurasikan koneksi database di file `.env` dengan mengisi informasi kredensial yang sesuai.
- Di platform database (misalnya phpMyAdmin), pilih opsi import dan unggah file dump database (terletak di folder `public` dari proyek Laravel).
- Proses impor akan mengisi database dengan data sampel yang diperlukan.
  
## SELESAI DAN SELAMAT MENCOBA
