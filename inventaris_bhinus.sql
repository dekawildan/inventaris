-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 08:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_bhinus`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_agenda` (IN `kodebrg` CHAR(20))  SELECT barang.*,agenda_service.* FROM barang,agenda_service WHERE barang.barang_kode=agenda_service.barang_kode AND agenda_service.barang_kode LIKE kodebrg$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_barang` (IN `barangnya` CHAR(20))  SELECT jurusan.*,ruang.*,barang.* FROM jurusan,ruang,barang WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_id=barang.ruang_id AND barang.barang_kode=barangnya$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_jurusan` (IN `namajurusan` VARCHAR(100))  SELECT * FROM jurusan WHERE jurusan.jurusan_nama LIKE namajurusan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_ruang` (IN `namaruang` VARCHAR(100))  SELECT jurusan.*,ruang.* FROM jurusan,ruang WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_nama LIKE namaruang$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cari_rusak` (IN `carirusak` CHAR(20))  SELECT * FROM rusak WHERE rusak.barang_kode LIKE carirusak$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cek_login` (IN `userlogin` VARCHAR(100), IN `passlogin` VARCHAR(100))  SELECT * FROM login WHERE login.login_user=userlogin AND login.login_password=passlogin$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `filter_laporan` (IN `bulan` INT(11))  SELECT jurusan.*,ruang.*,barang.*,agenda_service.*,MONTH(agenda_service.tgl_agenda) AS bulan FROM jurusan,ruang,barang,agenda_service WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_id=barang.ruang_id AND barang.barang_kode=agenda_service.barang_kode AND MONTH(agenda_service.tgl_agenda)=bulan AND agenda_service.keterangan_agenda<>'BELUM DILAKSANAKAN'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_agenda` (IN `idagenda` INT(11))  DELETE FROM agenda_service WHERE agenda_service.agenda_id=idagenda$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_barang` (IN `idbarang` INT(11))  DELETE FROM barang WHERE barang.barang_id=idbarang$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_jurusan` (IN `idjurusan` INT(11))  DELETE FROM jurusan WHERE jurusan.jurusan_id=idjurusan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_ruang` (IN `idruang` INT(11))  DELETE FROM ruang WHERE ruang.ruang_id=idruang$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_rusak` (IN `idrusak` INT(11))  DELETE FROM rusak WHERE rusak.rusak_id=idrusak$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `laporan_inventaris` ()  SELECT jurusan.*,ruang.*,barang.*,agenda_service.* FROM jurusan,ruang,barang,agenda_service WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_id=barang.ruang_id AND barang.barang_kode=agenda_service.barang_kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_agenda` (IN `kodebrg` CHAR(20), IN `tglagenda` DATE, IN `jenisagenda` ENUM('PERBAIKAN','PERAWATAN','PENGGANTIAN'), IN `ket` ENUM('BELUM DILAKSANAKAN','PROSES DILAKSANAKAN','SELESAI DILAKSANAKAN'))  INSERT INTO agenda_service (agenda_service.barang_kode,agenda_service.tgl_agenda,agenda_service.jenis_agenda,agenda_service.keterangan_agenda) VALUES(kodebrg,tglagenda,jenisagenda,ket)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_barang` (IN `kodebrg` CHAR(20), IN `namabrg` VARCHAR(100), IN `tglmasuk` DATE, IN `jmlbrg` MEDIUMINT(20), IN `keterangan` ENUM('MATI','NYALA SEBAGIAN','NYALA NORMAL'), IN `spesifikasi` TEXT, IN `foto` VARCHAR(200), IN `idruang` INT(11))  INSERT INTO barang (barang.barang_kode,barang.barang_nama,barang.tgl_masuk,barang.barang_jumlah,barang.barang_keterangan,barang.barang_spesifikasi,barang.barang_foto,barang.ruang_id) VALUES(kodebrg,namabrg,tglmasuk,jmlbrg,keterangan,spesifikasi,foto,idruang)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_jurusan` (IN `namajurusan` VARCHAR(100))  INSERT INTO jurusan (jurusan.jurusan_nama) VALUES(namajurusan)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_ruang` (IN `namaruang` VARCHAR(100), IN `idjurusan` INT(11))  INSERT INTO ruang (ruang.ruang_nama,ruang.jurusan_id) VALUES(namaruang,idjurusan)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_rusak` (IN `kodebrg` CHAR(20), IN `namabrg` VARCHAR(100), IN `tglrusak` DATE, IN `jmlbrg` MEDIUMINT(20), IN `ket` ENUM('MATI','RUSAK'), IN `spek` TEXT)  INSERT INTO rusak (rusak.barang_kode,rusak.barang_nama,rusak.tgl_rusak,rusak.barang_jumlah,rusak.barang_keterangan,rusak.barang_spesifikasi) VALUES(kodebrg,namabrg,tglrusak,jmlbrg,ket,spek)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_agenda` ()  SELECT barang.*,agenda_service.* FROM barang,agenda_service WHERE barang.barang_kode=agenda_service.barang_kode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_agenda_belum` ()  SELECT barang.*,agenda_service.* FROM barang,agenda_service WHERE barang.barang_kode=agenda_service.barang_kode AND agenda_service.keterangan_agenda='BELUM DILAKSANAKAN'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_agenda_proses` ()  SELECT barang.*,agenda_service.* FROM barang,agenda_service WHERE barang.barang_kode=agenda_service.barang_kode AND agenda_service.keterangan_agenda='PROSES DILAKSANAKAN'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_agenda_selesai` ()  SELECT barang.*,agenda_service.* FROM barang,agenda_service WHERE barang.barang_kode=agenda_service.barang_kode AND agenda_service.keterangan_agenda='SELESAI DILAKSANAKAN'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_barang` ()  SELECT jurusan.*,ruang.*,barang.* FROM jurusan,ruang,barang WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_id=barang.ruang_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_barang_mati` ()  SELECT * FROM rusak$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_barang_normal` ()  SELECT jurusan.*,ruang.*,barang.* FROM jurusan,ruang,barang WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_id=barang.ruang_id AND barang.barang_keterangan='NYALA NORMAL'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_barang_sebagian` ()  SELECT jurusan.*,ruang.*,barang.* FROM jurusan,ruang,barang WHERE jurusan.jurusan_id=ruang.jurusan_id AND ruang.ruang_id=barang.ruang_id AND barang.barang_keterangan='NYALA SEBAGIAN'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_jurusan` ()  SELECT * FROM jurusan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_ruang` ()  SELECT jurusan.*,ruang.* FROM jurusan,ruang WHERE jurusan.jurusan_id=ruang.jurusan_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_agenda` (IN `idagenda` INT(11), IN `kodebrg` CHAR(20), IN `tglagenda` DATE, IN `jenisagenda` ENUM('PERBAIKAN','PERAWATAN','PENGGANTIAN'), IN `ket` ENUM('BELUM DILAKSANAKAN','PROSES DILAKSANAKAN','SELESAI DILAKSANAKAN'))  UPDATE agenda_service SET agenda_service.barang_kode=kodebrg, agenda_service.tgl_agenda=tglagenda, agenda_service.jenis_agenda=jenisagenda, agenda_service.keterangan_agenda=ket WHERE agenda_service.agenda_id=idagenda$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_barang` (IN `idbrg` INT(11), IN `kodebrg` CHAR(20), IN `namabrg` VARCHAR(100), IN `tglmasuk` DATE, IN `jmlbrg` MEDIUMINT(20), IN `brgket` ENUM('NYALA SEBAGIAN','NYALA NORMAL'), IN `spek` TEXT, IN `fotobrg` VARCHAR(200), IN `idruang` INT(11))  UPDATE barang SET barang.barang_kode=kodebrg, barang.barang_nama=namabrg, barang.tgl_masuk=tglmasuk, barang.barang_jumlah=jmlbrg, barang.barang_keterangan=brgket, barang.barang_spesifikasi=spek, barang.barang_foto=fotobrg, barang.ruang_id=idruang WHERE barang.barang_id=idbrg$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_jurusan` (IN `idjurusan` INT(11), IN `namajurusan` VARCHAR(100))  UPDATE jurusan SET jurusan.jurusan_nama=namajurusan WHERE jurusan.jurusan_id=idjurusan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_ruang` (IN `idruang` INT(11), IN `namaruang` VARCHAR(100), IN `idjurusan` INT(11))  UPDATE ruang SET ruang.ruang_nama=namaruang, ruang.jurusan_id=idjurusan WHERE ruang.ruang_id=idruang$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_rusak` (IN `idrusak` INT(11), IN `jmlbrg` MEDIUMINT(20))  UPDATE rusak SET rusak.barang_jumlah=jmlbrg WHERE rusak.rusak_id=idrusak$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_service`
--

CREATE TABLE `agenda_service` (
  `agenda_id` int(11) NOT NULL,
  `barang_kode` char(20) NOT NULL,
  `tgl_agenda` date NOT NULL,
  `jenis_agenda` enum('PERBAIKAN','PERAWATAN','PENGGANTIAN') NOT NULL,
  `keterangan_agenda` enum('BELUM DILAKSANAKAN','PROSES DILAKSANAKAN','SELESAI DILAKSANAKAN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agenda_service`
