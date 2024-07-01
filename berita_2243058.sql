-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 08:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berita_2243058`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `isi` text NOT NULL,
  `tgl_terbit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_penulis` varchar(3) DEFAULT NULL,
  `id_kategori` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `deskripsi`, `isi`, `tgl_terbit`, `id_penulis`, `id_kategori`) VALUES
(1, 'Kenapa kita merasa sedih?', 'Sebuah artikel tentang emosi manusia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id arcu sit amet urna volutpat blandit. Nunc id dapibus purus, ac commodo est. Vivamus tincidunt nibh nec purus semper, id hendrerit purus dapibus. Nam at tempus mi. Mauris eu ipsum condimentum, volutpat eros sollicitudin, tincidunt erat. Vivamus id metus metus. Donec imperdiet elit non nisi volutpat, at consequat dolor pharetra. Aenean ligula eros, volutpat nec turpis sit amet, cursus dapibus nibh. Praesent mollis a neque id elementum. Cras vel felis metus. Praesent nec risus fermentum, molestie libero scelerisque, semper enim. Suspendisse nulla enim, accumsan interdum quam eget, tristique imperdiet sem.', '2024-05-31 07:08:27', '019', 'HKM'),
(2, 'Top 10 Pegulat Terbaik di Indonesia', 'LIst pegulat', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id arcu sit amet urna volutpat blandit. Nunc id dapibus purus, ac commodo est. Vivamus tincidunt nibh nec purus semper, id hendrerit purus dapibus. Nam at tempus mi. Mauris eu ipsum condimentum, volutpat eros sollicitudin, tincidunt erat. Vivamus id metus metus. Donec imperdiet elit non nisi volutpat, at consequat dolor pharetra. Aenean ligula eros, volutpat nec turpis sit amet, cursus dapibus nibh. Praesent mollis a neque id elementum. Cras vel felis metus. Praesent nec risus fermentum, molestie libero scelerisque, semper enim. Suspendisse nulla enim, accumsan interdum quam eget, tristique imperdiet sem.', '2024-05-29 16:00:00', '058', 'SPT');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(3) NOT NULL,
  `nama_kat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kat`) VALUES
('HKM', 'Hukum'),
('SPT', 'Sport\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` varchar(3) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama`, `tgl_lahir`, `gender`) VALUES
('019', 'Chat', '2004-06-04', 'P'),
('058', 'Fabian', '2005-02-21', 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `id_penulis` (`id_penulis`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `berita_ibfk_2` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
