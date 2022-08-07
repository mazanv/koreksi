<?php
include "koneksi.php";
session_start();
$sql = "SELECT * FROM mobil WHERE NOT stok = '0'";
$query = mysqli_query($koneksi, $sql);
$sql2 = "SELECT * FROM cusstomer";
$query2 = mysqli_query($koneksi, $sql2);
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
    <div class="container">
        <h1>Tambah Data</h1>
        <form action="proses_tambah.php" method="post">
            <input type="hidden" name="kd_sewa">
            <label class="label-control" for="kd_mobil">KD Mobil</label>
            <br><select class="form-select" name="kd_mobil" id="kd_mobil">
                <option value="">-- Pilih Jenis Mobil --</option>
                <?php
                while ($mobil = mysqli_fetch_assoc($query)) { ?>
                    <option value=""><?= $mobil['kd_mobil'] ?><?= strtoupper($mobil['jenis_mobil']) ?></option>
                <?php }
                ?>
            </select><br>
            <!-- <br><input type="number" name="kd_mobil"><br> -->
            <label class="label-control" for="kd_customer">KD Customer</label>
            <br><select class="form-select" name="kd_customer" id="kd_customer">
                <option value="">-- Pilih Nama Customer --</option>
                <?php
                while ($cusstomer = mysqli_fetch_assoc($query2)) { ?>
                    <option value=""><?= $cusstomer['kd_customer'] ?><?= strtoupper($cusstomer['nama']) ?></option>
                <?php }
                ?>
            </select><br>
            <!-- <br><input type="number" name="kd_customer"><br> -->
            <label class="label-control" for="tgl_pinjam">Tgl Pinjam</label>
            <br><input class="form-control" type="date" name="tgl_pinjam"><br>
            <label class="label-control" for="tgl_kembali">Tgl Kembali</label>
            <br><input class="form-control" type="date" name="tgl_kembali"><br>
            <button type="submit" class="btn btn-outline-primary">Kirim</button>
        </form>
    </div>


</body>

</html>