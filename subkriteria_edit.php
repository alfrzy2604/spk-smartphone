<?php
session_start();
include "koneksi.php";

$conn = new mysqli($host,$user,$pass,$db);

$id = $_GET['id'];

$data = $conn->query("
SELECT * FROM subkriteria
WHERE id_subkriteria='$id'
");

$row = $data->fetch_assoc();

if(isset($_POST['update'])){

    $kriteria = $_POST['kriteria'];
    $crips = $_POST['crips'];
    $nilai = $_POST['nilai'];

    $stmt = $conn->prepare("
    UPDATE subkriteria
    SET
    kriteria=?,
    crips=?,
    nilai=?
    WHERE id_subkriteria=?
    ");

    $stmt->bind_param(
    "ssii",
    $kriteria,
    $crips,
    $nilai,
    $id
    );

    $stmt->execute();

    header("Location: subkriteria.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Subkriteria</title>
<link rel="stylesheet" href="dashboard.css">
</head>

<body>

<div class="content">

<div class="table-box">

<h2>Edit Data Subkriteria</h2>

<form method="POST">

<label>Kriteria</label>
<input type="text"
name="kriteria"
value="<?php echo $row['kriteria']; ?>">

<label>Crips</label>
<input type="text"
name="crips"
value="<?php echo $row['crips']; ?>">

<label>Nilai</label>
<input type="number"
name="nilai"
value="<?php echo $row['nilai']; ?>">

<br><br>

<button
type="submit"
name="update"
class="btn-add">
Update
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