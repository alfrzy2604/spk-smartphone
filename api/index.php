<?php
/**
 * Front Controller & Router untuk Vercel Serverless
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($uri, '/');
$filename = basename($path);

// 1. Jika akses root (/) atau index.php -> Tampilkan Dashboard
if (empty($path) || $filename === 'index.php') {
    require_once __DIR__ . '/session_handler.php';

    if (!isset($_SESSION['loggedin'])) {
        header("Location: Login.php");
        exit;
    }
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard SPK Smartphone</title>
        <link rel="stylesheet" href="dashboard.css">
    </head>
    <body>

    <div class="topbar">
        <div class="logo">
            <img src="logo1.jpeg" alt="Logo">
        </div>

        <div class="user-info">
            <span><?php echo $_SESSION['username']; ?></span>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a class="active" href="index.php">Dashboard</a>
            <a href="alternatif.php">Alternatif</a>
            <a href="kriteria.php">Kriteria</a>
            <a href="subkriteria.php">Subkriteria</a>
            <a href="normalisasi.php">Normalisasi</a>
            <a href="perhitungan.php">Perhitungan</a>
        </div>

        <div class="content">
            <h1>Sistem Pendukung Keputusan</h1>
            <p class="subtitle">Pemilihan Smartphone</p>

            <div class="cards">
            <div class="card orange">
                <h2></h2>
                <p>Alternatif</p>
            </div>

            <div class="card blue">
                 <h2>10</h2>
                <p>Kriteria</p>
            </div>
        </div>

            <div class="banner">
                <img src="fototoko.jpeg" alt="Foto" class="fototoko">
            </div>
        </div>
    </div>

    </body>
    </html>
    <?php
    exit;
}

// 2. Cek apakah ada file PHP yang diminta di folder api/
$targetFile = __DIR__ . '/' . $filename;

if (file_exists($targetFile) && is_file($targetFile) && $filename !== 'index.php') {
    require $targetFile;
    exit;
}

// 3. Tangani case-insensitive login (login.php -> Login.php)
if (strcasecmp($filename, 'login.php') === 0 && file_exists(__DIR__ . '/Login.php')) {
    require __DIR__ . '/Login.php';
    exit;
}

// 4. Default fallback: arahkan ke Login.php
header("Location: Login.php");
exit;
?>
