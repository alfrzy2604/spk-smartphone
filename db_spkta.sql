-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2026 at 08:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spkta`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`, `merk`, `tahun`) VALUES
(1, 'Xiaomi', 'Xiaomi Note 13 Pro', '2024'),
(2, 'Poco', 'Poco X6 Pro', '2024'),
(3, 'Vivo', 'Vivo V29', '2023'),
(4, 'Xiaomi', 'Xiaomi 13T', '2023'),
(5, 'Vivo', 'Vivo Y21T', '2022'),
(6, 'Iphone', 'Iphone 12 Pro', '2022'),
(7, 'Iphone', 'Iphone 15', '2023'),
(8, 'Oppo', 'Oppo A92', '2020'),
(9, 'Samsung', 'Samsung A13', '2022'),
(10, 'Iphone', 'Iphone 11', '2021'),
(11, 'Realme', 'Realme Note 50', '2024'),
(12, 'Samsung', 'Samsung Galaxy S24+', '2024'),
(13, 'Vivo', 'Vivo Y100', '2024'),
(14, 'Samsung', 'Samsung S22 Ultra', '2024'),
(15, 'Tecno', 'Tecno Spark 20', '2024'),
(16, 'Infinix', 'Infinix Hot 40 Pro', '2024'),
(17, 'Xiaomi', 'Xiaomi Redmi Note 13 5G', '2024'),
(18, 'Poco', 'Poco C75', '2024'),
(19, 'Vivo', 'Vivo Y28', '2024'),
(20, 'Poco', 'Poco X7', '2024'),
(21, 'Oppo', 'Oppo A38', '2024'),
(22, 'Oppo', 'Oppo A60', '2024'),
(23, 'Infinix', 'Infinix Hot 50', '2024'),
(24, 'Xiaomi', 'Xiaomi Redmi 12', '2024'),
(25, 'Realme', 'Realme 12', '2024'),
(26, 'Realme', 'Realme C53', '2024'),
(27, 'Realme', 'Realme GT 6', '2024'),
(28, 'Infinix', 'Infinix Zero 40', '2024'),
(29, 'Oppo', 'Oppo Reno12', '2024'),
(30, 'Realme', 'Realme C61', '2024'),
(31, 'Oppo', 'Oppo Reno11', '2024'),
(32, 'Iphone', 'iPhone 15', '2024'),
(33, 'Iphone', 'iPhone 13 Mini', '2024'),
(34, 'Realme', 'Realme GT Neo 6', '2024'),
(35, 'Poco', 'Poco M7 Pro', '2024'),
(36, 'Samsung', 'Samsung Galaxy S23 FE', '2024'),
(37, 'Vivo', 'Vivo V40 Lite', '2024'),
(38, 'Infinix', 'Infinix GT 20 Pro', '2024'),
(39, 'Poco', 'Poco F6 Pro', '2024'),
(40, 'Vivo', 'Vivo T3 5G', '2024'),
(41, 'Realme', 'Realme 12 Pro', '2024'),
(42, 'Vivo', 'Vivo Y36', '2024'),
(43, 'Vivo', 'Vivo Y18', '2024'),
(44, 'Iphone', 'iPhone 15 Pro Max', '2024'),
(45, 'Oppo', 'Oppo A58', '2024'),
(46, 'Tecno', 'Tecno Pova 6 Pro', '2024'),
(47, 'Samsung', 'Samsung Galaxy M15', '2024'),
(48, 'Vivo', 'Vivo V40', '2024'),
(49, 'Xiaomi', 'Xiaomi Poco C65', '2024'),
(50, 'Xiaomi', 'Xiaomi Redmi 13C', '2024'),
(51, 'Infinix', 'Infinix Smart 9', '2024'),
(52, 'Infinix', 'Infinix Hot 50 Pro', '2024'),
(53, 'Oppo', 'Oppo Reno12 F', '2024'),
(54, 'Samsung', 'Samsung Galaxy A55', '2024'),
(55, 'Vivo', 'Vivo V30', '2024'),
(56, 'Tecno', 'Tecno Spark 30', '2024'),
(57, 'Infinix', 'Infinix Note 50 Pro', '2024'),
(58, 'Xiaomi', 'Xiaomi Redmi Note 13 Pro+', '2024'),
(59, 'Vivo', 'Vivo V40 Pro', '2024'),
(60, 'Oppo', 'Oppo Reno11 F', '2024'),
(61, 'Xiaomi', 'Xiaomi C65', '2024'),
(62, 'Iphone', 'iPhone 13', '2024'),
(63, 'Poco', 'Poco M6 Pro', '2024'),
(64, 'Samsung', 'Samsung Galaxy A25', '2024'),
(65, 'Samsung', 'Samsung Galaxy A35', '2024'),
(66, 'Realme', 'Realme 12+', '2024'),
(67, 'Oppo', 'Oppo A79', '2024'),
(68, 'Iphone', 'iPhone 14', '2024'),
(69, 'Samsung', 'Samsung Galaxy S24', '2024'),
(70, 'Iphone', 'iPhone 14 Plus', '2024'),
(71, 'Xiaomi', 'Xiaomi 14 Ultra', '2024'),
(72, 'Tecno', 'Tecno Camon 30', '2024'),
(73, 'Oppo', 'Oppo A18', '2024'),
(74, 'Xiaomi', 'Xiaomi 14', '2024'),
(75, 'Poco', 'Poco X7 Pro', '2024'),
(76, 'Iphone', 'iPhone 15 Plus', '2024'),
(77, 'Realme', 'Realme C63', '2024'),
(78, 'Iphone', 'iPhone 14 Pro', '2024'),
(79, 'Oppo', 'Oppo Find X8', '2024'),
(80, 'Poco', 'Poco X8 Pro', '2024'),
(81, 'Poco', 'Poco M6', '2024'),
(82, 'Tecno', 'Tecno Pova 6', '2024'),
(83, 'Infinix', 'Infinix Smart 8', '2024'),
(84, 'Poco', 'Poco F6', '2024'),
(85, 'Poco', 'Poco F5', '2024'),
(86, 'Iphone', 'iPhone 13 Pro', '2024'),
(87, 'Iphone', 'iPhone 15 Pro', '2024'),
(88, 'Samsung', 'Samsung Galaxy A15', '2024'),
(89, 'Realme', 'Realme C51', '2024'),
(90, 'Tecno', 'Tecno Camon 30 Pro', '2024'),
(91, 'Samsung', 'Samsung Galaxy S24 Ultra', '2024'),
(92, 'Infinix', 'Infinix Zero 30', '2024'),
(93, 'Samsung', 'Samsung Galaxy F15', '2024'),
(94, 'Xiaomi', 'Xiaomi Redmi 13', '2024'),
(95, 'Poco', 'Poco F5 Pro', '2024'),
(96, 'Poco', 'Poco X6', '2024'),
(97, 'Vivo', 'Vivo V30 Pro', '2024'),
(98, 'Infinix', 'Infinix Note 60', '2024'),
(99, 'Xiaomi', 'Xiaomi Redmi Note 13', '2024'),
(100, 'Iphone', 'iPhone 13 Pro Max', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `atribut` varchar(20) DEFAULT NULL,
  `bobot` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `atribut`, `bobot`) VALUES
