-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2021 at 03:11 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps_setting`
--

CREATE TABLE `apps_setting` (
  `ID` int(11) NOT NULL,
  `TYPE_SETTING` varchar(20) DEFAULT NULL,
  `PARAMETER_NAME` varchar(50) DEFAULT NULL,
  `VALUE_PARAMETER` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apps_setting`
--

INSERT INTO `apps_setting` (`ID`, `TYPE_SETTING`, `PARAMETER_NAME`, `VALUE_PARAMETER`) VALUES
(2, 'AKT', 'LABA_DITAHAN', '30302');

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `KD_COA` varchar(15) CHARACTER SET latin1 NOT NULL,
  `NAMA_COA` char(150) CHARACTER SET latin1 DEFAULT NULL,
  `KD_INDUK_COA` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `KELOMPOK` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `M_D` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `D_K` varchar(2) CHARACTER SET latin1 DEFAULT NULL,
  `LEVEL_COA` int(2) DEFAULT NULL,
  `SALDO_AWAL` double(17,2) DEFAULT 0.00,
  `SALDO_DEBET` double(17,2) DEFAULT 0.00,
  `SALDO_KREDIT` double(17,2) DEFAULT 0.00,
  `SALDO_AKHIR` double(17,2) DEFAULT 0.00,
  `AKT_PSV` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`KD_COA`, `NAMA_COA`, `KD_INDUK_COA`, `KELOMPOK`, `M_D`, `D_K`, `LEVEL_COA`, `SALDO_AWAL`, `SALDO_DEBET`, `SALDO_KREDIT`, `SALDO_AKHIR`, `AKT_PSV`) VALUES
