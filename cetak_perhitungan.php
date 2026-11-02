<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

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

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

/* AMBIL DATA NORMALISASI */
$queryNormalisasi = $conn->query("SELECT * FROM normalisasi ORDER BY id_normalisasi ASC");

$dataAlternatif = [];

while ($row = $queryNormalisasi->fetch_assoc()) {
    $dataAlternatif[] = $row;
}

/* MAPPING KRITERIA KE KOLOM DATABASE */
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

/* AMBIL DATA KRITERIA */
$queryKriteria = $conn->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");

$kriteria = [];

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

/* FORMAT ANGKA */
function formatNilai($angka)
{
    return rtrim(rtrim(number_format($angka, 4, '.', ''), '0'), '.');
}

/* CARI NILAI MAX DAN MIN */
$pembagi = [];

foreach ($kriteria as $field => $info) {
    $nilaiKolom = [];

    foreach ($dataAlternatif as $alt) {
        $nilaiKolom[] = (float) $alt[$field];
    }

    if (!empty($nilaiKolom)) {
        if ($info['atribut'] == 'Benefit') {
            $pembagi[$field] = max($nilaiKolom);
        } else {
            $nilaiPositif = array_filter($nilaiKolom, function ($nilai) {
                return $nilai > 0;
            });

            $pembagi[$field] = !empty($nilaiPositif) ? min($nilaiPositif) : 0;
        }
    } else {
        $pembagi[$field] = 0;
    }
}

/* HITUNG NILAI AKHIR DAN RANKING */
$ranking = [];

foreach ($dataAlternatif as $alt) {
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

        $total += $info['bobot'] * $rij;
    }

    $ranking[] = [
        'merk' => $alt['merk'],
        'nama' => $alt['merek_smartphone'],
        'hasil' => $total
    ];
}

/* URUTKAN DARI NILAI TERTINGGI */
usort($ranking, function ($a, $b) {
    return $b['hasil'] <=> $a['hasil'];
});
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Cetak Hasil Perangkingan</title>

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
    margin-bottom: 15px;
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

.keterangan {
    border: 1px solid #000;
    padding: 12px;
    margin-top: 25px;
    font-size: 13px;
    background: #f2fff2;
    line-height: 1.5;
}

body {
    font-family: Arial, sans-serif;
    margin: 20px 35px;
    color: #000;
}

.kop {
    display: flex;
    align-items: center;
    border-bottom: 2px solid #000;
    padding-bottom: 8px;
}

.kop img {
    width: 90px;
    height: auto;
}

.kop-text h1 {
    margin: 0;
    color: #c0392b;
    font-size: 28px;
    letter-spacing: 2px;
}

.kop-text p {
    margin: 2px 0;
    font-size: 12px;
    line-height: 1.3;
}

.judul-laporan {
    text-align: center;
    margin: 18px 0 15px;
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
    margin-top: 8px;
}

th, td {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
    font-size: 13px;
}

.keterangan {
    border: 1px solid #000;
    padding: 10px 12px;
    margin-top: 18px;
    font-size: 13px;
    line-height: 1.35;
    background: #fff;
}

.ttd {
    width: 260px;
    text-align: center;
    margin-top: 28px;
    margin-left: auto;
    margin-right: 35px;
    font-size: 13px;
    float: none;
    page-break-inside: avoid;
    break-inside: avoid;
}

.nama-ttd {
    margin-top: 60px;
    font-weight: bold;
    text-decoration: underline;
}

@media print {
    .no-print {
        display: none;
    }

    body {
        margin: 10mm 14mm;
    }

    @page {
        size: A4 portrait;
        margin: 10mm 14mm;
    }

    table,
    tr,
    .keterangan,
    .ttd {
        page-break-inside: avoid;
        break-inside: avoid;
    }
}
</style>
</head>

<body>

<div class="no-print">
    <button onclick="window.print()">Cetak</button>
    <a href="perhitungan.php">
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

<h3 class="judul-laporan">LAPORAN HASIL PERANGKINGAN SMARTPHONE</h3>

<div class="info">
    Tanggal Cetak: <?php echo $hari . ', ' . $tanggal; ?><br>
    Dicetak oleh: <?php echo $_SESSION['username']; ?>
</div>

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

        if (!empty($ranking)) {
            foreach ($ranking as $row) {
        ?>
        <tr>
            <td><b><?php echo $rank++; ?></b></td>
            <td><?php echo htmlspecialchars($row['merk']); ?></td>
            <td><b><?php echo htmlspecialchars($row['nama']); ?></b></td>
            <td><b><?php echo formatNilai($row['hasil']); ?></b></td>
        </tr>
        <?php
            }
        } else {
        ?>
        <tr>
            <td colspan="4">Data perangkingan belum tersedia.</td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php if (!empty($ranking)) { ?>
<div class="keterangan">
    Berdasarkan hasil perhitungan menggunakan metode Simple Additive Weighting (SAW),
    alternatif dengan nilai tertinggi adalah
    <b><?php echo htmlspecialchars($ranking[0]['nama']); ?></b>
    dengan nilai preferensi sebesar
    <b><?php echo formatNilai($ranking[0]['hasil']); ?></b>.
    Dengan demikian, smartphone tersebut menjadi rekomendasi terbaik berdasarkan kriteria yang telah ditentukan.
</div>
<?php } ?>

<<div class="ttd">
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