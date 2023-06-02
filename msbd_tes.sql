-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2022 at 08:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msbd_tes`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_mhs_per_angkatan` (IN `tahun` VARCHAR(255))  BEGIN
	SELECT nim, nama, email, angkatan, jenis_kelamin
    FROM mahasiswas 
    WHERE angkatan = tahun;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_semhas_per_date` (IN `tanggal` DATE)  BEGIN 
SELECT m.nama, m.nim, m.angkatan, s.judul_skripsi, d.nama AS `dosbing`
FROM mahasiswas m 
JOIN skripsis s ON m.nim = s.nim
JOIN dosen_pembimbings dp ON m.nim = dp.nim 
JOIN dosens d ON dp.nip_dosbing1 = d.nip OR dp.nip_dosbing2 = d.nip
JOIN jadwal_semhas js ON m.nim = js.nim
WHERE tanggal_semhas = tanggal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_semproPerDate_dosbing` (IN `nip` VARCHAR(16), IN `tanggal` DATE)  BEGIN
SELECT m.nama, m.nim, m.angkatan, s.judul_skripsi
FROM mahasiswas m 
JOIN skripsis s ON m.nim = s.nim
JOIN dosen_pembimbings dp ON m.nim = dp.nim 
JOIN jadwal_sempros js ON m.nim = js.nim
WHERE js.tanggal_sempro = tanggal AND (dp.nip_dosbing1 = nip OR dp.nip_dosbing2 = nip);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_sempro_per_date` (IN `tanggal` DATE)  BEGIN 
SELECT m.nama, m.nim, m.angkatan, s.judul_skripsi, d.nama AS `dosbing`
FROM mahasiswas m 
JOIN skripsis s ON m.nim = s.nim
JOIN dosen_pembimbings dp ON m.nim = dp.nim 
JOIN dosens d ON dp.nip_dosbing1 = d.nip OR dp.nip_dosbing2 = d.nip
JOIN jadwal_sempros js ON m.nim = js.nim
WHERE tanggal_sempro = tanggal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_sidang_per_date` (IN `tanggal` DATE)  BEGIN 
SELECT m.nama, m.nim, m.angkatan, s.judul_skripsi, d.nama AS `dosbing`
FROM mahasiswas m 
JOIN skripsis s ON m.nim = s.nim
JOIN dosen_pembimbings dp ON m.nim = dp.nim 
JOIN dosens d ON dp.nip_dosbing1 = d.nip OR dp.nip_dosbing2 = d.nip
JOIN jadwal_sidangs js ON m.nim = js.nim
WHERE tanggal_sidangs = tanggal;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToFive` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 5
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToFour` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 4
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToOne` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 1
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToSeven` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 7
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToSix` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 6
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToThree` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 3
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToTwo` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 2
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setToZero` (IN `nim` VARCHAR(9))  BEGIN
	DECLARE st_akses INT;
    SET st_akses = (SELECT no_statusAkses FROM `status_akses` `sa` WHERE `sa`.`nim` COLLATE utf8mb4_general_ci = nim);
    UPDATE `status_akses` `s` 
    SET no_statusAkses = 0
    WHERE s.nim COLLATE utf8mb4_general_ci = nim;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `batas_skripsi` (`angkatan` INT) RETURNS INT(11) BEGIN
	DECLARE batas INT;
    	SET batas = angkatan + 7;
	RETURN batas;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `persentase_skripsi` (`status` INT) RETURNS DECIMAL(5,2) BEGIN
	DECLARE persentase DECIMAL (5,2);
    DECLARE percent DECIMAL (5,2);
    SET percent = (status / 7) * 100;
    SET persentase = ROUND(percent, 2);
    RETURN persentase;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(9) UNSIGNED NOT NULL,
  `nama` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('admin','super admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(9) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `nama`, `status`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'Ariana Grande', 'super admin', 21, NULL, '2022-06-02 13:08:52'),
(2, 'Olivia Rodrigo', 'super admin', 22, NULL, NULL),
(3, 'Conan Gray', 'super admin', 23, NULL, NULL),
(4, 'Sufjan Stevens', 'admin', 24, NULL, NULL),
(5, 'Casey Luong', 'admin', 25, NULL, NULL),
(6, 'Lana Del Ray', 'admin', 26, NULL, NULL),
(7, 'Greg Gonzalez', 'admin', 27, NULL, NULL),
(8, 'Shawn Mendez', 'admin', 28, NULL, NULL),
(9, 'Christian Yu', 'admin', 29, NULL, NULL),
(10, 'Alex Turner', 'admin', 30, NULL, NULL),
(11, 'Harry Styles', 'admin', 38, '2022-05-25 17:14:43', '2022-05-25 17:14:43'),
(12, 'Patrick Watson', 'admin', 39, '2022-05-25 17:16:07', '2022-05-25 17:16:07');

--
-- Triggers `admins`
--
DELIMITER $$
CREATE TRIGGER `tr_delete_admin` AFTER DELETE ON `admins` FOR EACH ROW BEGIN
	DELETE FROM users WHERE id = OLD.id_user;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_duplicate_id_user` BEFORE INSERT ON `admins` FOR EACH ROW BEGIN
	IF NEW.id_user IN (SELECT m.id_user FROM mahasiswas m)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data pengguna sudah terdaftar sebagai mahasiswa!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_duplicate_id_user2` BEFORE INSERT ON `admins` FOR EACH ROW BEGIN
	IF NEW.id_user IN (SELECT d.id_user FROM dosens d)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data pengguna sudah terdaftar sebagai dosen!";
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ajukan_bidang_ilmus`
--

CREATE TABLE `ajukan_bidang_ilmus` (
  `id_user` int(8) DEFAULT NULL,
  `bidang_ilmu1` int(8) DEFAULT NULL,
  `bidang_ilmu2` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ajukan_bidang_ilmus`
--

INSERT INTO `ajukan_bidang_ilmus` (`id_user`, `bidang_ilmu1`, `bidang_ilmu2`) VALUES
(6, 1, 2),
(6, 2, 4),
(6, 4, 5),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bidang_ilmus`
--

CREATE TABLE `bidang_ilmus` (
  `id` int(11) NOT NULL,
  `bidang_ilmu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bidang_ilmus`
--

INSERT INTO `bidang_ilmus` (`id`, `bidang_ilmu`) VALUES
(1, 'Analisis dan Desain Sistem'),
(2, 'Animasi'),
(3, 'Interaksi Manusia dan Komputer'),
(4, 'Pemrograman'),
(5, 'Pemrograman Web'),
(6, 'Pengantar Teknologi Informasi'),
(7, 'Teori Graph dan Aplikasi');

-- --------------------------------------------------------

--
-- Stand-in structure for view `dosbing1`
-- (See below for the actual view)
--
CREATE TABLE `dosbing1` (
`nama_mhs` varchar(64)
,`nim` varchar(9)
,`nip_dosbing1` varchar(18)
,`nama_dosbing1` varchar(64)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dosbing2`
-- (See below for the actual view)
--
CREATE TABLE `dosbing2` (
`nama_mhs` varchar(64)
,`nim` varchar(9)
,`nip_dosbing2` varchar(18)
,`nama_dosbing2` varchar(64)
);

-- --------------------------------------------------------

--
-- Table structure for table `dosens`
--

CREATE TABLE `dosens` (
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIDN` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(9) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosens`
--

INSERT INTO `dosens` (`nip`, `nama`, `NIDN`, `kode`, `jenis_kelamin`, `id_user`, `created_at`, `updated_at`) VALUES
('178603032010121006', 'Hange Zoe', '0031125984', 'HGZ', 'perempuan', 59, '2022-06-01 17:01:22', '2022-06-01 17:01:22'),
('195912311998021001', 'Dr.Sawaluddin, M.IT', '0031125982', 'SWL', 'laki-laki', 12, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('196108171987011001', 'Prof. Dr. Opim Salim Sitompul M.Sc', '0017086108', 'OPM', 'laki-laki', 16, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('197603032010121004', 'Uchiha Sasuke', '0031125972', 'UCS', 'laki-laki', 52, '2022-06-01 16:54:43', '2022-06-01 16:54:43'),
('197908312009121002', 'Dedy Arisandi ST., M.Kom. ', '0031087905', 'DDA', 'laki-laki', 13, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('198001102008011010', 'Muhammad Anggia Muchtar ST., MMIT.', '0010018006', 'MAM', 'laki-laki', 19, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('198302262010122003', 'Sarah Purnamawati ST., MSc.', '0026028304', 'SRH', 'perempuan', 14, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('198302262010122015', 'Maudy Ayunda', '0026028379', 'MDY', 'perempuan', 78, '2022-06-06 08:29:09', '2022-06-06 08:29:09'),
('198402262010122003', 'Gang Mo Lee', '0026028387', 'GML', 'laki-laki', 76, '2022-06-06 08:25:37', '2022-06-06 08:25:37'),
('198407072015041001', 'Ivan Jaya S.Si., M.Kom.', '0107078404', 'IVJ', 'laki-laki', 11, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('198510272017061001', 'Ainul Hizriadi S.Kom, M.Sc ', '0127108502', 'AIN', 'laki-laki', 20, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('198603032010121004', 'Romi Fadillah Rahmat B.Comp.Sc., M.Sc.', '0003038601', 'ROM', 'laki-laki', 47, '2022-05-26 06:36:12', '2022-05-26 06:36:12'),
('198603032010121005', 'Mikasa Ackerman', '0107078407', 'MKC', 'perempuan', 55, '2022-06-01 16:57:56', '2022-06-01 16:57:56'),
('198603032010121006', 'Erwin Smith', '0107078409', 'EWS', 'laki-laki', 58, '2022-06-01 17:00:11', '2022-06-01 17:00:11'),
('198603032010121007', 'Haruno Sakura', '0107097404', 'HRS', 'perempuan', 50, '2022-06-01 16:52:26', '2022-06-01 16:52:26'),
('198603032010121009', 'Uzumaki Naruto', '0107098404', 'UZN', 'laki-laki', 51, '2022-06-01 16:53:04', '2022-06-01 16:53:04'),
('198604032010121004', 'Taylor Swift', '0003038631', 'TYS', 'perempuan', 53, '2022-06-01 16:55:43', '2022-06-01 16:55:43'),
('198610122018052001', 'Fahrurrozi Lubis B.IT., M.Sc.IT', '0012108604', 'ROZ', 'laki-laki', 17, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('198703032010121003', 'Armin Arlert', '0107079405', 'ARM', 'laki-laki', 57, '2022-06-01 16:59:29', '2022-06-01 16:59:29'),
('198703032010121004', 'Eren Yeager', '0031127992', 'ERN', 'laki-laki', 54, '2022-06-01 16:57:18', '2022-06-01 16:57:18'),
('198707012018052001', 'Rossy Nurhasanah S.Kom., M.Kom ', '0001078708', 'RSS', 'perempuan', 18, '0000-00-00 00:00:00', '2022-05-23 17:00:00'),
('198903032010121005', 'Levi Ackerman', '0001071978', 'LEV', 'laki-laki', 56, '2022-06-01 16:58:54', '2022-06-01 16:58:54');

--
-- Triggers `dosens`
--
DELIMITER $$
CREATE TRIGGER `tr_cek_dosen` BEFORE INSERT ON `dosens` FOR EACH ROW BEGIN
	IF NEW.nip IN (SELECT d.nip FROM dosens d)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Dosen dengan NIP tersebut sudah terdaftar!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_delete_dosen` AFTER DELETE ON `dosens` FOR EACH ROW BEGIN
	DELETE FROM users WHERE id = OLD.id_user;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dosen_exist` BEFORE INSERT ON `dosens` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nip FROM dosens WHERE nip = NEW.nip) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Dosen dengan NIP tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_duplicate_id_user3` BEFORE INSERT ON `dosens` FOR EACH ROW BEGIN
	IF NEW.id_user IN (SELECT a.id_user FROM admins a)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data pengguna sudah terdaftar sebagai admin!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_duplicate_id_user4` BEFORE INSERT ON `dosens` FOR EACH ROW BEGIN
	IF NEW.id_user IN (SELECT m.id_user FROM mahasiswas m)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data pengguna sudah terdaftar sebagai mahasiswa!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_duplicate_id_user6` BEFORE INSERT ON `dosens` FOR EACH ROW BEGIN
	IF NEW.id_user IN (SELECT a.id_user FROM admins a)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data pengguna sudah terdaftar sebagai admin!";
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pembimbings`
--

CREATE TABLE `dosen_pembimbings` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen_pembimbings`
--

INSERT INTO `dosen_pembimbings` (`nim`, `nip_dosbing1`, `nip_dosbing2`, `created_at`, `updated_at`) VALUES
('171402002', '195912311998021001', '197908312009121002', '2022-05-25 17:00:00', '2022-05-25 17:00:00'),
('171402001', '196108171987011001', '198510272017061001', '2022-05-31 17:00:00', '2022-05-31 17:00:00'),
('171402003', '198610122018052001', '198001102008011010', '2022-05-31 17:00:00', '2022-05-31 17:00:00'),
('171402004', '198302262010122003', '197908312009121002', '2022-05-31 17:00:00', '2022-05-31 17:00:00'),
('171402006', '197908312009121002', '198603032010121004', '2022-05-31 17:00:00', '2022-05-31 17:00:00'),
('171402005', '198510272017061001', '198610122018052001', '2022-05-31 17:00:00', '2022-05-31 17:00:00'),
('181402004', '178603032010121006', '198603032010121005', '2022-06-01 19:36:52', '2022-06-01 19:36:52'),
('181402001', '198603032010121006', '198903032010121005', '2022-06-02 08:56:35', '2022-06-02 08:56:35'),
('181402009', '198603032010121005', '198603032010121007', '2022-06-02 14:01:29', '2022-06-02 14:01:29'),
('181402007', '198703032010121004', '198703032010121003', '2022-06-02 16:57:29', '2022-06-02 16:57:29'),
('181402002', '198603032010121006', '198903032010121005', '2022-06-03 02:38:07', '2022-06-03 02:38:07'),
('181402005', '198510272017061001', '198407072015041001', '2022-06-18 14:19:41', '2022-06-18 14:19:41');

--
-- Triggers `dosen_pembimbings`
--
DELIMITER $$
CREATE TRIGGER `tr_dosbing_exist` BEFORE INSERT ON `dosen_pembimbings` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nim FROM dosen_pembimbings WHERE nim = NEW.nim) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Dosen pembimbing untuk mahasiswa tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `dosen_penguji1`
-- (See below for the actual view)
--
CREATE TABLE `dosen_penguji1` (
`nama_mhs` varchar(64)
,`nim` varchar(9)
,`nama_dosen_penguji1` varchar(64)
,`nip_dosen_penguji1` varchar(18)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dosen_penguji2`
-- (See below for the actual view)
--
CREATE TABLE `dosen_penguji2` (
`nama_mhs` varchar(64)
,`nim` varchar(9)
,`nama_dosen_penguji2` varchar(64)
,`nip_dosen_penguji2` varchar(18)
);

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pengujis`
--

CREATE TABLE `dosen_pengujis` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_penguji1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_penguji2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen_pengujis`
--

INSERT INTO `dosen_pengujis` (`nim`, `nip_penguji1`, `nip_penguji2`, `created_at`, `updated_at`) VALUES
('171402001', '198903032010121005', '198707012018052001', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('171402002', '198903032010121005', '198707012018052001', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('171402003', '198707012018052001', '198703032010121004', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('171402004', '198703032010121004', '198703032010121003', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('171402005', '198903032010121005', '198707012018052001', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('171402006', '198707012018052001', '198903032010121005', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('181402004', '198604032010121004', '198603032010121006', '2022-06-02 08:37:11', '2022-06-02 08:37:11'),
('181402001', '198604032010121004', '198707012018052001', '2022-06-02 09:31:11', '2022-06-02 09:31:11');

--
-- Triggers `dosen_pengujis`
--
DELIMITER $$
CREATE TRIGGER `tr_cek_dosbing` BEFORE INSERT ON `dosen_pengujis` FOR EACH ROW BEGIN
	IF NEW.nim NOT IN (SELECT db.nim FROM dosen_pembimbings db)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa belum seharusnya mendaftarkan dosbing!!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_cek_jd_sempro2` BEFORE INSERT ON `dosen_pengujis` FOR EACH ROW BEGIN
	IF NEW.nim NOT IN (SELECT s.nim FROM skripsis s)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa belum memiliki judul skripsi";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dosen_penguji` BEFORE INSERT ON `dosen_pengujis` FOR EACH ROW BEGIN
	IF(SELECT dp.nip_dosbing1 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing1 = NEW.nip_penguji1) OR (SELECT dp.nip_dosbing2 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing2 = NEW.nip_penguji1)  OR (SELECT dp.nip_dosbing1 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing1 = NEW.nip_penguji2) OR (SELECT dp.nip_dosbing2 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing2 = NEW.nip_penguji2)
    THEN 
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Dosen penguji sudah terdaftar sebagai doping mahasiswa yang bersangkutan!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dosen_penguji2` BEFORE UPDATE ON `dosen_pengujis` FOR EACH ROW BEGIN
	IF(SELECT dp.nip_dosbing1 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing1 = NEW.nip_penguji1) OR (SELECT dp.nip_dosbing2 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing2 = NEW.nip_penguji1)  OR (SELECT dp.nip_dosbing1 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing1 = NEW.nip_penguji2) OR (SELECT dp.nip_dosbing2 FROM dosen_pembimbings dp WHERE dp.nim = NEW.nim AND dp.nip_dosbing2 = NEW.nip_penguji2)
    THEN 
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Dosen penguji sudah terdaftar sebagai doping mahasiswa yang bersangkutan!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dosen_uji_exist` BEFORE INSERT ON `dosen_pengujis` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nim FROM dosen_pengujis WHERE nim = NEW.nim) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Dosen penguji untuk mahasiswa tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `exums`
--

CREATE TABLE `exums` (
  `nama_mhs` varchar(100) DEFAULT NULL,
  `nim` char(9) DEFAULT NULL,
  `file_exum` varchar(100) DEFAULT NULL,
  `status` enum('Belum Diperiksa','Disetujui','Ditolak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exums`
--

INSERT INTO `exums` (`nama_mhs`, `nim`, `file_exum`, `status`) VALUES
('Jeno Lee', '171402002', '171402002.pdf', 'Belum Diperiksa'),
('Jeno Lee', '171402002', '171402002.pdf', 'Belum Diperiksa');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_semhas`
--

CREATE TABLE `jadwal_semhas` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_semhas` date NOT NULL,
  `waktu` time NOT NULL DEFAULT '09:00:00',
  `tempat` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_semhas`
--

INSERT INTO `jadwal_semhas` (`nim`, `tanggal_semhas`, `waktu`, `tempat`, `created_at`, `updated_at`) VALUES
('171402002', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402003', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402004', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402005', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402006', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402001', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('181402004', '2022-06-29', '09:00:00', 'Online Elearning USU', '2022-06-01 18:41:41', '2022-06-01 18:41:41'),
('181402001', '2022-07-13', '22:26:00', 'Online Elearning USU', '2022-06-02 09:57:37', '2022-06-04 15:26:06');

--
-- Triggers `jadwal_semhas`
--
DELIMITER $$
CREATE TRIGGER `tr_cek_jd_sempro` BEFORE INSERT ON `jadwal_semhas` FOR EACH ROW BEGIN 
 	IF (NEW.nim NOT IN (SELECT nim FROM jadwal_sempros)) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa yang bersangkutan belum melakukan seminar proposal.";
    END IF;    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_cek_skripsi` BEFORE INSERT ON `jadwal_semhas` FOR EACH ROW BEGIN
	IF NEW.nim NOT IN (SELECT s.nim FROM skripsis s)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa harus sudah memiliki judul skripsi!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dont_schedule_semhas` BEFORE INSERT ON `jadwal_semhas` FOR EACH ROW BEGIN 	
	IF NEW.nim NOT IN (SELECT nim FROM status_akses WHERE no_statusAkses >= 3)
    	 THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa belum lulus seminar proposal!";
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_jadwal_semhas_exist` BEFORE INSERT ON `jadwal_semhas` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nim FROM jadwal_semhas WHERE nim = NEW.nim) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Jadwal seminar hasil untuk mahasiswa tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sempros`
--

CREATE TABLE `jadwal_sempros` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sempro` date NOT NULL,
  `waktu` time NOT NULL,
  `tempat` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_sempros`
--

INSERT INTO `jadwal_sempros` (`nim`, `tanggal_sempro`, `waktu`, `tempat`, `created_at`, `updated_at`) VALUES
('171402002', '2022-05-03', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402003', '2022-05-04', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402004', '2022-05-05', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402005', '2022-05-04', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402006', '2022-05-03', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402001', '2022-06-15', '09:00:00', 'Online Elearning USU', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('181402004', '2022-07-13', '09:00:00', 'Online Elearning USU', '2022-06-01 19:40:04', '2022-06-02 16:59:28'),
('181402001', '2022-06-28', '09:00:00', 'Online Elearning USU', '2022-06-02 09:05:10', '2022-06-02 09:05:10'),
('181402009', '2022-06-24', '09:00:00', 'Online Elearning USU', '2022-06-02 14:02:43', '2022-06-02 14:02:43'),
('181402007', '2022-06-25', '09:45:00', 'Online Elearning USU', '2022-06-04 14:35:27', '2022-06-14 01:24:42');

--
-- Triggers `jadwal_sempros`
--
DELIMITER $$
CREATE TRIGGER `tr_cek_skripsi3` BEFORE INSERT ON `jadwal_sempros` FOR EACH ROW BEGIN
	IF NEW.nim NOT IN (SELECT s.nim FROM skripsis s)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa harus sudah memiliki judul skripsi!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dont_schedule_sempro` BEFORE INSERT ON `jadwal_sempros` FOR EACH ROW BEGIN 	
	IF NEW.nim NOT IN (SELECT nim FROM status_akses WHERE no_statusAkses >= 1)
    	 THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa belum terdaftar mengikuti sempro!";
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_jadwal_sempro_exist` BEFORE INSERT ON `jadwal_sempros` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nim FROM jadwal_sempros WHERE nim = NEW.nim) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Jadwal seminar proposal untuk mahasiswa tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidangs`
--

CREATE TABLE `jadwal_sidangs` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sidang` date NOT NULL,
  `waktu` time DEFAULT NULL,
  `tempat` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_sidangs`
--

INSERT INTO `jadwal_sidangs` (`nim`, `tanggal_sidang`, `waktu`, `tempat`, `created_at`, `updated_at`) VALUES
('171402002', '2022-08-17', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402003', '2022-08-17', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402004', '2022-08-17', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402006', '2022-08-17', '09:00:00', 'Online Elearning USU', '2022-05-23 17:00:00', '2022-05-26 12:40:19'),
('171402001', '2022-08-17', '09:00:00', 'Online Elearning USU', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('171402005', '2022-08-17', '09:00:00', 'Online Elearning USU', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
('181402004', '2022-06-16', '10:00:00', 'Online Elearning USU', '2022-06-04 15:39:42', '2022-06-04 15:39:42'),
('181402001', '2022-06-23', '09:00:00', 'Online Elearning USU', '2022-06-07 15:23:48', '2022-06-07 15:23:48');

--
-- Triggers `jadwal_sidangs`
--
DELIMITER $$
CREATE TRIGGER `tr_cek_jd_semhas` BEFORE INSERT ON `jadwal_sidangs` FOR EACH ROW BEGIN 
 	IF (NEW.nim NOT IN (SELECT nim FROM jadwal_semhas)) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa yang bersangkutan belum melakukan seminar hasil.";
    END IF;    
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_cek_skripsi2` BEFORE INSERT ON `jadwal_sidangs` FOR EACH ROW BEGIN
	IF NEW.nim NOT IN (SELECT s.nim FROM skripsis s)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa harus sudah memiliki judul skripsi!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_dont_schedule_sidang` BEFORE INSERT ON `jadwal_sidangs` FOR EACH ROW BEGIN 	
	IF NEW.nim NOT IN (SELECT nim FROM status_akses WHERE no_statusAkses >= 5)
    	 THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa belum lulus seminar hasil!";
	END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_jadwal_sidang_exist` BEFORE INSERT ON `jadwal_sidangs` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nim FROM jadwal_sidangs WHERE nim = NEW.nim) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Jadwal sidang meja hijau untuk mahasiswa tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `jdsidangmejahijau`
-- (See below for the actual view)
--
CREATE TABLE `jdsidangmejahijau` (
`tanggal_sidang` date
,`waktu` time
,`tempat` varchar(64)
,`nama` varchar(64)
,`nim` varchar(9)
,`nip` varchar(18)
,`nama_dosen` varchar(64)
,`bidang_TA` varchar(64)
,`judul_skripsi` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `keterangan_status_akses`
--

CREATE TABLE `keterangan_status_akses` (
  `no_statusAkses` int(9) UNSIGNED NOT NULL,
  `keterangan` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keterangan_status_akses`
--

INSERT INTO `keterangan_status_akses` (`no_statusAkses`, `keterangan`) VALUES
(0, 'Belum memulai'),
(1, 'Sedang mempersiapkan seminar proposal'),
(2, 'Akan segera seminar proposal'),
(3, 'Sedang mempersiapkan seminar hasil'),
(4, 'Akan segera seminar hasil'),
(5, 'Sedang mempersiapkan sidang meja hijau'),
(6, 'Akan segera sidang meja hijau'),
(7, 'Sudah lulus sidang');

-- --------------------------------------------------------

--
-- Table structure for table `log_mahasiswa_luluses`
--

CREATE TABLE `log_mahasiswa_luluses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_skripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_ilmu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dosbing1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dosbing2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_mahasiswa_luluses`
--

INSERT INTO `log_mahasiswa_luluses` (`id`, `nim`, `nama`, `judul_skripsi`, `bidang_ilmu`, `nip_dosbing1`, `nama_dosbing1`, `nip_dosbing2`, `nama_dosbing2`, `created_at`, `updated_at`) VALUES
(1, '171402001', 'Cadis Etrama di Raizel', 'Pengembangan Bahan Ajar Pengantar Teknologi Informasi Berbasis Contextual Teaching and Learning di Jurusan Teknik Elektro Universitas Negeri Malang', 'Analisis dan Desain Sistem', '196108171987011001', 'Prof. Dr. Opim Salim Sitompul M.Sc', '198510272017061001', 'Ainul Hizriadi S.Kom, M.Sc ', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(2, '171402002', 'Jeno Lee', 'Rancang Bangun Game 2d Shooter Pltformer Menggunakan Metode Finite State Machine', 'Analisis dan Desain Sistem', '195912311998021001', 'Dr.Sawaluddin, M.IT', '198510272017061001', 'Ainul Hizriadi S.Kom, M.Sc ', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(3, '171402003', 'Mark Lee', 'Analisa Perancangan Sistem Pendukung Keputusan Admisi Siswa Baru Menggunakan Analytical Hierarcy Process di SMA Negeri II Manado', 'Analisis dan Desain Sistem', '198610122018052001', 'Fahrurrozi Lubis B.IT., M.Sc.IT', '198001102008011010', 'Muhammad Anggia Muchtar ST., MMIT.', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(4, '171402004', 'Jisung Park', 'Perancangan Animasi 3 Dimensi Alur Pengurusan Administrasi Pasien Umum dan Jaminan di Bagian Rehabilitasi Medik RSUP Prof. DR. R. D. Kandou Manado', 'Animasi', '198302262010122003', 'Sarah Purnamawati ST., MSc.', '197908312009121002', 'Dedy Arisandi ST., M.Kom. ', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(5, '171402005', 'Jaemin Na', 'Pemanfaatan Virtual Tour Sebagai Interaksi Manusia dan Komputer', 'Interaksi Manusia dan Komputer', '198510272017061001', 'Ainul Hizriadi S.Kom, M.Sc ', '198610122018052001', 'Fahrurrozi Lubis B.IT., M.Sc.IT', NULL, NULL),
(6, '171402006', 'Renjun Huang', 'Rancang Bangun Aplikasi Bimbingan Dosen Wali Secara Online', 'Pemrograman', '197908312009121002', 'Dedy Arisandi ST., M.Kom. ', '198603032010121004', 'Romi Fadillah Rahmat B.Comp.Sc., M.Sc.', '2022-06-01 17:00:00', '2022-06-01 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_penambahan_dosbings`
--

CREATE TABLE `log_penambahan_dosbings` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_admin` int(9) UNSIGNED NOT NULL,
  `nama_admin` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_penambahan_dosbings`
--

INSERT INTO `log_penambahan_dosbings` (`id`, `id_admin`, `nama_admin`, `nim`, `nip_dosbing1`, `nip_dosbing2`, `created_at`, `updated_at`) VALUES
(5, 1, 'Ariana Grande', '171402001', '196108171987011001', '198510272017061001', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(6, 2, 'Olivia Rodrigo', '171402002', '196108171987011001', '198510272017061001', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(7, 3, 'Conan Gray', '171402003', '198610122018052001', '198001102008011010', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(9, 1, 'Ariana Grande', '171402004', '198302262010122003', '197908312009121002', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(10, 2, 'Olivia Rodrigo', '171402005', '198510272017061001', '198610122018052001', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(11, 3, 'Conan Gray', '171402006', '197908312009121002', '198603032010121004', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(12, 1, 'Ariana Grandee', '181402001', '178603032010121006', '198603032010121005', '2022-06-01 18:51:44', '2022-06-01 18:51:44'),
(13, 1, 'Ariana Grandee', '181402004', '178603032010121006', '198603032010121005', '2022-06-01 18:58:27', '2022-06-01 18:58:27'),
(14, 1, 'Ariana Grandee', '181402004', '178603032010121006', '198703032010121004', '2022-06-01 19:30:04', '2022-06-01 19:30:04'),
(15, 1, 'Ariana Grandee', '181402004', '178603032010121006', '198603032010121005', '2022-06-01 19:36:52', '2022-06-01 19:36:52'),
(16, 1, 'Ariana Grandee', '181402001', '198603032010121006', '198903032010121005', '2022-06-02 08:56:36', '2022-06-02 08:56:36'),
(17, 1, 'Ariana Grande', '181402009', '198603032010121005', '198603032010121007', '2022-06-02 14:01:29', '2022-06-02 14:01:29'),
(18, 1, 'Ariana Grande', '181402002', '198604032010121004', '198703032010121004', '2022-06-02 16:06:43', '2022-06-02 16:06:43'),
(19, 1, 'Ariana Grande', '181402002', '198707012018052001', '198603032010121009', '2022-06-02 16:32:54', '2022-06-02 16:32:54'),
(20, 1, 'Ariana Grande', '181402007', '198703032010121004', '198703032010121003', '2022-06-02 16:57:29', '2022-06-02 16:57:29'),
(21, 5, 'Casey Luong', '181402002', '198603032010121006', '198903032010121005', '2022-06-03 02:38:09', '2022-06-03 02:38:09'),
(22, 1, 'Ariana Grande', '181402003', '198603032010121009', '198604032010121004', '2022-06-04 15:49:22', '2022-06-04 15:49:22'),
(23, 1, 'Ariana Grande', '181402005', '198610122018052001', '198603032010121004', '2022-06-18 13:54:55', '2022-06-18 13:54:55'),
(24, 1, 'Ariana Grande', '181402005', '198510272017061001', '198407072015041001', '2022-06-18 14:19:41', '2022-06-18 14:19:41');

--
-- Triggers `log_penambahan_dosbings`
--
DELIMITER $$
CREATE TRIGGER `dont_delete_log_penambahan_dosbing` BEFORE DELETE ON `log_penambahan_dosbings` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data log tidak dapat dihapus!";    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_pendaftaran_skripsis`
--

CREATE TABLE `log_pendaftaran_skripsis` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_user` int(9) NOT NULL,
  `nama_pendaftar` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_skripsi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_by` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_pendaftaran_skripsis`
--

INSERT INTO `log_pendaftaran_skripsis` (`id`, `id_user`, `nama_pendaftar`, `nim`, `judul_skripsi`, `registered_by`, `created_at`, `updated_at`) VALUES
(4, 21, 'Ariana Grande', '171402001', 'Pengembangan Bahan Ajar Pengantar Teknologi Informasi Berbasis Contextual Teaching and Learning di Jurusan Teknik Elektro Universitas Negeri Malang', 'admin', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(5, 22, 'Olivia Rodrigo', '171402002', 'Rancang Bangun Game 2d Shooter Pltformer Menggunakan Metode Finite State Machine', 'admin', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(6, 23, 'Conan Gray', '171402003', 'Analisa Perancangan Sistem Pendukung Keputusan Admisi Siswa Baru Menggunakan Analytical Hierarcy Process di SMA Negeri II Manado', 'admin', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(7, 7, 'Jisung Park', '171402004', 'Perancangan Animasi 3 Dimensi Alur Pengurusan Administrasi Pasien Umum dan Jaminan di Bagian Rehabilitasi Medik RSUP Prof. DR. R. D. Kandou Manado', 'mahasiswa', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(8, 8, 'Jaemin Na', '171402005', 'Pemanfaatan Virtual Tour Sebagai Interaksi Manusia dan Komputer', 'mahasiswa', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(9, 9, 'Renjun Huang', '171402006', 'Rancang Bangun Aplikasi Bimbingan Dosen Wali Secara Online', 'mahasiswa', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(10, 21, 'Ariana Grandee', '181402004', 'Sistem Penunjang Keputusan Pencarian Jarak Terpendek Menuju Rumah Sakit Dan Puskesmas Dengan Metode Dijkstra', 'admin', '2022-06-01 19:37:44', '2022-06-01 19:37:44'),
(11, 21, 'Ariana Grandee', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'admin', '2022-06-02 09:04:21', '2022-06-02 09:04:21'),
(12, 21, 'Ariana Grande', '181402009', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Ti Stmik Akakom Yogyakarta)', 'admin', '2022-06-02 14:02:12', '2022-06-02 14:02:12'),
(13, 21, 'Ariana Grande', '181402009', 'Sistem Pendukung Keputusan Penilaian Kesehatan Tanah Dengan Metode Simple Additive Weighting', 'admin', '2022-06-02 16:39:51', '2022-06-02 16:39:51'),
(14, 21, 'Ariana Grande', '181402007', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Berbasis Mobile', 'admin', '2022-06-02 16:57:58', '2022-06-02 16:57:58'),
(15, 25, 'Casey Luong', '181402002', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Umum Sidikalang', 'admin', '2022-06-03 02:38:53', '2022-06-03 02:38:53'),
(16, 21, 'Ariana Grande', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'admin', '2022-06-07 15:36:48', '2022-06-07 15:36:48'),
(17, 21, 'Ariana Grande', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stm)', 'admin', '2022-06-07 15:37:31', '2022-06-07 15:37:31'),
(18, 21, 'Ariana Grande', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'admin', '2022-06-07 15:38:39', '2022-06-07 15:38:39'),
(19, 21, 'Ariana Grande', '181402007', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Berbasis Web Dinamis', 'admin', '2022-06-14 00:49:56', '2022-06-14 00:49:56'),
(20, 21, 'Ariana Grande', '181402007', 'Perancangan Sistem Informasi Manajemen Rumah Sakit', 'admin', '2022-06-17 12:48:42', '2022-06-17 12:48:42'),
(21, 4, 'Rael Kertia', '181402005', 'Perancangan Sistem Informasi Manajemen Klinik Light House Berbasis Web', 'mahasiswa', '2022-06-18 14:07:01', '2022-06-18 14:07:01'),
(22, 21, 'Ariana Grande', '181402005', 'Perancangan Sistem Informasi Manajemen Klinik Light House Berbasis Web', 'admin', '2022-06-18 14:20:13', '2022-06-18 14:20:13'),
(23, 1, 'Annelis Mellema', '181402001', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Umum Jonggol', 'mahasiswa', '2022-06-29 04:19:17', '2022-06-29 04:19:17'),
(24, 21, 'Ariana Grande', '181402002', 'Perancangan Sistem Informasi Manajemen Klinik Light House', 'admin', '2022-06-29 06:33:26', '2022-06-29 06:33:26'),
(25, 21, 'Ariana Grande', '181402002', 'Perancangan Sistem Informasi Manajemen Klinik Light House', 'admin', '2022-06-29 06:33:50', '2022-06-29 06:33:50'),
(26, 33, 'Anneliese Mitchel', '181402002', 'Perancangan Sistem Informasi Manajemen Z Library Berbasis Web', 'mahasiswa', '2022-06-29 06:41:39', '2022-06-29 06:41:39'),
(27, 33, 'Anneliese Mitchel', '181402002', 'Perancangan Sistem Informasi Manajemen Z Library', 'mahasiswa', '2022-06-29 06:59:05', '2022-06-29 06:59:05'),
(28, 33, 'Anneliese Mitchel', '181402002', 'Perancangan Sistem Informasi Manajemen Z Library', 'mahasiswa', '2022-06-29 06:59:39', '2022-06-29 06:59:39');

--
-- Triggers `log_pendaftaran_skripsis`
--
DELIMITER $$
CREATE TRIGGER `dont_delete_log_pendaftaran_skripsi` BEFORE DELETE ON `log_pendaftaran_skripsis` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data log tidak dapat dihapus!";    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_penghapusan_dosbings`
--

CREATE TABLE `log_penghapusan_dosbings` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_admin` int(9) UNSIGNED NOT NULL,
  `nama_admin` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_dosbing2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_penghapusan_dosbings`
--

INSERT INTO `log_penghapusan_dosbings` (`id`, `id_admin`, `nama_admin`, `nim`, `nip_dosbing1`, `nip_dosbing2`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ariana Grande', '161402002', '195912311998021001', '198707012018052001', '2022-05-30 15:13:46', '2022-05-30 15:13:46'),
(2, 1, 'Ariana Grandee', '181402001', '178603032010121006', '198603032010121005', '2022-06-01 18:53:03', '2022-06-01 18:53:03'),
(3, 1, 'Ariana Grandee', '181402004', '178603032010121006', '198603032010121005', '2022-06-01 18:59:26', '2022-06-01 18:59:26'),
(4, 1, 'Ariana Grandee', '181402004', '178603032010121006', '198703032010121004', '2022-06-01 19:33:17', '2022-06-01 19:33:17'),
(5, 1, 'Ariana Grande', '181402002', '198604032010121004', '198703032010121004', '2022-06-02 16:06:57', '2022-06-02 16:06:57'),
(6, 1, 'Ariana Grande', '181402002', '198707012018052001', '198610122018052001', '2022-06-02 16:34:33', '2022-06-02 16:34:33'),
(7, 1, 'Ariana Grande', '181402003', '198610122018052001', '198604032010121004', '2022-06-04 15:49:40', '2022-06-04 15:49:40'),
(8, 1, 'Ariana Grande', '181402005', '198610122018052001', '198603032010121004', '2022-06-18 14:11:38', '2022-06-18 14:11:38');

--
-- Triggers `log_penghapusan_dosbings`
--
DELIMITER $$
CREATE TRIGGER `dont_delete_log_penghapusan_dosbing` BEFORE DELETE ON `log_penghapusan_dosbings` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data log tidak dapat dihapus!";    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_penghapusan_skripsis`
--

CREATE TABLE `log_penghapusan_skripsis` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_admin` int(9) UNSIGNED NOT NULL,
  `nama_admin` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_skripsi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_ilmu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_penghapusan_skripsis`
--

INSERT INTO `log_penghapusan_skripsis` (`id`, `id_admin`, `nama_admin`, `nim`, `judul_skripsi`, `bidang_ilmu`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ariana Grande', '161402002', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Berbasis Android', 'Pemrograman Mobile', '2022-05-30 16:42:57', '2022-05-30 16:42:57'),
(2, 1, 'Ariana Grande', '181402009', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', '2022-06-02 16:35:12', '2022-06-02 16:35:12'),
(3, 1, 'Ariana Grande', '181402009', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', '2022-06-02 16:35:56', '2022-06-02 16:35:56'),
(4, 1, 'Ariana Grande', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stm', 'Pemrograman Web', '2022-06-07 15:33:07', '2022-06-07 15:33:07'),
(5, 1, 'Ariana Grande', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', '2022-06-07 15:38:28', '2022-06-07 15:38:28'),
(6, 1, 'Ariana Grande', '181402007', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Berbasis Mobile', 'Pemrograman Mobile', '2022-06-14 00:30:11', '2022-06-14 00:30:11'),
(7, 1, 'Ariana Grande', '181402007', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Berbasis Web Dinamis', 'Pemrograman Web', '2022-06-14 00:52:17', '2022-06-14 00:52:17'),
(8, 1, 'Ariana Grande', '181402005', 'Perancangan Sistem Informasi Manajemen Klinik Light House Berbasis Web', 'Animasi', '2022-06-18 14:11:27', '2022-06-18 14:11:27'),
(9, 1, 'Ariana Grande', '181402002', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Umum Sidikalang', 'Pemrograman web', '2022-06-18 14:21:17', '2022-06-18 14:21:17'),
(10, 1, 'Ariana Grande', '181402001', 'Analisis Pengunaan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', '2022-06-29 04:18:48', '2022-06-29 04:18:48'),
(11, 1, 'Ariana Grande', '181402002', 'Perancangan Sistem Informasi Manajemen Klinik Light House', 'Analisis dan Desain Sistem', '2022-06-29 06:34:51', '2022-06-29 06:34:51'),
(12, 1, 'Ariana Grande', '181402002', 'Perancangan Sistem Informasi Manajemen Z Library Berbasis Web', 'Animasi', '2022-06-29 06:58:31', '2022-06-29 06:58:31');

--
-- Triggers `log_penghapusan_skripsis`
--
DELIMITER $$
CREATE TRIGGER `dont_delete_log_penghapusan_skripsi` BEFORE DELETE ON `log_penghapusan_skripsis` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data log tidak dapat dihapus!";    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_pengubahan_dosbings`
--

CREATE TABLE `log_pengubahan_dosbings` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_admin` int(9) UNSIGNED NOT NULL,
  `nama_admin` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_nip_dosbing1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_nip_dosbing1` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_nip_dosbing2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_nip_dosbing2` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_pengubahan_dosbings`
--

INSERT INTO `log_pengubahan_dosbings` (`id`, `id_admin`, `nama_admin`, `nim`, `old_nip_dosbing1`, `new_nip_dosbing1`, `old_nip_dosbing2`, `new_nip_dosbing2`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ariana Grande', '201402001', '195912311998021001', '198407072015041001', '196108171987011001', '196108171987011001', '2022-05-30 14:59:52', '2022-05-30 14:59:52'),
(2, 1, 'Ariana Grande', '181402002', '198707012018052001', '198707012018052001', '198603032010121009', '198610122018052001', '2022-06-02 16:33:44', '2022-06-02 16:33:44'),
(3, 1, 'Ariana Grande', '181402003', '198603032010121009', '198610122018052001', '198604032010121004', '198604032010121004', '2022-06-04 15:49:35', '2022-06-04 15:49:35');

--
-- Triggers `log_pengubahan_dosbings`
--
DELIMITER $$
CREATE TRIGGER `dont_delete_log_pengubahan_dosbing` BEFORE DELETE ON `log_pengubahan_dosbings` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data log tidak dapat dihapus!";    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_pengubahan_skripsis`
--

CREATE TABLE `log_pengubahan_skripsis` (
  `id` int(9) UNSIGNED NOT NULL,
  `id_user` int(9) UNSIGNED NOT NULL,
  `nama_pengubah` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_judul_skripsi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_judul_skripsi` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_bidang_ilmu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_bidang_ilmu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edited_by` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_pengubahan_skripsis`
--

INSERT INTO `log_pengubahan_skripsis` (`id`, `id_user`, `nama_pengubah`, `nim`, `old_judul_skripsi`, `new_judul_skripsi`, `old_bidang_ilmu`, `new_bidang_ilmu`, `edited_by`, `created_at`, `updated_at`) VALUES
(2, 21, 'Ariana Grande', '161402002', 'Rancang Bangun Game 2d Shooter Pltformer Menggunakan Metode Finite State Machine', 'Rancang Bangun Game 2d Shooter Platformer Menggunakan Metode Finite State Machine', 'Analisis dan desain sistem', 'Analisis dan desain sistem', 'admin', '2022-05-30 16:29:17', '2022-05-30 16:29:17'),
(3, 21, 'Ariana Grande', '181402004', 'Sistem Penunjang Keputusan Pencarian Jarak Terpendek Menuju Rumah Sakit Dan Puskesmas Dengan Metode Dijkstra', 'Sistem Penunjang Keputusan Pencarian Jarak Terpendek Menuju Rumah Sakit Dan Puskesmas Dengan Metode Dijkstra', 'Teori Graf dan Aplikasi', 'Teori Graph dan Aplikasi', 'admin', '2022-06-02 16:36:39', '2022-06-02 16:36:39'),
(4, 21, 'Ariana Grande', '181402005', 'Perancangan Sistem Informasi Manajemen Klinik Light House Berbasis Web', 'Perancangan Sistem Informasi Manajemen Klinik Light House Berbasis Web', 'Analisis dan Desain Sistem', 'Analisis dan Desain Sistem', 'admin', '2022-06-18 14:21:04', '2022-06-18 14:21:04'),
(5, 1, 'Annelis Mellema', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Analisis Penggunaan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', 'Pemrograman Web', 'mahasiswa', '2022-06-29 04:14:32', '2022-06-29 04:14:32'),
(6, 1, 'Annelis Mellema', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Analisis Penggunaan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', 'Pemrograman Web', 'mahasiswa', '2022-06-29 04:17:15', '2022-06-29 04:17:15'),
(7, 1, 'Annelis Mellema', '181402001', 'Analisis Perbandingan Framework Codeigniter Dan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Analisis Pengunaan Framework Laravel (Studi Kasus Inventaris Hmj Ti Stmik Akakom Yogyakarta)', 'Pemrograman Web', 'Pemrograman Web', 'mahasiswa', '2022-06-29 04:17:52', '2022-06-29 04:17:52'),
(8, 1, 'Annelis Mellema', '181402001', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Umum Jonggol', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Umum Jonggola', 'Analisis dan Desain Sistem', 'Analisis dan Desain Sistem', 'mahasiswa', '2022-06-29 04:19:34', '2022-06-29 04:19:34'),
(9, 21, 'Ariana Grande', '181402002', 'Perancangan Sistem Informasi Manajemen Klinik Light House', 'Perancangan Sistem Informasi Manajemen Klinik Light House', 'Analisis dan Desain Sistem', 'Analisis dan Desain Sistem', 'admin', '2022-06-29 06:34:38', '2022-06-29 06:34:38'),
(10, 33, 'Anneliese Mitchel', '181402002', 'Eng Perancangan Sistem Informasi Manajemen Z Library Berbasis Web', 'Perancangan Sistem Informasi Manajemen Z Library Berbasis Web', 'Animasi', 'Animasi', 'mahasiswa', '2022-06-29 06:58:18', '2022-06-29 06:58:18');

--
-- Triggers `log_pengubahan_skripsis`
--
DELIMITER $$
CREATE TRIGGER `dont_delete_log_pengubahan_skripsi` BEFORE DELETE ON `log_pengubahan_skripsis` FOR EACH ROW BEGIN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data log tidak dapat dihapus!";    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswas`
--

CREATE TABLE `mahasiswas` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `angkatan` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Aktif','Lulus','Drop out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(9) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswas`
--

INSERT INTO `mahasiswas` (`nim`, `nama`, `angkatan`, `jenis_kelamin`, `foto`, `status`, `id_user`, `created_at`, `updated_at`) VALUES
('171402001', 'Cadis Etrama di Raizel', '2017', 'Laki-laki', 'red-leaves.jpg', 'Lulus', 5, '2022-05-23 17:00:00', '2022-06-18 14:28:04'),
('171402002', 'Jeno Lee', '2017', 'Laki-laki', 'graduate_student.png', 'Lulus', 6, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402003', 'Mark Lee', '2017', 'Laki-laki', NULL, 'Lulus', 7, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402004', 'Jisung Park', '2017', 'Laki-laki', NULL, 'Lulus', 8, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402005', 'Jaemin Na', '2017', 'Laki-laki', NULL, 'Lulus', 9, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('171402006', 'Renjun Huang', '2017', 'Laki-laki', NULL, 'Lulus', 10, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('181402001', 'Annelis Mellema', '2018', 'Perempuan', 'banana.jpg', 'Aktif', 1, '2022-05-23 17:00:00', '2022-06-02 17:17:21'),
('181402002', 'Anneliese Mitchel', '2018', 'Perempuan', NULL, 'Aktif', 33, '2022-05-24 13:35:41', '2022-05-26 06:28:22'),
('181402003', 'Regis K Landegre', '2018', 'Laki-laki', NULL, 'Aktif', 2, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('181402004', 'Seira J Loyard', '2018', 'Perempuan', NULL, 'Aktif', 3, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('181402005', 'Rael Kertia', '2018', 'Laki-laki', NULL, 'Aktif', 4, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
('181402007', 'Harry Styles', '2018', 'Laki-laki', NULL, 'Aktif', 62, '2022-06-02 16:56:11', '2022-06-02 16:56:11'),
('181402008', 'Hanbin Kim', '2018', 'Laki-laki', 'red-leaves.jpg', 'Aktif', 63, '2022-06-03 02:11:29', '2022-06-03 02:11:29'),
('181402009', 'Hermione', '2018', 'Perempuan', NULL, 'Aktif', 60, '2022-06-02 14:01:05', '2022-06-02 14:01:05'),
('181402010', 'Junhoe Ko', '2018', 'Laki-laki', NULL, 'Aktif', 64, '2022-06-03 02:12:31', '2022-06-03 02:12:31'),
('181402011', 'Pierre Peter', '2018', 'Laki-laki', NULL, 'Aktif', 65, '2022-06-03 02:13:42', '2022-06-03 02:13:42'),
('181402012', 'Sean Garrel', '2018', 'Laki-laki', NULL, 'Aktif', 66, '2022-06-03 02:14:41', '2022-06-03 02:14:41'),
('181402013', 'Lowell Stevens', '2018', 'Laki-laki', NULL, 'Aktif', 67, '2022-06-03 02:16:01', '2022-06-03 02:16:01'),
('181402014', 'Darcy Fitzwilliam', '2018', 'Laki-laki', NULL, 'Aktif', 68, '2022-06-03 02:17:51', '2022-06-03 02:17:51'),
('181402015', 'Elizabeth Bennet', '2018', 'Perempuan', NULL, 'Aktif', 69, '2022-06-03 02:18:37', '2022-06-03 02:25:12'),
('181402016', 'Josee Audisio', '2018', 'Laki-laki', NULL, 'Aktif', 70, '2022-06-03 02:19:42', '2022-06-03 02:19:42'),
('181402017', 'Timothee Chalamet', '2018', 'Laki-laki', NULL, 'Aktif', 71, '2022-06-03 02:21:19', '2022-06-03 02:21:19'),
('181402018', 'Louis Partridge', '2018', 'Laki-laki', NULL, 'Aktif', 72, '2022-06-03 02:21:59', '2022-06-03 02:21:59'),
('181402019', 'Andrew William Foy', '2018', 'Laki-laki', NULL, 'Aktif', 73, '2022-06-03 02:22:46', '2022-06-03 02:22:46'),
('181402020', 'Renee Foy', '2018', 'Perempuan', NULL, 'Aktif', 74, '2022-06-03 02:23:50', '2022-06-03 02:23:50'),
('181402021', 'Ysabelle Cuevas', '2018', 'Perempuan', NULL, 'Aktif', 75, '2022-06-03 02:24:45', '2022-06-03 02:24:45'),
('191402007', 'Vashti Bunyan', '2019', 'Perempuan', NULL, 'Aktif', 35, '2022-05-26 17:00:00', '2022-05-26 17:00:00'),
('191402011', 'Ricky Montgomery', '2019', 'Laki-laki', NULL, 'Aktif', 31, '2022-05-23 17:00:00', '2022-05-23 17:00:00');

--
-- Triggers `mahasiswas`
--
DELIMITER $$
CREATE TRIGGER `delete_mhs` AFTER DELETE ON `mahasiswas` FOR EACH ROW BEGIN
	DELETE FROM users WHERE id = OLD.id_user;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_cek_mahasiswa` BEFORE INSERT ON `mahasiswas` FOR EACH ROW BEGIN
	IF NEW.nim IN (SELECT m.nim FROM mahasiswas m)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Mahasiswa dengan NIM tersebut sudah terdaftar!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_duplicate_id_user5` BEFORE INSERT ON `mahasiswas` FOR EACH ROW BEGIN
	IF NEW.id_user IN (SELECT d.id_user FROM dosens d)
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data pengguna sudah terdaftar sebagai dosen!";
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tr_give_access` AFTER INSERT ON `mahasiswas` FOR EACH ROW BEGIN 
	INSERT INTO status_akses VALUES('', NEW.nim, 0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_05_134008_create_admins_table', 1),
(6, '2022_05_05_134926_create_mahasiswas_table', 1),
(7, '2022_05_05_135659_create_dosens_table', 1),
(8, '2022_05_09_144626_create_skripsis_table', 1),
(9, '2022_05_09_150341_create_dosen_pembimbings_table', 1),
(10, '2022_05_09_151622_create_dosen_pengujis_table', 1),
(11, '2022_05_09_153303_create_keterangan_status_akses_table', 1),
(12, '2022_05_09_153902_create_status_akses_table', 1),
(13, '2022_05_09_161514_create_log_update_mahasiswas_table', 1),
(14, '2022_05_09_162315_create_log_update_dosens_table', 1),
(15, '2022_05_09_162900_create_log_update_admins_table', 1),
(16, '2022_05_18_163857_create_jadwal_sempros_table', 1),
(17, '2022_05_18_164005_create_jadwal_semhas_table', 1),
(18, '2022_05_18_164110_create_jadwal_sidangs_table', 1),
(21, '2022_05_30_205607_create_log_penambahan_dosbings_table', 2),
(22, '2022_05_30_214759_create_log_pengubahan_dosbings_table', 3),
(23, '2022_05_30_220511_create_log_penghapusan_dosbings_table', 4),
(24, '2022_05_30_224217_create_log_pendaftaran_skripsis_table', 5),
(25, '2022_05_30_231111_create_log_pengubahan_skripsis_table', 6),
(26, '2022_05_30_233432_create_log_penghapusan_skripsis_table', 7),
(31, '2022_06_01_190050_create_log_mahasiswa_luluses_table', 8),
(33, '2022_06_06_162748_create_nilai_uji_programs_table', 9),
(34, '2022_06_10_090649_create_nilai_sidang_meja_hijaus_table', 10),
(35, '2022_06_10_125711_create_nilai_seminar_hasils_table', 11),
(36, '2022_06_10_150305_create_nilai_i_p_k_s_table', 12),
(37, '2022_06_18_204052_create_bidang_ilmus_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_i_p_k_s`
--

CREATE TABLE `nilai_i_p_k_s` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IPK` double(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_i_p_k_s`
--

INSERT INTO `nilai_i_p_k_s` (`nim`, `IPK`, `created_at`, `updated_at`) VALUES
('171402001', 3.80, '2022-06-10 09:00:13', '2022-06-10 09:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_seminar_hasils`
--

CREATE TABLE `nilai_seminar_hasils` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstrak` double(4,2) NOT NULL,
  `pendahuluan` double(4,2) NOT NULL,
  `landasan_teori` double(4,2) NOT NULL,
  `metodologi` double(4,2) NOT NULL,
  `implementasi` double(4,2) NOT NULL,
  `kesimpulan` double(4,2) NOT NULL,
  `kemampuan_mengemukakan_substansi` double(4,2) NOT NULL,
  `total` double(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_sidang_meja_hijaus`
--

CREATE TABLE `nilai_sidang_meja_hijaus` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sistematika_penulisan` double(4,2) NOT NULL,
  `substansi` double(4,2) NOT NULL,
  `kemampuan_menguasai_substansi` double(4,2) NOT NULL,
  `kemampuan_mengemukakan_pendapat` double(4,2) NOT NULL,
  `total` double(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_sidang_meja_hijaus`
--

INSERT INTO `nilai_sidang_meja_hijaus` (`nim`, `nip`, `sistematika_penulisan`, `substansi`, `kemampuan_menguasai_substansi`, `kemampuan_mengemukakan_pendapat`, `total`, `created_at`, `updated_at`) VALUES
('181402004', '198604032010121004', 25.00, 25.00, 25.00, 25.00, 0.00, '2022-06-10 05:19:33', '2022-06-10 05:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_uji_programs`
--

CREATE TABLE `nilai_uji_programs` (
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_kemampuan_dasar_program` double(4,2) DEFAULT NULL,
  `nilai_kecocokan_algoritma` double(4,2) DEFAULT NULL,
  `nilai_penguasaan_program` double(4,2) DEFAULT NULL,
  `nilai_penguasaan_ui` double(4,2) DEFAULT NULL,
  `nilai_validasi_output` double(4,2) DEFAULT NULL,
  `total` double(4,2) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_uji_programs`
--

INSERT INTO `nilai_uji_programs` (`nim`, `nip`, `nilai_kemampuan_dasar_program`, `nilai_kecocokan_algoritma`, `nilai_penguasaan_program`, `nilai_penguasaan_ui`, `nilai_validasi_output`, `total`, `tanggal`, `waktu`, `created_at`, `updated_at`) VALUES
('171402001', '198610122018052001', 35.00, 8.00, 18.00, 10.00, 7.00, 78.00, '2020-07-03', '09:00:00', '2022-06-05 17:00:00', '2022-06-05 17:00:00'),
('171402002', '195912311998021001', 35.00, 8.00, 17.00, 9.00, 8.00, 77.00, '2020-07-03', '09:00:00', '2022-06-05 17:00:00', '2022-06-05 17:00:00'),
('171402003', '198610122018052001', 32.00, 7.00, 17.00, 7.00, 17.00, 80.00, '2020-07-03', '09:00:00', '2022-06-05 17:00:00', '2022-06-05 17:00:00'),
('171402004', '198302262010122003', 35.00, 8.00, 17.00, 7.00, 17.00, 81.00, '2020-07-03', '09:00:00', '2022-06-05 17:00:00', '2022-06-05 17:00:00'),
('171402005', '198510272017061001', 36.00, 8.00, 18.00, 8.00, 18.00, 88.00, '2020-07-03', '09:00:00', '2022-06-05 17:00:00', '2022-06-05 17:00:00'),
('171402006', '197908312009121002', 38.00, 8.00, 18.00, 8.00, 18.00, 82.00, '2020-07-03', '09:00:00', '2022-06-05 17:00:00', '2022-06-05 17:00:00'),
('181402001', '198603032010121006', NULL, NULL, NULL, NULL, NULL, 91.00, '2022-06-17', '06:06:00', '2022-06-17 11:06:24', '2022-06-18 01:58:09'),
('181402004', '198603032010121005', 38.00, 9.00, 20.00, 5.00, 10.00, 82.00, '2022-06-09', '12:06:00', '2022-06-10 04:06:44', '2022-06-10 04:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_judul`
--

CREATE TABLE `pengajuan_judul` (
  `nama` varchar(100) DEFAULT NULL,
  `nim` varchar(9) DEFAULT NULL,
  `pengaju` varchar(50) DEFAULT NULL,
  `bidang_ilmu1` varchar(100) DEFAULT NULL,
  `bidang_ilmu2` varchar(100) DEFAULT NULL,
  `status` enum('Diterima','Ditolak') DEFAULT NULL,
  `hasil_uji` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skripsis`
--

CREATE TABLE `skripsis` (
  `id` int(9) UNSIGNED NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_skripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eng_judul_skripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_ilmu` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skripsis`
--

INSERT INTO `skripsis` (`id`, `nim`, `judul_skripsi`, `eng_judul_skripsi`, `bidang_ilmu`, `created_at`, `updated_at`) VALUES
(6, '171402003', 'Analisa Perancangan Sistem Pendukung Keputusan Admisi Siswa Baru Menggunakan Analytical Hierarcy Pro', 'Judul Bahasa Inggris 1', 'Analisis dan Desain Sistem', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
(7, '171402004', 'Perancangan Animasi 3 Dimensi Alur Pengurusan Administrasi Pasien Umum dan Jaminan di Bagian Rehabil', 'Judul Bahasa Inggris 2', 'Animasi', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
(8, '171402005', 'Pemanfaatan Virtual Tour Sebagai Interaksi Manusia dan Komputer', 'Judul Bahasa Inggris 3', 'Interaksi Manusia dan Komputer', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
(9, '171402006', 'Rancang Bangun Aplikasi Bimbingan Dosen Wali Secara Online', 'Judul Bahasa Inggris 4', 'Pemrograman', '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
(13, '171402001', 'Pengembangan Bahan Ajar Pengantar Teknologi Informasi Berbasis Contextual Teaching and Learning', 'Judul Bahasa Inggris 5', 'Pengantar Teknologi Informasi', '2022-06-01 17:00:00', '2022-06-18 14:23:41'),
(14, '171402002', 'Rancang Bangun Game 2d Shooter Pltformer Menggunakan Metode Finite State Machine', 'Judul Bahasa Inggris 6', 'Analisis dan Desain Sistem', '2022-06-01 17:00:00', '2022-06-01 17:00:00'),
(15, '181402004', 'Sistem Penunjang Keputusan Pencarian Jarak Terpendek Menuju Rumah Sakit Dan Puskesmas', 'Judul Bahasa Inggris 7', 'Teori Graph dan Aplikasi', '2022-06-01 19:37:44', '2022-06-02 16:36:39'),
(18, '181402009', 'Sistem Pendukung Keputusan Penilaian Kesehatan Tanah Dengan Metode Simple Additive Weighting', 'Judul Bahasa Inggris 8', 'Pemrograman Web', '2022-06-02 16:39:51', '2022-06-02 16:39:51'),
(24, '181402007', 'Perancangan Sistem Informasi Manajemen Rumah Sakit', 'Judul Bahasa Inggris 9', 'Pemrograman Web', '2022-06-17 12:48:42', '2022-06-17 12:48:42'),
(26, '181402005', 'Perancangan Sistem Informasi Manajemen Klinik Light House Berbasis Web', 'Judul Bahasa Inggris 10', 'Analisis dan Desain Sistem', '2022-06-18 14:20:13', '2022-06-18 14:21:04'),
(27, '181402001', 'Perancangan Sistem Informasi Manajemen Rumah Sakit Umum Jonggola', 'Judul Bahasa Inggris 11', 'Analisis dan Desain Sistem', '2022-06-29 04:19:18', '2022-06-29 04:19:34'),
(30, '181402002', 'Perancangan Sistem Informasi Manajemen Z Library', 'Eng Perancangan Sistem Informasi Manajemen Z Library', 'Analisis dan Desain Sistem', '2022-06-29 06:59:39', '2022-06-29 06:59:52');

--
-- Triggers `skripsis`
--
DELIMITER $$
CREATE TRIGGER `tr_skripsi_exist` BEFORE INSERT ON `skripsis` FOR EACH ROW BEGIN
	IF EXISTS (SELECT nim FROM skripsis WHERE nim = NEW.nim) 
    THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Judul skripsi untuk mahasiswa tersebut sudah terdaftar.";
	END IF;     
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `status_akses`
--

CREATE TABLE `status_akses` (
  `id` int(9) UNSIGNED NOT NULL,
  `nim` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_statusAkses` int(9) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_akses`
--

INSERT INTO `status_akses` (`id`, `nim`, `no_statusAkses`) VALUES
(2, '181402001', 3),
(3, '181402003', 0),
(4, '181402004', 5),
(5, '181402005', 1),
(6, '171402001', 7),
(7, '171402002', 7),
(8, '171402003', 7),
(9, '171402004', 7),
(10, '171402005', 7),
(11, '171402006', 7),
(12, '191402011', 0),
(13, '181402002', 1),
(18, '191402007', 0),
(19, '181402009', 3),
(20, '181402007', 1),
(21, '181402008', 0),
(22, '181402010', 0),
(23, '181402011', 0),
(24, '181402012', 0),
(25, '181402013', 0),
(26, '181402014', 0),
(27, '181402015', 0),
(28, '181402016', 0),
(29, '181402017', 0),
(30, '181402018', 0),
(31, '181402019', 0),
(32, '181402020', 0),
(33, '181402021', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(9) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('admin','mahasiswa','dosen','prodi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Annelis Mellema', 'annelis@gmail.com', 'mahasiswa', NULL, '$2y$10$imVIR.XI8iNJ0x2m1tPYt.oHGVa.K5mjNAbwn0v/dX5MzxNu4rZN.', '4oVTuh1Ld2sfWwilYNTYZSEcmFZMfM9DDW7qZuP8OhAHmB4jkWI0TvfssTpy', '2022-05-24 03:02:06', '2022-05-24 03:02:06'),
(2, 'Regis Landegre', 'regis@gmail.com', 'mahasiswa', NULL, '$2y$10$38.mMDp.avH0rJKv3jGZ/Or9DAWPmcyh858thfnDcqmVy0.uIfH0m', NULL, '2022-05-24 03:14:50', '2022-05-24 03:14:50'),
(3, 'Seira Loyard', 'seira@gmail.com', 'mahasiswa', NULL, '$2y$10$7UzWSq9U/FazkdaVzC7MzeIAOluLkB7zczJrN9hM2N59lfpQm.F6G', NULL, '2022-05-24 03:16:27', '2022-05-24 03:16:27'),
(4, 'Rael Kertia', 'rael@gmail.com', 'mahasiswa', NULL, '$2y$10$whxxrnbTIZqsqMFQyJPpN.X6.3D8d549mykgErjlbFrZD7dizJLFK', NULL, '2022-05-24 03:18:43', '2022-05-24 03:18:43'),
(5, 'Cadis Etrama', 'cadis@gmail.com', 'mahasiswa', NULL, '$2y$10$Czrd8P29x/xT5IjX4H5HEOwm2QRPUmT96RopLXOfOGJeGYXl3c9FG', NULL, '2022-05-24 03:22:53', '2022-05-24 03:22:53'),
(6, '191401002', 'jeno@gmail.com', 'mahasiswa', NULL, '$2y$10$nNC3hJ03K/kNyZJ1EWcBIeyaPDI.6syiYvD7832CeMazfjHjl3g72', NULL, '2022-05-24 03:24:40', '2022-05-24 03:24:40'),
(7, 'Mark Lee', '191401002', 'mahasiswa', NULL, '$2y$10$jQvFRrLqhHL1YKaNMA1vbOJzq.IycujZ5eN9wNj8zId96LgdsrPQ2', NULL, '2022-05-24 03:27:25', '2022-05-24 03:27:25'),
(8, 'Jisung Park', 'jisung@gmail.com', 'mahasiswa', NULL, '$2y$10$HMPvp2rSQJbZNfdSz74VhubmiR9ECp6tQcqpg/N9XVXZHGBNdb9V.', NULL, '2022-05-24 03:28:51', '2022-05-24 03:28:51'),
(9, 'Nana', 'jaemin@gmail.com', 'mahasiswa', NULL, '$2y$10$U1.fPXEqBKh5/RR.DjxNheX9E.7c99JHBqe0e.Q28UX4B1bfpxCqC', NULL, '2022-05-24 03:30:46', '2022-05-24 03:30:46'),
(10, 'Renjun', 'renjun@gmail.com', 'mahasiswa', NULL, '$2y$10$aO3WEmRrcy44IAlDmiKvz.DrAgWQTlAybTCBm.qJRujV7Licqriii', NULL, '2022-05-24 03:32:29', '2022-05-24 03:32:29'),
(11, 'Ivan Jaya', 'jayaivan@gmail.com', 'dosen', NULL, '$2y$10$CZ.XgBe0wpBu5MiZpcjd1eyhOGBvdq9sFCfu8.jPHTlQaqFw8RCEO', NULL, '2022-05-24 03:35:47', '2022-05-24 03:35:47'),
(12, 'Sawal', 'sawal@usu.ac.id', 'dosen', NULL, '$2y$10$I/G8fTX2N4YED8/mvceAT.8zP.PTwagxuZ/6cueiDphBKNNyNV4ye', NULL, '2022-05-24 03:37:39', '2022-05-24 03:37:39'),
(13, 'Dedy Arisandi', 'dedyarisandi@gmail.com', 'dosen', NULL, '$2y$10$6RQGHuE1QLeMYBH6ETU3nudOaO2mnRx.lau7lPkub8.fE.xp2bIWi', NULL, '2022-05-24 03:44:29', '2022-05-24 03:44:29'),
(14, 'Sarah Purnamawati', 'sarahpurnamawati@gmail.com', 'prodi', NULL, '$2y$10$a8f7JTo4sfMwItySxuk3HOk2oAROvV5gRWDiyTvF2g4DjwD7tvD1K', NULL, '2022-05-24 03:46:19', '2022-05-24 03:46:19'),
(16, 'Opim Salim', 'opimstp@yahoo.com', 'dosen', NULL, '$2y$10$0xhqreJ3aSt/7UbRoH.eNeQRepvpwk0QpLV3OQQz/GYAo.xDhIeRe', NULL, '2022-05-24 03:51:23', '2022-05-24 03:51:23'),
(17, 'Fahrurrozi Lubis', 'rozi.sibul@gmail.com', 'dosen', NULL, '$2y$10$87f6urh.fIOhVE.tby2ql.b46w56eAmX9YD3wTmcuCGtwPFx8hzb.', NULL, '2022-05-24 03:54:15', '2022-05-24 03:54:15'),
(18, 'Rossy Nurhasanah', 'rossy.nurhasanah@gmail.com', 'dosen', NULL, '$2y$10$Y6ctqkwSjnNL2bLc0lYBLOQ0u0XnKtShuJXJDHmbp2N70eeYr1b4a', NULL, '2022-05-24 03:56:44', '2022-05-24 03:56:44'),
(19, 'Muhammad Anggia Muchtar', 'anggi.muchtar@gmail.com', 'dosen', NULL, '$2y$10$bxpuftMKoZj75Q1cWqBslerfqUEkt7ymPT1yA.AIOpyOgzG4okVtW', NULL, '2022-05-24 04:00:48', '2022-05-24 04:00:48'),
(20, 'Ainul Hizriadi', 'ainul.hizriadi@usu.ac.id', 'dosen', NULL, '$2y$10$gFc6LUyFbyBMu.Crm66CaOyE8GiKe/TFpwm1D6ifyUBt6Mo916Z2C', NULL, '2022-05-24 04:02:55', '2022-05-24 04:02:55'),
(21, 'Ariana Grande', 'ariana@gmail.com', 'admin', NULL, '$2y$10$KBy0hehZQIYK.9YPwwopi.b4Idd32PKMOq8R1dHTqGFkngCAeuAZu', NULL, '2022-05-24 04:05:06', '2022-05-24 04:05:06'),
(22, 'Olivia Rodrigo', 'olivia@gmail.com', 'admin', NULL, '$2y$10$nrKd/58SrJFF0OYId11nkuk85gKVBFGyDbBZL6lAS6FF4MHsdER9y', NULL, '2022-05-24 04:06:09', '2022-05-24 04:06:09'),
(23, 'Conan Gray', 'conan@gmail.com', 'admin', NULL, '$2y$10$wIAukacQESCk4Z6mYV5cLuZvKf.cYhbK6NGciuzGNzrOiNgydaZae', NULL, '2022-05-24 04:07:17', '2022-05-24 04:07:17'),
(24, 'Sufjan Stevens', 'sufjan@gmail.com', 'admin', NULL, '$2y$10$6XflEVJoCWexlUvtjQRmGe0pCW5fk1aTjfZql.hcCTHWJWWmJsxMe', NULL, '2022-05-24 04:08:32', '2022-05-24 04:08:32'),
(25, 'Keshi', 'keshi@gmail.com', 'admin', NULL, '$2y$10$bSHUqKf0MVxrp3XdM5UCMe47yrrlNQVisjvyfZ/.BFI88WivzlT6W', NULL, '2022-05-24 04:09:22', '2022-05-24 04:09:22'),
(26, 'Lana Del Ray', 'lana@gmail.com', 'admin', NULL, '$2y$10$KHeuMZIfTjhiEy89QIvS9ukEvsUvyYMBOaTZCCR/ezRmKLmyg9N1q', NULL, '2022-05-24 04:11:00', '2022-05-24 04:11:00'),
(27, 'Greg Gonzalez', 'greg@gmail.com', 'admin', NULL, '$2y$10$CDXdkT0do6QtT96G0d.bzOF3wJT5aR/qfPshml6RMSeg5XeW6JSOa', NULL, '2022-05-24 04:12:51', '2022-05-24 04:12:51'),
(28, 'Shawn Mendes', 'shawn@gmail.com', 'admin', NULL, '$2y$10$QriWEruGUnqF4G6zif1CGubYT3BTksmj871NcRdV3y7zldTJPAkP.', NULL, '2022-05-24 04:13:49', '2022-05-24 04:13:49'),
(29, 'Christian Yu', 'christian@gmail.com', 'admin', NULL, '$2y$10$LZ076Mkspc78OKHoiY1bxOJSdy.792qwEQmCAEcs/bxTI4BsaVUzW', NULL, '2022-05-24 04:15:15', '2022-05-24 04:15:15'),
(30, 'Alex Turner', 'alexturner@gmail.com', 'admin', NULL, '$2y$10$AdVgYcUrqtNJ3Ky8sbJyze.97gzqqvA4veVbYnKJjVMz6AwcMxKkq', NULL, '2022-05-24 04:16:14', '2022-05-24 04:16:14'),
(31, 'Ricky Montgomery', 'rickymont@gmail.com', 'mahasiswa', NULL, '$2y$10$DMDikoXsJfXgJrtQBNJ3i.rQWL3jWZ5qIRTkPkj.t8Njbh36k1xXa', NULL, '2022-05-23 17:00:00', '2022-05-23 17:00:00'),
(33, 'Anneliese Mitchel', 'anneliese@gmail.com', 'mahasiswa', NULL, '$2y$10$ZQKyB5ohTzyEMbYU7WAoqei56tr8PC1t8eSnr4/7P7.5XuJ/QSz0O', NULL, '2022-05-24 13:35:39', '2022-05-24 13:35:39'),
(35, 'Vashti Bunyan', 'vashti@gmail.com', 'mahasiswa', NULL, '$2y$10$bkwED/yNHuwmW0Jx6u.4JelJAQdkTGwkdbxa.4mvTpKjwfE8aONZy', NULL, '2022-05-25 15:21:10', '2022-05-25 15:21:10'),
(38, 'Harry Styles', 'harry@gmail.com', 'admin', NULL, '$2y$10$NjmkR0bBZd1rT4BnzJy.Kucc02NL0zxJScDLUEYSo0y.VRjzmZoWm', NULL, '2022-05-25 17:14:43', '2022-05-25 17:14:43'),
(39, 'Patrick Watson', 'patrick@gmail.com', 'admin', NULL, '$2y$10$DSDA9a/aBwJgQ5a.jlX9vuOBeYkNxTMem/yn5auK98RMQ/cPI.xlO', NULL, '2022-05-25 17:16:07', '2022-05-25 17:16:07'),
(47, 'Romi Fadillah', 'romifadillahrahmat@gmail.com', 'dosen', NULL, '$2y$10$ljMD0/KOx22gD4W/Q5N85urIvenCEyZhBL0IjxxZNFoCI38ZcTYDa', NULL, '2022-05-26 06:36:11', '2022-05-26 06:36:11'),
(50, 'Sakura', 'sakura@gmail.com', 'dosen', NULL, '$2y$10$d0S5oF/hMmzHmecnFfjF2.S2xqCBgk892NjCSZG7tPdpGCiAFnoVq', NULL, '2022-06-01 16:52:26', '2022-06-01 16:52:26'),
(51, 'Naruto', 'naruto@gmail.com', 'dosen', NULL, '$2y$10$Vg8r7uhPAt.dY/5Kcqfu3eHM5sOlYJbfxGSFtlnooD.8oJXm9J.J.', NULL, '2022-06-01 16:53:04', '2022-06-01 16:53:04'),
(52, 'Sasuke', 'sasuke@gmail.com', 'dosen', NULL, '$2y$10$ItY/tXaw/7BBa/CMSkpMye8hGGmHWeuOt2smhFStysPzBPtqUpPDe', NULL, '2022-06-01 16:54:43', '2022-06-01 16:54:43'),
(53, 'Taylor Swift', 'taylor@gmail.com', 'dosen', NULL, '$2y$10$7/ZCi3yx4VjvQXc6pl8Et.2693wloHkDXjI4BNzTpHeqXXBE70PW.', NULL, '2022-06-01 16:55:43', '2022-06-01 16:55:43'),
(54, 'Erenn', 'eren@gmail.com', 'dosen', NULL, '$2y$10$1KfYkErF6bG3gup.Lg5aUOUVWbj3jNDzPdC5rmYdHSEKBkrFPUOFO', NULL, '2022-06-01 16:57:18', '2022-06-01 16:57:18'),
(55, 'Mikasa', 'mikasa@gmail.com', 'dosen', NULL, '$2y$10$jhGs3wGS8GQLm8YGEVNkGOSl34tT5Q0h2qYCVBvUJ.MidlnxU98da', NULL, '2022-06-01 16:57:56', '2022-06-01 16:57:56'),
(56, 'Levi Gantengz', 'levi@gmail.com', 'dosen', NULL, '$2y$10$buiaBbAHa3ggm/BOA.Eq5e1sRdINCrUFUtqRNIp6TJ.799u2NO6IW', NULL, '2022-06-01 16:58:54', '2022-06-01 16:58:54'),
(57, 'Armin', 'armin@gmail.com', 'dosen', NULL, '$2y$10$0kf7S8sjRRmugxXsK8FTrOiTw/RjEd1uqZIEWhMWVeICuLl0BW4FS', NULL, '2022-06-01 16:59:29', '2022-06-01 16:59:29'),
(58, 'Erwin', 'erwin@gmail.com', 'dosen', NULL, '$2y$10$NS.TvDcvKmO4SQq4EnC0VOM.gs3spNxIO/wK/fmiXCS.yAHKLF6b6', NULL, '2022-06-01 17:00:11', '2022-06-01 17:00:11'),
(59, 'Hange', 'hange@gmail.com', 'dosen', NULL, '$2y$10$PrCAm0ITW4bZCO5Tz8.g3udCteLtVBSCKJ8qqffEffxQJ0H1XK4gC', NULL, '2022-06-01 17:01:22', '2022-06-01 17:01:22'),
(60, 'Hermione', 'hermione@gmail.com', 'mahasiswa', NULL, '$2y$10$FAdp5/OdzD0uD/rpCHdqL.PVmhPYlc8.55BCROGmlHlfBnHpxpakC', NULL, '2022-06-02 14:01:05', '2022-06-02 14:01:05'),
(62, 'Harry', 'harrystyles@gmail.com', 'mahasiswa', NULL, '$2y$10$snqirCEY/h69lQPteqmawe.M.D6SJ9sFSV9Patf.guzoiCBMIr4Da', NULL, '2022-06-02 16:56:11', '2022-06-02 16:56:11'),
(63, 'Hanbin', 'hanbin@gmail.com', 'mahasiswa', NULL, '$2y$10$gWKC3VifvcOS0HpwrZVQFuMUD/oMghnWZH4.88RdHrzAUU6tliRfy', NULL, '2022-06-03 02:11:25', '2022-06-03 02:11:25'),
(64, 'Junee', 'junee@gmail.com', 'mahasiswa', NULL, '$2y$10$9eqUThdIqg7KKKp2NSFXsOTfcgINSR5./7/gIRDJW53nSg.0lQWNK', NULL, '2022-06-03 02:12:31', '2022-06-03 02:12:31'),
(65, 'Pierre Peter', 'pierre@gmail.com', 'mahasiswa', NULL, '$2y$10$L65DZC/NQhzRhUZUgK8LDu2JH.uaok3HMU8liC4lnTE051ybm4FKS', NULL, '2022-06-03 02:13:41', '2022-06-03 02:13:41'),
(66, 'Seann', 'sean@gmail.com', 'mahasiswa', NULL, '$2y$10$pe/CLEPe/NPwSg6G6VRXEeEUlRMs6qdSYo6Q7Wu6QE6JZZ4xEIYqW', NULL, '2022-06-03 02:14:41', '2022-06-03 02:14:41'),
(67, 'Lowell', 'lowell@gmail.com', 'mahasiswa', NULL, '$2y$10$Rd374quB4Rp1FDrTRmRM4eP/Euc04L5NH9G/H53Xn5eNQ6T5FvBCe', NULL, '2022-06-03 02:16:01', '2022-06-03 02:16:01'),
(68, 'Darcy', 'darcy@gmail.com', 'mahasiswa', NULL, '$2y$10$oWOU6GfVqp4IzQuFoCLoreLdnN/9G6ouLlxyb4rSr3ETbEoYMom06', NULL, '2022-06-03 02:17:51', '2022-06-03 02:17:51'),
(69, 'Elizabeth', 'elizabeth@gmail.com', 'mahasiswa', NULL, '$2y$10$jTLb1UoMbKR1ZYNjQUwo2.em5yA0SjOWOgjRH8Acrv6nueGHa9efK', NULL, '2022-06-03 02:18:37', '2022-06-03 02:18:37'),
(70, 'Josee', 'jose@gmail.com', 'mahasiswa', NULL, '$2y$10$AnEwhZ0aA6zjQnx24rMZN.cqbnBptAuIJHhxHQvpCaOdKYg6DsYLa', NULL, '2022-06-03 02:19:42', '2022-06-03 02:19:42'),
(71, 'Timothee', 'timothee@gmail.com', 'mahasiswa', NULL, '$2y$10$OxDAzn6zufWZJ.uF0ZUYLutdIZg.RagF1QeyIehthXq2V.lD7iuj6', NULL, '2022-06-03 02:21:18', '2022-06-03 02:21:18'),
(72, 'Louis', 'louis@gmail.com', 'mahasiswa', NULL, '$2y$10$SCCTnmoetRUlNi.7qPQNA.Rv.FnCmUabAzaPR.ww1cqlPG/H.6/Oy', NULL, '2022-06-03 02:21:59', '2022-06-03 02:21:59'),
(73, 'Andrew', 'andrew@gmail.com', 'mahasiswa', NULL, '$2y$10$HCXZC15bl7Pe3L/avgVru.BJ6rjCq1hLFdvytayyBJ/m1kfYnm6HO', NULL, '2022-06-03 02:22:46', '2022-06-03 02:22:46'),
(74, 'Renee', 'renee@gmail.com', 'mahasiswa', NULL, '$2y$10$nisJnXtdakdcWudUU83ZGemW60CTEp1dcIllRoifYmYzknrpAEvfC', NULL, '2022-06-03 02:23:50', '2022-06-03 02:23:50'),
(75, 'Ysabelle', 'ysabelle@gmail.com', 'mahasiswa', NULL, '$2y$10$iL/qEkMLOkgO72MmPbS1heNrVm/GqXSEgVruEpMLl9Eg27H5SBKX6', NULL, '2022-06-03 02:24:45', '2022-06-03 02:24:45'),
(76, 'Black Tiger', 'black@gmail.com', 'prodi', NULL, '$2y$10$e8lfVohb4HBtERLLi/zji.khzqq.zYmtqZcEff95qTW0oiF0cTRbW', NULL, '2022-06-06 08:25:36', '2022-06-06 08:25:36'),
(78, 'Maudy Ayunda', 'maudy@gmail.com', 'prodi', NULL, '$2y$10$nmTzu6hk0bduklf1RSQPxOiIOgvzL7Mdix4BYgHK9m21S1VnSghFS', NULL, '2022-06-06 08:29:09', '2022-06-06 08:29:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_mhs`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_mhs` (
`nama` varchar(64)
,`nim` varchar(9)
,`angkatan` varchar(4)
,`judul_skripsi` varchar(255)
,`dosen_pembimbing` varchar(64)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dosbing`
-- (See below for the actual view)
--
CREATE TABLE `v_dosbing` (
`nama_mhs` varchar(64)
,`nim` varchar(9)
,`nama_dosbing1` varchar(64)
,`nip_dosbing1` varchar(18)
,`nama_dosbing2` varchar(64)
,`nip_dosbing2` varchar(18)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dosen_penguji`
-- (See below for the actual view)
--
CREATE TABLE `v_dosen_penguji` (
`nama_mhs` varchar(64)
,`nim` varchar(9)
,`nama_dosen_penguji1` varchar(64)
,`nip_dosen_penguji1` varchar(18)
,`nama_dosen_penguji2` varchar(64)
,`nip_dosen_penguji2` varchar(18)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jdsemhas`
-- (See below for the actual view)
--
CREATE TABLE `v_jdsemhas` (
`tanggal_semhas` date
,`waktu` time
,`tempat` varchar(64)
,`nama` varchar(64)
,`nim` varchar(9)
,`nip` varchar(18)
,`nama_dosen` varchar(64)
,`bidang_TA` varchar(64)
,`judul_skripsi` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jdsempro`
-- (See below for the actual view)
--
CREATE TABLE `v_jdsempro` (
`tanggal_sempro` date
,`waktu` time
,`tempat` varchar(64)
,`nama` varchar(64)
,`nim` varchar(9)
,`nip` varchar(18)
,`nama_dosen` varchar(64)
,`judul_skripsi` varchar(255)
,`bidang_TA` varchar(64)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mahasiswa_aktif`
-- (See below for the actual view)
--
CREATE TABLE `v_mahasiswa_aktif` (
`nama` varchar(64)
,`nim` varchar(9)
,`email` varchar(254)
,`angkatan` varchar(4)
,`jenis_kelamin` enum('Laki-laki','Perempuan')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mhs_bimbingan`
-- (See below for the actual view)
--
CREATE TABLE `v_mhs_bimbingan` (
`nama_dsn` varchar(64)
,`nip` varchar(18)
,`nama_mhs` varchar(64)
,`nim` varchar(9)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mhs_semhas`
-- (See below for the actual view)
--
CREATE TABLE `v_mhs_semhas` (
`nama` varchar(64)
,`nim` varchar(9)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mhs_sempro`
-- (See below for the actual view)
--
CREATE TABLE `v_mhs_sempro` (
`nama` varchar(64)
,`nim` varchar(9)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mhs_sidang_meja_hijau`
-- (See below for the actual view)
--
CREATE TABLE `v_mhs_sidang_meja_hijau` (
`nama` varchar(64)
,`nim` varchar(9)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_progress_skripsi`
-- (See below for the actual view)
--
CREATE TABLE `v_progress_skripsi` (
`nama` varchar(64)
,`nim` varchar(9)
,`persentase_skripsi` decimal(5,2)
,`keterangan` varchar(64)
);

-- --------------------------------------------------------

--
-- Structure for view `dosbing1`
--
DROP TABLE IF EXISTS `dosbing1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dosbing1`  AS SELECT `m`.`nama` AS `nama_mhs`, `m`.`nim` AS `nim`, `d`.`nip` AS `nip_dosbing1`, `d`.`nama` AS `nama_dosbing1` FROM ((`mahasiswas` `m` join `dosen_pembimbings` `db` on(`m`.`nim` = `db`.`nim`)) join `dosens` `d` on(`db`.`nip_dosbing1` = `d`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `dosbing2`
--
DROP TABLE IF EXISTS `dosbing2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dosbing2`  AS SELECT `m`.`nama` AS `nama_mhs`, `m`.`nim` AS `nim`, `d`.`nip` AS `nip_dosbing2`, `d`.`nama` AS `nama_dosbing2` FROM ((`mahasiswas` `m` join `dosen_pembimbings` `db` on(`m`.`nim` = `db`.`nim`)) join `dosens` `d` on(`db`.`nip_dosbing2` = `d`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `dosen_penguji1`
--
DROP TABLE IF EXISTS `dosen_penguji1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dosen_penguji1`  AS SELECT `m`.`nama` AS `nama_mhs`, `m`.`nim` AS `nim`, `d`.`nama` AS `nama_dosen_penguji1`, `d`.`nip` AS `nip_dosen_penguji1` FROM ((`mahasiswas` `m` join `dosen_pengujis` `dp` on(`m`.`nim` = `dp`.`nim`)) join `dosens` `d` on(`dp`.`nip_penguji1` = `d`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `dosen_penguji2`
--
DROP TABLE IF EXISTS `dosen_penguji2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dosen_penguji2`  AS SELECT `m`.`nama` AS `nama_mhs`, `m`.`nim` AS `nim`, `d`.`nama` AS `nama_dosen_penguji2`, `d`.`nip` AS `nip_dosen_penguji2` FROM ((`mahasiswas` `m` join `dosen_pengujis` `dp` on(`m`.`nim` = `dp`.`nim`)) join `dosens` `d` on(`dp`.`nip_penguji2` = `d`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `jdsidangmejahijau`
--
DROP TABLE IF EXISTS `jdsidangmejahijau`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `jdsidangmejahijau`  AS SELECT `td`.`tanggal_sidang` AS `tanggal_sidang`, `td`.`waktu` AS `waktu`, `td`.`tempat` AS `tempat`, `mh`.`nama` AS `nama`, `mh`.`nim` AS `nim`, `ds`.`nip` AS `nip`, `ds`.`nama` AS `nama_dosen`, `s`.`bidang_ilmu` AS `bidang_TA`, `s`.`judul_skripsi` AS `judul_skripsi` FROM ((((`jadwal_sidangs` `td` join `mahasiswas` `mh` on(`td`.`nim` = `mh`.`nim`)) join `skripsis` `s` on(`s`.`nim` = `mh`.`nim`)) join `dosen_pembimbings` `dp` on(`td`.`nim` = `dp`.`nim`)) join `dosens` `ds` on(`dp`.`nip_dosbing1` = `ds`.`nip` or `dp`.`nip_dosbing2` = `ds`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_detail_mhs`
--
DROP TABLE IF EXISTS `v_detail_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_mhs`  AS SELECT `m`.`nama` AS `nama`, `m`.`nim` AS `nim`, `m`.`angkatan` AS `angkatan`, `s`.`judul_skripsi` AS `judul_skripsi`, `d`.`nama` AS `dosen_pembimbing` FROM (((`mahasiswas` `m` join `skripsis` `s` on(`m`.`nim` = `s`.`nim`)) join `dosen_pembimbings` `dp` on(`m`.`nim` = `dp`.`nim`)) join `dosens` `d` on(`dp`.`nip_dosbing1` = `d`.`nip` or `dp`.`nip_dosbing2` = `d`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_dosbing`
--
DROP TABLE IF EXISTS `v_dosbing`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dosbing`  AS SELECT `db1`.`nama_mhs` AS `nama_mhs`, `db1`.`nim` AS `nim`, `db1`.`nama_dosbing1` AS `nama_dosbing1`, `db1`.`nip_dosbing1` AS `nip_dosbing1`, `db2`.`nama_dosbing2` AS `nama_dosbing2`, `db2`.`nip_dosbing2` AS `nip_dosbing2` FROM (`dosbing1` `db1` join `dosbing2` `db2` on(`db1`.`nim` = `db2`.`nim`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_dosen_penguji`
--
DROP TABLE IF EXISTS `v_dosen_penguji`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dosen_penguji`  AS SELECT `m`.`nama` AS `nama_mhs`, `m`.`nim` AS `nim`, `dp1`.`nama_dosen_penguji1` AS `nama_dosen_penguji1`, `dp1`.`nip_dosen_penguji1` AS `nip_dosen_penguji1`, `dp2`.`nama_dosen_penguji2` AS `nama_dosen_penguji2`, `dp2`.`nip_dosen_penguji2` AS `nip_dosen_penguji2` FROM ((`mahasiswas` `m` join `dosen_penguji1` `dp1` on(`m`.`nim` = `dp1`.`nim`)) join `dosen_penguji2` `dp2` on(`m`.`nim` = `dp2`.`nim`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_jdsemhas`
--
DROP TABLE IF EXISTS `v_jdsemhas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jdsemhas`  AS SELECT `ts`.`tanggal_semhas` AS `tanggal_semhas`, `ts`.`waktu` AS `waktu`, `ts`.`tempat` AS `tempat`, `mh`.`nama` AS `nama`, `mh`.`nim` AS `nim`, `ds`.`nip` AS `nip`, `ds`.`nama` AS `nama_dosen`, `s`.`bidang_ilmu` AS `bidang_TA`, `s`.`judul_skripsi` AS `judul_skripsi` FROM ((((`jadwal_semhas` `ts` join `mahasiswas` `mh` on(`ts`.`nim` = `mh`.`nim`)) join `skripsis` `s` on(`s`.`nim` = `mh`.`nim`)) join `dosen_pembimbings` `dp` on(`ts`.`nim` = `dp`.`nim`)) join `dosens` `ds` on(`dp`.`nip_dosbing1` = `ds`.`nip` or `dp`.`nip_dosbing2` = `ds`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_jdsempro`
--
DROP TABLE IF EXISTS `v_jdsempro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jdsempro`  AS SELECT `tp`.`tanggal_sempro` AS `tanggal_sempro`, `tp`.`waktu` AS `waktu`, `tp`.`tempat` AS `tempat`, `mh`.`nama` AS `nama`, `mh`.`nim` AS `nim`, `ds`.`nip` AS `nip`, `ds`.`nama` AS `nama_dosen`, `s`.`judul_skripsi` AS `judul_skripsi`, `s`.`bidang_ilmu` AS `bidang_TA` FROM ((((`jadwal_sempros` `tp` join `mahasiswas` `mh` on(`tp`.`nim` = `mh`.`nim`)) join `skripsis` `s` on(`s`.`nim` = `mh`.`nim`)) join `dosen_pembimbings` `dp` on(`tp`.`nim` = `dp`.`nim`)) join `dosens` `ds` on(`dp`.`nip_dosbing1` = `ds`.`nip` or `dp`.`nip_dosbing2` = `ds`.`nip`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_mahasiswa_aktif`
--
DROP TABLE IF EXISTS `v_mahasiswa_aktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mahasiswa_aktif`  AS SELECT `m`.`nama` AS `nama`, `m`.`nim` AS `nim`, `u`.`email` AS `email`, `m`.`angkatan` AS `angkatan`, `m`.`jenis_kelamin` AS `jenis_kelamin` FROM (`mahasiswas` `m` join `users` `u` on(`m`.`id_user` = `u`.`id`)) WHERE `m`.`status` = 'Aktif\'Aktif\'Aktif\'Aktif\'Aktif\'Aktif\'Aktif\'Aktif' ;


-- create view jadwal_uji_kelayakan as select nim, nama, tanggal, waktu, tempat, judul_skripsi from jadwal_uji_kelayakans 
-- join mahasiswas join skrisis

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jadwal_uji_kelayakan`  AS SELECT `nim`, `nama`, `tanggal`, `waktu`, `tempat`, `judul_skripsi` FROM `jadwal_uji_kelayakans` join `mahasiswas`, `skrisis` ;

-- --------------------------------------------------------

--
-- Structure for view `v_mhs_bimbingan`
--
DROP TABLE IF EXISTS `v_mhs_bimbingan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mhs_bimbingan`  AS SELECT `d`.`nama` AS `nama_dsn`, `d`.`nip` AS `nip`, `m`.`nama` AS `nama_mhs`, `m`.`nim` AS `nim` FROM ((`dosens` `d` join `dosen_pembimbings` `dp` on(`d`.`nip` = `dp`.`nip_dosbing1` or `d`.`nip` = `dp`.`nip_dosbing2`)) join `mahasiswas` `m` on(`m`.`nim` = `dp`.`nim`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_mhs_semhas`
--
DROP TABLE IF EXISTS `v_mhs_semhas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mhs_semhas`  AS SELECT `mahasiswas`.`nama` AS `nama`, `mahasiswas`.`nim` AS `nim` FROM `mahasiswas` WHERE `mahasiswas`.`nim` in (select `status_akses`.`nim` from `status_akses` where `status_akses`.`no_statusAkses` > 2) ;

-- --------------------------------------------------------

--
-- Structure for view `v_mhs_sempro`
--
DROP TABLE IF EXISTS `v_mhs_sempro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mhs_sempro`  AS SELECT `mahasiswas`.`nama` AS `nama`, `mahasiswas`.`nim` AS `nim` FROM `mahasiswas` WHERE `mahasiswas`.`nim` in (select `status_akses`.`nim` from `status_akses` where `status_akses`.`no_statusAkses` > 0) ;

-- --------------------------------------------------------

--
-- Structure for view `v_mhs_sidang_meja_hijau`
--
DROP TABLE IF EXISTS `v_mhs_sidang_meja_hijau`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mhs_sidang_meja_hijau`  AS SELECT `mahasiswas`.`nama` AS `nama`, `mahasiswas`.`nim` AS `nim` FROM `mahasiswas` WHERE `mahasiswas`.`nim` in (select `status_akses`.`nim` from `status_akses` where `status_akses`.`no_statusAkses` > 4) ;

-- --------------------------------------------------------

--
-- Structure for view `v_progress_skripsi`
--
DROP TABLE IF EXISTS `v_progress_skripsi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_progress_skripsi`  AS SELECT `m`.`nama` AS `nama`, `m`.`nim` AS `nim`, (select `persentase_skripsi`(`st`.`no_statusAkses`)) AS `persentase_skripsi`, `kt`.`keterangan` AS `keterangan` FROM ((`mahasiswas` `m` join `status_akses` `st` on(`m`.`nim` = `st`.`nim`)) join `keterangan_status_akses` `kt` on(`st`.`no_statusAkses` = `kt`.`no_statusAkses`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_id_user_foreign` (`id_user`);

--
-- Indexes for table `bidang_ilmus`
--
ALTER TABLE `bidang_ilmus`
  ADD PRIMARY KEY (`bidang_ilmu`);

--
-- Indexes for table `dosens`
--
ALTER TABLE `dosens`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `NIDN` (`NIDN`),
  ADD UNIQUE KEY `kode` (`kode`),
  ADD KEY `dosens_id_user_foreign` (`id_user`);

--
-- Indexes for table `dosen_pembimbings`
--
ALTER TABLE `dosen_pembimbings`
  ADD KEY `dosen_pembimbings_nip_dosbing1_foreign` (`nip_dosbing1`),
  ADD KEY `dosen_pembimbings_nim_foreign` (`nim`),
  ADD KEY `dosen_pembimbings_nip_dosbing2_foreign` (`nip_dosbing2`);

--
-- Indexes for table `dosen_pengujis`
--
ALTER TABLE `dosen_pengujis`
  ADD KEY `dosen_pengujis_penguji1_foreign` (`nip_penguji1`),
  ADD KEY `dosen_pengujis_penguji2_foreign` (`nip_penguji2`),
  ADD KEY `dosen_pengujis_nim_foreign` (`nim`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jadwal_semhas`
--
ALTER TABLE `jadwal_semhas`
  ADD KEY `jadwal_semhas_nim_foreign` (`nim`);

--
-- Indexes for table `jadwal_sempros`
--
ALTER TABLE `jadwal_sempros`
  ADD KEY `jadwal_sempros_nim_foreign` (`nim`);

--
-- Indexes for table `jadwal_sidangs`
--
ALTER TABLE `jadwal_sidangs`
  ADD KEY `jadwal_sidangs_nim_foreign` (`nim`);

--
-- Indexes for table `keterangan_status_akses`
--
ALTER TABLE `keterangan_status_akses`
  ADD PRIMARY KEY (`no_statusAkses`);

--
-- Indexes for table `log_mahasiswa_luluses`
--
ALTER TABLE `log_mahasiswa_luluses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_penambahan_dosbings`
--
ALTER TABLE `log_penambahan_dosbings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_penambahan_dosbings_id_admin_foreign` (`id_admin`),
  ADD KEY `log_penambahan_dosbings_nim_foreign` (`nim`),
  ADD KEY `log_penambahan_dosbings_nip_dosbing1_foreign` (`nip_dosbing1`),
  ADD KEY `log_penambahan_dosbings_nip_dosbing2_foreign` (`nip_dosbing2`);

--
-- Indexes for table `log_pendaftaran_skripsis`
--
ALTER TABLE `log_pendaftaran_skripsis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_penghapusan_dosbings`
--
ALTER TABLE `log_penghapusan_dosbings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_penghapusan_skripsis`
--
ALTER TABLE `log_penghapusan_skripsis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_pengubahan_dosbings`
--
ALTER TABLE `log_pengubahan_dosbings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_pengubahan_skripsis`
--
ALTER TABLE `log_pengubahan_skripsis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `mahasiswas_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_i_p_k_s`
--
ALTER TABLE `nilai_i_p_k_s`
  ADD KEY `nilai_i_p_k_s_nim_foreign` (`nim`);

--
-- Indexes for table `nilai_seminar_hasils`
--
ALTER TABLE `nilai_seminar_hasils`
  ADD KEY `nilai_seminar_hasils_nim_foreign` (`nim`),
  ADD KEY `nilai_seminar_hasils_nip_foreign` (`nip`);

--
-- Indexes for table `nilai_sidang_meja_hijaus`
--
ALTER TABLE `nilai_sidang_meja_hijaus`
  ADD KEY `nilai_sidang_meja_hijaus_nim_foreign` (`nim`),
  ADD KEY `nilai_sidang_meja_hijaus_nip_foreign` (`nip`);

--
-- Indexes for table `nilai_uji_programs`
--
ALTER TABLE `nilai_uji_programs`
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `nilai_uji_programs_nip_foreign` (`nip`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `skripsis`
--
ALTER TABLE `skripsis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eng_judul_skripsi` (`eng_judul_skripsi`),
  ADD UNIQUE KEY `judul_skripsi` (`judul_skripsi`),
  ADD KEY `skripsis_nim_foreign` (`nim`);

--
-- Indexes for table `status_akses`
--
ALTER TABLE `status_akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_akses_nim_foreign` (`nim`),
  ADD KEY `status_akses_no_statusakses_foreign` (`no_statusAkses`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_mahasiswa_luluses`
--
ALTER TABLE `log_mahasiswa_luluses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `log_penambahan_dosbings`
--
ALTER TABLE `log_penambahan_dosbings`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `log_pendaftaran_skripsis`
--
ALTER TABLE `log_pendaftaran_skripsis`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `log_penghapusan_dosbings`
--
ALTER TABLE `log_penghapusan_dosbings`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `log_penghapusan_skripsis`
--
ALTER TABLE `log_penghapusan_skripsis`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `log_pengubahan_dosbings`
--
ALTER TABLE `log_pengubahan_dosbings`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log_pengubahan_skripsis`
--
ALTER TABLE `log_pengubahan_skripsis`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skripsis`
--
ALTER TABLE `skripsis`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `status_akses`
--
ALTER TABLE `status_akses`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosens`
--
ALTER TABLE `dosens`
  ADD CONSTRAINT `dosens_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosen_pembimbings`
--
ALTER TABLE `dosen_pembimbings`
  ADD CONSTRAINT `dosen_pembimbings_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_pembimbings_nip_dosbing1_foreign` FOREIGN KEY (`nip_dosbing1`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE,
  ADD CONSTRAINT `dosen_pembimbings_nip_dosbing2_foreign` FOREIGN KEY (`nip_dosbing2`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dosen_pengujis`
--
ALTER TABLE `dosen_pengujis`
  ADD CONSTRAINT `dosen_pengujis_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dosen_pengujis_penguji1_foreign` FOREIGN KEY (`nip_penguji1`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE,
  ADD CONSTRAINT `dosen_pengujis_penguji2_foreign` FOREIGN KEY (`nip_penguji2`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `jadwal_semhas`
--
ALTER TABLE `jadwal_semhas`
  ADD CONSTRAINT `jadwal_semhas_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_sempros`
--
ALTER TABLE `jadwal_sempros`
  ADD CONSTRAINT `jadwal_sempros_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_sidangs`
--
ALTER TABLE `jadwal_sidangs`
  ADD CONSTRAINT `jadwal_sidangs_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswas`
--
ALTER TABLE `mahasiswas`
  ADD CONSTRAINT `mahasiswas_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_i_p_k_s`
--
ALTER TABLE `nilai_i_p_k_s`
  ADD CONSTRAINT `nilai_i_p_k_s_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_seminar_hasils`
--
ALTER TABLE `nilai_seminar_hasils`
  ADD CONSTRAINT `nilai_seminar_hasils_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_seminar_hasils_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_sidang_meja_hijaus`
--
ALTER TABLE `nilai_sidang_meja_hijaus`
  ADD CONSTRAINT `nilai_sidang_meja_hijaus_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_sidang_meja_hijaus_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `nilai_uji_programs`
--
ALTER TABLE `nilai_uji_programs`
  ADD CONSTRAINT `nilai_uji_programs_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_uji_programs_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `dosens` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `skripsis`
--
ALTER TABLE `skripsis`
  ADD CONSTRAINT `skripsis_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_akses`
--
ALTER TABLE `status_akses`
  ADD CONSTRAINT `status_akses_nim_foreign` FOREIGN KEY (`nim`) REFERENCES `mahasiswas` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;






