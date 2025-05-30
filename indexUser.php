<?php
require_once 'auth/session.php';

if(!isset($_SESSION['user_id'])) {
    header('Location: auth/loginForm.php');
    exit();
} 

$role = $_SESSION['role'];
$username = $_SESSION['users']['nama'];

require_once 'model/Database.php';

$db = new Database();
$result = $db->mysqli->query("SELECT * FROM kopi");

$datas = [];
if($result) {
    $datas = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kopi</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav>
        <h2>KOPIKU</h2>
        <div style="float: right;" class="nav-buttons">
            <span style="margin-top: 5px;">Halo, <?= $_SESSION['username']; ?></span>
            <a href="auth/logout.php" onclick="return confirm('Yakin ingin logout?')">
                <button type="button">Logout</button>
            </a>
        </div>
    </nav>
    <section class="content">
        <?php if ($role === 0): ?>
            <form method="post">
                <label>Nama Kopi&nbsp;&nbsp;:</label>
                <input type="text" name="nama" required><br>

                <label>Stok &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type="number" name="stock" required><br>

                <label>Harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type="number" name="harga" required><br><br>

                <button type="submit" name="submit">Tambah</button>
            </form>
        <?php endif ?>
        <?php
        if (isset($_POST['submit']) and $role === 0) {
            $nama = $_POST['nama'];
            $stock = $_POST['stock'];
            $harga = $_POST['harga'];

            $data = [
                'nama' => $nama,
                'stock' => $stock,
                'harga' => $harga,
            ];

            $kopi->addKopi($data);
            echo "<script>alert('Data Berhasil Di Simpah');</script>";
            exit;

            header("Location: index.php");
        }
        ?>
        <h1>Tabel Kopi</h1>
        <table border="1">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
                <?php if ($role === 0): ?>
                    <th>Aksi</th>
                <?php endif; ?>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($datas as $data) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>';
                    echo '<td>' . $data['nama'] . '</td>';
                    echo '<td>' . $data['stock'] . '</td>';
                    echo '<td>' . $data['harga'] . '</td>';
                    if ($role === 0) {
                        echo    '<td>
                                    <a href="CRUD/update.php?id=' . $data['id'] . '">Edit</a> |
                                    <a href="CRUD/delete.php?action=hapus&id=' . $data['id'] . '" onclick="return confirm(\'Yakin hapus data?\')">Hapus</a>
                                </td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </section>

</body>

</html>