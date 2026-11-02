<?php
session_start();
include "koneksi.php";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_SESSION["loggedin"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_user = $_POST['username'];
    $input_pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");

    if (!$stmt) {
        die("Query error: " . $conn->error);
    }

    $stmt->bind_param("s", $input_user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($input_pass === $row['password']) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $row['username'];
            $_SESSION["role"] = $row['role'];

            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah";
        }
    } else {
        $error = "Username tidak ditemukan";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | SPK Smartphone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">
        <img src="logo1.jpeg" alt="Logo" class="logo">

        <h2>Login Admin</h2>
        <p>Sistem Pendukung Keputusan Pemilihan Smartphone</p>

        <form method="post" action="">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit">Login</button>
        </form>

        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
    </div>
</div>

</body>
</html>