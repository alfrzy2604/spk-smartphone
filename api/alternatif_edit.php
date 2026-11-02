<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$id = $_GET['id'];

$data = $conn->query("SELECT * FROM alternatif WHERE id_alternatif = '$id'");
$row = $data->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $merk = $_POST['merk'];
    $tahun = $_POST['tahun'];

    $stmt = $conn->prepare("UPDATE alternatif SET nama=?, merk=?, tahun=? WHERE id_alternatif=?");
    $stmt->bind_param("sssi", $nama, $merk, $tahun, $id);
    $stmt->execute();

    header("Location: alternatif.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Alternatif</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="topbar">
    <div class="logo">
        <img src="logo1.jpeg" alt="Logo">
    </div>
    <div class="user-info">
        <span><?php echo $_SESSION['username']; ?></span>
        <a href="logout.php">↪ Logout</a>
    </div>
</div>

<div class="container">
    <div class="sidebar">
        <a href="index.php">Dashboard</a>
        <a class="active" href="alternatif.php">Alternatif</a>
        <a href="kriteria.php">Kriteria</a>
        <a href="subkriteria.php">Subkriteria</a>
        <a href="normalisasi.php">Normalisasi</a>
        <a href="perhitungan.php">Perhitungan</a>
    </div>

    <div class="content">
        <div class="table-box">
            <div class="table-header">
                <h2>Edit Data Alternatif</h2>
            </div>

            <form method="post">
                <label>Nama</label>
                <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>

                <label>Merk</label>
                <input type="text" name="merk" value="<?php echo $row['merk']; ?>" required>

                <label>Tahun</label>
                <input type="text" name="tahun" value="<?php echo $row['tahun']; ?>" required>

                <br><br>
                <button type="submit" class="btn-print">Simpan</button>
                <a href="alternatif.php" class="btn-add">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
