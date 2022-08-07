<?php
$server = "localhost";
$username = "root";
$pass = "";
$database = "db_rentalmobilg";

$koneksi = mysqli_connect($server, $username, $pass, $database);

if ($koneksi) {
    echo "Berhasil";
} else {
    echo "Gagal";
}
