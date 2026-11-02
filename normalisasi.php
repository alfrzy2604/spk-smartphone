<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$conn = new mysqli($host, $user, $pass, $db);

$result = $conn->query("SELECT * FROM normalisasi ORDER BY id_normalisasi ASC");

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

/* Kriteria */
$kriteria = [
    'nilai_chipset' => ['label' => 'Nilai Chipset', 'atribut' => 'Benefit'],
    'nilai_ram' => ['label' => 'Nilai RAM', 'atribut' => 'Benefit'],
    'nilai_storage' => ['label' => 'Nilai Storage', 'atribut' => 'Benefit'],
    'nilai_layar' => ['label' => 'Nilai Layar', 'atribut' => 'Benefit'],
    'nilai_kamera_depan' => ['label' => 'Nilai Kamera Depan', 'atribut' => 'Benefit'],
    'nilai_kamera_belakang' => ['label' => 'Nilai Kamera Belakang', 'atribut' => 'Benefit'],
    'nilai_baterai' => ['label' => 'Nilai Baterai', 'atribut' => 'Benefit'],
    'nilai_harga' => ['label' => 'Nilai Harga', 'atribut' => 'Cost'],
    'nilai_berat' => ['label' => 'Nilai Berat', 'atribut' => 'Cost'],
    'nilai_fast_charging' => ['label' => 'Nilai Fast Charging', 'atribut' => 'Benefit']
];

/* Mencari nilai max untuk benefit dan min untuk cost */
/* Mencari nilai max untuk benefit dan min untuk cost */
$pembagi = [];

foreach ($kriteria as $field => $info) {
    $nilaiKolom = [];

    foreach ($data as $row) {
        $nilaiKolom[] = (float) $row[$field];
    }

    if (!empty($nilaiKolom)) {
        if ($info['atribut'] == 'Benefit') {
            $pembagi[$field] = max($nilaiKolom);
        } else {
            $nilaiPositif = array_filter($nilaiKolom, function($nilai) {
                return $nilai > 0;
            });

            $pembagi[$field] = !empty($nilaiPositif) ? min($nilaiPositif) : 0;
        }
    } else {
        $pembagi[$field] = 0;
    }
}

/* Fungsi format angka agar rapi */

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Normalisasi</title>
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
        <a href="subkriteria.php">Subkriteria</a>
        <a class="active" href="normalisasi.php">Normalisasi</a>
        <a href="perhitungan.php">Perhitungan</a>
    </div>

    <div class="content">
        <div class="table-box">
            <div class="table-header">
                <h2>Normalisasi</h2>

                <div class="table-action">
                    <a href="normalisasi_tambah.php" class="btn-add">+ Tambah</a>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Merek Smartphone</th>
                            <th>Harga</th>

                            <?php foreach ($kriteria as $info) { ?>
                                <th><?php echo $info['label']; ?></th>
                            <?php } ?>

                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    if (!empty($data)) {
                        foreach ($data as $row) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['merk']); ?></td>
                            <td><?php echo htmlspecialchars($row['merek_smartphone']); ?></td>
                            <td><?php echo number_format($row['harga'], 0, ',', '.'); ?></td>

                            
                            <?php foreach ($kriteria as $field => $info) { ?>
                            <td><?php echo $row[$field]; ?></td>
                            <?php } ?>

                            <td>
                                <a href="normalisasi_edit.php?id=<?php echo $row['id_normalisasi']; ?>" class="action-edit">
                                    Edit
                                </a>

                                <span class="action-separator">|</span>

                                <a href="normalisasi_hapus.php?id=<?php echo $row['id_normalisasi']; ?>"
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
                            <td colspan="15">Data normalisasi belum tersedia.</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</body>
</html>