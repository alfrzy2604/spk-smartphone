<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

$data = $conn->query("
SELECT * FROM subkriteria
ORDER BY id_subkriteria ASC
");

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
<html>
<head>
<title>Laporan Subkriteria</title>

<style>

body{
font-family:Arial;
margin:35px;
}

.kop{
display:flex;
align-items:center;
border-bottom:2px solid black;
padding-bottom:10px;
}

.kop img{
width:110px;
}

.kop-text{
flex:1;
text-align:center;
}

.kop-text h1{
margin:0;
color:#c0392b;
}

.judul{
text-align:center;
margin:25px 0;
text-decoration:underline;
}

table{
width:100%;
border-collapse:collapse;
}

table th,
table td{
border:1px solid black;
padding:8px;
text-align:center;
}

table th{
background:#dbe8ff;
}

.ttd{
    width:250px;
    margin-top:30px;
    margin-left:auto;
    text-align:center;
    font-size:13px;
    page-break-inside:avoid;
    break-inside:avoid;
}

.nama-ttd{
    margin-top:80px;
    font-weight:bold;
    text-decoration:underline;
}

@media print{

.no-print{
display:none;
}

body{
margin:20px;
}

table{
page-break-inside:auto;
}

tr{
page-break-inside:avoid;
page-break-after:auto;
}

.ttd{
page-break-inside:avoid;
break-inside:avoid;
}

}

</style>

</head>

<body>

<div class="no-print">
<button onclick="window.print()">Cetak</button>

<a href="subkriteria.php">
<button>Tutup</button>
</a>
</div>

<div class="kop">

<img src="logo1.jpeg">

<div class="kop-text">

<h1>JHONO PHONE CELL</h1>

<p>Handphone & Accessories</p>

<p>
Pasar Induk Gedung Masjid Lt.2
Blok ACT No.08/09
</p>

<p>
Kramat Jati, Jakarta Timur
</p>

<p>
Telp.081380008499
</p>

</div>

</div>

<h3 class="judul">
LAPORAN DATA SUBKRITERIA SMARTPHONE
</h3>

<p>
Tanggal Cetak :
<?php echo $tanggal; ?>
</p>

<p>
Dicetak Oleh :
<?php echo $_SESSION['username']; ?>
</p>

<table>

<tr>
<th>No</th>
<th>Kriteria</th>
<th>Crips</th>
<th>Nilai</th>
</tr>

<?php

$no=1;

if ($data && $data->num_rows > 0) {
    while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= htmlspecialchars($row['kriteria']); ?></td>

<td><?= htmlspecialchars($row['crips']); ?></td>

<td><?= htmlspecialchars($row['nilai']); ?></td>

</tr>

<?php 
    }
} else {
?>
<tr>
    <td colspan="4">Data subkriteria belum tersedia.</td>
</tr>
<?php } ?>

</table>

<br><br>

<table style="width:100%; border:none; margin-top:30px;">
<tr style="border:none;">
<td style="border:none;"></td>

<td style="border:none; width:250px; text-align:center;">
    Jakarta, <?php echo $hari . ', ' . $tanggal; ?><br><br>
    Pemilik Toko
    <br><br><br><br><br>
    <b><u>Bapak Triyono</u></b>
</td>
</tr>
</table>

<script>
window.onload=function(){
window.print();
}
</script>

</body>
</html>

