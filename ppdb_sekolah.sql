-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 05:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppdb_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `berkas_registrasi`
--

CREATE TABLE `berkas_registrasi` (
  `id` int(11) NOT NULL,
  `registrasi_id` int(11) NOT NULL,
  `nama_berkas` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berkas_registrasi`
--

INSERT INTO `berkas_registrasi` (`id`, `registrasi_id`, `nama_berkas`, `file`, `created_at`, `updated_at`) VALUES
(3, 3, 'ijazah sma', '64e577e92bed8.pdf', '2023-08-22 22:07:21', '2023-08-22 22:07:21'),
(4, 6, 'ijazah smk', '64e57834a7385.pdf', '2023-08-22 22:08:36', '2023-08-22 22:08:36'),
(15, 7, 'ijazah smk', '64e5ac6c3286e.pdf', '2023-08-23 01:51:24', '2023-08-23 01:51:24'),
(19, 1, 'ijazah sma', '64e612a9f3e37.pdf', '2023-08-23 09:07:38', '2023-08-23 09:07:38'),
(20, 8, 'ijazah sma', '64e6199847592.pdf', '2023-08-23 09:37:12', '2023-08-23 09:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, 'IPA', '2023-08-22 06:29:12', '2023-08-22 06:29:12'),
(2, 'IPS', '2023-08-22 06:29:41', '2023-08-22 06:29:41'),
(3, 'Bahasa', '2023-08-22 06:29:41', '2023-08-22 06:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `registrasi`
--

CREATE TABLE `registrasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('accept','reject','pending','') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrasi`
--

INSERT INTO `registrasi` (`id`, `user_id`, `jurusan_id`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'L', 'Karawang', '2002-08-23', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-22 02:40:44', '2023-08-22 02:40:44'),
(3, 5, 3, 'L', 'Karawang', '2003-01-17', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-22 03:00:57', '2023-08-22 03:00:57'),
(4, 2, 2, 'L', 'Karawang', '2003-07-10', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-22 08:19:39', '2023-08-22 08:19:39'),
(5, 4, 1, 'L', 'Karawang', '2002-02-05', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-22 08:38:50', '2023-08-22 08:38:50'),
(6, 6, 3, 'P', 'Karawang', '2002-02-06', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-22 22:08:21', '2023-08-22 22:08:21'),
(7, 7, 2, 'L', 'Karawang', '2023-08-10', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-23 01:35:19', '2023-08-23 01:35:19'),
(8, 11, 1, 'P', 'Karawang', '2005-06-07', 'Dusun Krajan, RT 007 / RW 001, Kel. Pasirawi, Kec. Rawamerta', 'pending', '2023-08-23 09:36:59', '2023-08-23 09:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','','') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `nama`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, '9bmuhamadagusfaisal@gmail.com', 'Muhamad Agus Faisal', '$2y$10$.xiS.sCXCe6izsLLMva82.L0C/oJ8olOcvIT9NR0gf.fQ4UPIDRMy', 'user', '2023-08-21 08:20:44', '2023-08-21 08:20:44'),
(2, 'raka1212@gmail.com', 'Raka Fazzah Fithra', '$2y$10$qJlUkjKLisYI8DCpOQZYhO0oUM.Oab0yBTp2eE7lU.DRWIAU7hlw.', 'user', '2023-08-21 09:26:56', '2023-08-21 09:26:56'),
(3, 'sultan@gmail.com', 'Sultan Naufal', '$2y$10$KU8CMmWmHFYOZx.UGenTW.zj5ejC8QhjWy7uyiFAo8.zNfaOQo7Hm', 'user', '2023-08-21 20:34:47', '2023-08-21 20:34:47'),
(4, 'adit@gmail.com', 'Aditya Ramadhan', '$2y$10$jleFm1G0ei2cTYDyTc3V0OJocZ1rL4nyyKayP02top57Obx0A3tWW', 'user', '2023-08-21 22:28:30', '2023-08-21 22:28:30'),
(5, 'luqman@gmail.com', 'Luthfi Luqman Fattah', '$2y$10$mEsdbQpTjqA8tGAPEEl/fuwXVYbL.744.tY/5wNAYektGw42EW4B.', 'user', '2023-08-21 23:24:13', '2023-08-21 23:24:13'),
(6, 'rianti@gmail.com', 'Rianti Febrianti', '$2y$10$8RIqd4Tr16pWNN/LTiJOEO5HaZmCgKlIsZaMZRoLstSeZjh.1RBvu', 'user', '2023-08-22 11:15:20', '2023-08-22 11:15:20'),
(7, 'raka6@gmail.com', 'raka', '$2y$10$S/VLN9687dimbp22jZBq9.gYgQL9OXGJWNMKlRRJjJqLv4Ha9pSwK', 'user', '2023-08-23 01:34:47', '2023-08-23 01:34:47'),
(8, 'bintang@gmail.com', 'Bintang', '$2y$10$N5Ktrh0W1LurR5L/jrXHHOkm4Se5nFLUrY5s9toWsWL2WkBiejAgW', 'user', '2023-08-23 02:07:51', '2023-08-23 02:07:51'),
(9, 'adam@gmail.com', 'Adam', '$2y$10$9e0KdW7riHlDn09RB7FwDOfGULTWCbfDGPvibZcXk4vDSBJ0QXUW2', 'user', '2023-08-23 03:12:35', '2023-08-23 03:12:35'),
(10, 'rieko@gmail.com', 'Rieko Alysia Syahputra', '$2y$10$p.PEBcXOswee29juqeoZwubBAzIOlwtxeDTolZGZ3kbkqKWM9949a', 'user', '2023-08-23 09:32:01', '2023-08-23 09:32:01'),
(11, 'divia@gmail.com', 'Divia Maharani', '$2y$10$XpVOagvYqcv4o.zEKP4vx.K68oSU2a5g2EdqmkdS8BJuRDSnMnDpy', 'user', '2023-08-23 09:36:22', '2023-08-23 09:36:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berkas_registrasi`
--
ALTER TABLE `berkas_registrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registrasi_id` (`registrasi_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurusan_unique` (`nama_jurusan`);

--
-- Indexes for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berkas_registrasi`
--
ALTER TABLE `berkas_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berkas_registrasi`
--
ALTER TABLE `berkas_registrasi`
  ADD CONSTRAINT `berkas_registrasi_ibfk_1` FOREIGN KEY (`registrasi_id`) REFERENCES `registrasi` (`id`);

--
-- Constraints for table `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `registrasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `registrasi_ibfk_2` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
