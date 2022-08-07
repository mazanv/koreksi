<?php
include "koneksi.php";

$kd_mobil = $_POST['kd_mobil'];
$kd_customer = $_POST['kd_customer'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];

// var_dump(mysqli_error($koneksi));
// die;
// var_dump($kd_mobil);
// var_dump(mysqli_fetch_assoc($querymobil));
// die;
$querymobil = mysqli_query($koneksi, "SELECT * FROM mobil WHERE kd_mobil = '$kd_mobil'");
if (mysqli_num_rows($querymobil)) {
    while ($mobil = mysqli_fetch_assoc($querymobil)) {
        $stok = $mobil['stok'];
    }
}


if ($stok == 0) {
    // echo "ga ke kirim?";
    // echo "<script>alert('Stok Kosong, Pilih Mobil Lain!'); location.href = 'tambah.php'; </script>";
} else if ($tgl_pinjam > $tgl_kembali) {
    echo "<script>alert('Format Tanggal Salah!'); location.href = 'tambah.php'; </script>";
} else {

    $diff = date_diff(date_create($tgl_pinjam), date_create($tgl_kembali));
    $hari = $diff->format("%a") + 1;
    $sql = "SELECT * FROM mobil WHERE kd_mobil = '$kd_mobil'";
    $query = mysqli_query($koneksi, $sql);

    while ($mobil = mysqli_fetch_assoc($query)) {
        $tarif_sewa = $mobil['tarif_sewa'];
    }

    $total_sewa = $hari * $tarif_sewa;

    $sql1 = "INSERT INTO sewa(kd_mobil, kd_customer, tgl_pinjam, tgl_kembali, total_sewa) VALUES('$kd_mobil', '$kd_customer', '$tgl_pinjam', '$tgl_kembali', '$total_sewa')";
    $query1 = mysqli_query($koneksi, $sql1);

    if ($query1) {
        echo "<script>alert('Tambah Data Berhasil!'); location.href = 'index.php'; </script>";
    } else {
        echo "<script>alert('Tambah Data Gagal!'); location.href = 'tambah.php'; </script>";
    }
}
