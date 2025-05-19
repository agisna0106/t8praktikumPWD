<?php
require_once 'controller/KopiController.php';

$kopi = new KopiController();
$datas = $kopi->getAllKopi();
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
    </nav>
    <section class="content">
        <form method="post">
            <label>Nama Kopi&nbsp;&nbsp;:</label>
            <input type="text" name="nama" required><br>
            
            <label>Stok &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="number" name="stock" required><br>
            
            <label>Harga &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="number" name="harga" required><br><br>
            
            <button type="submit" name="submit">Tambah</button>
        </form>
        <?php 
            if(isset($_POST['submit'])){
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
                <th>Aksi</th>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach ($datas as $data) {
                        echo '<tr>';
                        echo '<td>'.$no++.'</td>';
                        echo '<td>'.$data['nama'].'</td>';
                        echo '<td>'.$data['stock'].'</td>';
                        echo '<td>'.$data['harga'].'</td>';
                        echo '<td>
                            <a href="CRUD/update.php?id='.$data['id'].'">Edit</a> |
                            <a href="CRUD/delete.php?action=hapus&id='.$data['id'].'" onclick="return confirm(\'Yakin hapus data?\')">Hapus</a>
                        </td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </section>
    
</body>
</html>



