# Sistem Pendukung Keputusan (SPK) Pemilihan Smartphone - Metode SAW

Aplikasi berbasis web yang dirancang untuk membantu proses pengambilan keputusan dalam memilih smartphone terbaik. Proyek ini dibuat sebagai tugas akhir (Skripsi) dengan studi kasus pada Jhonophone Cell. 

Aplikasi ini menggunakan metode **Simple Additive Weighting (SAW)** untuk melakukan perangkingan berdasarkan kriteria dan bobot yang telah ditentukan.

## Fitur Utama

- Autentikasi Admin: Sistem login yang aman untuk membatasi akses ke dalam sistem.
- Manajemen Data Master:
  - CRUD (Create, Read, Update, Delete) Data Alternatif (Smartphone).
  - CRUD Data Kriteria (Chipset, RAM, Storage, dll).
  - CRUD Data Subkriteria (Bobot nilai untuk setiap kriteria).
- Manajemen Normalisasi: Pengelolaan data nilai alternatif berdasarkan kriteria.
- Perhitungan Otomatis: Menghitung matriks keputusan, normalisasi, dan nilai preferensi secara otomatis menggunakan metode SAW.
- Perangkingan: Menampilkan hasil urutan smartphone terbaik berdasarkan nilai tertinggi.
- Cetak Laporan: Fitur untuk mencetak data alternatif, kriteria, dan hasil perangkingan (format cetak ramah printer).

## Teknologi yang Digunakan

- Bahasa Pemrograman: PHP (Native)
- Database: MySQL
- Frontend: HTML, CSS, JavaScript
- Web Server (Lokal): Apache (XAMPP/Laragon)

## Cara Menjalankan Secara Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer Anda:

1. Persiapan
   Pastikan Anda sudah menginstal XAMPP atau Laragon di komputer Anda.

2. Clone / Download Repository
   Unduh kode ini dengan cara klik tombol `Code` > `Download ZIP`, atau gunakan perintah terminal:
   ```bash
   git clone https://github.com/username-anda/nama-repo.git
