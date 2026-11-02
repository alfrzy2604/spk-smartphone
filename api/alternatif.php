<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$result = $conn->query("SELECT * FROM alternatif ORDER BY id_alternatif ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Alternatif</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="topbar no-print">
    <div class="logo">
        <img src="logo1.jpeg" alt="Logo">
    </div>

    <div class="user-info">
        <span><?php echo $_SESSION['username']; ?></span>
        <a href="logout.php">↪ Logout</a>
    </div>
</div>

<div class="container">
    <div class="sidebar no-print">
        <a href="index.php">Dashboard</a>
        <a class="active" href="alternatif.php">Alternatif</a>
        <a href="kriteria.php">Kriteria</a>
        <a href="subkriteria.php">Subkriteria</a>
        <a href="normalisasi.php">Normalisasi</a>
        <a href="perhitungan.php">Perhitungan</a>
    </div>

    <div class="content">
        <div class="table-box">
            <div class="table-header no-print">
                <h2>Daftar Alternatif Smartphone</h2>

                <div class="table-action">
                    <a href="alternatif_tambah.php" class="btn-add">+ Tambah Data</a>
                    <a href="cetak_alternatif.php" target="_blank" class="btn-print">Cetak</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Tahun</th>
                        <th class="no-print">Aksi</th>
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
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['merk']; ?></td>
                        <td><?php echo $row['tahun']; ?></td>
                        <td class="no-print">
                            <a href="alternatif_edit.php?id=<?php echo $row['id_alternatif']; ?>" class="action-edit">Edit</a>
                            <span class="action-separator">|</span>
                            <a href="alternatif_hapus.php?id=<?php echo $row['id_alternatif']; ?>"
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
                        <td colspan="5">Data alternatif belum tersedia.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
