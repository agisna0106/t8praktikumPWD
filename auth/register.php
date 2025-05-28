<?php
require '../model/Database.php';

$db = new Database();
$conn = $db->mysqli;

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek apakah username sudah digunakan
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $message = "❌ Username sudah digunakan. Silakan pilih yang lain.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $role = 'viewer'; // default

        $stmt = $conn->prepare("INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $username, $hashedPassword, $role);

        if ($stmt->execute()) {
            $message = "✅ Registrasi berhasil! <a href='login.php'>Login di sini</a>.";
        } else {
            $message = "❌ Terjadi kesalahan saat registrasi.";
        }
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Register Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #111;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .register-box {
            background-color: #1a1a1a;
            padding: 40px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        .register-box img {
            max-width: 120px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            text-align: left;
        }

        label {
            font-size: 14px;
            margin-bottom: 6px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px;
            font-size: 14px;
            background-color: #222;
            border: 1px solid #444;
            border-radius: 6px;
            color: white;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .google-login {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 0;
            background-color: #333;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            width: 100%;
        }

        .google-login svg {
            margin-right: 10px;
        }

        .signup {
            font-size: 14px;
            color: #ccc;
            text-align: center;
            margin-top: 20px;
        }

        .signup a {
            color: #007bff;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-box">
        <h1>Register</h1>

        <form method="POST">
            <div>
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Nama" required />
            </div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="username" required />
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required />
            </div>

            <button type="submit" name="submit">Register</button>
            <?= "<script>alert('Data Berhasil Diupdate'); window.location.href='login.php';</script>"; ?>

            <p class="signup">
                Already have an account? <a href="loginForm.php">Sign in</a>
            </p>
        </form>
    </div>
</body>

</html>