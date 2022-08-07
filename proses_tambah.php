<?php
include "koneksi.php";

$kd_mobil = $_POST['kd_mobil'];
$kd_customer = (int)$_POST['kd_customer'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];

$getCarsByID = mysqli_query($koneksi, "SELECT * FROM mobil WHERE kd_mobil = '$kd_mobil'");

if (!mysqli_num_rows($getCarsByID))
    echo "<script>alert('Stok Kosong, Pilih Mobil Lain!'); location.href = 'tambah.php'; </script>";
else if ($tgl_pinjam > $tgl_kembali)
    echo "<script>alert('Format Tanggal Salah!'); location.href = 'tambah.php'; </script>";
else {

    $diff = date_diff(date_create($tgl_pinjam), date_create($tgl_kembali));
    $hari = $diff->format("%a") + 1;

    while ($mobil = mysqli_fetch_assoc($getCarsByID)) {
        $tarif_sewa = $mobil['tarif_sewa'];
    }

    $total_sewa = $hari * $tarif_sewa;

    $createRent = "INSERT INTO sewa(kd_mobil, kd_customer, tgl_pinjam, tgl_kembali, total_sewa) VALUES('$kd_mobil', $kd_customer, '$tgl_pinjam', '$tgl_kembali', '$total_sewa')";
    $resultRent = mysqli_query($koneksi, $createRent);
    if ($resultRent)
        echo "<script>alert('Tambah Data Berhasil!'); location.href = 'index.php'; </script>";
    else
        echo "<script>alert('Tambah Data Gagal!'); location.href = 'tambah.php'; </script>";
}
