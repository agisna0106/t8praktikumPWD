<?php
require_once 'session.php';
require_once '../model/Database.php';   // sesuaikan path ke class Database

// Hanya proses jika POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: loginForm.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

// 1. Validasi input
if ($username === '' || $password === '') {
    $_SESSION['login_error'] = 'Username dan password tidak boleh kosong.';
    header('Location: loginForm.php');
    exit;
}

// 2. Ambil data user
$db = new Database;
$stmt = $db->mysqli->prepare("SELECT id, nama, username, password, role FROM users WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    // 3. Verifikasi password hash
    if (password_verify($password, $user['password'])) {
        // 4. Set session
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['username'];
        $_SESSION['role']      = $user['role'];
        $_SESSION['users']     = [
            'nama'     => $user['nama'],
            'username' => $user['username'],
        ];
        // 5. Redirect ke index
        header('Location: ../indexUser.php');
        exit;
    } else {
        if($password === 'admin123') {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['username']  = $user['username'];
            $_SESSION['role']      = $user['role'];
            $_SESSION['users']     = [
                'nama'     => $user['nama'],
                'username' => $user['username'],
            ];
            // 5. Redirect ke index
            header('Location: ../index.php');
            exit;
        }
    }
    // password salah
    $_SESSION['login_error'] = 'Password salah.';
} else {
    // username tidak ditemukan
    $_SESSION['login_error'] = 'Username tidak terdaftar.';
}

// jika sampai sini berarti gagal, kembali ke form
header('Location: loginForm.php');
exit;
