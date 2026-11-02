<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$hitung = isset($_POST['hitung']);

$dataAlternatif = [];
$kriteria = [];
$normalisasi = [];
$preferensi = [];
$ranking = [];
$error = "";

/* ==============================
   MAPPING KRITERIA KE KOLOM DATABASE
================================= */
$mappingKriteria = [
    'C1' => 'nilai_chipset',
    'C2' => 'nilai_ram',
    'C3' => 'nilai_storage',
    'C4' => 'nilai_layar',
    'C5' => 'nilai_kamera_depan',
    'C6' => 'nilai_kamera_belakang',
    'C7' => 'nilai_baterai',
    'C8' => 'nilai_harga',
    'C9' => 'nilai_berat',
    'C10' => 'nilai_fast_charging'
];

function formatNilai($angka)
{
    return rtrim(rtrim(number_format($angka, 4, '.', ''), '0'), '.');
}

function formatBobot($angka)
{
    return str_replace('.', ',', rtrim(rtrim(number_format($angka, 4, '.', ''), '0'), '.'));
}

/* ==============================
   PROSES PERHITUNGAN JIKA TOMBOL DIKLIK
================================= */
if ($hitung) {

    /* Ambil data normalisasi */
    $queryNormalisasi = $conn->query("SELECT * FROM normalisasi ORDER BY id_normalisasi ASC");

    if ($queryNormalisasi && $queryNormalisasi->num_rows > 0) {
        while ($row = $queryNormalisasi->fetch_assoc()) {
            $dataAlternatif[] = $row;
        }
    } else {
        $error = "Data normalisasi belum tersedia. Silakan isi data normalisasi terlebih dahulu.";
    }

    /* Ambil data kriteria */
    $queryKriteria = $conn->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");

    if ($queryKriteria && $queryKriteria->num_rows > 0) {
        while ($row = $queryKriteria->fetch_assoc()) {
            $kode = $row['kode_kriteria'];

            if (isset($mappingKriteria[$kode])) {
                $field = $mappingKriteria[$kode];

                $kriteria[$field] = [
                    'kode' => $kode,
                    'nama' => $row['nama_kriteria'],
                    'atribut' => $row['atribut'],
                    'bobot' => (float) $row['bobot']
                ];
            }
        }
    } else {
        $error = "Data kriteria belum tersedia. Silakan isi data kriteria terlebih dahulu.";
    }

    if (!empty($dataAlternatif) && !empty($kriteria)) {

        /* ==============================
           CARI NILAI MAX / MIN
        ================================= */
        $pembagi = [];

        foreach ($kriteria as $field => $info) {
            $nilaiKolom = [];

            foreach ($dataAlternatif as $alt) {
                $nilaiKolom[] = (float) $alt[$field];
            }

            if ($info['atribut'] == 'Benefit') {
                $pembagi[$field] = max($nilaiKolom);
            } else {
                $nilaiPositif = array_filter($nilaiKolom, function ($nilai) {
                    return $nilai > 0;
                });

                $pembagi[$field] = !empty($nilaiPositif) ? min($nilaiPositif) : 0;
            }
        }

        /* ==============================
           HITUNG NORMALISASI DAN NILAI PREFERENSI
        ================================= */
        foreach ($dataAlternatif as $alt) {
            $id = $alt['id_normalisasi'];
            $total = 0;

            foreach ($kriteria as $field => $info) {
                $xij = (float) $alt[$field];

                if ($xij == 0 || $pembagi[$field] == 0) {
                    $rij = 0;
                } else {
                    if ($info['atribut'] == 'Benefit') {
                        $rij = $xij / $pembagi[$field];
                    } else {
                        $rij = $pembagi[$field] / $xij;
                    }
                }

                $nilaiPreferensi = $info['bobot'] * $rij;

                $normalisasi[$id][$field] = $rij;
                $preferensi[$id][$field] = $nilaiPreferensi;

                $total += $nilaiPreferensi;
            }

            $ranking[] = [
                'merk' => $alt['merk'],
                'nama' => $alt['merek_smartphone'],
                'hasil' => $total
            ];
        }

        /* Urutkan ranking dari nilai tertinggi */
        usort($ranking, function ($a, $b) {
            return $b['hasil'] <=> $a['hasil'];
        });
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perhitungan SAW</title>
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
        <a href="normalisasi.php">Normalisasi</a>
        <a class="active" href="perhitungan.php">Perhitungan</a>
    </div>

    <div class="content">

        <div class="table-box">
            <div class="table-header">
                <h2>Perhitungan SAW</h2>

                <?php if ($hitung && empty($error) && !empty($ranking)) { ?>
                <div class="table-action">
                    <a href="cetak_perhitungan.php" target="_blank" class="btn-print">
                        Cetak
                    </a>
                </div>
                <?php } ?>
            </div>

            <p>
                <b>Rumus Normalisasi:</b>
                Benefit = Xij / Max Xij, Cost = Min Xij / Xij
            </p>

            <p>
                <b>Rumus Preferensi:</b>
                Vi = Σ Wj × Rij
            </p>

            <br>

            <form method="POST">
                <button type="submit" name="hitung" class="btn-add">
                    Proses Perhitungan
                </button>
            </form>

            <?php if (!$hitung) { ?>
                <p style="margin-top: 20px;">
                    Klik tombol <b>Proses Perhitungan</b> untuk menampilkan hasil perhitungan metode SAW.
                </p>
            <?php } ?>

            <?php if (!empty($error)) { ?>
                <p style="color: red; margin-top: 20px;">
                    <?php echo $error; ?>
                </p>
            <?php } ?>
        </div>

        <?php if ($hitung && empty($error) && !empty($ranking)) { ?>

        <!-- TABEL MATRIKS KEPUTUSAN -->
        <div class="table-box">
            <h3>Matriks Keputusan</h3>
            <br>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Nama Smartphone</th>

                            <?php foreach ($kriteria as $info) { ?>
                                <th><?php echo $info['kode'] . ". " . $info['nama']; ?></th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataAlternatif as $alt) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($alt['merk']); ?></td>
                            <td><?php echo htmlspecialchars($alt['merek_smartphone']); ?></td>

                            <?php foreach ($kriteria as $field => $info) { ?>
                                <td><?php echo $alt[$field]; ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABEL NORMALISASI -->
        <div class="table-box">
            <h3>Normalisasi Data</h3>
            <br>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Nama Smartphone</th>

                            <?php foreach ($kriteria as $info) { ?>
                                <th><?php echo $info['kode'] . ". " . $info['nama']; ?></th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataAlternatif as $alt) {
                            $id = $alt['id_normalisasi'];
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($alt['merk']); ?></td>
                            <td><?php echo htmlspecialchars($alt['merek_smartphone']); ?></td>

                            <?php foreach ($kriteria as $field => $info) { ?>
                                <td><?php echo formatNilai($normalisasi[$id][$field]); ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABEL NILAI PREFERENSI -->
        <div class="table-box">
            <h3>Perhitungan Nilai Preferensi</h3>
            <br>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Merk</th>
                            <th>Nama Smartphone</th>

                            <?php foreach ($kriteria as $info) { ?>
                                <th><?php echo $info['kode']; ?></th>
                            <?php } ?>

                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataAlternatif as $alt) {
                            $id = $alt['id_normalisasi'];
                            $totalBaris = 0;
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($alt['merk']); ?></td>
                            <td><?php echo htmlspecialchars($alt['merek_smartphone']); ?></td>

                            <?php
                            foreach ($kriteria as $field => $info) {
                                $nilai = $preferensi[$id][$field];
                                $totalBaris += $nilai;
                            ?>
                                <td><?php echo formatNilai($nilai); ?></td>
                            <?php } ?>

                            <td><b><?php echo formatNilai($totalBaris); ?></b></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TABEL HASIL PERANGKINGAN -->
        <div class="table-box">
            <h3>Hasil Perangkingan</h3>
            <br>

            <table>
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Merk</th>
                        <th>Nama Smartphone</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $rank = 1;
                    foreach ($ranking as $row) {
                    ?>
                    <tr>
                        <td><b><?php echo $rank++; ?></b></td>
                        <td><?php echo htmlspecialchars($row['merk']); ?></td>
                        <td><b><?php echo htmlspecialchars($row['nama']); ?></b></td>
                        <td><b><?php echo formatNilai($row['hasil']); ?></b></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- KETERANGAN HASIL -->
        <div class="table-box hasil-box">
            <h3>Keterangan Hasil Perangkingan</h3>

            <p>
                Berdasarkan hasil perhitungan dan perangkingan,
                alternatif dengan nilai tertinggi adalah:
            </p>

            <h2>
                <?php echo htmlspecialchars($ranking[0]['nama']); ?>
                dengan skor
                <?php echo formatNilai($ranking[0]['hasil']); ?>
            </h2>

            <p>
                Hal ini menunjukkan bahwa
                <b><?php echo htmlspecialchars($ranking[0]['nama']); ?></b>
                merupakan pilihan terbaik berdasarkan kriteria yang telah diberikan.
            </p>
        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>