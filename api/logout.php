<?php
require_once __DIR__ . '/session_handler.php';
session_destroy();
header("Location: Login.php");
exit;
?>

