-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2024 at 02:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `thn_terbit` varchar(255) NOT NULL,
  `stok` int NOT NULL,
  `id_kategori` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `cover`, `penerbit`, `pengarang`, `thn_terbit`, `stok`, `id_kategori`) VALUES
(10, 'sdfsd', 'cover_1723731135.jpg', 'adefs', 'sdvs', '2024-08-17', 120, 15),
(11, 'asd', 'cover_1723991858.jpeg', '1sda', 'asd', '2024-08-18', 1, 17),
(12, 'salad 600 ml', 'cover_1724076270.jpg', 'CV.Nusantara', 'sdfs', '2024-08-19', 19, 0),
(13, 'The Bike Guy', 'cover_1724076399.jpg', 'sdfsd', '123', '2024-08-19', 120, 0),
(14, 'Aku Tahu Kapan Kamu Mati', 'cover_1724077785.jpg', 'Rockstar', 'C.J GTA SA', '2024-08-11', 1, 0),
(15, 'Penggali Kubur Absurd', 'cover_1724078507.jpeg', 'CV.Global IND', 'Setiadinata', '2024-08-19', 3, 0),
(16, 'The Side', 'cover_1724207994.png', 'CV.Joseph', 'Mbohhasd', '2024-08-21', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `buku_kategori`
--

CREATE TABLE `buku_kategori` (
  `id_buku` int NOT NULL,
  `id_kategori` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku_kategori`
--

INSERT INTO `buku_kategori` (`id_buku`, `id_kategori`) VALUES
(12, 15),
(13, 15),
(14, 15),
(15, 15),
(16, 16),
(12, 17),
(13, 17),
(16, 17),
(14, 18),
(15, 18),
(14, 19),
(14, 20),
(15, 20);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int NOT NULL,
  `id_pinjam` int NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int NOT NULL,
  `tgl_denda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `id_pinjam`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
(2, 12, '2000', 1, '2024-08-22'),
(4, 14, '6000', 3, '2024-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(15, 'Novel'),
(16, 'Agama Islam'),
(17, 'Edukasi'),
(18, 'Horor'),
(19, 'Action'),
(20, 'Absurd');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int NOT NULL,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `status` enum('Dipinjam','Dikembalikan') NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int NOT NULL,
  `tgl_kembali` varchar(255) NOT NULL,
  `balik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `id_user`, `id_buku`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_kembali`, `balik`) VALUES
(11, 8, 13, 'Dikembalikan', '2024-08-19', 2, '2024-08-21', '2024-08-20'),
(12, 8, 13, 'Dikembalikan', '2024-08-20', 1, '2024-08-21', '2024-08-22'),
(14, 8, 12, 'Dikembalikan', '2024-08-23', 2, '2024-08-25', '2024-08-28'),
(15, 8, 13, 'Dikembalikan', '2024-08-23', 2, '2024-08-25', '2024-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('Petugas','Anggota','Administrator') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `pass`, `email`, `role`) VALUES
(4, 'Surya 15', '$2y$10$HA6gmwdedGhtaH3R/Stkt.aqa8xy.cCfqUIB9jm8rx716zUNqtGUe', 'perry33@happiseektest.com', 'Petugas'),
(6, 'asdbc', '$2y$10$ECXxlyn9dpcd7ZLV7T/FSeZL8ie1GwJX8JlXqAcWa8vnck/dEqUKO', 'rantipwr12@gmail.com', 'Petugas'),
(7, 'asdc', '$2y$10$dESkxpc58Rj07Ifo/B79jO6ObyIVJ5Jq6iLl3zvv7gq6i0nWlgdlC', 'perry33@1hssaappiseektest.comc', 'Petugas'),
(8, 'nazaki', '$2y$10$uLioWXxjhShQRMGTXAPfNuaJrlNsXVvVOxxZoQfEzt8z.NczuyZAW', 'panmu90@gmail.com', 'Anggota'),
(9, 'Siti Khadijah', '$2y$10$B4Lv89m2DbtHbcKc/sX.7OYDrLQ9VIGNISOfsnQfS7ikX1n67wbkW', 'rantipwr8@gmail.com', 'Administrator'),
(10, 'Naxex', '$2y$10$MDZKHaV1f2JmTGtf1qmSxuuC4V5HEckh/QFnoZG0j/PUf0E4w7gwq', 'Ranfor@gmail.com', 'Anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `buku_kategori`
--
ALTER TABLE `buku_kategori`
  ADD PRIMARY KEY (`id_buku`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `user` (`id_user`),
  ADD KEY `buku` (`id_buku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku_kategori`
--
ALTER TABLE `buku_kategori`
  ADD CONSTRAINT `buku_kategori_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE,
  ADD CONSTRAINT `buku_kategori_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
