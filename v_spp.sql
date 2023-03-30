-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 07:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(15) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan`) VALUES
(1, '10 PPLG 1', 'Rekyasa Perangkat Lunak'),
(2, '10 PPLG 2', 'Rekayasa Perangkat Lunak'),
(3, '10 TKJT 1', 'Teknik Komputer Jaringan'),
(4, '10 TKJT 2', 'Teknik Komputer Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(15) NOT NULL,
  `nama_petugas` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('ADMIN','PETUGAS') NOT NULL,
  `status` enum('AKTIF','PASIF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `username`, `password`, `level`, `status`) VALUES
(1, 'Tasya ', 'Tasya', '7d19636b89246d5a90c4a7ceb0a7142345bbf020', 'ADMIN', 'AKTIF'),
(2, 'Ramadhinta', 'Ramadhinta', 'a036317b65f0e03c0d45845ffc07956dc7861ea4', 'PETUGAS', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` int(20) NOT NULL,
  `nis` int(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `kelas_id` int(20) NOT NULL,
  `alamat` varchar(20) NOT NULL,
  `telp` varchar(25) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'SISWA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `kelas_id`, `alamat`, `telp`, `level`) VALUES
(202020, 2020, 'Caca', 4, 'Jl.Melati', '8947264', 'SISWA'),
(12131415, 1213, 'Ryanda', 3, 'Jl.Jati Wangi', '2147483647', 'SISWA'),
(24242424, 2424, 'Sasya', 2, 'Jl.Meru Raya ', '893736224', 'SISWA'),
(70707070, 7070, 'Kirana', 2, 'Jl.Jambu 1', '283748736', 'SISWA');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` int(15) NOT NULL,
  `tahun` int(20) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `nominal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `tahun`, `bulan`, `nominal`) VALUES
(1, 2022, 'Maret', 400000),
(2, 2022, 'April', 400000),
(3, 2022, 'Mei', 400000),
(5, 2023, 'Januari', 420000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(15) NOT NULL,
  `petugas_id` int(20) NOT NULL,
  `nisn` int(20) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `tgl_bayar` int(20) NOT NULL,
  `bln_bayar` varchar(20) NOT NULL,
  `th_bayar` int(20) NOT NULL,
  `spp_id` int(20) NOT NULL,
  `jml_bayar` int(20) NOT NULL,
  `ket` enum('Lunas','Tertunda') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `petugas_id`, `nisn`, `nama`, `tgl_bayar`, `bln_bayar`, `th_bayar`, `spp_id`, `jml_bayar`, `ket`) VALUES
(2, 1, 24242424, 'Sasya', 20, 'Desember', 2022, 5, 350000, 'Tertunda'),
(4, 1, 12131415, 'Ryanda', 20, 'Januari', 2023, 5, 420000, 'Lunas'),
(5, 1, 70707070, 'Kirana', 20, 'Mei', 2022, 3, 350000, 'Tertunda'),
(6, 1, 70707070, 'Kirana', 20, 'November', 2022, 3, 420000, 'Lunas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `kelas_id` (`kelas_id`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_id` (`petugas_id`,`nisn`,`spp_id`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `spp_id` (`spp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nisn` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70707071;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
