<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

if(isset($_POST['simpan'])){

    $kode = $_POST['kode_kriteria'];
    $nama = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];
    $bobot = $_POST['bobot'];

    $stmt = $conn->prepare("INSERT INTO kriteria(kode_kriteria,nama_kriteria,atribut,bobot)
    VALUES(?,?,?,?)");

    $stmt->bind_param("sssi",$kode,$nama,$atribut,$bobot);

    $stmt->execute();

    header("Location: kriteria.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kriteria</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="content">

<div class="table-box">

<h2>Tambah Data Kriteria</h2>

<form method="POST">

<label>Kode Kriteria</label>
<input type="text" name="kode_kriteria" required>

<label>Nama Kriteria</label>
<input type="text" name="nama_kriteria" required>

<label>Atribut</label>
<select name="atribut">
    <option value="Benefit">Benefit</option>
    <option value="Cost">Cost</option>
</select>

<label>Bobot</label>
<input type="text" name="bobot" placeholder="Contoh: 0,15" required>

<br><br>

<button type="submit" name="simpan" class="btn-add">
Simpan
</button>

<a href="kriteria.php" class="btn-print">
Kembali
</a>

</form>

</div>

</div>

</body>
</html>

