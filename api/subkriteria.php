<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$result = $conn->query("SELECT * FROM subkriteria ORDER BY id_subkriteria ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Subkriteria</title>
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
        <a href="kriteria.php">Kriteria</a>
        <a class="active" href="subkriteria.php">Subkriteria</a>
        <a href="normalisasi.php">Normalisasi</a>
        <a href="perhitungan.php">Perhitungan</a>
    </div>

    <div class="content">
        <div class="table-box">
            <div class="table-header">
                <h2>Daftar Subkriteria Smartphone</h2>

                <div class="table-action">
                    <a href="subkriteria_tambah.php" class="btn-add">+ Tambah Data</a>
                    <a href="cetak_subkriteria.php" target="_blank" class="btn-print">Cetak</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kriteria</th>
                        <th>Crips</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['kriteria']; ?></td>
                        <td><?php echo $row['crips']; ?></td>
                        <td><?php echo $row['nilai']; ?></td>
                        <td>
                            <a href="subkriteria_edit.php?id=<?php echo $row['id_subkriteria']; ?>" class="action-edit">Edit</a>

                            <span class="action-separator">|</span>

                            <a href="subkriteria_hapus.php?id=<?php echo $row['id_subkriteria']; ?>"
                               class="action-delete"
                               onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="5">Data subkriteria belum tersedia.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

