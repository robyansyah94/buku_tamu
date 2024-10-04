-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 05:47 AM
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
-- Database: `app_bukutamu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_buku_tamu`
--

CREATE TABLE `tabel_buku_tamu` (
  `id_tamu` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_tamu` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `bertemu` varchar(100) NOT NULL,
  `kepentingan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_buku_tamu`
--

INSERT INTO `tabel_buku_tamu` (`id_tamu`, `tanggal`, `nama_tamu`, `alamat`, `no_hp`, `bertemu`, `kepentingan`) VALUES
('00002', '2024-09-10', 'Asep Komarudin', 'jl.Arciko NO 78 CIanjur', '085788997788', 'Bu indah', 'Mengambil Rapot'),
('00003', '2024-09-18', 'Airil Jahran', 'jl.cimenteng no 79 Cianjur', '085755667744', 'Roby', 'Bayar Hutang 1M'),
('zt004', '2024-09-19', 'zt004', 'dimana we', '090876365345', 'dia', 'kepo'),
('zt008', '2024-09-24', 'sahanya', 'kp.dmana we', '0980987456', 'dia', 'ehem');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` enum('admin','operator') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `user_role`) VALUES
('usr05', 'admin', '$2y$10$h/cNfjndBKo/pJWIn0ROeeAaQGSqv.kBq1FyFnmR2Tt10a8cZBzWK', 'admin'),
('usr06', 'operator', '$2y$10$Ai/OZAaSwfnzMQ7cAl71EO0qWew7v.jlWpldYYLsc6ISMjKjySeWC', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_buku_tamu`
--
ALTER TABLE `tabel_buku_tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
