# Vercel + Aiven - SPK Smartphone

Proyek ini telah dikonfigurasi untuk di-deploy ke Vercel dengan database Aiven MySQL.

## Struktur Folder

```
/
├── api/                    ← Semua file PHP (serverless functions)
│   ├── Koneksi.php         ← Koneksi DB (env vars / localhost)
│   ├── session_handler.php ← Session berbasis database
│   ├── index.php
│   ├── Login.php
│   ├── logout.php
│   └── ... (semua file PHP lainnya)
├── dashboard.css           ← File statis (CSS & gambar)
├── login.css
├── style.css
├── logo1.jpeg
├── fototoko.jpeg
├── vercel.json             ← Konfigurasi routing Vercel
├── .env.example            ← Referensi environment variables
└── db_spkta.sql            ← SQL dump untuk import ke Aiven
```

## Langkah Deploy

### 1. Buat Database di Aiven
1. Daftar/login di [aiven.io](https://aiven.io)
2. Buat service **MySQL**
3. Catat: Host, Port, Username, Password
4. Download file **CA Certificate** (`ca.pem`)
5. Import `db_spkta.sql` ke Aiven menggunakan MySQL client:
   ```
   mysql -h HOST -P PORT -u avnadmin -p --ssl-ca=ca.pem db_spkta < db_spkta.sql
   ```

### 2. Deploy ke Vercel
1. Push proyek ini ke GitHub
2. Di [vercel.com](https://vercel.com), import repository tersebut
3. Tambahkan **Environment Variables** di Settings:
   - `DB_HOST` = host dari Aiven
   - `DB_PORT` = port dari Aiven
   - `DB_USER` = username dari Aiven (biasanya `avnadmin`)
   - `DB_PASS` = password dari Aiven
   - `DB_NAME` = `db_spkta`
   - `DB_SSL` = `true`
4. Deploy!

### 3. Untuk Development Lokal (XAMPP)
Proyek ini tetap bisa dijalankan di XAMPP tanpa perubahan:
- Jika environment variables tidak diset, otomatis menggunakan `localhost` / `root` / tanpa password
- File `api/Koneksi.php` mendeteksi otomatis

