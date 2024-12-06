-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 04:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekap_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `asal_surat`
--

CREATE TABLE `asal_surat` (
  `id_asal_surat` int(11) NOT NULL,
  `nama_instansi` varchar(200) NOT NULL,
  `alamat_instansi` varchar(200) NOT NULL,
  `no_telpon_instansi` varchar(30) NOT NULL,
  `email_instansi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asal_surat`
--

INSERT INTO `asal_surat` (`id_asal_surat`, `nama_instansi`, `alamat_instansi`, `no_telpon_instansi`, `email_instansi`) VALUES
(1, 'Dinas Pariwisata', 'Jln Benua Anyar', '', ''),
(2, 'Dinas Dinasan', 'Jln An', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Pertanian'),
(2, 'Sekretariat');

-- --------------------------------------------------------

--
-- Table structure for table `kode_surat`
--

CREATE TABLE `kode_surat` (
  `id_kode_surat` int(11) NOT NULL,
  `kode_surat` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kode_surat`
--

INSERT INTO `kode_surat` (`id_kode_surat`, `kode_surat`, `keterangan`) VALUES
(1, '01', 'Surat Keputusan (SK)'),
(2, '02', 'Surat Undangan (SU)'),
(3, '03', 'Surat Permohonan (SPm)'),
(4, '04', 'Surat Pemberitahuan (SPb)'),
(5, '05', 'Surat Peminjaman (SPp)'),
(6, '06', 'Surat Pernyataan (SPn)'),
(7, '07', 'Surat Mandat (SM)'),
(8, '08', 'Surat Tugas (ST)'),
(9, '09', 'Surat Keterangan (SKet)'),
(10, '10', 'Surat Rekomendasi (SR)'),
(11, '11', 'Surat Balasan (SB)'),
(12, '12', 'Surat Perintah Perjalanan Dinas (SPPD)'),
(13, '13', 'Sertifikat (SRT)'),
(14, '14', 'Perjanjian Kerja (PK)'),
(15, '15', 'Surat Pengantar (SPeng)');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat` int(11) NOT NULL,
  `no_surat` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `perihal` varchar(500) NOT NULL,
  `file_surat` varchar(500) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_divisi` int(11) NOT NULL,
  `id_kode_surat` int(11) NOT NULL,
  `id_asal_surat` int(11) NOT NULL,
  `catatan` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat`, `no_surat`, `tanggal_masuk`, `perihal`, `file_surat`, `id_user`, `id_divisi`, `id_kode_surat`, `id_asal_surat`, `catatan`) VALUES
(28, '1', '2002-11-09', 'Undangan Makan Bersama', 'http://localhost/pengarsipan/files/67530f4265b55.pdf', 1, 1, 2, 1, 'Bayar Sendiri');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(3) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('pegawai','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nm_user`, `username`, `password`, `role`) VALUES
(1, 'Novriyan', 'admin', 'admin', 'admin'),
(2, 'Pegawai Generik', 'pegawai', 'pegawai', 'pegawai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asal_surat`
--
ALTER TABLE `asal_surat`
  ADD PRIMARY KEY (`id_asal_surat`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `kode_surat`
--
ALTER TABLE `kode_surat`
  ADD PRIMARY KEY (`id_kode_surat`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_asal_surat` (`id_asal_surat`),
  ADD KEY `id_kode_surat` (`id_kode_surat`),
  ADD KEY `id_divisi` (`id_divisi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asal_surat`
--
ALTER TABLE `asal_surat`
  MODIFY `id_asal_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kode_surat`
--
ALTER TABLE `kode_surat`
  MODIFY `id_kode_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `surat_masuk_ibfk_2` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`),
  ADD CONSTRAINT `surat_masuk_ibfk_4` FOREIGN KEY (`id_asal_surat`) REFERENCES `asal_surat` (`id_asal_surat`),
  ADD CONSTRAINT `surat_masuk_ibfk_5` FOREIGN KEY (`id_kode_surat`) REFERENCES `kode_surat` (`id_kode_surat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
