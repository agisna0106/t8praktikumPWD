<?php
require_once 'model/Kopi.php';

$kopi = new Kopi();
$table = 'kopi';
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
    <section class="content">
        <h1>Tabel Kopi</h1>
        <table border="1">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    $data = $kopi->tampil($table);
                    foreach ($data as $data) {
                        echo '<tr>';
                        echo '<td>'.$no++.'</td>';
                        echo '<td>'.$data['nama'].'</td>';
                        echo '<td>'.$data['stock'].'</td>';
                        echo '<td>'.$data['harga'].'</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </section>
    
</body>
</html>



