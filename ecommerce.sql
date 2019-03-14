-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2018 at 10:03 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kurir`
--

CREATE TABLE IF NOT EXISTS `tbl_kurir` (
  `id_kurir` int(11) NOT NULL,
  `nama_kurir` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kurir`
--

INSERT INTO `tbl_kurir` (`id_kurir`, `nama_kurir`, `harga`) VALUES
(1, 'JNE', 5000),
(2, 'POST', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `email` text NOT NULL,
  `no_hp` int(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `id_user`, `nama_pelanggan`, `alamat`, `email`, `no_hp`) VALUES
(1, 2, 'Andiantoro', 'Jakarta', 'andi@gmail.com', 897756788),
(2, 5, 'Bagas', 'Bogor', 'bagas@bagas.com', 23123213),
(3, 6, 'Dimas', 'Cibinong', 'Dimas@dimdim.com', 987654567),
(4, 18, 'Manda', 'Sukahati', 'asd@hh.a', 897655),
(5, 19, 'piko', 'jauh', 'asa@gmail.com', 808098),
(6, 20, 'rezky', 'rezky', 'rezky@gmail.cp,', 123);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE IF NOT EXISTS `tbl_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `invoice` varchar(10) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `banyak` int(5) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id_pembelian`, `invoice`, `tgl_pembelian`, `id_pelanggan`, `id_produk`, `banyak`, `id_kurir`, `total_bayar`, `status`, `img`) VALUES
(6, 'INV2312181', '2018-12-23', 1, 14, 1, 1, 15000, 2, 'IMG20181111091128.jpg'),
(10, 'INV2312182', '2018-12-23', 3, 14, 1, 1, 15000, 1, ''),
(11, 'INV2312182', '2018-12-23', 3, 3, 1, 1, 25000, 1, ''),
(12, 'INV2312182', '2018-12-23', 3, 2, 1, 1, 75000, 1, ''),
(13, 'INV2312183', '2018-12-23', 1, 3, 1, 1, 15000, 1, ''),
(14, 'INV2312184', '2018-12-23', 3, 3, 1, 1, 15000, 1, ''),
(15, 'INV2312184', '2018-12-23', 3, 2, 1, 1, 65000, 1, ''),
(17, 'INV2312185', '2018-12-23', 1, 2, 1, 2, 60000, 3, 'IMG20181111091128.jpg'),
(18, 'INV2312185', '2018-12-23', 1, 27, 3, 2, 75000, 2, 'IMG20181111091128.jpg'),
(19, 'INV2312185', '2018-12-23', 1, 29, 1, 2, 125000, 1, 'IMG20181111091128.jpg'),
(20, 'INV2312185', '2018-12-23', 1, 3, 1, 2, 135000, 1, 'IMG20181111091128.jpg'),
(21, 'INV1911181', '2018-11-19', 1, 35, 1, 1, 45000, 1, ''),
(22, 'INV2011181', '2018-11-20', 1, 2, 1, 1, 55000, 1, ''),
(23, 'INV2111181', '2018-11-21', 1, 35, 1, 1, 45000, 1, ''),
(24, 'INV2111182', '2018-11-21', 5, 16, 1, 2, 40000, 1, 'bukti.jpg'),
(25, 'INV2111182', '2018-11-21', 5, 32, 1, 2, 65000, 1, 'bukti.jpg'),
(26, 'INV2111182', '2018-11-21', 5, 2, 1, 2, 115000, 1, 'bukti.jpg'),
(27, 'INV2111183', '2018-11-21', 6, 22, 1, 2, 20000, 1, '323482004_w640_h640_colorex.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE IF NOT EXISTS `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stok` int(5) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `kode_produk`, `nama_produk`, `stok`, `deskripsi`, `harga`, `img`) VALUES
(2, 'KCNG', 'Kucing', 8, 'ini kucing', 50000, 'Mix (8).jpg'),
(3, 'BGN', 'Bunglon', 10, 'warna ijo', 10000, 'Mix (7).jpg'),
(14, 'BRNG', 'Burung', 17, 'warna putih', 10000, 'Mix (4).jpg'),
(16, 'KD', 'Kuda', 10, 'Kakinya Empat', 30000, 'Mix (11).jpg'),
(22, 'CB', 'Canned Bread', 10, 'Roti dalam Kaleng', 10000, 'Gbr (1).jpg'),
(24, 'CCF', 'Candy Fish', 10, 'Permen Ikan', 5000, 'Gbr (3).jpg'),
(25, 'KLP', 'Kelpo', 10, 'Kelpo adalah makanan untuk sarapan', 15000, 'Gbr (5).jpg'),
(26, 'DS', 'Sausage', 10, 'Sosis yang dapat diminum', 7000, 'Gbr (6).jpg'),
(27, 'SS', 'Sponge Sauce', 7, 'Sauce Spongebob', 5000, 'Gbr (7).jpg'),
(28, 'KS', 'Kelp Shake', 100, 'Minuman segar', 2000, 'Gbr (8).jpg'),
(29, 'SN', 'Snail Nip', 20, 'Makanan Siput', 50000, 'Gbr (9).jpg'),
(30, 'KPIC', 'Patty In Can', 15, 'Krabby patty sekarang ada dalam kaleng', 2000, 'Gbr (10).jpg'),
(31, 'SP', 'Peanut', 10, 'Kacang Kalengan', 20000, 'Gbr (11).jpg'),
(32, 'KM', 'Kiddie Meal', 20, 'Krabby patty untuk anak kecil', 25000, 'Gbr (13).jpg'),
(33, 'KP', 'Krabby Patties', 100, 'Makanan yang enak se lautan', 5000, 'Gbr (14).jpg'),
(34, 'KG', 'Kelp Grow', 10, 'Semprotan pembesaran', 50000, 'Gbr (4).jpg'),
(35, 'IVS', 'Invisible Spray', 10, 'Semprotan Tidak Terlihat', 40000, 'Gbr (12).jpg'),
(37, 'MB', 'Mobil Truckk', 100, 'Rodanya Empat (4) ada bagasinya', 100000000, 'truck.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stok`
--

CREATE TABLE IF NOT EXISTS `tbl_stok` (
  `id_stok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jml_stok` int(5) NOT NULL,
  `tgl_msk` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stok`
--

INSERT INTO `tbl_stok` (`id_stok`, `id_produk`, `jml_stok`, `tgl_msk`) VALUES
(6, 14, 6, '2018-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1),
(2, 'andi', '202cb962ac59075b964b07152d234b70', 2),
(3, 'gg', '202cb962ac59075b964b07152d234b70', 2),
(5, 'bagas', '202cb962ac59075b964b07152d234b70', 2),
(6, 'dimas', '202cb962ac59075b964b07152d234b70', 2),
(14, 'd', 'c4ca4238a0b923820dcc509a6f75849b', 2),
(15, 'ddd', 'c4ca4238a0b923820dcc509a6f75849b', 2),
(16, 'diko', '202cb962ac59075b964b07152d234b70', 2),
(17, 'gabriel', '202cb962ac59075b964b07152d234b70', 2),
(18, 'zahra', '202cb962ac59075b964b07152d234b70', 2),
(19, 'piko', '202cb962ac59075b964b07152d234b70', 2),
(20, 'rezky', '202cb962ac59075b964b07152d234b70', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kurir`
--
ALTER TABLE `tbl_kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `tbl_pembelian_ibfk_1` (`id_kurir`),
  ADD KEY `tbl_pembelian_ibfk_2` (`id_pelanggan`),
  ADD KEY `tbl_pembelian_ibfk_3` (`id_produk`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kurir`
--
ALTER TABLE `tbl_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD CONSTRAINT `tbl_pelanggan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD CONSTRAINT `tbl_pembelian_ibfk_1` FOREIGN KEY (`id_kurir`) REFERENCES `tbl_kurir` (`id_kurir`),
  ADD CONSTRAINT `tbl_pembelian_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `tbl_pembelian_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`);

--
-- Constraints for table `tbl_stok`
--
ALTER TABLE `tbl_stok`
  ADD CONSTRAINT `tbl_stok_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
