<?php

include "koneksi.php";

$conn = new mysqli($host,$user,$pass,$db);

$id = $_GET['id'];

$conn->query("
DELETE FROM kriteria
WHERE id_kriteria='$id'
");

header("Location: kriteria.php");

?>