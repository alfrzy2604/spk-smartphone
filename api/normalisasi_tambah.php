<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $merk = $_POST['merk'];
    $merek_smartphone = $_POST['merek_smartphone'];
    $harga = $_POST['harga'];
    $nilai_chipset = $_POST['nilai_chipset'];
    $nilai_ram = $_POST['nilai_ram'];
    $nilai_storage = $_POST['nilai_storage'];
    $nilai_layar = $_POST['nilai_layar'];
    $nilai_kamera_depan = $_POST['nilai_kamera_depan'];
    $nilai_kamera_belakang = $_POST['nilai_kamera_belakang'];
    $nilai_baterai = $_POST['nilai_baterai'];
    $nilai_harga = $_POST['nilai_harga'];
    $nilai_berat = $_POST['nilai_berat'];
    $nilai_fast_charging = $_POST['nilai_fast_charging'];

    $stmt = $conn->prepare("INSERT INTO normalisasi 
    (merk, merek_smartphone, harga, nilai_chipset, nilai_ram, nilai_storage, nilai_layar, nilai_kamera_depan, nilai_kamera_belakang, nilai_baterai, nilai_harga, nilai_berat, nilai_fast_charging)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssiiiiiiiiiii",
        $merk,
        $merek_smartphone,
        $harga,
        $nilai_chipset,
        $nilai_ram,
        $nilai_storage,
        $nilai_layar,
        $nilai_kamera_depan,
        $nilai_kamera_belakang,
        $nilai_baterai,
        $nilai_harga,
        $nilai_berat,
        $nilai_fast_charging
    );

    $stmt->execute();

    header("Location: normalisasi.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Normalisasi</title>
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
                <h2>Tambah Data Normalisasi</h2>
            </div>

            <form method="POST">
                <label>Merk</label>
                <input type="text" name="merk" required>

                <label>Merek Smartphone</label>
                <input type="text" name="merek_smartphone" required>

                <label>Harga</label>
                <input type="number" name="harga" required>

                <label>Nilai Chipset</label>
                <select name="nilai_chipset" required>
                    <option value="">Pilih Chipset</option>
                    <option value="1">Helio P22 - 1</option>
                    <option value="2">Snapdragon 710 - 2</option>
                    <option value="3">Snapdragon 855 - 3</option>
                    <option value="4">Helio G96 - 4</option>
                    <option value="5">Bionic - 5</option>
                </select>

                <label>Nilai RAM</label>
                <select name="nilai_ram" required>
                    <option value="">Pilih RAM</option>
                    <option value="1">2 GB - 1</option>
                    <option value="2">3 GB - 2</option>
                    <option value="3">4 GB - 3</option>
                    <option value="4">6 GB - 4</option>
                    <option value="5">8 GB ke atas - 5</option>
                </select>

                <label>Nilai Storage</label>
                <select name="nilai_storage" required>
                    <option value="">Pilih Storage</option>
                    <option value="1">32 GB - 1</option>
                    <option value="2">64 GB - 2</option>
                    <option value="3">128 GB - 3</option>
                    <option value="4">256 GB - 4</option>
                    <option value="5">512 GB ke atas - 5</option>
                </select>

                <label>Nilai Layar</label>
                <select name="nilai_layar" required>
                    <option value="">Pilih Layar</option>
                    <option value="1">Kurang dari 5 inch - 1</option>
                    <option value="2">Kurang dari 5.5 inch - 2</option>
                    <option value="3">Kurang dari 6 inch - 3</option>
                    <option value="4">Kurang dari 6.5 inch - 4</option>
                    <option value="5">6.5 inch ke atas - 5</option>
                </select>

                <label>Nilai Kamera Depan</label>
                <select name="nilai_kamera_depan" required>
                    <option value="">Pilih Kamera Depan</option>
                    <option value="1">Kurang dari 20 MP - 1</option>
                    <option value="2">Kurang dari 30 MP - 2</option>
                    <option value="3">Kurang dari 40 MP - 3</option>
                    <option value="4">Kurang dari 50 MP - 4</option>
                    <option value="5">50 MP ke atas - 5</option>
                </select>

                <label>Nilai Kamera Belakang</label>
                <select name="nilai_kamera_belakang" required>
                    <option value="">Pilih Kamera Belakang</option>
                    <option value="1">Kurang dari 15 MP - 1</option>
                    <option value="2">Kurang dari 20 MP - 2</option>
                    <option value="3">Kurang dari 25 MP - 3</option>
                    <option value="4">Kurang dari 30 MP - 4</option>
                    <option value="5">30 MP ke atas - 5</option>
                </select>

                <label>Nilai Baterai</label>
                <select name="nilai_baterai" required>
                    <option value="">Pilih Baterai</option>
                    <option value="1">Kurang dari 3000 mAh - 1</option>
                    <option value="2">Kurang dari 3500 mAh - 2</option>
                    <option value="3">Kurang dari 4000 mAh - 3</option>
                    <option value="4">Kurang dari 4500 mAh - 4</option>
                    <option value="5">4500 mAh ke atas - 5</option>
                </select>

                <label>Nilai Harga</label>
                <select name="nilai_harga" required>
                    <option value="">Pilih Harga</option>
                    <option value="1">Lebih dari 6.000.000 - 1</option>
                    <option value="2">4.500.000 - 2</option>
                    <option value="3">3.500.000 - 3</option>
                    <option value="4">3.000.000 - 4</option>
                    <option value="5">Kurang dari 1.500.000 - 5</option>
                </select>

                <label>Nilai Berat</label>
                <select name="nilai_berat" required>
                    <option value="">Pilih Berat</option>
                    <option value="1">220 gram ke atas - 1</option>
                    <option value="2">Kurang dari 220 gram - 2</option>
                    <option value="3">Kurang dari 200 gram - 3</option>
                    <option value="4">Kurang dari 185 gram - 4</option>
                    <option value="5">Kurang dari 170 gram - 5</option>
                </select>

                <label>Nilai Fast Charging</label>
                <select name="nilai_fast_charging" required>
                    <option value="">Pilih Fast Charging</option>
                    <option value="1">Kurang dari 18 W - 1</option>
                    <option value="2">18-32 W - 2</option>
                    <option value="3">33-64 W - 3</option>
                    <option value="4">65-99 W - 4</option>
                    <option value="5">120 W ke atas - 5</option>
                </select>

                <br><br>

                <button type="submit" name="simpan" class="btn-add">Add</button>
                <a href="normalisasi.php" class="btn-print">Kembali</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>

