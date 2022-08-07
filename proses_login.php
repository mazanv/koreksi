<?php
include "koneksi.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE username = '$username' AND password =md5( '$password')";
$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) > 0) {
    $_SESSION['login'] == 'admin';
    echo "<script>alert('Anda Berhasil Login'); location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Anda Gagal Login'); location.href = 'login.php';</script>";
}