--

INSERT INTO `agenda_service` (`agenda_id`, `barang_kode`, `tgl_agenda`, `jenis_agenda`, `keterangan_agenda`) VALUES
(1, '01/TANGCRM/TKJBN', '2022-07-14', 'PERBAIKAN', 'PROSES DILAKSANAKAN');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_kode` char(20) NOT NULL,
  `barang_nama` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `barang_jumlah` mediumint(20) NOT NULL,
  `barang_keterangan` enum('NYALA SEBAGIAN','NYALA NORMAL') NOT NULL,
  `barang_spesifikasi` text NOT NULL,
  `barang_foto` varchar(200) NOT NULL,
  `ruang_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_kode`, `barang_nama`, `tgl_masuk`, `barang_jumlah`, `barang_keterangan`, `barang_spesifikasi`, `barang_foto`, `ruang_id`) VALUES
(1, '01/TANGCRM/TKJBN', 'Tang Crimping', '2022-07-04', 9, 'NYALA NORMAL', 'Tang Crimping 2 Port', 'IMG-20220627-WA0021.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `jurusan_id` int(11) NOT NULL,
  `jurusan_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jurusan_id`, `jurusan_nama`) VALUES
(1, 'Teknik Komputer dan Jaringan'),
(2, 'Rekayasa Perangkat Lunak'),
(3, 'Multimedia');

-- --------------------------------------------------------

--
-- Stand-in structure for view `laporan_inventaris`
-- (See below for the actual view)
--
CREATE TABLE `laporan_inventaris` (
`jurusan_id` int(11)
,`jurusan_nama` varchar(100)
,`ruang_id` int(11)
,`ruang_nama` varchar(100)
,`barang_id` int(11)
,`barang_kode` char(20)
,`barang_nama` varchar(100)
,`tgl_masuk` date
,`barang_jumlah` mediumint(20)
,`barang_keterangan` enum('NYALA SEBAGIAN','NYALA NORMAL')
,`barang_foto` varchar(200)
,`agenda_id` int(11)
,`tgl_agenda` date
,`jenis_agenda` enum('PERBAIKAN','PERAWATAN','PENGGANTIAN')
,`keterangan_agenda` enum('BELUM DILAKSANAKAN','PROSES DILAKSANAKAN','SELESAI DILAKSANAKAN')
);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_user` varchar(100) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  `login_nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_user`, `login_password`, `login_nama`) VALUES
(1, 'toolman', 'toolman', 'Nur Fatoni');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `ruang_id` int(11) NOT NULL,
  `ruang_nama` varchar(100) NOT NULL,
  `jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`ruang_id`, `ruang_nama`, `jurusan_id`) VALUES
(1, 'Ruang Praktek RPL', 2),
(2, 'Ruang Praktek TKJ 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rusak`
--

