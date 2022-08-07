<?php
include "koneksi.php";
session_start();

// $sql = "SELECT * FROM sewa";
$sql = "SELECT *, cusstomer.nama, mobil.jenis_mobil FROM sewa JOIN mobil ON mobil.kd_mobil = sewa.kd_mobil JOIN cusstomer ON cusstomer.kd_customer = sewa.kd_customer";
// $sql = "SELECT * mobil.jenis_mobil, customer.nama FROM sewa JOIN mobil ON mobil.kd_mobil = sewa.kd_mobil JOIN customer ON customer.kd_customer = sewa.kd_customer";
$query = mysqli_query($koneksi, $sql);

if (!isset($_SESSION['login'])) {
    echo "<script>alert('Silahkan Login Dulu'); location.href = 'login.php';</script>";
    exit;
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.bundle.js"></script>
        <title>Document</title>
    </head>

    <body>
        <div class="container">
            <h1>Data Sewa</h1>
            <a href="tambah.php"><button>Tambah</button></a>
            <table class="table table-bordered border-secondary">
                <tr class="table table-dark">
                    <th>KD</th>
                    <th>KD Mobil</th>
                    <th>KD Customer</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Total Sewa</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $kd_sewa = 0;
                while ($sewa = mysqli_fetch_assoc($query)) {
                    $kd_sewa++;
                    echo "<tr>";
                    echo "<td>" . $kd_sewa . "</td>";
                    echo "<td>" . strtoupper($sewa['jenis_mobil']) . "</td>";
                    echo "<td>" . strtoupper($sewa['nama']) . "</td>";
                    echo "<td>" . date("d-m-Y", strtotime($sewa['tgl_pinjam'])) . "</td>";
                    echo "<td>" . date("d-m-Y", strtotime($sewa['tgl_kembali'])) . "</td>";
                    echo "<td>" . number_format($sewa['total_sewa']) . "</td>";
                    echo "<td><a href = 'hapus.php?kd_sewa=" . $sewa['kd_sewa'] . "'><button>Hapus</button></a> | ";
                    echo "<a href = 'edit.php?kd_sewa=" . $sewa['kd_sewa'] . "'><button>Edit</button></a></td>";
                    echo "</tr>";
                }

                ?>
            </table>
        </div>

    </body>

    </html>
<?php   // echo "<script>alert('Anda Gagal Login'); location.href = 'login.php';</script>";
} ?>