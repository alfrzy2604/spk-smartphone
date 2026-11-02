<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM kriteria WHERE id_kriteria = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: kriteria.php");
exit;
?>

