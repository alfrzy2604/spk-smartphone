<?php

include "koneksi.php";

$conn = new mysqli($host,$user,$pass,$db);

$id = $_GET['id'];

$conn->query("
DELETE FROM subkriteria
WHERE id_subkriteria='$id'
");

header("Location: subkriteria.php");

?>