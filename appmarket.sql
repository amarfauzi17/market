-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 02:29 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kode_barcode` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `profit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`kode_barcode`, `nama_barang`, `satuan`, `harga_beli`, `stock`, `harga_jual`, `profit`) VALUES
('978020137962', 'Piring', 'pcs', 5000, 19, 8000, 3000),
('974135260121', 'Buah Plum', 'pcs', 1500, 31, 2700, 1200),
('984123156741', 'Gelas Kaca', 'lusin', 4500, 11, 6000, 1500),
('513527896251', 'Sapu', 'pcs', 3000, 11, 5000, 2000),
('316835243272', 'Beng beng', 'pack', 1500, 2, 3000, 1500),
('617847519697', 'Kursi', 'pcs', 8000, 60, 12000, 4000),
('424218932811', 'Baju anak', 'lusin', 30000, 26, 75000, 45000),
('413452788327', 'Celana jeans', 'lusin', 60000, 31, 120000, 60000),
('511420025621', 'Buah jeruk', 'pcs', 2000, 113, 5000, 3000),
('115463643222', 'Roy co', 'pcs', 1200, 34, 1500, 300),
('5155674985688', 'Buah sirsak', 'pcs', 2500, 26, 4500, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `kode_pelanggan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`kode_pelanggan`, `nama`, `alamat`, `telpon`, `email`) VALUES
(4, '00 Non Member', 'Non Member', '00000000', 'NonMember@mail'),
(5, 'Abdul', 'Bulaksumur, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa', '087234567123', 'abdul@mail.com'),
(6, 'Rahman', 'Jl. Malioboro Sosromenduran, Gedong Tengen, Kota Yogyakarta', '081214534219', 'rahman@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL,
  `foto` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id`, `username`, `nama`, `password`, `level`, `foto`) VALUES
(5, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1539482267.jpg'),
(6, 'kasir', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'kasir', 'profile-pic.jpg'),
(8, 'qw', 'qw', '006d2143154327a64d86a264aea225f3', 'admin', '1522741237.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(20) NOT NULL,
  `kode_barcode` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id`, `kode_penjualan`, `kode_barcode`, `jumlah`, `total`, `tgl_penjualan`, `id_pelanggan`) VALUES
(1, 'KPJ-9908316404', '974135260121', 10, 27000, '2018-11-04', 4),
(2, 'KPJ-6052864779', '984123156741', 1, 6000, '2018-11-05', 4),
(3, 'KPJ-3456158305', '413452788327', 2, 240000, '2018-11-03', 6),
(4, 'KPJ-3456158305', '424218932811', 3, 225000, '2018-11-03', 6),
(5, 'KPJ-7021055255', '513527896251', 1, 5000, '2018-11-02', 4),
(6, 'KPJ-7021055255', '511420025621', 2, 10000, '2018-11-02', 4),
(7, 'KPJ-9732078978', '316835243272', 1, 30000, '2018-11-01', 5),
(8, 'KPJ-9732078978', '974135260121', 4, 10800, '2018-11-01', 5),
(9, 'KPJ-9732078978', '511420025621', 5, 25000, '2018-11-01', 5),
(10, 'KPJ-9732078978', '978020137962', 1, 8000, '2018-11-01', 5),
(11, 'KPJ-7168420422', '316835243272', 7, 21000, '2018-11-06', 6),
(12, 'KPJ-7168420422', '424218932811', 1, 75000, '2018-11-06', 6),
(13, 'KPJ-6648806485', '511420025621', 5, 25000, '2018-11-07', 4);

--
-- Triggers `tb_penjualan`
--
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `tb_penjualan` FOR EACH ROW BEGIN UPDATE tb_barang SET stock = stock - NEW.jumlah WHERE kode_barcode = NEW.kode_barcode; END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_detail`
--

CREATE TABLE `tb_penjualan_detail` (
  `kode_penjualan` varchar(50) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `potongan` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan_detail`
--

INSERT INTO `tb_penjualan_detail` (`kode_penjualan`, `bayar`, `kembali`, `diskon`, `potongan`, `total_bayar`) VALUES
('KPJ-3456158305', 465000, 81500, 10, 46500, 418500),
('KPJ-6052864779', 6000, 4300, 5, 300, 5700),
('KPJ-6648806485', 25000, 5000, 0, 0, 25000),
('KPJ-7021055255', 15000, 5000, 0, 0, 15000),
('KPJ-7168420422', 96000, 8400, 15, 14400, 81600),
('KPJ-9732078978', 73800, 960, 20, 14760, 59040),
('KPJ-9908316404', 27000, 3000, 0, 0, 27000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_penjualan_detail`
--
ALTER TABLE `tb_penjualan_detail`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
