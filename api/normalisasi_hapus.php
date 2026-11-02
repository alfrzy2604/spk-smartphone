<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM normalisasi WHERE id_normalisasi = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: normalisasi.php");
exit;
?>

