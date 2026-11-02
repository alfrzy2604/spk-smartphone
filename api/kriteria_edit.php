<?php
require_once __DIR__ . '/session_handler.php';

if (!isset($_SESSION['loggedin'])) {
    header("Location: Login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID kriteria tidak ditemukan.");
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM kriteria WHERE id_kriteria = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result();

if ($data->num_rows == 0) {
    die("Data kriteria tidak ditemukan.");
}

$row = $data->fetch_assoc();

if (isset($_POST['update'])) {
    $kode = $_POST['kode_kriteria'];
    $nama = $_POST['nama_kriteria'];
    $atribut = $_POST['atribut'];

    // Mengubah koma menjadi titik agar bisa disimpan sebagai desimal di MySQL
    $bobot = str_replace(',', '.', $_POST['bobot']);

    if (!is_numeric($bobot)) {
        $error = "Bobot harus berupa angka desimal. Contoh: 0,15";
    } else {
        $update = $conn->prepare("
            UPDATE kriteria
            SET kode_kriteria = ?,
                nama_kriteria = ?,
                atribut = ?,
                bobot = ?
            WHERE id_kriteria = ?
        ");

        $update->bind_param(
            "sssdi",
            $kode,
            $nama,
            $atribut,
            $bobot,
            $id
        );

        if ($update->execute()) {
            header("Location: kriteria.php");
            exit;
        } else {
            $error = "Data gagal diupdate.";
        }
    }
}

function tampilBobot($bobot) {
    return str_replace('.', ',', rtrim(rtrim($bobot, '0'), '.'));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kriteria</title>
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

            <h2>Edit Kriteria</h2>

            <?php if (!empty($error)) { ?>
                <p style="color:red; margin-top:15px;">
                    <?php echo $error; ?>
                </p>
            <?php } ?>

            <form method="POST">

                <label>Kode Kriteria</label>
                <input type="text"
                       name="kode_kriteria"
                       value="<?php echo htmlspecialchars($row['kode_kriteria']); ?>"
                       required>

                <label>Nama Kriteria</label>
                <input type="text"
                       name="nama_kriteria"
                       value="<?php echo htmlspecialchars($row['nama_kriteria']); ?>"
                       required>

                <label>Atribut</label>
                <select name="atribut" required>
                    <option value="Benefit" <?php if ($row['atribut'] == "Benefit") echo "selected"; ?>>
                        Benefit
                    </option>

                    <option value="Cost" <?php if ($row['atribut'] == "Cost") echo "selected"; ?>>
                        Cost
                    </option>
                </select>

                <label>Bobot</label>
                <input type="text"
                       name="bobot"
                       value="<?php echo tampilBobot($row['bobot']); ?>"
                       placeholder="Contoh: 0,15"
                       required>

                <br><br>

                <button type="submit"
                        name="update"
                        class="btn-add">
                    Update
                </button>

                <a href="kriteria.php" class="btn-print">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>

