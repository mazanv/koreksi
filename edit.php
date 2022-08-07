<?php
include "koneksi.php";

$kd_sewa = $_GET['kd_sewa'];
$sql = "SELECT * FROM sewa WHERE kd_sewa = '$kd_sewa'";
$query = mysqli_query($koneksi, $sql);
while ($sewa = mysqli_fetch_assoc($query)) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit</title>
    </head>

    <body>
        <form action="proses_edit.php" method="post">
            <input type="hidden" name="kd_sewa" value="<?= $sewa['kd_sewa'] ?>">
            <label for="kd_mobil">KD Mobil</label>
            <br><input type="number" name="kd_mobil" value="<?= $sewa['kd_mobil'] ?>"><br>
            <label for="kd_customer">KD Customer</label>
            <br><input type="number" name="kd_customer" value="<?= $sewa['kd_customer'] ?>"><br>
            <label for="tgl_pinjam">Tgl Pinjam</label>
            <br><input type="date" name="tgl_pinjam" value="<?= $sewa['tgl_pinjam'] ?>"><br>
            <label for="tgl_kembali">Tgl Kembali</label>
            <br><input type="date" name="tgl_kembali" value="<?= $sewa['tgl_kembali'] ?>"><br>
            <button type="submit">Ubah</button>
        </form>

    </body>

    </html>
<?php

}
?>