(1, 'C1', 'Chipset', 'Benefit', 0.15),
(2, 'C2', 'RAM', 'Benefit', 0.10),
(3, 'C3', 'Storage', 'Benefit', 0.10),
(4, 'C4', 'Layar', 'Benefit', 0.07),
(5, 'C5', 'Kamera Depan', 'Benefit', 0.10),
(6, 'C6', 'Kamera Belakang', 'Benefit', 0.12),
(7, 'C7', 'Baterai', 'Benefit', 0.13),
(8, 'C8', 'Harga', 'Cost', 0.15),
(9, 'C9', 'Berat', 'Cost', 0.03),
(12, 'C10', 'Fast Charging (Watt)', 'Benefit', 0.05);

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id_normalisasi` int(11) NOT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `merek_smartphone` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `nilai_chipset` int(11) DEFAULT NULL,
  `nilai_ram` int(11) DEFAULT NULL,
  `nilai_storage` int(11) DEFAULT NULL,
  `nilai_layar` int(11) DEFAULT NULL,
  `nilai_kamera_depan` int(11) DEFAULT NULL,
  `nilai_kamera_belakang` int(11) DEFAULT NULL,
  `nilai_baterai` int(11) DEFAULT NULL,
  `nilai_harga` int(11) DEFAULT NULL,
  `nilai_berat` int(11) DEFAULT NULL,
  `nilai_fast_charging` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `normalisasi`
--

INSERT INTO `normalisasi` (`id_normalisasi`, `merk`, `merek_smartphone`, `harga`, `nilai_chipset`, `nilai_ram`, `nilai_storage`, `nilai_layar`, `nilai_kamera_depan`, `nilai_kamera_belakang`, `nilai_baterai`, `nilai_harga`, `nilai_berat`, `nilai_fast_charging`) VALUES
(18, 'Xiaomi', 'Xiaomi Note 13 Pro', 3000000, 3, 2, 3, 4, 1, 4, 4, 4, 2, 4),
(19, 'Poco', 'Poco X6 Pro', 1499999, 4, 3, 4, 5, 5, 2, 5, 5, 1, 4),
(20, 'Vivo', 'Vivo V29', 2999999, 5, 3, 4, 4, 4, 3, 4, 4, 5, 5),
(21, 'Xiaomi', 'Xiaomi 13T', 1499999, 2, 4, 4, 5, 3, 5, 5, 5, 3, 2),
(25, 'Vivo', 'Vivo Y21T', 2990000, 1, 3, 3, 4, 1, 1, 3, 4, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `kriteria` varchar(100) DEFAULT NULL,
  `crips` varchar(100) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `kriteria`, `crips`, `nilai`) VALUES
(1, 'Chipset', 'Helio P22', 1),
(2, 'Chipset', 'Snapdragon 710', 2),
(3, 'Chipset', 'Snapdragon 855', 3),
(4, 'Chipset', 'Helio G96', 4),
(5, 'Chipset', 'Bionic', 5),
(6, 'RAM', '2 GB', 1),
(7, 'RAM', '3 GB', 2),
(8, 'RAM', '4 GB', 3),
(9, 'RAM', '6 GB', 4),
(10, 'RAM', '8 GB ke atas', 5),
(11, 'Storage', '32 GB', 1),
(12, 'Storage', '64 GB', 2),
(13, 'Storage', '128 GB', 3),
(14, 'Storage', '256 GB', 4),
(15, 'Storage', '512 GB ke atas', 5),
(16, 'Layar', 'Kurang dari 5 inch', 1),
(17, 'Layar', 'Kurang dari 5.5 inch', 2),
(18, 'Layar', 'Kurang dari 6 inch', 3),
(19, 'Layar', 'Kurang dari 6.5 inch', 4),
(20, 'Layar', '6.5 inch ke atas', 5),
(21, 'Kamera Depan', 'Kurang dari 20 MP', 1),
(22, 'Kamera Depan', 'Kurang dari 30 MP', 2),
(23, 'Kamera Depan', 'Kurang dari 40 MP', 3),
(24, 'Kamera Depan', 'Kurang dari 50 MP', 4),
(25, 'Kamera Depan', '50 MP ke atas', 5),
(26, 'Kamera Belakang', 'Kurang dari 15 MP', 1),
(27, 'Kamera Belakang', 'Kurang dari 20 MP', 2),
(28, 'Kamera Belakang', 'Kurang dari 25 MP', 3),
(29, 'Kamera Belakang', 'Kurang dari 30 MP', 4),
(30, 'Kamera Belakang', '30 MP ke atas', 5),
(31, 'Baterai', 'Kurang dari 3000 mAh', 1),
(32, 'Baterai', 'Kurang dari 3500 mAh', 2),
(33, 'Baterai', 'Kurang dari 4000 mAh', 3),
(34, 'Baterai', 'Kurang dari 4500 mAh', 4),
(35, 'Baterai', '4500 mAh ke atas', 5),
(36, 'Harga', 'Lebih dari 6.000.000', 1),
(37, 'Harga', '4.500.000', 2),
(38, 'Harga', '3.500.000', 3),
(39, 'Harga', '3.000.000', 4),
(40, 'Harga', 'Kurang dari 1.500.000', 5),
(41, 'Berat', '220 gram ke atas', 1),
(42, 'Berat', 'Kurang dari 220 gram', 2),
(43, 'Berat', 'Kurang dari 200 gram', 3),
(44, 'Berat', 'Kurang dari 185 gram', 4),
(45, 'Berat', 'Kurang dari 170 gram', 5),
(46, 'Fast Charging (Watt)', 'Kurang dari 18 W', 1),
(47, 'Fast Charging (Watt)', '18-32 W', 2),
(48, 'Fast Charging (Watt)', '33-64 W', 3),
(49, 'Fast Charging (Watt)', '65-99 W', 4),
(50, 'Fast Charging (Watt)', '120 W ke atas', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD PRIMARY KEY (`id_normalisasi`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `id_normalisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
