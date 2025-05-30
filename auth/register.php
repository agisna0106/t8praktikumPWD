<?php 

require_once '../model/Database.php';

class Register {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }
    
    public function register() {
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $pass = $_POST['password'];
        $role = 1;

        if(empty($nama) || empty($username) || empty($pass)) {
            echo "<script>alert('Nama, Username atau Password tidak boleh kosong!');
            window.location.href = 'window.location.href='registerForm.php'; </script>";
        } else {
            $get_user = "SELECT * FROM users WHERE username = '$username'";
            $result = $this->db->mysqli->query($get_user);
            $check_username = $result->num_rows;

            if($check_username == 1){
                echo "<script>alert('Username anda sudah terdaftar!'); </script>";
            }else{
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(nama, username, password, role) 
                VALUES('".$nama ."', '" .$username ."', '" .$pass ."', '".$role."')";

                $result = $this->db->mysqli->query($sql);

                if($result){
                    echo "<script>window.location.href='loginForm.php';</script>";
                    header("location:loginForm.php");
                }else {
                   echo "<script>alert('Register Gagal!'); </script>";
                }
            }
        }
    }
}