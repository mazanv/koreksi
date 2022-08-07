-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2022 at 04:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rentalmobilg`
--

-- --------------------------------------------------------

--
-- Table structure for table `cusstomer`
--

CREATE TABLE `cusstomer` (
  `kd_customer` int(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cusstomer`
--

INSERT INTO `cusstomer` (`kd_customer`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'noni ariesta', 'banyumas', '088882222'),
(2, 'susi susanti', 'cilacap', '08883456'),
(3, 'rina wirawan', 'purbalingga', '088882020'),
(4, 'tomi saputra', 'banjarnegara', '08889100');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `kd_mobil` int(8) NOT NULL,
  `jenis_mobil` varchar(35) NOT NULL,
  `warna` varchar(35) NOT NULL,
  `stok` int(15) NOT NULL,
  `tarif_sewa` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`kd_mobil`, `jenis_mobil`, `warna`, `stok`, `tarif_sewa`) VALUES
(1, 'sedan', 'putih', 2, 150000),
(2, 'station wagon', 'hitam', 18, 250000),
(3, 'suv', 'biru', 5, 300000),
(4, 'hatchback', 'silver', 9, 250000);

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `kd_sewa` int(8) NOT NULL,
  `kd_mobil` int(8) NOT NULL,
  `kd_customer` int(8) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `total_sewa` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`kd_sewa`, `kd_mobil`, `kd_customer`, `tgl_pinjam`, `tgl_kembali`, `total_sewa`) VALUES
(1, 3, 2, '2022-02-02', '2022-02-03', 600000),
(3, 1, 1, '2022-08-05', '2022-08-05', 150000),
(4, 4, 1, '2022-08-03', '2022-08-04', 500000);

--
-- Triggers `sewa`
--
DELIMITER $$
CREATE TRIGGER `tr_pengembalian` AFTER DELETE ON `sewa` FOR EACH ROW begin
update mobil set stok = stok + 1 where kd_mobil = OLD.kd_mobil;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_sewa` AFTER INSERT ON `sewa` FOR EACH ROW begin
update mobil set stok = stok - 1 where kd_mobil = NEW.kd_mobil;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_update` AFTER UPDATE ON `sewa` FOR EACH ROW begin
if OLD.kd_mobil <> NEW.kd_mobil then
update mobil set stok =stok + 1 where kd_mobil = OLD.kd_mobil;
update mobil set stok =stok - 1 where kd_mobil = NEW.kd_mobil;
end if ;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(8) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cusstomer`
--
ALTER TABLE `cusstomer`
  ADD PRIMARY KEY (`kd_customer`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`kd_mobil`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`kd_sewa`),
  ADD KEY `kd_mobil` (`kd_mobil`),
  ADD KEY `kd_customer` (`kd_customer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cusstomer`
--
ALTER TABLE `cusstomer`
  MODIFY `kd_customer` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mobil`
--
ALTER TABLE `mobil`
  MODIFY `kd_mobil` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `kd_sewa` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `sewa_ibfk_1` FOREIGN KEY (`kd_mobil`) REFERENCES `mobil` (`kd_mobil`),
  ADD CONSTRAINT `sewa_ibfk_2` FOREIGN KEY (`kd_customer`) REFERENCES `cusstomer` (`kd_customer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