CREATE TABLE `rusak` (
  `rusak_id` int(11) NOT NULL,
  `barang_kode` char(20) NOT NULL,
  `barang_nama` varchar(100) NOT NULL,
  `tgl_rusak` date NOT NULL,
  `barang_jumlah` mediumint(20) NOT NULL,
  `barang_keterangan` enum('MATI','RUSAK') NOT NULL,
  `barang_spesifikasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rusak`
--

INSERT INTO `rusak` (`rusak_id`, `barang_kode`, `barang_nama`, `tgl_rusak`, `barang_jumlah`, `barang_keterangan`, `barang_spesifikasi`) VALUES
(1, '01/TANGCRM/TKJBN', 'Tang Crimping', '2022-07-18', 1, 'RUSAK', 'Tang Crimping 2 Port');

--
-- Triggers `rusak`
--
DELIMITER $$
CREATE TRIGGER `barang_rusak` AFTER INSERT ON `rusak` FOR EACH ROW UPDATE barang SET barang.barang_jumlah=barang.barang_jumlah-NEW.barang_jumlah WHERE barang.barang_kode=NEW.barang_kode
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kembali_stok` BEFORE DELETE ON `rusak` FOR EACH ROW UPDATE barang SET barang.barang_jumlah=barang.barang_jumlah+OLD.barang_jumlah WHERE barang.barang_kode=OLD.barang_kode
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER UPDATE ON `rusak` FOR EACH ROW BEGIN
UPDATE barang SET barang.barang_jumlah=barang.barang_jumlah+OLD.barang_jumlah WHERE barang.barang_kode=OLD.barang_kode;
UPDATE barang SET barang.barang_jumlah=barang.barang_jumlah-NEW.barang_jumlah WHERE barang.barang_kode=NEW.barang_kode;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `laporan_inventaris`
--
DROP TABLE IF EXISTS `laporan_inventaris`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan_inventaris`  AS SELECT `jurusan`.`jurusan_id` AS `jurusan_id`, `jurusan`.`jurusan_nama` AS `jurusan_nama`, `ruang`.`ruang_id` AS `ruang_id`, `ruang`.`ruang_nama` AS `ruang_nama`, `barang`.`barang_id` AS `barang_id`, `barang`.`barang_kode` AS `barang_kode`, `barang`.`barang_nama` AS `barang_nama`, `barang`.`tgl_masuk` AS `tgl_masuk`, `barang`.`barang_jumlah` AS `barang_jumlah`, `barang`.`barang_keterangan` AS `barang_keterangan`, `barang`.`barang_foto` AS `barang_foto`, `agenda_service`.`agenda_id` AS `agenda_id`, `agenda_service`.`tgl_agenda` AS `tgl_agenda`, `agenda_service`.`jenis_agenda` AS `jenis_agenda`, `agenda_service`.`keterangan_agenda` AS `keterangan_agenda` FROM (((`jurusan` join `ruang`) join `barang`) join `agenda_service`) WHERE `jurusan`.`jurusan_id` = `ruang`.`jurusan_id` AND `ruang`.`ruang_id` = `barang`.`ruang_id` AND `barang`.`barang_kode` = `agenda_service`.`barang_kode` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda_service`
--
ALTER TABLE `agenda_service`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `barang_kode` (`barang_kode`) USING BTREE;

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `barang_kode` (`barang_kode`) USING BTREE,
  ADD KEY `ruang_id` (`ruang_id`) USING BTREE;

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`jurusan_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_user` (`login_user`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`ruang_id`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `rusak`
--
ALTER TABLE `rusak`
  ADD PRIMARY KEY (`rusak_id`),
  ADD UNIQUE KEY `barang_kode` (`barang_kode`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda_service`
--
ALTER TABLE `agenda_service`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `jurusan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `ruang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rusak`
--
ALTER TABLE `rusak`
  MODIFY `rusak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda_service`
--
ALTER TABLE `agenda_service`
  ADD CONSTRAINT `agenda_service_ibfk_1` FOREIGN KEY (`barang_kode`) REFERENCES `barang` (`barang_kode`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`ruang_id`) REFERENCES `ruang` (`ruang_id`);

--
-- Constraints for table `ruang`
--
ALTER TABLE `ruang`
  ADD CONSTRAINT `ruang_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`jurusan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
