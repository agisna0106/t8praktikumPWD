<?php
require_once 'session.php';

// Hapus semua variabel sesi
$_SESSION = [];

// Hancurkan sesi
session_destroy();

// Redirect ke form login
header("Location: loginForm.php");
exit;