('', NULL, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL),
('1', 'AKTIVA', '0', 'HARTA', 'M', 'D', 0, 350074675.00, 0.00, 0.00, 350074675.00, 1),
('101', 'Aktiva Lancar', '1', 'HARTA', 'M', 'D', 1, 9975000.00, 0.00, 0.00, 9975000.00, 1),
('10101', 'Kas', '101', 'HARTA', 'D', 'D', 2, 9975000.00, 0.00, 0.00, 9975000.00, 1),
('10102', 'Bank', '101', 'HARTA', 'D', 'D', 2, 310074675.00, 0.00, 0.00, 310074675.00, 1),
('10103', 'Piutang', '101', 'HARTA', 'M', 'D', 2, 25000.00, 0.00, 0.00, 25000.00, 1),
('1010301', 'Piutang Umum', '10103', 'HARTA', 'D', 'D', 3, 25000.00, 0.00, 0.00, 25000.00, 1),
('1010302', 'Piutang Dagang', '10103', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('10104', 'Persediaan', '101', 'HARTA', 'M', 'D', 2, 0.00, 0.00, 0.00, 0.00, 1),
('1010401', 'Persediaan Barang', '10104', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('1010402', 'Persediaan Accessories', '10104', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('1010403', 'Persediaan Lainnya', '10104', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('102', 'Aktiva Tetap', '1', 'HARTA', 'M', 'D', 1, 30000000.00, 0.00, 0.00, 30000000.00, 1),
('10201', 'Perolehan Aktiva', '102', 'HARTA', 'M', 'D', 2, 30000000.00, 0.00, 0.00, 30000000.00, 1),
('1020101', 'Tanah', '10201', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('1020102', 'Bangunan', '10201', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('1020103', 'Kendaraan', '10201', 'HARTA', 'D', 'D', 3, 25000000.00, 0.00, 0.00, 25000000.00, 1),
('1020104', 'Inventaris Lainnya', '10201', 'HARTA', 'D', 'D', 3, 5000000.00, 0.00, 0.00, 5000000.00, 1),
('10202', 'Akumulasi Penyusutan -/-', '102', 'HARTA', 'M', 'D', 2, 0.00, 0.00, 0.00, 0.00, 1),
('1020201', 'Akumulasi Penyusutan Bagunan -/-', '10202', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('1020202', 'Akumulasi Penyusutan Kendaraan -/-', '10202', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('1020203', 'Akumulasi Penyusutan Inventaris Lainnya -/-', '10202', 'HARTA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 1),
('104', 'Aktiva Lain-Lain', '1', 'HARTA', 'D', 'D', 1, 0.00, 0.00, 0.00, 0.00, 1),
('2', 'PASSIVA', '0', 'KEWAJIBAN', 'M', 'K', 0, 100000000.00, 0.00, 0.00, 100000000.00, 2),
('201', 'Hutang', '2', 'KEWAJIBAN', 'M', 'K', 1, 100000000.00, 0.00, 0.00, 100000000.00, 2),
('20101', 'Hutang Jangka Pendek', '201', 'KEWAJIBAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 2),
('20102', 'Hutang Jangka Panjang', '201', 'KEWAJIBAN', 'D', 'K', 2, 100000000.00, 0.00, 0.00, 100000000.00, 2),
('202', 'Kewajian Lainnya', '2', 'KEWAJIBAN', 'D', 'K', 1, 0.00, 0.00, 0.00, 0.00, 2),
('203', 'Antar Kantor', '2', 'KEWAJIBAN', 'D', 'K', 1, 0.00, 0.00, 0.00, 0.00, 2),
('204', 'Passiva Lain-Lain', '2', 'KEWAJIBAN', 'D', 'K', 1, 0.00, 0.00, 0.00, 0.00, 2),
('3', 'MODAL', '0', 'MODAL', 'M', 'K', 0, 250074675.00, 0.00, 0.00, 250074675.00, 2),
('301', 'Saham', '3', 'MODAL', 'M', 'K', 1, 250000000.00, 0.00, 0.00, 250000000.00, 2),
('30101', 'Saham Disetor', '301', 'MODAL', 'D', 'K', 2, 250000000.00, 0.00, 0.00, 250000000.00, 2),
('30102', 'Saham Belum Disetor', '301', 'MODAL', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 2),
('302', 'Cadangan Umum', '3', 'MODAL', 'D', 'K', 1, 0.00, 0.00, 0.00, 0.00, 2),
('303', 'Laba Rugi', '3', 'MODAL', 'M', 'K', 1, 74675.00, 0.00, 0.00, 74675.00, 2),
('30301', 'Laba Rugi Ditahan', '303', 'MODAL', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 2),
('30302', 'Laba Rugi Berjalan', '303', 'LR', 'D', 'K', 2, 74675.00, 0.00, 0.00, 74675.00, 2),
('4', 'PENDAPATAN', '0', 'PENDAPATAN', 'M', 'K', 0, 75200.00, 0.00, 0.00, 75200.00, 4),
('401', 'Pendapatan Usaha', '4', 'PENDAPATAN', 'M', 'K', 1, 0.00, 0.00, 0.00, 0.00, 4),
('40101', 'Pendapatan Penjualan', '401', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('40102', 'Pendapatan Usaha Lainnya', '401', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('402', 'Pendapatan Service', '4', 'PENDAPATAN', 'M', 'K', 1, 0.00, 0.00, 0.00, 0.00, 4),
('40201', 'Pendapatan Jasa service Umum', '402', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('40202', 'Pendapatan Jasa service Khusus', '402', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('403', 'Pendapatan Lainnya / Other Income', '4', 'PENDAPATAN', 'M', 'K', 1, 75200.00, 0.00, 0.00, 75200.00, 4),
('40301', 'Pendaptan Bantuan Promosi', '403', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('40302', 'Pendapatan Konpensasi Penjualan', '403', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('40303', 'Pendapatan Penjualan Aktiva', '403', 'PENDAPATAN', 'D', 'K', 2, 0.00, 0.00, 0.00, 0.00, 4),
('40304', 'Pendapatan Bank', '403', 'PENDAPATAN', 'D', 'K', 2, 75200.00, 0.00, 0.00, 75200.00, 4),
('5', 'BIAYA', '0', 'BIAYA', 'M', 'D', 0, 525.00, 0.00, 0.00, 525.00, 5),
('502', 'Biaya Tenaga Kerja', '5', 'BIAYA', 'M', 'D', 1, 0.00, 0.00, 0.00, 0.00, 5),
('50201', 'Pegawai Tetap', '502', 'BIAYA', 'M', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('5020101', 'Gaji', '50201', 'BIAYA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 5),
('5020102', 'Lembur', '50201', 'BIAYA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 5),
('5020103', 'Bonus', '5020102', 'BIAYA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 5),
('5020104', 'THR', '5020102', 'BIAYA', 'D', 'D', 3, 0.00, 0.00, 0.00, 0.00, 5),
('50202', 'Pegawai Lepas', '502', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('503', 'Biaya Umum', '5', 'BIAYA', 'M', 'D', 1, 0.00, 0.00, 0.00, 0.00, 5),
('50301', 'ATK', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50302', 'Medical', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50303', 'Telephone', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50304', 'Telephone Cellular', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50305', 'Transportasi dan Akomodasi', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50306', 'Biaya Makan', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50307', 'Maintenance', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50308', 'Listrik, Genset dan Air', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50309', 'Pajak Daerah dan Retribusi', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50310', 'Barang Habis Pakai', '503', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('504', 'Biaya Marketing', '5', 'BIAYA', 'M', 'D', 1, 0.00, 0.00, 0.00, 0.00, 5),
('50401', 'Brosur', '504', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50402', 'Advertesing', '504', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50403', 'Merchandise / Sponsorship', '504', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50404', 'Pameran', '504', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('505', 'Biaya Penyusutan', '5', 'BIAYA', 'M', 'D', 1, 0.00, 0.00, 0.00, 0.00, 5),
('50501', 'Penyusutan Bangunan', '505', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50502', 'Penyusutan Kendaraan', '505', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('50503', 'Penyusutan Inventaris Lainnya', '505', 'BIAYA', 'D', 'D', 2, 0.00, 0.00, 0.00, 0.00, 5),
('506', 'Biaya Lainnya', '5', 'BIAYA', 'D', 'D', 1, 525.00, 0.00, 0.00, 525.00, 5);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `ID_TRANS` int(11) NOT NULL,
  `NO_REFERENCE` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `TGL_TRANS` date DEFAULT NULL,
  `URAIAN_JURNAL` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `TYPE_JURNAL` varchar(20) CHARACTER SET latin1 DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`ID_TRANS`, `NO_REFERENCE`, `TGL_TRANS`, `URAIAN_JURNAL`, `TYPE_JURNAL`) VALUES
(101, '101', '2018-04-08', 'SAHAM PENDIRI', 'JURNAL UMUM'),
(102, '102', '2018-04-12', 'Penarikkan Bank', 'JURNAL UMUM'),
(103, '103', '2018-04-15', 'Jurnal Piutang', 'JURNAL UMUM'),
(104, '104', '2018-04-12', 'Pembelian Komputer', 'JURNAL UMUM'),
(105, '105', '2018-04-12', 'Pembelian Kendaraan', 'JURNAL UMUM'),
(106, '106', '2018-04-23', 'Dana Pinjaman Bank', 'JURNAL UMUM'),
(107, '107', '2018-04-28', 'Pendapan Bank', 'JURNAL UMUM'),
(108, '108', '2018-04-28', 'Biaya bunga bank', 'JURNAL UMUM'),
(109, '109', '2018-05-07', '99', 'JURNAL UMUM'),
(456, '456', '2018-05-12', 'Setoran BNI Syari\'ah Norek : 0938764', 'MODUL BANK');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_d1`
--

CREATE TABLE `jurnal_d1` (
  `ID_DETAIL` int(11) NOT NULL,
  `ID_TRANS` int(11) DEFAULT NULL,
  `KD_COA` varchar(15) DEFAULT NULL,
  `DEBET` double(17,2) DEFAULT 0.00,
  `KREDIT` double(17,2) DEFAULT 0.00,
  `KELOMPOK` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jurnal_d1`
--

INSERT INTO `jurnal_d1` (`ID_DETAIL`, `ID_TRANS`, `KD_COA`, `DEBET`, `KREDIT`, `KELOMPOK`) VALUES
(1, 101, '10102', 250000000.00, 0.00, 'HARTA'),
(2, 101, '30101', 0.00, 250000000.00, 'MODAL'),
(3, 103, '1010301', 25000.00, 0.00, 'HARTA'),
(4, 103, '10101', 0.00, 25000.00, 'HARTA'),
(5, 102, '10101', 15000000.00, 0.00, 'HARTA'),
(6, 102, '10102', 0.00, 15000000.00, 'HARTA'),
(7, 104, '1020104', 5000000.00, 0.00, 'HARTA'),
(8, 104, '10101', 0.00, 5000000.00, 'HARTA'),
(9, 105, '1020103', 25000000.00, 0.00, 'HARTA'),
(10, 105, '10102', 0.00, 25000000.00, 'HARTA'),
(11, 106, '10102', 100000000.00, 0.00, 'HARTA'),
(12, 106, '20102', 0.00, 100000000.00, 'KEWAJIBAN'),
(13, 107, '10102', 75200.00, 0.00, 'HARTA'),
(14, 107, '40304', 0.00, 75200.00, 'PENDAPATAN'),
(15, 108, '506', 525.00, 0.00, 'BIAYA'),
(16, 108, '10102', 0.00, 525.00, 'HARTA'),
(17, 109, '10101', 5000000.00, 0.00, 'HARTA'),
(18, 109, '10102', 0.00, 5000000.00, 'HARTA'),
(19, 456, '10102', 10000000.00, 0.00, 'HARTA'),
(20, 456, '30101', 0.00, 10000000.00, 'HARTA');

-- --------------------------------------------------------

--
-- Table structure for table `modul_bank`
--

CREATE TABLE `modul_bank` (
  `ID` int(11) NOT NULL,
  `NAME_BANK` varchar(55) DEFAULT NULL,
  `NO_REKENING` varchar(55) DEFAULT NULL,
  `AN_REKENING` varchar(25) DEFAULT NULL,
  `INTEGRASI_COA` int(11) DEFAULT NULL,
  `SALDO_BANK` double(17,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul_bank`
--

INSERT INTO `modul_bank` (`ID`, `NAME_BANK`, `NO_REKENING`, `AN_REKENING`, `INTEGRASI_COA`, `SALDO_BANK`) VALUES
(3, 'Mandiri', '08190283', 'Ahmad Tauhid', 10102, 5000000.00),
(4, 'BNI Syari\'ah', '0938764', 'Ahmad Tauhid', 10102, 10000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `modul_bank_trans`
--

CREATE TABLE `modul_bank_trans` (
  `id` int(11) NOT NULL,
  `ID_BANK` int(11) DEFAULT NULL,
  `TGL_TRANS` date DEFAULT NULL,
  `JENIS_TRANS` int(3) DEFAULT NULL,
  `NOMINAL` double(17,2) DEFAULT NULL,
  `URAIAN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul_bank_trans`
--

INSERT INTO `modul_bank_trans` (`id`, `ID_BANK`, `TGL_TRANS`, `JENIS_TRANS`, `NOMINAL`, `URAIAN`) VALUES
(456, 4, '2018-05-12', 0, 10000000.00, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps_setting`
--
ALTER TABLE `apps_setting`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`KD_COA`) USING BTREE;

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`ID_TRANS`) USING BTREE;

--
-- Indexes for table `jurnal_d1`
--
ALTER TABLE `jurnal_d1`
  ADD PRIMARY KEY (`ID_DETAIL`) USING BTREE;

--
-- Indexes for table `modul_bank`
--
ALTER TABLE `modul_bank`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `modul_bank_trans`
--
ALTER TABLE `modul_bank_trans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps_setting`
--
ALTER TABLE `apps_setting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurnal_d1`
--
ALTER TABLE `jurnal_d1`
  MODIFY `ID_DETAIL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `modul_bank`
--
ALTER TABLE `modul_bank`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
