<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$result = $conn->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");

function formatBobot($bobot) {
    return number_format((float)$bobot, 2, ',', '');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kriteria</title>
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
        <a href="alternatif.php">Alternatif</a>
        <a class="active" href="kriteria.php">Kriteria</a>
        <a href="subkriteria.php">Subkriteria</a>
        <a href="normalisasi.php">Normalisasi</a>
        <a href="perhitungan.php">Perhitungan</a>
    </div>

    <div class="content">

        <div class="table-box">

            <div class="table-header">
                <h2>Daftar Kriteria Smartphone</h2>

                <div class="table-action">
                    <a href="kriteria_tambah.php" class="btn-add">
                        + Tambah Data
                    </a>

                    <a href="cetak_kriteria.php" target="_blank" class="btn-print">
                        Cetak
                    </a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Atribut</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['kode_kriteria']; ?></td>
                        <td><?php echo $row['nama_kriteria']; ?></td>
                        <td><?php echo $row['atribut']; ?></td>
                        <td><?php echo formatBobot($row['bobot']); ?></td>

                        <td>
                            <a href="kriteria_edit.php?id=<?php echo $row['id_kriteria']; ?>" class="action-edit">
                                Edit
                            </a>

                            <span class="action-separator">|</span>

                            <a href="kriteria_hapus.php?id=<?php echo $row['id_kriteria']; ?>"
                               class="action-delete"
                               onclick="return confirm('Yakin ingin menghapus data?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="5">Data kriteria belum tersedia.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</div>

</body>
</html>

