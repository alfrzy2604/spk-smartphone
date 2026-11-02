<?php
/**
 * Koneksi Database - Mendukung Aiven MySQL (cloud) dan localhost (XAMPP)
 */

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'defaultdb';
$port = getenv('DB_PORT') ? (int) getenv('DB_PORT') : 3306;
$useSSL = getenv('DB_SSL') === 'true';

$conn = mysqli_init();

if ($useSSL) {
    mysqli_options($conn, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
    $caPath = getenv('DB_CA_PATH') ?: __DIR__ . '/ca.pem';
    if (file_exists($caPath)) {
        mysqli_ssl_set($conn, NULL, NULL, $caPath, NULL, NULL);
    }
    mysqli_real_connect($conn, $host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL);
} else {
    mysqli_real_connect($conn, $host, $user, $pass, $db, $port);
}

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
