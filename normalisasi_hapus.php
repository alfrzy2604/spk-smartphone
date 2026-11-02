<?php

include "koneksi.php";

$conn = new mysqli($host,$user,$pass,$db);

$id = $_GET['id'];

$conn->query("
DELETE FROM normalisasi
WHERE id_normalisasi='$id'
");

header("Location: normalisasi.php");
exit;

?>