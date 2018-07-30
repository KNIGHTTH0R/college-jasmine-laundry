-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 Jul 2018 pada 17.14
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jasmine_laundry`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`) VALUES
(1, 'admin');

--
-- Trigger `admin`
--
DELIMITER $$
CREATE TRIGGER `check_role_admin` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.admin_id) != 'admin' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `agen`
--

CREATE TABLE `agen` (
  `agen_id` int(11) NOT NULL,
  `agen_nama` varchar(31) NOT NULL,
  `agen_deleted` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agen`
--

INSERT INTO `agen` (`agen_id`, `agen_nama`, `agen_deleted`) VALUES
(2, 'Agen Antapani', 'false');

--
-- Trigger `agen`
--
DELIMITER $$
CREATE TRIGGER `check_role_agen` BEFORE INSERT ON `agen` FOR EACH ROW BEGIN
		IF (SELECT login_role FROM login WHERE login_id = NEW.agen_id) != 'agen' THEN 
			SIGNAL SQLSTATE '45000';
		END IF;
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jeniscucian`
--

CREATE TABLE `jeniscucian` (
  `jeniscucian_id` int(11) NOT NULL,
  `jeniscucian_nama` varchar(31) NOT NULL,
  `jeniscucian_harga` int(11) NOT NULL,
  `jeniscucian_deleted` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jeniscucian`
--

INSERT INTO `jeniscucian` (`jeniscucian_id`, `jeniscucian_nama`, `jeniscucian_harga`, `jeniscucian_deleted`) VALUES
(1, 'Cover Jas', 5000, 'false'),
(2, 'Selimut tipis', 17500, 'false'),
(3, 'T-shirt', 4500, 'false'),
(4, 'Toga', 24000, 'false'),
(5, 'Tikar biasa', 27500, 'false'),
(6, 'Tenda', 30500, 'false'),
(7, 'Tas ransel', 27500, 'false'),
(8, 'Tas kulit', 69000, 'false'),
(9, 'Selendang', 6000, 'false'),
(10, 'Jas', 17500, 'false'),
(11, 'Dasi', 11000, 'false'),
(12, 'Boneka bantal', 14000, 'false'),
(13, 'Bantal', 15500, 'false'),
(14, 'Sajadah', 10000, 'false'),
(15, 'Rompi', 13000, 'false'),
(16, 'Peci', 9500, 'false'),
(17, 'Matras springbed single', 27500, 'false'),
(18, 'Kerudung', 9500, 'false'),
(19, 'Kemeja', 14500, 'false'),
(20, 'Kaos kaki	', 6500, 'false'),
(21, 'Baju lab', 11000, 'false');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(31) NOT NULL,
  `login_password` varchar(51) NOT NULL,
  `login_role` enum('admin','agen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `login_role`) VALUES
(1, 'admin', '21232F297A57A5A743894A0E4A801FC3', 'admin'),
(2, 'antapani', '827ccb0eea8a706c4c34a16891f84e7b', 'agen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota_jeniscucian`
--

CREATE TABLE `nota_jeniscucian` (
  `nota_jeniscucian_id` int(11) NOT NULL,
  `nota_jeniscucian_jumlah` smallint(6) NOT NULL,
  `nota_jeniscucian_subtotal` int(11) NOT NULL,
  `nota_id` int(11) NOT NULL,
  `jeniscucian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota_jeniscucian`
--

INSERT INTO `nota_jeniscucian` (`nota_jeniscucian_id`, `nota_jeniscucian_jumlah`, `nota_jeniscucian_subtotal`, `nota_id`, `jeniscucian_id`) VALUES
(1, 1, 5000, 1, 1),
(2, 1, 5000, 2, 1),
(3, 2, 9000, 3, 3),
(4, 1, 24000, 3, 4),
(6, 1, 69000, 4, 8),
(8, 1, 17500, 5, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(31) NOT NULL,
  `pelanggan_alamat` varchar(101) NOT NULL,
  `pelanggan_notelp` varchar(13) NOT NULL,
  `pelanggan_deleted` enum('true','false') DEFAULT 'false',
  `agen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_notelp`, `pelanggan_deleted`, `agen_id`) VALUES
(1, 'Taufiq', 'Jl. Antapani No. 1', '087887865456', 'false', 2),
(2, 'Benna', 'Jl. Antapani No. 4', '087382737282', 'false', 2),
(3, 'Firman', 'Jl. Antapani no.3', '08948394383', 'false', 2),
(4, 'Darmawan', 'Jl. dipatiukur no 119', '0841738132121', 'false', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `nota_id` int(11) NOT NULL,
  `nota_tgl_masuk` date NOT NULL,
  `nota_tgl_selesai` date NOT NULL,
  `nota_status` enum('Sudah Bayar','Belum Bayar') NOT NULL DEFAULT 'Belum Bayar',
  `nota_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`nota_id`, `nota_tgl_masuk`, `nota_tgl_selesai`, `nota_status`, `nota_deleted`, `pelanggan_id`) VALUES
(1, '2018-07-28', '2018-07-28', 'Belum Bayar', 'false', 1),
(2, '2018-07-28', '2018-07-28', 'Belum Bayar', 'true', 1),
(3, '2018-07-28', '2018-07-28', 'Sudah Bayar', 'false', 2),
(4, '2018-07-30', '2018-07-30', 'Sudah Bayar', 'false', 3),
(5, '2018-07-30', '2018-07-30', 'Belum Bayar', 'false', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`agen_id`);

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
-- Indexes for table `nota_jeniscucian`
--
ALTER TABLE `nota_jeniscucian`
  ADD PRIMARY KEY (`nota_jeniscucian_id`),
  ADD KEY `fk_nota_jeniscucian_nota` (`nota_id`),
  ADD KEY `fk_nota_jeniscucian_jeniscucian` (`jeniscucian_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`),
  ADD KEY `fk_pelanggan_agen` (`agen_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nota_id`),
  ADD KEY `fk_transaksi_pelanggan` (`pelanggan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jeniscucian`
--
ALTER TABLE `jeniscucian`
  MODIFY `jeniscucian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nota_jeniscucian`
--
ALTER TABLE `nota_jeniscucian`
  MODIFY `nota_jeniscucian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `nota_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_login` FOREIGN KEY (`admin_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `agen`
--
ALTER TABLE `agen`
  ADD CONSTRAINT `fk_agen_login` FOREIGN KEY (`agen_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nota_jeniscucian`
--
ALTER TABLE `nota_jeniscucian`
  ADD CONSTRAINT `fk_nota_jeniscucian_jeniscucian` FOREIGN KEY (`jeniscucian_id`) REFERENCES `jeniscucian` (`jeniscucian_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_jeniscucian_nota` FOREIGN KEY (`nota_id`) REFERENCES `transaksi` (`nota_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_agen` FOREIGN KEY (`agen_id`) REFERENCES `agen` (`agen_id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
