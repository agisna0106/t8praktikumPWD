<?php
require '../model/Database.php';

$db = new Database();
$conn = $db->mysqli;

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'viewer'; // default role

    // Cek apakah username sudah digunakan
    $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
    if ($check) {
        $check->bind_param("s", $username);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "❌ Username sudah digunakan. Silakan pilih yang lain.";
        } else {
            $query = "INSERT INTO users (nama, username, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $nama, $username, $password, $role);

            if ($stmt->execute()) {
                $message = '✅ Registrasi berhasil! Anda akan diarahkan ke halaman login...';
                // Redirect otomatis setelah 3 detik
                echo "<script>alert('register berhasil);</script>";
                echo "<script>windows.location.href='login.php'; </script>";
            } else {
                $message = '❌ Terjadi kesalahan saat menyimpan data.';
            }

            $stmt->close();
        }

        $check->close();
    } else {
        $message = "❌ Gagal menyiapkan query untuk cek username.";
    }
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

            <p class="signup">
                Already have an account? <a href="loginForm.php">Sign in</a>
            </p>
        </form>
    </div>
</body>

</html>