<?php
/**
 * Koneksi Database - Mendukung Aiven MySQL (cloud) dan localhost (XAMPP)
 * 
 * Untuk Vercel: Set environment variables di dashboard Vercel:
 *   DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_SSL (true/false)
 * 
 * Untuk lokal XAMPP: Jika env vars tidak diset, otomatis pakai localhost.
 */

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'db_spkta';
$port = getenv('DB_PORT') ? (int) getenv('DB_PORT') : 3306;
$useSSL = getenv('DB_SSL') === 'true';

$conn = mysqli_init();

if ($useSSL) {
    // Aiven mewajibkan SSL. Sertifikat CA diunduh dari dashboard Aiven.
    $caPath = getenv('DB_CA_PATH') ?: __DIR__ . '/ca.pem';
    if (file_exists($caPath)) {
        mysqli_ssl_set($conn, NULL, NULL, $caPath, NULL, NULL);
    }
    // MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT agar tidak error jika CA belum ada
    mysqli_real_connect($conn, $host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);
} else {
    mysqli_real_connect($conn, $host, $user, $pass, $db, $port);
}

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>

