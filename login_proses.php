<?php
session_start();

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password_plain = $_POST['password'];
    $password = md5($password_plain);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $db->query($query);
    $data = mysqli_fetch_array($result);

    if ($result->num_rows == 1) {
        $_SESSION['login'] = TRUE;
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];
        $_SESSION['user_id'] = $data['id_user'];

        // Login berhasil, arahkan ke halaman lain
        if ($_SESSION['level'] == 'admin') {
            header("Location: admin/index.php");
        } elseif ($_SESSION['level'] == 'dokter') {
            header("Location: dokter/index.php"); 
        }
        else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "Login gagal. Silakan coba lagi.";
    }
}
?>