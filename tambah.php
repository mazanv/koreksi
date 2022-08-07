<?php
include "koneksi.php";
$sql = "SELECT * FROM mobil WHERE stok > 0";
$query = mysqli_query($koneksi, $sql);
$sql2 = "SELECT * FROM cusstomer";
$query2 = mysqli_query($koneksi, $sql2);
// $sql = "SELECT *, cusstomer.nama, mobil.jenis_mobil FROM sewa JOIN mobil ON mobil.kd_mobil = sewa.kd_mobil JOIN cusstomer ON cusstomer.kd_customer = sewa.kd_customer";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <title>Tambah</title>
</head>

<body>
    <form action="proses_tambah.php" method="post">
        <input type="hidden" name="kd_sewa">
        <label class="label-control" for="kd_mobil">KD Mobil</label>
        <br><select class="select-control" name="kd_mobil" id="kd_mobil">
            <option value="">-- Pilih Jenis Mobil --</option>
            <?php
            while ($mobil = mysqli_fetch_assoc($query)) { ?>
                <option value=""><?= $mobil['kd_mobil'] ?><?= strtoupper($mobil['jenis_mobil']) ?></option>
            <?php }
            ?>
        </select><br>
        <!-- <br><input type="number" name="kd_mobil"><br> -->
        <label class="form-control" for="kd_customer">KD Customer</label>
        <br><select name="kd_customer" id="kd_customer">
            <option value="">-- Pilih Nama Customer --</option>
            <?php
            while ($cusstomer = mysqli_fetch_assoc($query2)) { ?>
                <option value=""><?= $cusstomer['kd_customer'] ?><?= strtoupper($cusstomer['nama']) ?></option>
            <?php }
            ?>
        </select><br>
        <!-- <br><input type="number" name="kd_customer"><br> -->
        <label for="tgl_pinjam">Tgl Pinjam</label>
        <br><input type="date" name="tgl_pinjam"><br>
        <label for="tgl_kembali">Tgl Kembali</label>
        <br><input type="date" name="tgl_kembali"><br>
        <button type="submit" class="btn btn-outline-primary">Kirim</button>
    </form>

</body>

</html>