<?php
require_once '../controller/KopiController.php';

$kopi = new KopiController();

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$datas = $kopi->getAllKopi();
$selected = null;

foreach ($datas as $d) {
    if ($d['id'] == $id) {
        $selected = $d;
        break;
    }
}

if (!$selected) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Kopi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <button><a href="../index.php"><-Back</a></button>
    <section class="content">
        <h1>Edit Data Kopi</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $selected['id']; ?>">
            <label>Nama Kopi:</label><br>
            <input type="text" name="nama" value="<?= $selected['nama']; ?>" required><br>
            <label>Stok:</label><br>
            <input type="number" name="stock" value="<?= $selected['stock']; ?>" required><br>
            <label>Harga:</label><br>
            <input type="number" name="harga" value="<?= $selected['harga']; ?>" required><br><br>
            <button type="submit" name="submit">Update</button>
        </form>
        <?php

        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $stock = $_POST['stock'];
            $harga = $_POST['harga'];

            $data = [
                'nama' => $nama,
                'stock' => $stock,
                'harga' => $harga
            ];
            $where = ['id' => $id];
            $kopi->updateKopi($data, $where);
            echo "<script>alert('Data Berhasil Diupdate'); window.location.href='../index.php';</script>";    
        }
        ?>
    </section>
</body>
</html>
