<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$data = $conn->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");

date_default_timezone_set('Asia/Jakarta');

$hariIndo = [
'Sunday' => 'Minggu',
'Monday' => 'Senin',
'Tuesday' => 'Selasa',
'Wednesday' => 'Rabu',
'Thursday' => 'Kamis',
'Friday' => 'Jumat',
'Saturday' => 'Sabtu'
];

$bulanIndo = [
1 => 'Januari',
2 => 'Februari',
3 => 'Maret',
4 => 'April',
5 => 'Mei',
6 => 'Juni',
7 => 'Juli',
8 => 'Agustus',
9 => 'September',
10 => 'Oktober',
11 => 'November',
12 => 'Desember'
];

$hari = $hariIndo[date('l')];
$tanggal = date('d') . ' ' . $bulanIndo[(int)date('m')] . ' ' . date('Y');
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Kriteria Smartphone</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 35px;
    color: #000;
}

.no-print {
    margin-bottom: 25px;
}

.no-print button {
    padding: 10px 18px;
    cursor: pointer;
}

.kop {
    display: flex;
    align-items: center;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
}

.kop img {
    width: 110px;
    height: auto;
}

.kop-text {
    flex: 1;
    text-align: center;
}

.kop-text h1 {
    margin: 0;
    color: #c0392b;
    font-size: 30px;
    letter-spacing: 2px;
}

.kop-text p {
    margin: 2px 0;
    font-size: 13px;
    line-height: 1.4;
}

.judul-laporan {
    text-align: center;
    margin: 25px 0 18px;
    font-size: 18px;
    text-decoration: underline;
}

.info {
    margin-bottom: 12px;
    font-size: 13px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th {
    background: #d9e8ff;
}

th, td {
    border: 1px solid #000;
    padding: 8px;
    text-align: center;
    font-size: 13px;
}

.ttd {
    width: 260px;
    float: right;
    text-align: center;
    margin-top: 45px;
    font-size: 13px;
}

.nama-ttd {
    margin-top: 70px;
    font-weight: bold;
    text-decoration: underline;
}

@media print {
    .no-print {
        display: none;
    }

    body {
        margin: 25px;
    }

    @page {
        margin: 20mm;
    }
}
</style>
</head>

<body>

<div class="no-print">
    <button onclick="window.print()">Cetak</button>
    <a href="kriteria.php">
        <button type="button">Tutup</button>
    </a>
</div>

<div class="kop">
    <img src="logo1.jpeg" alt="Logo">

    <div class="kop-text">
        <h1>JHONO PHONE CELL</h1>
        <p>Handphone & Accessories</p>
        <p>Pasar Induk Gedung Masjid Lt. 2 Blok ACT No. 08/09</p>
        <p>Kp. Tengah, Kramat Jati, Jakarta Timur, DKI Jakarta 13540</p>
        <p>Telp. 081380008499</p>
    </div>
</div>

<h3 class="judul-laporan">LAPORAN DATA KRITERIA SMARTPHONE</h3>

<div class="info">
    Tanggal Cetak: <?php echo $tanggal; ?><br>
    Dicetak oleh: <?php echo $_SESSION['username']; ?>
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Kriteria</th>
            <th>Nama Kriteria</th>
            <th>Atribut</th>
            <th>Bobot</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $no = 1;
        if ($data && $data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($row['kode_kriteria']); ?></td>
            <td><?php echo htmlspecialchars($row['nama_kriteria']); ?></td>
            <td><?php echo htmlspecialchars($row['atribut']); ?></td>
            <td><?php echo htmlspecialchars($row['bobot']); ?></td>
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

<div class="ttd">
    <p>Jakarta, <?php echo $hari . ', ' . $tanggal; ?></p>
    <p>Pemilik Toko</p>
    <p class="nama-ttd">Bapak Triyono</p>
</div>

<script>
window.onload = function() {
    window.print();
}
</script>

</body>
</html>

