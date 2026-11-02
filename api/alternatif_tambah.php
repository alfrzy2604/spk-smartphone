<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = $_POST['nama'];
    $merk  = $_POST['merk'];
    $tahun = $_POST['tahun'];

    $stmt = $conn->prepare("INSERT INTO alternatif (nama, merk, tahun) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $merk, $tahun);

    if ($stmt->execute()) {
        header("Location: alternatif.php");
        exit;
    } else {
        $error = "Data gagal ditambahkan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alternatif</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="content">
    <div class="table-box">
        <div class="table-header">
            <h2>Tambah Data Alternatif</h2>
        </div>

        <form method="post">
            <label>Nama Smartphone</label>
            <input type="text" name="nama" required>

            <label>Merk</label>
            <input type="text" name="merk" required>

            <label>Tahun</label>
            <input type="text" name="tahun" required>

            <br><br>
            <button type="submit" class="btn-print">Simpan</button>
            <a href="alternatif.php" class="btn-add">Kembali</a>
        </form>
    </div>
</div>

</body>
</html>
