<?php
session_start();
include "koneksi.php";

$conn = new mysqli($host,$user,$pass,$db);

if(isset($_POST['simpan'])){

    $kriteria = $_POST['kriteria'];
    $crips = $_POST['crips'];
    $nilai = $_POST['nilai'];

    $stmt = $conn->prepare("
    INSERT INTO subkriteria
    (kriteria,crips,nilai)
    VALUES (?,?,?)
    ");

    $stmt->bind_param(
    "ssi",
    $kriteria,
    $crips,
    $nilai
    );

    $stmt->execute();

    header("Location: subkriteria.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Subkriteria</title>
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="content">

<div class="table-box">

<h2>Tambah Data Subkriteria</h2>

<form method="POST">

<label>Kriteria</label>
<input type="text" name="kriteria" required>

<label>Crips</label>
<input type="text" name="crips" required>

<label>Nilai</label>
<input type="number" name="nilai" required>

<br><br>

<button type="submit"
name="simpan"
class="btn-add">
Simpan
</button>

<a href="subkriteria.php"
class="btn-print">
Kembali
</a>

</form>

</div>

</div>

</body>
</html>