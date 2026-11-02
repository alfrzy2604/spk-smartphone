<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$conn = new mysqli($host, $user, $pass, $db);

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM alternatif WHERE id_alternatif = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: alternatif.php");
exit;
?>