-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Des 2016 pada 18.16
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry_jasmine`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(31) NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `login_id`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `agen`
--

CREATE TABLE IF NOT EXISTS `agen` (
  `agen_id` int(11) NOT NULL,
  `agen_nama` varchar(31) NOT NULL,
  `agen_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agen`
--

INSERT INTO `agen` (`agen_id`, `agen_nama`, `agen_deleted`, `login_id`) VALUES
(1, 'Agen Antapani', 'false', 2),
(2, 'Agen Cileunyi', 'false', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jeniscucian`
--

CREATE TABLE IF NOT EXISTS `jeniscucian` (
  `jeniscucian_id` int(11) NOT NULL,
  `jeniscucian_nama` varchar(31) NOT NULL,
  `jeniscucian_harga` int(11) NOT NULL,
  `jeniscucian_deleted` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jeniscucian`
--

INSERT INTO `jeniscucian` (`jeniscucian_id`, `jeniscucian_nama`, `jeniscucian_harga`, `jeniscucian_deleted`) VALUES
(1, 'Levis', 6000, 'false'),
(3, 'Kaos', 2000, 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(31) NOT NULL,
  `login_password` varchar(51) NOT NULL,
  `login_role` enum('admin','agen') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `login_role`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'firman', '74bfebec67d1a87b161e5cbcf6f72a4a', 'agen'),
(3, 'evan', '98cc7d37dc7b90c14a59ef0c5caa8995', 'agen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `nota_id` int(11) NOT NULL,
  `nota_tgl_masuk` date NOT NULL,
  `nota_tgl_selesai` date NOT NULL,
  `nota_status` enum('Sudah Bayar','Belum Bayar') NOT NULL DEFAULT 'Belum Bayar',
  `nota_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11112 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`nota_id`, `nota_tgl_masuk`, `nota_tgl_selesai`, `nota_status`, `nota_deleted`, `pelanggan_id`) VALUES
(1, '2016-12-15', '2016-12-31', 'Belum Bayar', 'false', 1),
(2, '2016-12-30', '2016-12-31', 'Belum Bayar', 'false', 12),
(3, '2016-12-30', '2016-12-31', 'Belum Bayar', 'false', 11),
(123, '2016-12-25', '2016-12-30', 'Belum Bayar', 'false', 1),
(444, '2017-01-08', '2016-12-25', 'Sudah Bayar', 'true', 11),
(888, '2016-12-31', '2016-12-25', 'Sudah Bayar', 'false', 11),
(11111, '2016-12-25', '2016-12-25', 'Belum Bayar', 'false', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota_jeniscucian`
--

CREATE TABLE IF NOT EXISTS `nota_jeniscucian` (
  `nota_jeniscucian_id` int(11) NOT NULL,
  `nota_jeniscucian_jumlah` smallint(6) NOT NULL,
  `nota_jeniscucian_subtotal` int(11) NOT NULL,
  `nota_id` int(11) NOT NULL,
  `jeniscucian_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota_jeniscucian`
--

INSERT INTO `nota_jeniscucian` (`nota_jeniscucian_id`, `nota_jeniscucian_jumlah`, `nota_jeniscucian_subtotal`, `nota_id`, `jeniscucian_id`) VALUES
(1, 2, 20000, 1, 1),
(2, 1, 12000, 2, 1),
(13, 2, 20000, 123, 1),
(14, 3, 30000, 123, 1),
(15, 1, 10000, 123, 1),
(16, 1, 10000, 444, 1),
(17, 4, 40000, 444, 1),
(18, 5, 50000, 444, 1),
(19, 0, 0, 444, 1),
(20, 5, 50000, 888, 1),
(21, 1, 10000, 888, 1),
(22, 3, 30000, 888, 1),
(23, 1, 10000, 888, 1),
(24, 1, 6000, 11111, 1),
(25, 10, 60000, 11111, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(31) NOT NULL,
  `pelanggan_alamat` varchar(101) NOT NULL,
  `pelanggan_notelp` varchar(13) NOT NULL,
  `pelanggan_deleted` enum('true','false') DEFAULT 'false',
  `agen_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_notelp`, `pelanggan_deleted`, `agen_id`) VALUES
(1, 'Evan Gilang', 'Cileunyi Bandung', '08122222', 'false', 1),
(11, 'Taufiq', 'Dago', '081212121', 'false', 1),
(12, 'Berry', 'Dago', '0876777', 'false', 2),
(13, 'Rafi', 'Antapani', '0888888', 'false', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`agen_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `jeniscucian`
--
ALTER TABLE `jeniscucian`
  ADD PRIMARY KEY (`jeniscucian_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_username` (`login_username`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `nota_jeniscucian`
--
ALTER TABLE `nota_jeniscucian`
  ADD PRIMARY KEY (`nota_jeniscucian_id`),
  ADD KEY `nota_id` (`nota_id`),
  ADD KEY `jeniscucian_id` (`jeniscucian_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`),
  ADD KEY `agen_id` (`agen_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `agen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jeniscucian`
--
ALTER TABLE `jeniscucian`
  MODIFY `jeniscucian_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11112;
--
-- AUTO_INCREMENT for table `nota_jeniscucian`
--
ALTER TABLE `nota_jeniscucian`
  MODIFY `nota_jeniscucian_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

--
-- Ketidakleluasaan untuk tabel `agen`
--
ALTER TABLE `agen`
  ADD CONSTRAINT `agen_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`);

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`);

--
-- Ketidakleluasaan untuk tabel `nota_jeniscucian`
--
ALTER TABLE `nota_jeniscucian`
  ADD CONSTRAINT `nota_jeniscucian_ibfk_1` FOREIGN KEY (`nota_id`) REFERENCES `nota` (`nota_id`),
  ADD CONSTRAINT `nota_jeniscucian_ibfk_2` FOREIGN KEY (`jeniscucian_id`) REFERENCES `jeniscucian` (`jeniscucian_id`);

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`agen_id`) REFERENCES `agen` (`agen_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
