<?php
include "koneksi.php";

$kd_sewa = $_POST['kd_sewa'];
$kd_mobil = $_POST['kd_mobil'];
$kd_customer = $_POST['kd_customer'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];


$querymobil = mysqli_query($koneksi, "SELECT * FROM mobil WHERE kd_mobil = '$kd_mobil'");
while ($mobil = mysqli_fetch_assoc($querymobil)) {
    $stok = $mobil['stok'];
}

if ($stok == 0) {
    echo "<script>alert('Stok Kosong, Pilih Mobil Lain!'); location.href = 'edit.php'; </script>";
} else if ($tgl_pinjam > $tgl_kembali) {
    echo "<script>alert('Format Tanggal Salah!'); location.href = 'edit.php'; </script>";
} else {

    $diff = date_diff(date_create($tgl_pinjam), date_create($tgl_kembali));
    $hari = $diff->format("%a") + 1;
    $sql = "SELECT * FROM mobil WHERE kd_mobil = '$kd_mobil'";
    $query = mysqli_query($koneksi, $sql);

    while ($mobil = mysqli_fetch_assoc($query)) {
        $tarif_sewa = $mobil['tarif_sewa'];
    }

    $total_sewa = $hari * $tarif_sewa;

    $sql1 = "UPDATE sewa SET kd_mobil = '$kd_mobil', kd_customer = '$kd_customer', tgl_pinjam = '$tgl_pinjam', tgl_kembali = '$tgl_kembali', total_sewa = '$total_sewa' WHERE kd_sewa = '$kd_sewa'";
    $query1 = mysqli_query($koneksi, $sql1);

    if ($query1) {
        // echo "Salah ga?";
        echo "<script>alert('Edit Data Berhasil!'); location.href = 'index.php'; </script>";
    } else {
        echo "<script>alert('Edit Data Gagal!'); location.href = 'edit.php'; </script>";
    }
}
