<?php

require_once 'register.php';

$reg = new Register();

if($_SERVER['REQUEST_METHOD'] == 'POST') {    
    $reg->register();
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

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
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

            <button type="submit" name="register" value="REGISTER">Register</button>

            <p class="signup">
                Already have an account? <a href="loginForm.php">Sign in</a>
            </p>
        </form>
    </div>
</body>

</html>