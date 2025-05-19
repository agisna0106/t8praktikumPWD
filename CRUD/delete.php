<?php

require_once '../controller/KopiController.php';
$kopi = new KopiController();

$kopi->deleteKopi();
echo "<script>alert('Data Berhasil Di Hapus'); window.location.href='../index.php'</script>";