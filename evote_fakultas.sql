-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 05:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evote_fakultas`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` int(11) NOT NULL,
  `nama_fakultas` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`, `status`) VALUES
(1, 'Kedokteran', 0),
(2, 'Kedokteran Gigi', 0),
(3, 'Hukum', 0),
(4, 'Ekonomi dan Bisnis', 0),
(5, 'Farmasi', 0),
(6, 'Kedokteran Hewan', 0),
(7, 'Ilmu Sosial dan Ilmu Politik', 0),
(8, 'Sains dan Teknologi', 0),
(9, 'Sekolah Pascasarjana', 0),
(10, 'Kesehatan Masyarakat', 0),
(11, 'Psikologi', 0),
(12, 'Ilmu Budaya', 0),
(13, 'Keperawatan', 0),
(14, 'Perikanan dan Kelautan', 0),
(15, 'Vokasi', 1),
(16, 'Teknologi Maju dan Multidisiplin', 0),
(17, 'Rektorat', 0),
(50, 'MBKM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenjang`
--

CREATE TABLE `jenjang` (
  `id_jenjang` int(11) NOT NULL,
  `nama_jenjang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenjang`
--

INSERT INTO `jenjang` (`id_jenjang`, `nama_jenjang`) VALUES
(1, 'S1'),
(2, 'S2'),
(3, 'S3'),
(4, 'D4'),
(5, 'D3'),
(6, 'D2'),
(7, 'D1'),
(9, 'Profesi'),
(10, 'Spesialis'),
(46, 'Sub Spesialis');

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id_program_studi` int(11) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `id_jenjang` int(11) NOT NULL,
  `id_fakultas` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id_program_studi`, `nama_prodi`, `id_jenjang`, `id_fakultas`, `status`) VALUES
(1, 'TEKNOLOGI LABORATORIUM MEDIS', 5, 15, 1),
(2, 'FISIOTERAPI', 5, 15, 1),
(3, 'RADIOLOGI', 5, 15, 0),
(4, 'PENGOBAT TRADISIONAL', 5, 15, 1),
(5, 'PENDIDIKAN PROFESI DOKTER', 9, 1, 1),
(6, 'KEBIDANAN', 1, 1, 1),
(7, 'KEDOKTERAN', 1, 1, 1),
(8, 'DD-MASTER OF HEALTH SCIENCE IN NURSING', 2, 1, 0),
(9, 'ILMU KESEHATAN REPRODUKSI', 2, 1, 1),
(10, 'ILMU KESEHATAN OLAH RAGA', 2, 1, 1),
(11, 'ILMU FORENSIK', 2, 9, 1),
(12, 'IMUNOLOGI', 2, 9, 1),
(13, 'ILMU KEDOKTERAN TROPIS', 2, 1, 1),
(14, 'ILMU KEDOKTERAN DASAR', 2, 1, 1),
(15, 'JANTUNG DAN PEMBULUH DARAH', 10, 1, 1),
(16, 'PATOLOGI ANATOMIK', 10, 1, 1),
(17, 'PATOLOGI KLINIK', 10, 1, 1),
(18, 'ILMU KEDOKTERAN FISIK DAN REHABILITASI', 10, 1, 1),
(19, 'RADIOLOGI', 10, 1, 1),
(20, 'ILMU KEDOKTERAN JIWA', 10, 1, 0),
(21, 'ILMU BEDAH SARAF', 10, 1, 1),
(22, 'ANDROLOGI', 10, 1, 1),
(23, 'MIKROBIOLOGI KLINIK', 10, 1, 1),
(24, 'BEDAH TORAKS, KARDIAK, DAN VASKULER', 10, 1, 1),
(25, 'ORTHOPAEDI DAN TRAUMATOLOGI', 10, 1, 1),
(26, 'ILMU KESEHATAN ANAK', 10, 1, 1),
(27, 'KEDOKTERAN FORENSIK DAN STUDI MEDIKOLEGAL ', 10, 1, 1),
(28, 'UROLOGI', 10, 1, 1),
(29, 'ILMU KESEHATAN MATA', 10, 1, 1),
(30, 'ILMU PENYAKIT DALAM', 10, 1, 1),
(31, 'NEUROLOGI', 10, 1, 1),
(32, 'BEDAH PLASTIK REKONSTRUKSI DAN ESTETIK', 10, 1, 1),
(33, 'DERMATOLOGI DAN VENEREOLOGI', 10, 1, 1),
(34, 'ILMU KESEHATAN TELINGA HIDUNG TENGGOROK BEDAH KEPALA DAN LEHER', 10, 1, 1),
(35, 'ANESTESIOLOGI DAN TERAPI INTENSIF', 10, 1, 1),
(36, 'ILMU BEDAH', 10, 1, 1),
(37, 'OBSTETRI DAN GINEKOLOGI ', 10, 1, 1),
(38, 'PULMONOLOGI DAN ILMU KEDOKTERAN RESPIRASI', 10, 1, 1),
(39, 'TEKNIK GIGI', 5, 15, 1),
(40, 'PENDIDIKAN PROFESI DOKTER GIGI', 9, 2, 1),
(41, 'KEDOKTERAN GIGI', 1, 2, 1),
(42, 'ILMU KESEHATAN GIGI', 2, 2, 1),
(43, 'ILMU KONSERVASI GIGI', 10, 2, 1),
(44, 'BEDAH MULUT DAN MAKSILOFASIAL', 10, 2, 1),
(45, 'ILMU PENYAKIT MULUT', 10, 2, 1),
(46, 'KEDOKTERAN GIGI ANAK', 10, 2, 1),
(47, 'SPESIALIS F K G', 10, 2, 0),
(48, 'PROSTODONSIA', 10, 2, 1),
(49, 'ORTODONTI', 10, 2, 1),
(50, 'PERIODONSIA', 10, 2, 1),
(51, 'ILMU HUKUM', 1, 3, 1),
(52, 'SAINS HUKUM DAN PEMBANGUNAN', 2, 9, 1),
(53, 'SAIN HUKUM', 2, 3, 0),
(54, 'KENOTARIATAN', 2, 3, 1),
(55, 'ILMU HUKUM', 2, 3, 1),
(56, 'ILMU HUKUM', 3, 3, 1),
(57, 'MANAJEMEN PERBANKAN', 5, 15, 1),
(58, 'ADMINISTRASI PERKANTORAN', 5, 15, 1),
(59, 'AKUNTANSI', 5, 15, 1),
(60, 'PERPAJAKAN', 5, 15, 1),
(61, 'MANAJEMEN PEMASARAN', 5, 15, 1),
(62, 'MANAJEMEN PERHOTELAN', 5, 15, 1),
(63, 'PENDIDIKAN PROFESI AKUNTAN', 9, 4, 1),
(64, 'AKUNTANSI', 1, 4, 1),
(65, 'EKONOMI PEMBANGUNAN', 1, 4, 1),
(66, 'MANAJEMEN', 1, 4, 1),
(67, 'EKONOMI ISLAM', 1, 4, 1),
(68, 'ILMU EKONOMI', 2, 4, 1),
(69, 'SAINS EKONOMI ISLAM', 2, 4, 1),
(70, 'SAINS EKONOMI', 2, 4, 0),
(71, 'AKUNTANSI', 2, 4, 1),
(72, 'SAINS MANAJEMEN', 2, 4, 1),
(73, 'MAGISTER MANAJEMEN', 2, 4, 1),
(74, 'PENDIDIKAN PROFESI APOTEKER', 9, 5, 1),
(75, 'FARMASI', 1, 5, 1),
(76, 'COMBINED DEGREE SPESIALIS FARMASI DAN MAGISTER FARMASI KLINIK', 2, 5, 0),
(77, 'ILMU FARMASI', 2, 5, 1),
(78, 'SPESIALIS FARMASI', 10, 5, 0),
(79, 'PARAMEDIK VETERINER', 5, 15, 1),
(80, 'KESEHATAN SATWA LIAR', 5, 6, 0),
(81, 'BUDIDAYA PERIKANAN', 5, 6, 0),
(82, 'PERUNGGASAN', 5, 6, 0),
(83, 'PENDIDIKAN PROFESI DOKTER HEWAN', 9, 6, 1),
(84, 'KEDOKTERAN HEWAN', 1, 6, 1),
(85, 'VAKSINOLOGI DAN IMUNOTERAPETIKA', 2, 6, 1),
(86, 'ILMU PENYAKIT DAN KESEHATAN MASYARAKAT VETERINER', 2, 6, 1),
(87, 'BIOLOGI REPRODUKSI', 2, 6, 1),
(88, 'AGRIBISNIS VETERINER', 2, 6, 1),
(89, 'PERPUSTAKAAN', 5, 15, 1),
(90, 'KEPARIWISATAAN / BINA WISATA', 5, 15, 1),
(91, 'SOSIOLOGI', 1, 7, 1),
(92, 'ILMU KOMUNIKASI', 1, 7, 1),
(93, 'ILMU HUBUNGAN INTERNASIONAL', 1, 7, 1),
(94, 'ADMINISTRASI PUBLIK', 1, 7, 1),
(95, 'ANTROPOLOGI', 1, 7, 1),
(96, 'ILMU INFORMASI DAN PERPUSTAKAAN', 1, 7, 1),
(97, 'ILMU POLITIK', 1, 7, 1),
(98, 'KEBIJAKAN PUBLIK', 2, 7, 1),
(99, 'SOSIOLOGI', 2, 7, 1),
(100, 'ILMU KOMUNIKASI', 2, 7, 0),
(101, 'HUBUNGAN INTERNASIONAL', 2, 7, 1),
(102, 'ILMU POLITIK', 2, 7, 1),
(103, 'PENGEMBANGAN SUMBER DAYA MANUSIA', 2, 9, 1),
(104, 'ILMU-ILMU SOSIAL', 2, 7, 0),
(105, 'OTOMASI SISTEM INSTRUMENTASI', 5, 15, 1),
(106, 'SISTEM INFORMASI', 5, 15, 1),
(107, 'MATEMATIKA', 1, 8, 1),
(108, 'FISIKA', 1, 8, 1),
(109, 'KIMIA', 1, 8, 1),
(110, 'BIOLOGI', 1, 8, 1),
(111, 'TEKNIK LINGKUNGAN', 1, 8, 1),
(112, 'SISTEM INFORMASI', 1, 8, 1),
(113, 'TEKNIK BIOMEDIS', 1, 8, 1),
(114, 'DD-MASTER ON BIOCHEMISTRY AND BIOTECHNOLOGY', 2, 8, 0),
(115, 'BIOLOGI', 2, 8, 1),
(116, 'KIMIA', 2, 8, 1),
(117, 'MATEMATIKA DAN ILMU PENGETAHUAN ALAM', 3, 8, 1),
(118, 'ILMU FARMASI', 3, 5, 1),
(119, 'AKUNTANSI', 3, 9, 0),
(120, 'PSIKOLOGI', 3, 11, 1),
(121, 'KESEHATAN MASYARAKAT', 3, 10, 1),
(122, 'ILMU EKONOMI ISLAM', 3, 4, 1),
(123, 'PENGEMBANGAN SUMBER DAYA MANUSIA', 3, 9, 1),
(124, 'ILMU SOSIAL', 3, 7, 1),
(125, 'ILMU EKONOMI', 3, 4, 1),
(126, 'ILMU KEDOKTERAN JENJANG DOKTOR', 3, 1, 1),
(127, 'SAINS VETERINER', 3, 6, 1),
(128, 'KESELAMATAN DAN KESEHATAN KERJA', 5, 15, 1),
(129, 'KESEHATAN MASYARAKAT', 1, 10, 1),
(130, 'ADMINISTRASI DAN KEBIJAKAN KESEHATAN', 2, 10, 1),
(131, 'KESEHATAN MASYARAKAT', 2, 10, 1),
(132, 'KESEHATAN DAN KESELAMATAN KERJA', 2, 10, 1),
(133, 'KESEHATAN LINGKUNGAN', 2, 10, 1),
(134, 'PSIKOLOGI', 1, 11, 1),
(135, 'PSIKOLOGI TERAPAN', 2, 11, 1),
(136, 'PSIKOLOGI', 2, 11, 1),
(137, 'PSIKOLOGI PROFESI ', 2, 11, 1),
(138, 'BAHASA INGGRIS', 5, 15, 1),
(139, 'ILMU SEJARAH', 1, 12, 1),
(140, 'STUDI KEJEPANGAN', 1, 12, 1),
(141, 'BAHASA DAN SASTRA INDONESIA', 1, 12, 1),
(142, 'BAHASA DAN SASTRA INGGRIS', 1, 12, 1),
(143, 'KAJIAN SASTRA DAN BUDAYA', 2, 12, 1),
(144, 'PENDIDIKAN PROFESI NERS', 9, 13, 1),
(145, 'KEPERAWATAN', 1, 13, 1),
(146, 'KEPERAWATAN', 2, 13, 1),
(147, 'AKUAKULTUR', 1, 14, 1),
(148, 'BIOTEKNOLOGI PERIKANAN DAN KELAUTAN', 2, 14, 1),
(150, 'MEDIA DAN KOMUNIKASI', 2, 7, 1),
(152, 'ILMU AKUNTANSI', 3, 4, 1),
(172, 'FARMASI KLINIK', 2, 5, 1),
(175, 'STATISTIKA', 1, 8, 1),
(195, 'PENDIDIKAN PROFESI BIDAN', 9, 1, 1),
(197, 'LINTAS PRODI FST', 1, 8, 0),
(201, 'ILMU PENYAKIT THT', 10, 1, 0),
(204, 'REHABILITASI MEDIK', 10, 1, 0),
(205, 'ILMU ANESTESI', 10, 1, 0),
(206, 'ILMU FORENSIK', 10, 1, 0),
(207, 'ILMU PENYAKIT JANTUNG', 10, 1, 0),
(208, 'PSIKIATRI', 10, 1, 1),
(210, 'BIOLOGI KELAUTAN', 2, 14, 0),
(211, 'ILMU MANAJEMEN', 3, 4, 1),
(212, 'FARMASI RUMAH SAKIT', 10, 5, 0),
(213, 'KAJIAN HAK ATAS KEKAYAAN INTELEKTUAL', 2, 9, 0),
(214, 'KAJIAN ILMU KEPOLISIAN', 2, 9, 1),
(215, 'TEKNIK BIOMEDIS', 2, 8, 1),
(216, 'MANAJEMEN BENCANA', 2, 9, 1),
(218, 'ILMU KEDOKTERAN KLINIK', 2, 1, 1),
(219, 'ILMU KEDOKTERAN KLINIK', 2, 1, 0),
(220, 'GIZI', 1, 10, 1),
(221, 'PENDIDIKAN APOTEKER', 1, 5, 0),
(222, 'PENDIDIKAN APOTEKER', 9, 5, 0),
(223, 'PENDIDIKAN NERS', 1, 13, 0),
(224, 'PENDIDIKAN NERS', 9, 13, 0),
(225, 'ILMU PENYAKIT DAN KESEHATAN MASYARAKAT VETERINER', 2, 6, 0),
(226, 'ILMU LINGUISTIK', 2, 12, 1),
(227, 'ILMU GIZI', 1, 10, 0),
(228, 'PROGRAM MKWU', 1, 0, 0),
(229, 'EKONOMI UMUM', 1, 4, 0),
(230, 'EKONOMI PERUSAHAAN', 1, 4, 0),
(231, 'AKUNTANSI', 1, 4, 0),
(232, 'EPIDEMIOLOGI', 2, 10, 1),
(233, 'DD', 10, 1, 0),
(234, 'ILMU PENYAKIT SARAF', 10, 1, 0),
(235, 'FARMASI', 9, 5, 0),
(236, 'ILMU EKONOMI', 3, 9, 0),
(237, 'MANAJEMEN', 1, 4, 0),
(238, 'AKUNTANSI (K.BANYUWANGI)', 1, 4, 1),
(239, 'KESEHATAN MASYARAKAT (K.BANYUWANGI)', 1, 10, 1),
(240, 'KEDOKTERAN HEWAN (K.BANYUWANGI)', 1, 6, 1),
(241, 'AKUAKULTUR (K.BANYUWANGI)', 1, 14, 1),
(242, 'PENGOBAT TRADISIONAL', 4, 15, 1),
(243, 'FISIOTERAPI', 4, 15, 1),
(244, 'TEKNOLOGI RADIOLOGI PENCITRAAN', 4, 15, 1),
(245, 'ILMU BEDAH ANAK', 10, 1, 1),
(246, 'TEKNOLOGI HASIL PERIKANAN', 1, 14, 1),
(247, 'PENDIDIKAN DOKTER GIGI', 1, 2, 0),
(248, 'PENDIDIKAN DOKTER GIGI', 9, 2, 0),
(249, 'MAGISTER MANAJEMEN', 2, 9, 0),
(250, 'SUB SPESIALIS PENYAKIT DALAM', 46, 1, 1),
(251, 'ANESTESIOLOGI DAN TERAPI INTENSIF', 46, 1, 1),
(252, 'OBSTETRI DAN GINEKOLOGI', 46, 1, 1),
(253, 'SUB SPESIALIS ILMU KESEHATAN ANAK', 46, 1, 1),
(254, 'PATOLOGI KLINIK', 46, 1, 1),
(255, 'SUB SPESIALIS PSIKIATRI ANAK DAN REMAJA KONSULTAN', 46, 1, 1),
(256, 'BEDAH KEPALA LEHER ', 46, 1, 1),
(257, 'BEDAH DIGESTIF', 46, 1, 1),
(258, 'ILMU PENYAKIT PARU', 10, 1, 0),
(259, 'PERUBAHAN DAN PENGEMBANGAN ORGANISASI', 2, 11, 0),
(260, 'ILMU KARDIOLOGI DAN KEDOKTERAN VASKULAR', 10, 1, 0),
(261, 'KEPERAWATAN', 5, 15, 1),
(262, 'ILMU KEDOKTERAN GIGI', 3, 2, 1),
(263, 'KEPERAWATAN', 3, 13, 1),
(264, 'ANALIS MEDIS', 5, 15, 0),
(265, 'HIPERKES DAN KESELAMATAN KERJA', 5, 15, 0),
(266, 'KESEHATAN TERNAK', 5, 15, 0),
(267, 'MANAJEMEN KESEKRETARIATAN DAN PERKANTORAN', 5, 15, 0),
(268, 'RADIOLOGI', 4, 15, 0),
(269, 'TEKNIK KESEHATAN GIGI', 5, 15, 0),
(270, 'TEKNISI PERPUSTAKAAN', 5, 15, 0),
(271, 'ILMU DAN TEKNOLOGI LINGKUNGAN', 1, 8, 0),
(272, 'TEKNOBIOMEDIK', 1, 8, 0),
(273, 'ILMU DAN TEKNOLOGI LINGKUNGAN', 1, 8, 0),
(274, 'TEKNOLOGI INDUSTRI HASIL PERIKANAN', 1, 14, 0),
(275, 'BUDIDAYA PERAIRAN (PDD BANYUWANGI)', 1, 14, 0),
(276, 'ILMU KESEHATAN MASYARAKAT', 2, 10, 0),
(277, 'ILMU KESEHATAN', 3, 10, 0),
(278, 'ILMU BIOLOGI REPRODUKSI', 2, 6, 0),
(279, 'SASTRA JEPANG', 1, 12, 0),
(280, 'SASTRA INDONESIA', 1, 12, 0),
(281, 'SASTRA INGGRIS', 1, 12, 0),
(282, 'KEBIDANAN', 1, 1, 0),
(283, 'DD', 1, 1, 0),
(284, 'PENDIDIKAN DOKTER', 9, 1, 0),
(285, 'PENDIDIKAN BIDAN', 9, 1, 0),
(286, 'PENDIDIKAN PROFESI AKUNTANSI', 9, 4, 0),
(287, 'PENDIDIKAN DOKTER HEWAN', 1, 6, 0),
(288, 'PENDIDIKAN DOKTER HEWAN (PDD BANYUWANGI)', 1, 6, 0),
(289, 'PENDIDIKAN DOKTER HEWAN', 9, 6, 0),
(290, 'BUDIDAYA PERAIRAN', 1, 14, 0),
(291, 'ILMU KEDOKTERAN FORENSIK DAN MEDIKOLEGAL', 10, 1, 0),
(292, 'ILMU KESEHATAN KULIT DAN KELAMIN', 10, 1, 0),
(293, 'BEDAH DIGESTIF', 46, 1, 0),
(294, 'ILMU PENYAKIT DALAM', 46, 1, 0),
(295, 'PSIKIATRI ANAK DAN REMAJA', 46, 1, 0),
(296, 'PATOLOGI ANATOMI', 10, 1, 0),
(297, 'KEPERAWATAN', 5, 15, 0),
(298, 'ILMU PERIKANAN', 2, 14, 1),
(299, 'TEKNOBIOMEDIK', 2, 9, 0),
(300, 'ILMU EKONOMI ISLAM', 3, 9, 0),
(301, 'SAINS EKONOMI ISLAM', 2, 9, 0),
(302, 'BIOTEKNOLOGI PERIKANAN DAN KELAUTAN', 2, 9, 0),
(303, 'TEKNIK BIOMEDIS', 2, 9, 0),
(304, 'TEKNOLOGI SAINS DATA', 1, 16, 1),
(305, 'TEKNIK ROBOTIKA DAN KECERDASAN BUATAN', 1, 16, 1),
(306, 'REKAYASA NANOTEKNOLOGI', 1, 16, 1),
(307, 'TEKNIK ELEKTRO', 1, 16, 1),
(308, 'TEKNIK INDUSTRI', 1, 16, 1),
(309, 'NEUROLOGI', 10, 1, 0),
(310, 'KEPERAWATAN MEDIKAL BEDAH', 10, 13, 1),
(311, 'KEPERAWATAN (KELAS GRESIK)', 1, 13, 0),
(312, 'KEPERAWATAN (KELAS LAMONGAN)', 1, 13, 0),
(313, 'ILMU ADMINISTRASI NEGARA', 1, 7, 0),
(314, 'MBKM', 1, 50, 1),
(315, 'MBKM', 5, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(128) NOT NULL,
  `admin_username` varchar(128) NOT NULL,
  `admin_password` varchar(256) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `role_id`) VALUES
(9, 'arman', 'arman', '$2y$10$k4Rsiwu3SSRIL6vQTRLd4.m7/QPXWt9pTnwEC0KRLvAn05O2MhKIW', 1),
(11, 'RACHMAN SINATRIYA MARJIANTO', '198409182015043101', NULL, 1),
(12, 'RATNA AYU ISTINADLIROH', '151911513025', NULL, 3),
(13, 'Hestiningrum Triastuti', '198704012018013201', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_calon_ketua`
--

CREATE TABLE `tb_calon_ketua` (
  `calon_ketua_id` int(11) NOT NULL,
  `calon_ketua_nama` varchar(128) NOT NULL,
  `calon_ketua_nourut` varchar(16) NOT NULL,
  `calon_ketua_foto` varchar(128) NOT NULL,
  `calon_ketua_visimisi` text DEFAULT NULL,
  `calon_ketua_suara` int(11) NOT NULL,
  `tema_id` int(11) NOT NULL,
  `id_program_studi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_calon_ketua`
--

INSERT INTO `tb_calon_ketua` (`calon_ketua_id`, `calon_ketua_nama`, `calon_ketua_nourut`, `calon_ketua_foto`, `calon_ketua_visimisi`, `calon_ketua_suara`, `tema_id`, `id_program_studi`) VALUES
(18, 'mangga', '1', '11161-2001.png', NULL, 0, 5, NULL),
(19, 'jeruk', '1', 'Find+Your.png', NULL, 0, 7, 106),
(20, 'rambuta', '2', '20079809_1.jpg', NULL, 0, 5, NULL),
(21, 'kedondong', '1', 'gosip.png', NULL, 0, 6, NULL),
(22, 'duren', '2', 'link_and_match.jpg', NULL, 0, 6, NULL),
(23, 'blimbing', '2', 'shutterstock_737482015.png', NULL, 0, 7, 106),
(24, 'pepaya', '1', 'index.png', NULL, 0, 7, 138),
(25, 'pare', '2', 'esertif.jpg', NULL, 0, 7, 138);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemilih`
--

CREATE TABLE `tb_pemilih` (
  `pemilih_id` int(11) NOT NULL,
  `pemilih_akun` varchar(128) DEFAULT NULL,
  `pemilih_nama` varchar(128) DEFAULT NULL,
  `pemilih_utusan` varchar(128) DEFAULT NULL,
  `pemilih_email` varchar(128) DEFAULT NULL,
  `pemilih_contact` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `pemilih_foto` varchar(50) DEFAULT NULL,
  `pemilih_verifikasi` enum('0','1') NOT NULL,
  `pemilih_status` enum('0','1') NOT NULL,
  `otp` varchar(5) DEFAULT NULL,
  `id_program_studi` int(11) NOT NULL,
  `angkatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_pemilih`
--

INSERT INTO `tb_pemilih` (`pemilih_id`, `pemilih_akun`, `pemilih_nama`, `pemilih_utusan`, `pemilih_email`, `pemilih_contact`, `password`, `pemilih_foto`, `pemilih_verifikasi`, `pemilih_status`, `otp`, `id_program_studi`, `angkatan`) VALUES
(5, '151911513025', 'RATNA AYU ISTINADLIROH', NULL, NULL, '082335996605', NULL, NULL, '1', '1', 'MB848', 106, 2019),
(8, '151911813002', 'RATIH CATUR LINTANG CAHYANINGRUM', NULL, NULL, '082146117721', NULL, NULL, '1', '1', '71ITA', 138, 2019),
(10, '152011813016', 'ULIF WAKHIDATUL JANNAH', NULL, NULL, '085703020343', NULL, NULL, '1', '0', 'NISV3', 138, 2020),
(11, '151911513016', 'Alif Rachmad Kurniawan', NULL, NULL, '083845188774', NULL, NULL, '1', '0', 'THPGI', 106, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `tb_saksi`
--

CREATE TABLE `tb_saksi` (
  `saksi_id` int(11) NOT NULL,
  `saksi_nama` varchar(128) NOT NULL,
  `saksi_nip` varchar(128) NOT NULL,
  `saksi_pangkat` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tb_suara`
--

CREATE TABLE `tb_suara` (
  `suara_id` int(11) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `tema_id` int(11) NOT NULL,
  `calon_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `ip_pemilih` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_suara`
--

INSERT INTO `tb_suara` (`suara_id`, `nim`, `tema_id`, `calon_id`, `tanggal`, `ip_pemilih`) VALUES
(1, '151911513025', 5, 18, '0000-00-00 00:00:00', '127.0.0.1'),
(2, '151911513025', 6, 21, '0000-00-00 00:00:00', '127.0.0.1'),
(3, '151911513025', 7, 23, '0000-00-00 00:00:00', '127.0.0.1'),
(10, '151911813002', 5, 20, '0000-00-00 00:00:00', '127.0.0.1'),
(11, '151911813002', 6, 21, '0000-00-00 00:00:00', '127.0.0.1'),
(12, '151911813002', 7, 25, '0000-00-00 00:00:00', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tema_pemilihan`
--

CREATE TABLE `tb_tema_pemilihan` (
  `tema_id` int(11) NOT NULL,
  `tema_nama` varchar(256) NOT NULL,
  `tema_mulai` int(128) DEFAULT NULL,
  `tema_batas` int(128) DEFAULT NULL,
  `tema_logo` varchar(128) NOT NULL,
  `tema_is_active` enum('0','1') NOT NULL,
  `status` varchar(5) NOT NULL DEFAULT '0',
  `prodi` tinyint(1) NOT NULL DEFAULT 0,
  `status_vote` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_tema_pemilihan`
--

INSERT INTO `tb_tema_pemilihan` (`tema_id`, `tema_nama`, `tema_mulai`, `tema_batas`, `tema_logo`, `tema_is_active`, `status`, `prodi`, `status_vote`) VALUES
(5, 'BEM', 1633906800, 1635778320, '', '1', '0', 0, 1),
(6, 'BLM', 1633906800, 1635778320, '', '1', '0', 0, 1),
(7, 'HIMA', 1633906800, 1635778320, '', '1', '0', 1, 1),
(8, 'test', 1633906800, 1635778320, '', '0', '0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_role`
--

CREATE TABLE `tb_user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_user_role`
--

INSERT INTO `tb_user_role` (`role_id`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Admin Fakultas'),
(3, 'KPU');

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id_unit_kerja` int(11) NOT NULL,
  `nama_unit_kerja` varchar(100) NOT NULL,
  `deskripsi_unit_kerja` varchar(100) DEFAULT NULL,
  `type_unit_kerja` varchar(100) DEFAULT NULL,
  `id_unit_kerja_induk` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_fakultas` int(11) DEFAULT NULL,
  `id_program_studi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id_unit_kerja`, `nama_unit_kerja`, `deskripsi_unit_kerja`, `type_unit_kerja`, `id_unit_kerja_induk`, `status`, `id_fakultas`, `id_program_studi`) VALUES
(255, 'STATISTIKA', NULL, 'PRODI', 248, 0, 8, 175),
(260, 'Spesialis FARMASI RUMAH SAKIT (Tdk Aktif)', NULL, 'PRODI', 245, 0, 5, 212),
(261, 'FARMASI KLINIK', NULL, 'PRODI', 245, 1, 5, 172),
(262, 'S2 ILMU KEDOKTERAN KLINIK (Tdk Aktif)', NULL, 'PRODI', 221, 0, 1, 219),
(263, 'PENDIDIKAN PROFESI BIDAN', NULL, 'PRODI', 221, 1, 1, 195),
(264, 'ILMU KEDOKTERAN KLINIK', NULL, 'PRODI', 221, 1, 1, 218),
(265, 'ILMU AKUNTANSI', NULL, 'PRODI', 244, 1, 4, 152),
(266, 'ILMU MANAJEMEN', NULL, 'PRODI', 244, 1, 4, 211),
(95, 'ANESTESIOLOGI DAN TERAPI INTENSIF', NULL, 'PRODI', 221, 1, 1, 35),
(104, 'BEDAH MULUT DAN MAKSILOFASIAL', NULL, 'PRODI', 242, 1, 2, 44),
(109, 'ORTODONTI', NULL, 'PRODI', 242, 1, 2, 49),
(136, 'S2 COMBINED DEGREE SPESIALIS FARMASI DAN MAGISTER FARMASI KLINIK (Tdk Aktif)', NULL, 'PRODI', 245, 0, 5, 76),
(221, 'Fakultas Kedokteran', NULL, 'FAKULTAS', 221, 1, 1, NULL),
(241, 'STATISTIKA', NULL, 'PRODI', 248, 1, 8, 175),
(242, 'Fakultas Kedokteran Gigi', NULL, 'FAKULTAS', 242, 1, 2, NULL),
(243, 'Fakultas Hukum', NULL, 'FAKULTAS', 243, 1, 3, NULL),
(244, 'Fakultas Ekonomi dan Bisnis', NULL, 'FAKULTAS', 244, 1, 4, NULL),
(245, 'Fakultas Farmasi', NULL, 'FAKULTAS', 245, 1, 5, NULL),
(246, 'Fakultas Kedokteran Hewan', NULL, 'FAKULTAS', 246, 1, 6, NULL),
(247, 'Fakultas Ilmu Sosial Ilmu Politik', NULL, 'FAKULTAS', 247, 1, 7, NULL),
(248, 'Fakultas Sains dan Teknologi', NULL, 'FAKULTAS', 248, 1, 8, NULL),
(249, 'Sekolah Pascasarjana', NULL, 'FAKULTAS', 249, 1, 9, NULL),
(250, 'Fakultas Kesehatan Masyarakat', NULL, 'FAKULTAS', 250, 1, 10, NULL),
(251, 'Fakultas Psikologi', NULL, 'FAKULTAS', 251, 1, 11, NULL),
(252, 'Fakultas Ilmu Budaya', NULL, 'FAKULTAS', 252, 1, 12, NULL),
(253, 'Fakultas Keperawatan', NULL, 'FAKULTAS', 253, 1, 13, NULL),
(254, 'Fakultas Perikanan dan Kelautan', NULL, 'FAKULTAS', 254, 1, 14, NULL),
(256, 'TEKNIK BIOMEDIS', NULL, 'PRODI', 249, 1, 8, 215),
(257, 'KAJIAN HAK ATAS KEKAYAAN INTELEKTUAL', NULL, 'PRODI', 249, 0, 9, 213),
(258, 'KAJIAN ILMU KEPOLISIAN', NULL, 'PRODI', 249, 1, 9, 214),
(259, 'MANAJEMEN BENCANA', NULL, 'PRODI', 249, 1, 9, 216),
(1, 'Perpustakaan', 'Perpustakaan', 'LEMBAGA', 1, 1, NULL, NULL),
(2, 'Direktorat Pendidikan', 'Direktorat Pendidikan', 'REKTORAT', 2, 1, 0, NULL),
(61, 'TEKNOLOGI LABORATORIUM MEDIS', NULL, 'PRODI', 306, 1, 15, 1),
(62, 'FISIOTERAPI', NULL, 'PRODI', 306, 1, 15, 2),
(63, 'RADIOLOGI', NULL, 'PRODI', 306, 1, 15, 3),
(64, 'PENGOBAT TRADISIONAL', NULL, 'PRODI', 306, 1, 15, 4),
(65, 'PENDIDIKAN PROFESI DOKTER', NULL, 'PRODI', 221, 1, 1, 5),
(66, 'KEBIDANAN', NULL, 'PRODI', 221, 1, 1, 6),
(67, 'KEDOKTERAN', NULL, 'PRODI', 221, 1, 1, 7),
(68, 'S2 DD-MASTER OF HEALTH SCIENCE IN NURSING (Tdk Aktif)', NULL, 'PRODI', 221, 0, 1, 8),
(69, 'ILMU KESEHATAN REPRODUKSI', NULL, 'PRODI', 221, 1, 1, 9),
(70, 'ILMU KESEHATAN OLAH RAGA', NULL, 'PRODI', 221, 1, 1, 10),
(71, 'ILMU FORENSIK', NULL, 'PRODI', 249, 1, 9, 11),
(72, 'IMUNOLOGI', NULL, 'PRODI', 249, 1, 9, 12),
(73, 'ILMU KEDOKTERAN TROPIS', NULL, 'PRODI', 221, 1, 1, 13),
(74, 'ILMU KEDOKTERAN DASAR', NULL, 'PRODI', 221, 1, 1, 14),
(75, 'JANTUNG DAN PEMBULUH DARAH', NULL, 'PRODI', 221, 1, 1, 15),
(76, 'PATOLOGI ANATOMIK', NULL, 'PRODI', 221, 1, 1, 16),
(77, 'PATOLOGI KLINIK', NULL, 'PRODI', 221, 1, 1, 17),
(78, 'ILMU KEDOKTERAN FISIK DAN REHABILITASI', NULL, 'PRODI', 221, 1, 1, 18),
(79, 'RADIOLOGI', NULL, 'PRODI', 221, 1, 1, 19),
(80, 'Spesialis ILMU KEDOKTERAN JIWA (Tdk Aktif)', NULL, 'PRODI', 221, 0, 1, 20),
(81, 'ILMU BEDAH SARAF', NULL, 'PRODI', 221, 1, 1, 21),
(82, 'ANDROLOGI', NULL, 'PRODI', 221, 1, 1, 22),
(83, 'MIKROBIOLOGI KLINIK', NULL, 'PRODI', 221, 1, 1, 23),
(84, 'BEDAH TORAKS, KARDIAK, DAN VASKULER', NULL, 'PRODI', 221, 1, 1, 24),
(85, 'ORTHOPAEDI DAN TRAUMATOLOGI', NULL, 'PRODI', 221, 1, 1, 25),
(86, 'ILMU KESEHATAN ANAK', NULL, 'PRODI', 221, 1, 1, 26),
(87, 'KEDOKTERAN FORENSIK DAN STUDI MEDIKOLEGAL ', NULL, 'PRODI', 221, 1, 1, 27),
(88, 'UROLOGI', NULL, 'PRODI', 221, 1, 1, 28),
(89, 'ILMU KESEHATAN MATA', NULL, 'PRODI', 221, 1, 1, 29),
(90, 'ILMU PENYAKIT DALAM', NULL, 'PRODI', 221, 1, 1, 30),
(91, 'NEUROLOGI', NULL, 'PRODI', 221, 1, 1, 31),
(92, 'BEDAH PLASTIK REKONSTRUKSI DAN ESTETIK', NULL, 'PRODI', 221, 1, 1, 32),
(93, 'DERMATOLOGI DAN VENEREOLOGI', NULL, 'PRODI', 221, 1, 1, 33),
(94, 'ILMU KESEHATAN TELINGA HIDUNG TENGGOROK BEDAH KEPALA DAN LEHER', NULL, 'PRODI', 221, 1, 1, 34),
(96, 'ILMU BEDAH', NULL, 'PRODI', 221, 1, 1, 36),
(97, 'OBSTETRI DAN GINEKOLOGI ', NULL, 'PRODI', 221, 1, 1, 37),
(98, 'PULMONOLOGI DAN ILMU KEDOKTERAN RESPIRASI', NULL, 'PRODI', 221, 1, 1, 38),
(99, 'TEKNIK GIGI', NULL, 'PRODI', 306, 1, 15, 39),
(100, 'PENDIDIKAN PROFESI DOKTER GIGI', NULL, 'PRODI', 242, 1, 2, 40),
(101, 'KEDOKTERAN GIGI', NULL, 'PRODI', 242, 1, 2, 41),
(102, 'ILMU KESEHATAN GIGI', NULL, 'PRODI', 242, 1, 2, 42),
(103, 'ILMU KONSERVASI GIGI', NULL, 'PRODI', 242, 1, 2, 43),
(105, 'ILMU PENYAKIT MULUT', NULL, 'PRODI', 242, 1, 2, 45),
(106, 'KEDOKTERAN GIGI ANAK', NULL, 'PRODI', 242, 1, 2, 46),
(107, 'Spesialis SPESIALIS F K G (Tdk Aktif)', NULL, 'PRODI', 242, 0, 2, 47),
(108, 'PROSTODONSIA', NULL, 'PRODI', 242, 1, 2, 48),
(110, 'PERIODONSIA', NULL, 'PRODI', 242, 1, 2, 50),
(111, 'ILMU HUKUM', NULL, 'PRODI', 243, 1, 3, 51),
(112, 'SAINS HUKUM DAN PEMBANGUNAN', NULL, 'PRODI', 249, 1, 9, 52),
(113, 'S2 SAIN HUKUM (Tdk Aktif)', NULL, 'PRODI', 243, 0, 3, 53),
(114, 'KENOTARIATAN', NULL, 'PRODI', 243, 1, 3, 54),
(115, 'ILMU HUKUM', NULL, 'PRODI', 243, 1, 3, 55),
(116, 'ILMU HUKUM', NULL, 'PRODI', 243, 1, 3, 56),
(117, 'MANAJEMEN PERBANKAN', NULL, 'PRODI', 306, 1, 15, 57),
(118, 'ADMINISTRASI PERKANTORAN', NULL, 'PRODI', 306, 1, 15, 58),
(119, 'AKUNTANSI', NULL, 'PRODI', 306, 1, 15, 59),
(120, 'PERPAJAKAN', NULL, 'PRODI', 306, 1, 15, 60),
(121, 'MANAJEMEN PEMASARAN', NULL, 'PRODI', 306, 1, 15, 61),
(122, 'MANAJEMEN PERHOTELAN', NULL, 'PRODI', 306, 1, 15, 62),
(123, 'PENDIDIKAN PROFESI AKUNTAN', NULL, 'PRODI', 244, 1, 4, 63),
(124, 'AKUNTANSI', NULL, 'PRODI', 244, 1, 4, 64),
(125, 'EKONOMI PEMBANGUNAN', NULL, 'PRODI', 244, 1, 4, 65),
(126, 'MANAJEMEN', NULL, 'PRODI', 244, 1, 4, 66),
(127, 'EKONOMI ISLAM', NULL, 'PRODI', 244, 1, 4, 67),
(128, 'ILMU EKONOMI', NULL, 'PRODI', 244, 1, 4, 68),
(129, 'SAINS EKONOMI ISLAM', NULL, 'PRODI', 249, 1, 4, 69),
(130, 'S2 SAINS EKONOMI (Tdk Aktif)', NULL, 'PRODI', 244, 0, 4, 70),
(131, 'AKUNTANSI', NULL, 'PRODI', 244, 1, 4, 71),
(132, 'SAINS MANAJEMEN', NULL, 'PRODI', 244, 1, 4, 72),
(133, 'MAGISTER MANAJEMEN', NULL, 'PRODI', 244, 1, 4, 73),
(134, 'PENDIDIKAN PROFESI APOTEKER', NULL, 'PRODI', 245, 1, 5, 74),
(135, 'FARMASI', NULL, 'PRODI', 245, 1, 5, 75),
(137, 'ILMU FARMASI', NULL, 'PRODI', 245, 1, 5, 77),
(138, 'SPESIALIS FARMASI', NULL, 'PRODI', 245, 1, 5, 78),
(139, 'PARAMEDIK VETERINER', NULL, 'PRODI', 306, 1, 15, 79),
(140, 'D3 KESEHATAN SATWA LIAR (Tdk Aktif)', NULL, 'PRODI', 246, 0, 6, 80),
(141, 'D3 BUDIDAYA PERIKANAN (Tdk Aktif)', NULL, 'PRODI', 246, 0, 6, 81),
(142, 'D3 PERUNGGASAN (Tdk Aktif)', NULL, 'PRODI', 246, 0, 6, 82),
(143, 'PENDIDIKAN PROFESI DOKTER HEWAN', NULL, 'PRODI', 246, 1, 6, 83),
(144, 'KEDOKTERAN HEWAN', NULL, 'PRODI', 246, 1, 6, 84),
(145, 'VAKSINOLOGI DAN IMUNOTERAPETIKA', NULL, 'PRODI', 246, 1, 6, 85),
(146, 'ILMU PENYAKIT DAN KESEHATAN MASYARAKAT VETERINER', NULL, 'PRODI', 246, 1, 6, 86),
(147, 'BIOLOGI REPRODUKSI', NULL, 'PRODI', 246, 1, 6, 87),
(148, 'AGRIBISNIS VETERINER', NULL, 'PRODI', 246, 1, 6, 88),
(149, 'PERPUSTAKAAN', NULL, 'PRODI', 306, 1, 15, 89),
(150, 'KEPARIWISATAAN / BINA WISATA', NULL, 'PRODI', 306, 1, 15, 90),
(151, 'SOSIOLOGI', NULL, 'PRODI', 247, 1, 7, 91),
(152, 'ILMU KOMUNIKASI', NULL, 'PRODI', 247, 1, 7, 92),
(153, 'ILMU HUBUNGAN INTERNASIONAL', NULL, 'PRODI', 247, 1, 7, 93),
(154, 'ADMINISTRASI PUBLIK', NULL, 'PRODI', 247, 1, 7, 94),
(155, 'ANTROPOLOGI', NULL, 'PRODI', 247, 1, 7, 95),
(156, 'ILMU INFORMASI DAN PERPUSTAKAAN', NULL, 'PRODI', 247, 1, 7, 96),
(157, 'ILMU POLITIK', NULL, 'PRODI', 247, 1, 7, 97),
(158, 'KEBIJAKAN PUBLIK', NULL, 'PRODI', 247, 1, 7, 98),
(159, 'SOSIOLOGI', NULL, 'PRODI', 247, 1, 7, 99),
(160, 'MEDIA DAN KOMUNIKASI', NULL, 'PRODI', 247, 1, 7, 150),
(161, 'HUBUNGAN INTERNASIONAL', NULL, 'PRODI', 247, 1, 7, 101),
(162, 'ILMU POLITIK', NULL, 'PRODI', 247, 1, 7, 102),
(163, 'PENGEMBANGAN SUMBER DAYA MANUSIA', NULL, 'PRODI', 249, 1, 9, 103),
(164, 'S2 ILMU-ILMU SOSIAL (Tdk Aktif)', NULL, 'PRODI', 247, 0, 7, 104),
(165, 'OTOMASI SISTEM INSTRUMENTASI', NULL, 'PRODI', 306, 1, 15, 105),
(166, 'SISTEM INFORMASI', NULL, 'PRODI', 306, 1, 15, 106),
(167, 'MATEMATIKA', NULL, 'PRODI', 248, 1, 8, 107),
(168, 'FISIKA', NULL, 'PRODI', 248, 1, 8, 108),
(169, 'KIMIA', NULL, 'PRODI', 248, 1, 8, 109),
(170, 'BIOLOGI', NULL, 'PRODI', 248, 1, 8, 110),
(171, 'TEKNIK LINGKUNGAN', NULL, 'PRODI', 248, 1, 8, 111),
(172, 'SISTEM INFORMASI', NULL, 'PRODI', 248, 1, 8, 112),
(173, 'TEKNIK BIOMEDIS', NULL, 'PRODI', 248, 1, 8, 113),
(174, 'S2 DD-MASTER ON BIOCHEMISTRY AND BIOTECHNOLOGY (Tdk Aktif)', NULL, 'PRODI', 248, 0, 8, 114),
(175, 'BIOLOGI', NULL, 'PRODI', 248, 1, 8, 115),
(176, 'KIMIA', NULL, 'PRODI', 248, 1, 8, 116),
(177, 'MATEMATIKA DAN ILMU PENGETAHUAN ALAM', NULL, 'PRODI', 248, 1, 8, 117),
(178, 'ILMU FARMASI', NULL, 'PRODI', 245, 1, 5, 118),
(179, 'S3 S3 AKUNTANSI (Tdk Aktif)', NULL, 'PRODI', 249, 0, 9, 119),
(180, 'PSIKOLOGI', NULL, 'PRODI', 251, 1, 11, 120),
(181, 'KESEHATAN MASYARAKAT', NULL, 'PRODI', 250, 1, 10, 121),
(182, 'ILMU EKONOMI ISLAM', NULL, 'PRODI', 249, 1, 4, 122),
(183, 'PENGEMBANGAN SUMBER DAYA MANUSIA', NULL, 'PRODI', 249, 1, 9, 123),
(184, 'ILMU SOSIAL', NULL, 'PRODI', 247, 1, 7, 124),
(185, 'ILMU EKONOMI', NULL, 'PRODI', 244, 1, 4, 125),
(186, 'ILMU KEDOKTERAN JENJANG DOKTOR', NULL, 'PRODI', 221, 1, 1, 126),
(187, 'SAINS VETERINER', NULL, 'PRODI', 246, 1, 6, 127),
(188, 'KESELAMATAN DAN KESEHATAN KERJA', NULL, 'PRODI', 306, 1, 15, 128),
(189, 'KESEHATAN MASYARAKAT', NULL, 'PRODI', 250, 1, 10, 129),
(190, 'ADMINISTRASI DAN KEBIJAKAN KESEHATAN', NULL, 'PRODI', 250, 1, 10, 130),
(191, 'KESEHATAN MASYARAKAT', NULL, 'PRODI', 250, 1, 10, 131),
(192, 'KESEHATAN DAN KESELAMATAN KERJA', NULL, 'PRODI', 250, 1, 10, 132),
(193, 'KESEHATAN LINGKUNGAN', NULL, 'PRODI', 250, 1, 10, 133),
(194, 'PSIKOLOGI', NULL, 'PRODI', 251, 1, 11, 134),
(195, 'PSIKOLOGI TERAPAN', NULL, 'PRODI', 251, 1, 11, 135),
(196, 'PSIKOLOGI', NULL, 'PRODI', 251, 1, 11, 136),
(197, 'PSIKOLOGI PROFESI ', NULL, 'PRODI', 251, 1, 11, 137),
(198, 'BAHASA INGGRIS', NULL, 'PRODI', 306, 1, 15, 138),
(199, 'ILMU SEJARAH', NULL, 'PRODI', 252, 1, 12, 139),
(200, 'STUDI KEJEPANGAN', NULL, 'PRODI', 252, 1, 12, 140),
(201, 'BAHASA DAN SASTRA INDONESIA', NULL, 'PRODI', 252, 1, 12, 141),
(202, 'BAHASA DAN SASTRA INGGRIS', NULL, 'PRODI', 252, 1, 12, 142),
(203, 'KAJIAN SASTRA DAN BUDAYA', NULL, 'PRODI', 252, 1, 12, 143),
(204, 'PENDIDIKAN PROFESI NERS', NULL, 'PRODI', 253, 1, 13, 144),
(205, 'KEPERAWATAN', NULL, 'PRODI', 253, 1, 13, 145),
(206, 'KEPERAWATAN', NULL, 'PRODI', 253, 1, 13, 146),
(207, 'AKUAKULTUR', NULL, 'PRODI', 254, 1, 14, 147),
(208, 'BIOTEKNOLOGI PERIKANAN DAN KELAUTAN', NULL, 'PRODI', 249, 1, 14, 148),
(22, 'Lembaga Penelitian dan Inovasi', 'Lembaga Penelitian dan Inovasi', 'LEMBAGA', 22, 1, NULL, NULL),
(23, 'P4UA', 'Lemb.Pengkajian & Pengemb.Pend', 'LEMBAGA', 23, 0, NULL, NULL),
(24, 'Pusat Penerbitan dan Percetakan', 'Pusat Penerbitan', 'LEMBAGA', 24, 1, NULL, NULL),
(25, 'LDB', 'Lab Dasar Bersama', 'LEMBAGA', 25, 0, NULL, NULL),
(26, 'ITD', 'Institute Tropical Desease ', 'LEMBAGA', 26, 0, NULL, NULL),
(27, 'PPHM', 'Pusat Perancangan Hukum', 'LEMBAGA', 27, 0, NULL, NULL),
(28, 'ME', 'Mikroskop Elektron', 'LEMBAGA', 28, 0, NULL, NULL),
(29, 'TPB', 'Tingkat Persiapan Bersama', 'LEMBAGA', 29, 0, NULL, NULL),
(30, 'Direktorat Sistem Informasi dan Digitalisasi ', 'Direktorat Sistem Informasi', 'REKTORAT', 30, 1, NULL, NULL),
(31, 'Direktorat Sumber Daya Manusia', 'Direktorat Sumber Daya Manusia', 'REKTORAT', 31, 1, NULL, NULL),
(32, 'Direktorat Keuangan', 'Direktorat Keuangan', 'REKTORAT', 32, 1, NULL, NULL),
(33, 'Direktorat Kemahasiswaan', 'Direktorat Kemahasiswaan', 'REKTORAT', 33, 1, NULL, NULL),
(34, 'Sekretaris Universitas', 'Sekretaris Universitas', 'LEMBAGA', 34, 1, NULL, NULL),
(35, 'Badan Penjaminan Mutu', 'Badan Penjaminan Mutu', 'LEMBAGA', 35, 1, NULL, NULL),
(36, 'Badan Perencanaan dan Pengembangan', 'Badan Perencanaan dan Pengembangan', 'LEMBAGA', 36, 1, NULL, NULL),
(37, 'Badan Pengawas Internal', 'Badan Pengawas Internal ', 'LEMBAGA', 37, 1, NULL, NULL),
(38, 'Lembaga Penyakit Tropis', 'Lembaga Penyakit Tropis', 'LEMBAGA', 38, 1, NULL, NULL),
(39, 'Airlangga Global Engagement', NULL, 'LEMBAGA', 39, 1, NULL, NULL),
(40, 'Rumah Sakit Univeritas Airlangga', 'Rumah Sakit Pendidikan', 'LEMBAGA', 40, 1, NULL, NULL),
(41, 'Pusat Bahasa dan Multi Budaya', 'Pusat Info & Layanan Bahasa', 'LEMBAGA', 41, 1, NULL, NULL),
(42, 'PLK', 'Pusat Layanan Kesehatan', 'LEMBAGA', 42, 1, NULL, NULL),
(43, 'PPMB', 'Pusat Penerimaan Mhs. Baru', 'LEMBAGA', 43, 1, NULL, NULL),
(44, 'Asrama Mahasiswa', 'Asrama Mahasiswa UA', 'LEMBAGA', 44, 1, NULL, NULL),
(288, 'Pusat Pengembangan Media dan Kehumasan  ', ' Pusat Pengembangan Media dan Kehumasan', 'LEMBAGA', 288, 1, NULL, NULL),
(267, 'GIZI', NULL, 'PRODI', 250, 1, 10, 220),
(289, 'LP3', 'Lembaga pengkajian dan Pengembangan Pendidikan', 'LEMBAGA', 289, 0, NULL, NULL),
(268, 'Majelis Wali Amanat', 'Organ Universitas', 'ORGAN', 268, 0, NULL, NULL),
(269, 'Dewan Audit', 'Organ Universitas', 'ORGAN', 269, 0, NULL, NULL),
(270, 'Senat Akademik', 'Organ Universitas', 'ORGAN', 270, 1, NULL, NULL),
(271, 'Bidang Administrasi dan Kearsipan', NULL, 'SEKRETARIAT', 34, 0, NULL, NULL),
(272, 'Bidang Hukum', NULL, 'SEKRETARIAT', 34, 0, NULL, NULL),
(273, 'Sub Direktorat Administrasi Pendidikan', NULL, 'SUBDIR', 2, 0, NULL, NULL),
(274, 'Sub Direktorat Pengembangan Pendidikan', NULL, 'SUBDIR', 2, 0, NULL, NULL),
(275, 'Sub Direktorat Program Kemahasiswaan', NULL, 'SUBDIR', 33, 0, NULL, NULL),
(276, 'Sub Direktorat Kesejahteraan Kemahasiswaan dan Urusan Alumni', NULL, 'SUBDIR', 33, 0, NULL, NULL),
(277, 'Sub Direktorat Kepegawaian', NULL, 'SUBDIR', 31, 0, NULL, NULL),
(278, 'Sub Direktorat SDM dan Organisasi', NULL, 'SUBDIR', 31, 0, NULL, NULL),
(279, 'Sub Direktorat Pengelolaan Sarana dan Prasarana', NULL, 'SUBDIR', 350, 0, NULL, NULL),
(280, 'Sub Direktorat Pengembangan Sarana dan Prasarana', NULL, 'SUBDIR', 31, 0, NULL, NULL),
(281, 'Sub Direktorat Keselamatan dan Kesehatan Kerja', NULL, 'SUBDIR', 350, 0, NULL, NULL),
(282, 'Sub Direktorat Perbendaharaan', NULL, 'SUBDIR', 32, 0, NULL, NULL),
(283, 'Sub Direktorat Akuntansi', NULL, 'SUBDIR', 32, 0, NULL, NULL),
(284, 'Sub Direktorat Anggaran', NULL, 'SUBDIR', 32, 0, NULL, NULL),
(285, 'Sub Direktorat Operasional Sistem Informasi', NULL, 'SUBDIR', 30, 0, NULL, NULL),
(286, 'Sub Direktorat Pengembangan Sistem', NULL, 'SUBDIR', 30, 0, NULL, NULL),
(287, 'Rektor dan Wakil Rektor', NULL, 'REKTORAT', 287, 0, NULL, NULL),
(290, 'Bidang Arsip', NULL, 'SEKRETARIAT', 34, 0, NULL, NULL),
(296, 'Pusat Pembinaan Karir dan Kewirausahaan', 'PPKK UA', 'LEMBAGA', 296, 1, NULL, NULL),
(297, 'Rumah Sakit Khusus Infeksi', 'RSKI UA', 'LEMBAGA', 297, 1, NULL, NULL),
(298, 'Rumah Sakit Gigi dan Mulut Pendidikan', 'RSGM FKG UA', NULL, 298, 0, NULL, NULL),
(292, 'ILMU LINGUISTIK', NULL, 'PRODI', 252, 1, 12, 226),
(295, 'Spesialis ILMU PENYAKIT SARAF (Tdk Aktif)', NULL, 'PRODI', NULL, 0, 1, NULL),
(293, 'EPIDEMIOLOGI', NULL, 'PRODI', 250, 0, 10, 232),
(294, 'Spesialis ILMU RADIOLOGI (Tdk Aktif)', NULL, 'PRODI', NULL, 0, 1, NULL),
(301, 'Seksi Networking', 'Membawahi Staf Seksi Hardware dan Jaringan', 'SEKSI', 285, 0, NULL, NULL),
(302, 'Seksi Security Data', 'Membawahi Staf Keamanan Data', 'SEKSI', 285, 0, NULL, NULL),
(303, 'Seksi Informatic Branding', 'Membawahi Staf Informatic Branding', 'SEKSI', 285, 0, NULL, NULL),
(305, 'S1 MANAJEMEN (Tdk Aktif)', NULL, 'PRODI', NULL, 0, 4, NULL),
(307, 'AKUNTANSI (K.BANYUWANGI)', NULL, 'PRODI', 244, 0, 4, 238),
(312, 'FISIOTERAPI', NULL, 'PRODI', 306, 1, 15, 243),
(317, 'Akademik & Kemahasiswaan (PddBywi)', NULL, 'LEMBAGA', 316, 0, NULL, NULL),
(318, 'Sumber Daya Manusia (Pdd Bywi)', NULL, NULL, 316, 0, NULL, NULL),
(320, 'TEKNOLOGI HASIL PERIKANAN', NULL, 'PRODI', NULL, 0, 14, 246),
(322, 'LP3T', 'Lembaga Pengkajian & Pengembangan Psikologi Terapan', 'LEMBAGA', NULL, 0, NULL, NULL),
(323, 'LPPAPSI', 'Laboratorium Pengkajian Pengembangan Akuntansi Perpajakan dan SI', 'LEMBAGA', NULL, 0, NULL, NULL),
(324, 'TDDC', 'Tropical Disease Diagnostics Center', 'LEMBAGA', NULL, 0, NULL, NULL),
(325, 'Graha BIK-IPTEKDOK', 'Graha BIK-IPTEKDOK', 'LEMBAGA', NULL, 0, NULL, NULL),
(334, 'SUB SPESIALIS PSIKIATRI ANAK DAN REMAJA KONSULTAN', NULL, 'PRODI', 65, 0, 1, 255),
(337, 'ILMU PENYAKIT PARU', NULL, 'PRODI', NULL, 0, 1, 258),
(343, 'Lembaga Penelitian dan Pengabdian Masyarakat 1', 'Lembaga Penelitian dan Pengabdian kepada Masyarakat', 'LEMBAGA', NULL, 0, NULL, NULL),
(344, 'Badan Pengembangan Bisnis Rintisan dan Inkubasi ', NULL, 'LEMBAGA', 344, 1, NULL, NULL),
(345, 'Pusat Layanan Pengadaan', NULL, 'Lembaga', 345, 0, NULL, NULL),
(299, 'Profesi FARMASI (Tdk Aktif)', NULL, 'PRODI', 245, 0, 5, 235),
(300, 'Seksi Sub Direktorat Pengembangan Sistem', 'Membawahi Staf Seksi Sub Direktorat Pengembangan Sistem', 'SEKSI', 286, 0, NULL, NULL),
(306, 'Fakultas Vokasi', 'Fakultas', 'FAKULTAS', 306, 1, 15, NULL),
(308, 'KESEHATAN MASYARAKAT (K.BANYUWANGI)', NULL, 'PRODI', 250, 1, 10, 239),
(310, 'AKUAKULTUR (K.BANYUWANGI)', NULL, 'PRODI', 254, 0, 14, 241),
(314, 'ILMU BEDAH ANAK', NULL, 'PRODI', 221, 0, 1, 245),
(316, 'Program Studi Di Luar Kampus Utama - Banyuwangi', 'Program Studi Di Luar Kampus Utama - Banyuwangi', 'LEMBAGA', 316, 1, NULL, NULL),
(321, 'DD', NULL, 'PRODI', 221, 0, 1, 233),
(327, 'PENDIDIKAN DOKTER GIGI', NULL, 'PRODI', 242, 0, 2, 248),
(329, 'SUB SPESIALIS PENYAKIT DALAM', NULL, 'PRODI', NULL, 1, 1, 250),
(331, 'OBSTETRI DAN GINEKOLOGI', NULL, 'PRODI', 221, 1, 1, 252),
(332, 'SUB SPESIALIS ILMU KESEHATAN ANAK', NULL, 'PRODI', NULL, 0, 1, 253),
(333, 'PATOLOGI KLINIK', NULL, 'PRODI', NULL, 0, 1, 254),
(335, 'BEDAH KEPALA LEHER ', NULL, 'PRODI', NULL, 0, 1, 256),
(367, 'Institut Ilmu Kesehatan', NULL, 'LEMBAGA', 367, 1, NULL, NULL),
(348, 'Pusat Pengembangan Jurnal dan Publikasi Ilmiah', 'Pusat Pengembangan Jurnal dan Publikasi Ilmiah', 'LEMBAGA', 348, 1, NULL, NULL),
(368, 'Badan Pengawas Intern', NULL, 'LEMBAGA', 368, 0, NULL, NULL),
(350, 'Direktorat Logistik, Keamanan, Ketertiban dan Lingkungan', 'Direktorat Sarana Prasarana dan Lingkungan', 'REKTORAT', 350, 1, NULL, NULL),
(370, 'Lembaga Penelitian dan Pengabdian Kepada Masyarakat', 'Lembaga Pengabdian Kepada Masyarakat', 'LEMBAGA', 370, 1, NULL, NULL),
(304, 'S3 ILMU EKONOMI (Tdk Aktif)', NULL, 'PRODI', NULL, 0, 9, NULL),
(309, 'KEDOKTERAN HEWAN (K.BANYUWANGI)', NULL, 'PRODI', 246, 0, 6, 240),
(311, 'PENGOBAT TRADISIONAL', NULL, 'PRODI', 306, 0, 15, 242),
(313, 'TEKNOLOGI RADIOLOGI PENCITRAAN', NULL, 'PRODI', 306, 0, 15, 244),
(315, 'S1 MKWU', NULL, 'PRODI', 703, 1, 0, 228),
(319, 'SISTEM INFORMASI', NULL, 'PRODI', 306, 0, 15, 106),
(326, 'PENDIDIKAN DOKTER GIGI', NULL, 'PRODI', 242, 0, 2, 247),
(328, 'S2 MAGISTER MANAJEMEN', NULL, 'PRODI', NULL, 0, 9, 249),
(330, 'ANESTESIOLOGI DAN TERAPI INTENSIF', NULL, 'PRODI', 221, 1, 1, 251),
(336, 'BEDAH DIGESTIF', NULL, 'PRODI', 221, 0, 1, 257),
(338, 'PPTSI', 'Pusat Pengembangan Teknologi dan Sistem Informasi', 'LEMBAGA', 338, 0, NULL, NULL),
(340, 'Sarana Prasarana dan Lingkungan', NULL, 'Rektorat', NULL, 0, NULL, NULL),
(341, 'Institut Ilmu Lingkungan', NULL, 'Lembaga', NULL, 0, NULL, NULL),
(374, 'PENDIDIKAN APOTEKER', NULL, 'PRODI', 245, 0, 5, 222),
(377, 'Pusat Penelitian dan Pengembangan Stem Cell', 'Pusat Penelitian dan Pengembangan Stem Cell', 'LEMBAGA', 377, 1, 17, NULL),
(378, 'KESEHATAN DAN KESELAMATAN KERJA', 'UNIT REKTORAT', 'REKTORAT', 378, 0, NULL, NULL),
(499, 'LEMBAGA PENGEMBANGAN BISNIS DAN INKUBASI', NULL, 'LEMBAGA', NULL, 0, NULL, NULL),
(500, 'KOSONG', 'DIKUSUSKAN BAGI PEGAWAI YANG SUDAH TIDAK AKTIF', NULL, NULL, 0, NULL, NULL),
(505, 'BEDAH PLASTIK', NULL, NULL, NULL, 1, 1, NULL),
(506, 'BEDAH SARAF', NULL, NULL, NULL, 1, 1, NULL),
(507, 'ILMU FAAL', NULL, NULL, NULL, 1, 1, NULL),
(508, 'ILMU KEDOKTERAN FORENSIK DAN MEDIKOLEGAL', NULL, NULL, NULL, 1, 1, NULL),
(509, 'ILMU KESEHATAN TELINGA HIDUNG TENGGOROKAN - BEDAH KEPALA DAN LEHER (THT-KL)', NULL, NULL, NULL, 1, 1, NULL),
(510, 'ORTHOPEDI DANTRAUMATOLOGI', NULL, NULL, NULL, 1, 1, NULL),
(511, 'UROLOGI', NULL, NULL, NULL, 0, 1, NULL),
(512, 'ANATOMI HISTOLOGI', NULL, NULL, NULL, 1, 1, NULL),
(513, 'ANESTESIOLOGI DAN REANIMASI', NULL, NULL, NULL, 1, 1, NULL),
(514, 'BIOKIMIA KEDOKTERAN', NULL, NULL, NULL, 1, 1, NULL),
(515, 'BIOLOGI KEDOKTERAN', NULL, NULL, NULL, 1, 1, NULL),
(516, 'FARMAKOLOGI', NULL, NULL, NULL, 1, 1, NULL),
(517, 'ILMU KEDOKTERAN JIWA', NULL, NULL, NULL, 1, 1, NULL),
(518, 'ILMU KESEHATAN ANAK', NULL, NULL, NULL, 0, 1, NULL),
(519, 'ILMU KESEHATAN FISIK DAN REHABILITASI', NULL, NULL, NULL, 1, 1, NULL),
(520, 'ILMU KESEHATAN KULIT DAN KELAMIN', NULL, NULL, NULL, 1, 1, NULL),
(521, 'ILMU KESEHATAN MATA', NULL, NULL, NULL, 0, 1, NULL),
(522, 'ILMU PENYAKIT DALAM', NULL, NULL, NULL, 0, 1, NULL),
(523, 'ILMU PENYAKIT PARU', NULL, NULL, NULL, 1, 1, NULL),
(524, 'ILMU PENYAKIT SARAF', NULL, NULL, NULL, 1, 1, NULL),
(525, 'ILMU BEDAH', NULL, 'PRODI', 221, 0, 1, 36),
(526, 'KESEHATAN MASYARAKAT – KEDOKTERAN PENCEGAHAN (KM-KP)', NULL, NULL, NULL, 1, 1, NULL),
(527, 'MIKROBIOLOGI KEDOKTERAN', NULL, NULL, NULL, 1, 1, NULL),
(528, 'OBSTETRI DAN GENEKOLOGI', NULL, NULL, NULL, 1, 1, NULL),
(529, 'PARASITOLOGI', NULL, NULL, NULL, 1, 1, NULL),
(530, 'PATOLOGI ANATOMI', NULL, NULL, NULL, 1, 1, NULL),
(531, 'PATOLOGI KLINIK', NULL, NULL, NULL, 0, 1, NULL),
(532, 'RADIOLOGI', NULL, NULL, NULL, 1, 1, NULL),
(533, 'KARDIOLOGI DAN KEDOKTERAN VASKULER', NULL, NULL, NULL, 1, 1, NULL),
(534, 'BEDAH MULUT DAN MAKSILOFASIAL', NULL, NULL, NULL, 0, 2, NULL),
(535, 'BIOLOGI ORAL', NULL, NULL, NULL, 1, 2, NULL),
(536, 'ILMU KEDOKTERAN GIGI ANAK', NULL, NULL, NULL, 0, 2, NULL),
(537, 'ILMU KESEHATAN GIGI MASYARAKAT', NULL, NULL, NULL, 1, 2, NULL),
(538, 'ILMU PENYAKIT MULUT', NULL, NULL, NULL, 0, 2, NULL),
(539, 'KONSERVASI GIGI', NULL, NULL, NULL, 1, 2, NULL),
(540, 'MATERIAL', NULL, NULL, NULL, 1, 2, NULL),
(541, 'ORTODONSIA', NULL, NULL, NULL, 0, 2, NULL),
(542, 'PERIODONSIA', NULL, NULL, NULL, 0, 2, NULL),
(543, 'PROSTODONSIA', NULL, NULL, NULL, 0, 2, NULL),
(544, 'RADIOLOGI', NULL, NULL, NULL, 1, 2, NULL),
(545, 'DASAR ILMU HUKUM', NULL, NULL, NULL, 1, 3, NULL),
(546, 'HUKUM ADMINISTRASI NEGARA', NULL, NULL, NULL, 1, 3, NULL),
(547, 'HUKUM INTERNASIONAL', NULL, NULL, NULL, 1, 3, NULL),
(548, 'HUKUM PERDATA', NULL, NULL, NULL, 1, 3, NULL),
(549, 'HUKUM PIDANA', NULL, NULL, NULL, 1, 3, NULL),
(550, 'HUKUM TATA NEGARA', NULL, NULL, NULL, 1, 3, NULL),
(551, 'ILMU EKONOMI', NULL, NULL, NULL, 1, 4, NULL),
(552, 'MANAJEMEN', NULL, NULL, NULL, 1, 4, NULL),
(553, 'AKUNTANSI', NULL, NULL, NULL, 1, 4, NULL),
(554, 'EKONOMI SYARIAH', NULL, NULL, NULL, 1, 4, NULL),
(555, 'FARMAKOGNOSI DAN FITOKIMIA', NULL, NULL, NULL, 1, 5, NULL),
(556, 'KIMIA FARMASI', NULL, NULL, NULL, 1, 5, NULL),
(557, 'FARMASI KOMUNITAS', NULL, NULL, NULL, 1, 5, NULL),
(558, 'FARMASI KLINIK', NULL, NULL, NULL, 1, 5, NULL),
(559, 'FARMASETIKA', NULL, NULL, NULL, 1, 5, NULL),
(560, 'ANATOMI VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(561, 'PATOLOGI VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(562, 'PETERNAKAN', NULL, NULL, NULL, 1, 6, NULL),
(563, 'REPRODUKSI VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(564, 'KESEHATAN MASYARAKAT VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(565, 'PARASITOLOGI VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(566, 'MIKROBIOLOGI VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(567, 'KEDOKTERAN DASAR VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(568, 'KLINIK VETERINER', NULL, NULL, NULL, 1, 6, NULL),
(569, 'BIOPRODUK, BIOSAFETY DAN BIOSEKURITI', NULL, NULL, NULL, 1, 6, NULL),
(570, 'ANTROPOLOGI', NULL, NULL, NULL, 0, 7, NULL),
(571, 'POLITIK', NULL, NULL, NULL, 1, 7, NULL),
(572, 'ADMINISTRASI NEGARA', NULL, NULL, NULL, 1, 7, NULL),
(573, 'HUBUNGAN INTERNASIONAL', NULL, NULL, NULL, 1, 7, NULL),
(574, 'SOSIOLOGI', NULL, NULL, NULL, 1, 7, NULL),
(575, 'KOMUNIKASI', NULL, NULL, NULL, 1, 7, NULL),
(576, 'INFORMASI DAN PERPUSTAKAAN', NULL, NULL, NULL, 1, 7, NULL),
(577, 'KIMIA', NULL, NULL, NULL, 0, 8, NULL),
(578, 'MATEMATIKA', NULL, NULL, NULL, 0, 8, NULL),
(579, 'BIOLOGI', NULL, NULL, NULL, 1, 8, NULL),
(580, 'FISIKA', NULL, NULL, NULL, 0, 8, NULL),
(581, 'ADMINISTRASI DAN KEBIJAKAN KESEHATAN', NULL, NULL, NULL, 1, 10, NULL),
(582, 'BIOSTATISTIK DAN KEPENDUDUKAN', NULL, NULL, NULL, 1, 10, NULL),
(583, 'KESEHATAN LINGKUNGAN', NULL, NULL, NULL, 1, 10, NULL),
(584, 'EPIDEMIOLOGI', NULL, NULL, NULL, 1, 10, 232),
(585, 'KESEHATAN DAN KESELAMATAN KERJA', NULL, NULL, NULL, 1, 10, NULL),
(586, 'PROMOSI KESEHATAN DAN ILMU PERILAKU', NULL, NULL, NULL, 1, 10, NULL),
(587, 'GIZI KESEHATAN', NULL, NULL, NULL, 1, 10, NULL),
(588, 'PENDIDIKAN DAN PERKEMBANGAN', NULL, NULL, NULL, 1, 11, NULL),
(589, 'KLINIS DAN KESEHATAN MENTAL', NULL, NULL, NULL, 1, 11, NULL),
(590, 'KEPRIBADIAN DAN SOSIAL', NULL, NULL, NULL, 1, 11, NULL),
(591, 'INDUSTRI DAN ORGANISASI', NULL, NULL, NULL, 1, 11, NULL),
(592, 'SASTRA INDONESIA', NULL, NULL, NULL, 1, 12, NULL),
(593, 'ILMU SEJARAH', NULL, NULL, NULL, 0, 12, NULL),
(594, 'SASTRA JEPANG', NULL, NULL, NULL, 1, 12, NULL),
(595, 'SASTRA INGGRIS', NULL, NULL, NULL, 1, 12, NULL),
(596, 'DASAR KEPERAWATAN MEDIKAL BEDAH KRITIS', NULL, NULL, NULL, 0, 13, NULL),
(597, 'JIWA DAN KOMUNIKASI', NULL, NULL, NULL, 1, 13, NULL),
(598, 'MATERNITAS ANAK', NULL, NULL, NULL, 1, 13, NULL),
(599, 'MANAJEMEN KESEHATAN IKAN DAN BUDIDAYA PERAIRAN', NULL, NULL, NULL, 1, 14, NULL),
(600, 'KELAUTAN', NULL, NULL, NULL, 1, 14, NULL),
(601, 'ODONTOLOGI FORENSIK', NULL, NULL, NULL, 1, 2, NULL),
(602, 'PATOLOGI MULUT & MAKSILOFASIAL', NULL, NULL, NULL, 1, 2, NULL),
(603, 'Rumah Sakit Hewan Pendidikan', NULL, 'LEMBAGA', NULL, 1, NULL, NULL),
(604, 'Rumah Sakit Gigi dan Mulut Pendidikan', NULL, 'LEMBAGA', NULL, 1, NULL, NULL),
(605, 'Pusat Inovasi Pembelajaran dan Sertifikasi', NULL, 'LEMBAGA', NULL, 1, NULL, NULL),
(606, 'Pusat Pengelolaan Dana Sosial', NULL, 'LEMBAGA', NULL, 1, NULL, NULL),
(608, 'Pusat Riset dan Pengembangan Produk Halal', NULL, NULL, NULL, 1, NULL, NULL),
(609, 'Pusat Riset dan Pengembangan Produk Halal', NULL, NULL, NULL, NULL, NULL, NULL),
(611, 'ANALIS MEDIS', NULL, 'PRODI', NULL, NULL, 15, 264),
(379, 'Integrasi Sistem dan Pengembangan Aplikasi', NULL, 'SEKSI', 286, 0, NULL, NULL),
(372, 'Sekolah Pasca Sarjana', 'Sekolah Program Pasca Sarjanah', 'REKTORAT', NULL, 0, NULL, NULL),
(373, 'Pusat Layanan Pengadaan', NULL, 'LEMBAGA', 373, 1, NULL, NULL),
(375, 'Pusat Riset Flu Burung', NULL, 'LEMBAGA', NULL, 0, NULL, NULL),
(376, 'LP4M', NULL, 'LEMBAGA', 376, 0, NULL, NULL),
(380, 'Kependidikan', 'Seksi subdit kepegawaian', 'SEKSI', NULL, 0, NULL, NULL),
(381, 'Sie Layanan Kegiatan Kokurikuler', NULL, 'SEKSI', 275, 0, NULL, NULL),
(382, 'Sie Pembelanjaan', NULL, 'SEKSI', 282, 0, NULL, NULL),
(383, 'Sie Pendapatan', NULL, 'SEKSI', 282, 0, NULL, NULL),
(384, 'Sub Direktorat Pengembangan Sumberdaya Manusia dan Organisasi', NULL, 'SUBDIR', 31, 0, NULL, NULL),
(385, 'Sie Pengembangan Organisasi', NULL, 'SEKSI', 384, 0, NULL, NULL),
(386, 'Sie Pengembangan Sumber Daya Manusia', NULL, 'SEKSI', 384, 0, NULL, NULL),
(387, 'Sie Evaluasi Program Studi', NULL, 'SEKSI', 274, 0, NULL, NULL),
(388, 'Sie Pengembangan Program Studi', NULL, 'SEKSI', 274, 0, NULL, NULL),
(389, 'Sie Perencanaan dan Aset', NULL, 'SEKSI', 279, 0, NULL, NULL),
(390, 'Sie Perlengkapan', NULL, 'SEKSI', 279, 0, NULL, NULL),
(391, 'Sie Rumah Tangga', NULL, 'SEKSI', 279, 0, NULL, NULL),
(392, 'Sie Layanan Kesejahteraan Mahasiswa dan Urusan Alumni', NULL, 'SEKSI', 276, 0, NULL, NULL),
(393, 'Sie Kesehatan dan Keselamatan Kerja', NULL, 'SEKSI', 281, 0, NULL, NULL),
(394, 'Sie Lingkungan', NULL, 'SEKSI', 281, 0, NULL, NULL),
(395, 'Sie Tenaga Akademik', NULL, 'SEKSI', 277, 0, NULL, NULL),
(396, 'Sie Tenaga Kependidikan', NULL, 'SEKSI', 277, 0, NULL, NULL),
(397, 'Sie Anggaran Belanja', NULL, 'SEKSI', 284, 0, NULL, NULL),
(398, 'Sie Anggaran Pendapatan', NULL, 'SEKSI', 284, 0, NULL, NULL),
(399, 'Sie Akuntansi Aktif Tetap dan Akuntansi Pemerintah', NULL, 'SEKSI', 283, 0, NULL, NULL),
(400, 'Sie Akuntansi Belanja / Pengeluaran Kas', NULL, 'SEKSI', 283, 0, NULL, NULL),
(401, 'Sie Sistem Informasi & Pelaporan Keuangan', NULL, 'SEKSI', 283, 0, NULL, NULL),
(402, 'Sie Pendidikan & Evaluasi', NULL, 'SEKSI', 273, 0, NULL, NULL),
(403, 'Sie Registrasi & Pengolahan Data', NULL, 'SEKSI', 273, 0, NULL, NULL),
(404, 'Bidang Kerjasama dan Bisnis', NULL, 'SEKRETARIAT', 34, 0, NULL, NULL),
(405, 'Sie Kerjasama Dalam Negeri', NULL, 'SEKSI', NULL, 0, NULL, NULL),
(406, 'Sie Satuan Usaha Akademik dan Komersial', NULL, 'SEKSI', NULL, 0, NULL, NULL),
(407, 'Sie Administrasi dan Kearsipan', NULL, 'SEKSI', 271, 0, NULL, NULL),
(408, 'Bagian Tata Usaha', NULL, 'SEKRETARIAT', 38, 0, NULL, NULL),
(409, 'Sie Sarana dan Prasarana', NULL, 'SEKSI', NULL, 0, NULL, NULL),
(410, 'Sie Sumberdaya Manusia', NULL, 'SEKSI', NULL, 0, NULL, NULL),
(411, 'Sie Umum', NULL, 'SEKSI', NULL, 0, NULL, NULL),
(412, 'Sub Bagian Administrasi dan Keuangan', NULL, 'SEKSI', NULL, 0, NULL, NULL),
(413, 'Bagian Tata Usaha', NULL, 'BAGIAN', 244, 0, NULL, NULL),
(414, 'Sub Bagian Akademik', NULL, 'SUBBAG', 413, 0, NULL, NULL),
(415, 'Bagian Tata Usaha', NULL, 'BAGIAN', 245, 0, NULL, NULL),
(416, 'Sub Bagian Akademik', NULL, 'SUBBAG', 416, 0, NULL, NULL),
(417, 'Bagian Tata Usaha', NULL, 'BAGIAN', 243, 0, NULL, NULL),
(418, 'Sub Bagian Akademik', NULL, 'SUBBAG', 417, 0, NULL, NULL),
(419, 'Bagian Tata Usaha', NULL, 'BAGIAN', 252, 0, NULL, NULL),
(420, 'Sub Bagian Akademik', NULL, 'SUBBAG', 419, 0, NULL, NULL),
(421, 'Bagian Tata Usaha', NULL, 'BAGIAN', 247, 0, NULL, NULL),
(422, 'Sub Bagian Akademik', NULL, 'SUBBAG', 421, 0, NULL, NULL),
(423, 'Bagian Tata Usaha', NULL, 'BAGIAN', 221, 0, NULL, NULL),
(424, 'Sub Bagian Akademik', NULL, 'SUBBAG', 423, 0, NULL, NULL),
(425, 'Bagian Tata Usaha', NULL, 'BAGIAN', 242, 0, NULL, NULL),
(426, 'Sub Bagian Akademik', NULL, 'SUBBAG', 425, 0, NULL, NULL),
(427, 'Bagian Tata Usaha', NULL, 'BAGIAN', 246, 0, NULL, NULL),
(428, 'Sub Bagian Akademik', NULL, 'SUBBAG', 427, 0, NULL, NULL),
(429, 'Bagian Tata Usaha', NULL, 'BAGIAN', 253, 0, NULL, NULL),
(430, 'Sub Bagian Akademik', NULL, 'SUBBAG', 429, 0, NULL, NULL),
(431, 'Bagian Tata Usaha', NULL, 'BAGIAN', 250, 0, NULL, NULL),
(432, 'Sub Bagian Akademik', NULL, 'SUBBAG', 432, 0, NULL, NULL),
(433, 'Bagian Tata Usaha', NULL, 'BAGIAN', 254, 0, NULL, NULL),
(434, 'Sub Bagian Akademik', NULL, 'SUBBAG', 433, 0, NULL, NULL),
(435, 'Bagian Tata Usaha', NULL, 'BAGIAN', 251, 0, NULL, NULL),
(436, 'Sub Bagian Akademik', NULL, 'SUBBAG', 435, 0, NULL, NULL),
(437, 'Bagian Tata Usaha', NULL, 'BAGIAN', 248, 0, NULL, NULL),
(438, 'Sub Bagian Akademik', NULL, 'SUBBAG', 437, 0, NULL, NULL),
(439, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 413, 0, NULL, NULL),
(440, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 415, 0, NULL, NULL),
(441, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 417, 0, NULL, NULL),
(442, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 419, 0, NULL, NULL),
(443, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 421, 0, NULL, NULL),
(444, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 423, 0, NULL, NULL),
(445, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 425, 0, NULL, NULL),
(446, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 427, 0, NULL, NULL),
(447, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 429, 0, NULL, NULL),
(448, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 431, 0, NULL, NULL),
(449, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 433, 0, NULL, NULL),
(450, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 435, 0, NULL, NULL),
(451, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 437, 0, NULL, NULL),
(452, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 413, 0, NULL, NULL),
(453, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 415, 0, NULL, NULL),
(454, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 417, 0, NULL, NULL),
(455, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 419, 0, NULL, NULL),
(456, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 421, 0, NULL, NULL),
(457, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 423, 0, NULL, NULL),
(458, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 425, 0, NULL, NULL),
(459, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 427, 0, NULL, NULL),
(460, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 429, 0, NULL, NULL),
(461, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 431, 0, NULL, NULL),
(462, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 433, 0, NULL, NULL),
(463, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 435, 0, NULL, NULL),
(464, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 437, 0, NULL, NULL),
(465, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 413, 0, NULL, NULL),
(466, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 415, 0, NULL, NULL),
(467, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 417, 0, NULL, NULL),
(468, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 419, 0, NULL, NULL),
(469, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 421, 0, NULL, NULL),
(470, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 423, 0, NULL, NULL),
(471, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 425, 0, NULL, NULL),
(472, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 427, 0, NULL, NULL),
(473, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 429, 0, NULL, NULL),
(474, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 431, 0, NULL, NULL),
(475, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 433, 0, NULL, NULL),
(476, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 435, 0, NULL, NULL),
(477, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 437, 0, NULL, NULL),
(478, 'Bagian Sumber Daya Manusia', NULL, 'BAGIAN', 306, 0, NULL, NULL),
(479, 'Sub Bagian Akademik', NULL, 'SUBBAG', 478, 0, NULL, NULL),
(480, 'Sub Bagian Kemahasiswaan', NULL, 'SUBBAG', 478, 0, NULL, NULL),
(481, 'Sub Bagian Keuangan dan Sumber Daya Manusia', NULL, 'SUBBAG', 478, 0, NULL, NULL),
(482, 'Sub Bagian Sarana dan Prasarana', NULL, 'SUBBAG', 478, 0, NULL, NULL),
(483, 'Sub Bagian Pendidikan', NULL, 'SUBBAG', 478, 0, NULL, NULL),
(484, 'Sie Pengadaan Barang & Jasa', NULL, 'SEKSI', 373, 0, NULL, NULL),
(485, 'Sie Pengendalian Pengadaan Barang dan Jasa', NULL, 'SEKSI', 373, 0, NULL, NULL),
(486, 'Sub Bagian Data dan Informasi', NULL, 'SUBBAG', 370, 0, NULL, NULL),
(487, 'Sub Bagian Program', NULL, 'SUBBAG', 22, 0, NULL, NULL),
(488, 'Sub Bagian Tata Usaha', NULL, 'SUBBAG', 1, 0, NULL, NULL),
(489, 'Sub Bagian Tata Usaha', NULL, 'SUBBAG', 372, 0, NULL, NULL),
(490, 'Lembaga Sertifikasi Profesi', NULL, 'LEMBAGA', 438, 1, NULL, NULL),
(491, 'PERUBAHAN DAN PENGEMBANGAN ORGANISASI', NULL, 'PRODI', NULL, 0, 11, 259),
(492, 'Ilmu Kedokteran Jiwa', NULL, 'PRODI', 221, 0, 1, 219),
(495, 'ILMU KARDIOLOGI DAN KEDOKTERAN VASKULAR', NULL, 'PRODI', NULL, 0, 1, 260),
(496, 'Pusat Pengelolaan Dana Sosial', 'Pusat Pengelolaan Dana Sosial Universitas Airlangga', 'LEMBAGA', NULL, 0, NULL, NULL),
(497, '(Non Aktif) Lembaga Sertifikasi Profesi', NULL, 'LEMBAGA', NULL, 0, NULL, NULL),
(498, 'LEMBAGA PENGEMBANGAN DAN PELATIHAN TERPADU', NULL, 'LEMBAGA', NULL, 1, NULL, NULL),
(501, 'Lembaga Pengembangan Bisnis dan Inkubasi', NULL, 'LEMBAGA', NULL, 0, NULL, NULL),
(502, 'KEPERAWATAN', NULL, 'PRODI', NULL, 0, 15, 261),
(503, 'ILMU KEDOKTERAN GIGI', NULL, 'PRODI', NULL, 0, 2, 262),
(504, 'KEPERAWATAN', NULL, 'PRODI', NULL, 0, 13, 263),
(615, 'RADIOLOGI', NULL, 'PRODI', NULL, NULL, 15, 268),
(625, 'BUDIDAYA PERAIRAN', NULL, 'PRODI', NULL, NULL, 14, 273),
(638, 'PENDIDIKAN DOKTER', NULL, 'PRODI', NULL, NULL, 1, 284),
(647, 'BEDAH DIGESTIF', NULL, 'PRODI', NULL, NULL, 1, 293),
(681, 'REKAYASA NANOTEKNOLOGI', NULL, 'PRODI', 690, 1, 16, 306),
(682, 'TEKNIK ELEKTRO', NULL, 'PRODI', 690, 1, 16, 307),
(686, 'KEPERAWATAN MEDIKAL BEDAH', NULL, 'PRODI', NULL, NULL, 13, 309),
(687, 'KEPERAWATAN MEDIKAL BEDAH', NULL, 'PRODI', NULL, 1, 13, 310),
(613, 'KESEHATAN TERNAK', NULL, 'PRODI', NULL, NULL, 15, 266),
(619, 'BUDIDAYA PERAIRAN	', NULL, 'PRODI', NULL, NULL, 14, 270),
(629, 'BUDIDAYA PERAIRAN (PDD BANYUWANGI)', NULL, 'PRODI', NULL, NULL, 14, 275),
(646, 'ILMU KESEHATAN KULIT DAN KELAMIN', NULL, 'PRODI', NULL, NULL, 1, 292),
(630, 'ILMU KESEHATAN MASYARAKAT', NULL, 'PRODI', NULL, NULL, 10, 276),
(633, 'SASTRA JEPANG', NULL, 'PRODI', NULL, NULL, 12, 279),
(635, 'SASTRA INGGRIS', NULL, 'PRODI', NULL, NULL, 12, 281),
(636, 'KEBIDANAN', NULL, 'PRODI', NULL, NULL, 1, 282),
(641, 'PENDIDIKAN DOKTER HEWAN', NULL, 'PRODI', NULL, NULL, 6, 287),
(653, 'KEPERAWATAN', NULL, 'PRODI', NULL, NULL, 15, 297),
(679, 'TEKNOLOGI SAINS DATA', NULL, 'PRODI', 690, 1, 16, 304),
(621, 'BUDIDAYA PERAIRAN', NULL, 'PRODI', NULL, NULL, 14, 270),
(632, 'ILMU BIOLOGI REPRODUKSI', NULL, 'PRODI', NULL, NULL, 6, 278),
(650, 'PATOLOGI ANATOMI', NULL, 'PRODI', NULL, 0, 1, 296),
(655, 'ILMU PERIKANAN', NULL, 'PRODI', NULL, NULL, 14, 298),
(658, 'ILMU KEDOKTERAN GIGI', NULL, 'PRODI', NULL, 1, 2, 262),
(659, 'PENGOBAT TRADISIONAL', NULL, 'PRODI', NULL, 1, 15, 242),
(660, 'TEKNOLOGI HASIL PERIKANAN', NULL, 'PRODI', NULL, 1, 14, 246),
(661, 'TEKNOLOGI RADIOLOGI PENCITRAAN', NULL, 'PRODI', NULL, 1, 15, 244),
(662, 'ILMU PERIKANAN', NULL, 'PRODI', NULL, 1, 14, 298),
(663, 'PENDIDIKAN PROFESI DOKTER', NULL, 'PRODI', NULL, 0, 1, 5),
(664, 'Akuakultur (PDD Banyuwangi)', NULL, 'PRODI', NULL, 1, NULL, 241),
(665, 'KEPERAWATAN', NULL, 'PRODI', NULL, 1, 13, 263),
(666, 'SUB SPESIALIS PSIKIATRI ANAK DAN REMAJA KONSULTAN', NULL, 'PRODI', NULL, 1, 1, 255),
(667, 'Ilmu Linguistik', NULL, 'PRODI', NULL, 0, NULL, 226),
(668, 'BEDAH KEPALA LEHER ', NULL, 'PRODI', NULL, 1, 1, 256),
(669, 'PENDIDIKAN PROFESI DOKTER HEWAN', NULL, 'PRODI', NULL, 1, 6, 83),
(670, 'SUB SPESIALIS ILMU KESEHATAN ANAK', NULL, 'PRODI', NULL, 1, 1, 253),
(671, 'ILMU PENYAKIT DALAM', NULL, 'PRODI', NULL, 1, 1, 30),
(672, 'BEDAH DIGESTIF', NULL, 'PRODI', NULL, 1, 1, 257),
(673, 'AKUNTANSI (K.BANYUWANGI)', NULL, 'PRODI', NULL, 1, 4, 238),
(674, 'KEPERAWATAN', NULL, 'PRODI', NULL, 1, 15, 261),
(675, 'PATOLOGI KLINIK', NULL, 'PRODI', NULL, 1, 1, 254),
(676, 'ILMU BEDAH ANAK', NULL, 'PRODI', NULL, 1, 1, 245),
(678, 'World University Asosiation for Community Development', 'World University Asosiation for Community Development', NULL, NULL, 1, NULL, NULL),
(680, 'TEKNIK ROBOTIKA DAN KECERDASAN BUATAN', NULL, 'PRODI', 690, 1, 16, 305),
(683, 'TEKNIK INDUSTRI', NULL, 'PRODI', 690, 1, 16, 308),
(618, 'BUDIDAYA PERAIRAN', NULL, 'PRODI', NULL, NULL, 14, 270),
(620, 'BUDIDAYA PERAIRAN	', NULL, 'PRODI', NULL, NULL, 14, 270),
(622, 'ILMU DAN TEKNOLOGI LINGKUNGAN', NULL, 'PRODI', NULL, NULL, 8, 271),
(623, 'TEKNOBIOMEDIK', NULL, 'PRODI', NULL, NULL, 8, 272),
(624, 'ILMU DAN TEKNOLOGI LINGKUNGAN', NULL, 'PRODI', NULL, NULL, 8, 273),
(637, 'DD', NULL, 'PRODI', NULL, NULL, 1, 283),
(643, 'PENDIDIKAN DOKTER HEWAN', NULL, 'PRODI', NULL, NULL, 6, 289),
(644, 'BUDIDAYA PERAIRAN', NULL, 'PRODI', NULL, NULL, 14, 290),
(645, 'ILMU KEDOKTERAN FORENSIK DAN MEDIKOLEGAL', NULL, 'PRODI', NULL, NULL, 1, 291),
(648, 'ILMU PENYAKIT DALAM', NULL, 'PRODI', NULL, NULL, 1, 294),
(651, 'ANALIS MEDIS', NULL, 'PRODI', 306, 1, 15, 264),
(654, 'KEPERAWATAN', NULL, 'PRODI', NULL, NULL, 15, 297),
(656, 'TEKNOBIOMEDIK', NULL, 'PRODI', NULL, NULL, 9, 299),
(677, 'PSIKIATRI', NULL, 'PRODI', NULL, 1, 1, 208),
(685, 'KEPERAWATAN MEDIKAL BEDAH', NULL, 'PRODI', NULL, NULL, 13, 309),
(688, 'Direktorat Sarana Prasarana', 'Direktorat Sarana Prasarana', NULL, 688, 1, NULL, NULL),
(612, 'HIPERKES DAN KESELAMATAN KERJA', NULL, 'PRODI', NULL, NULL, 15, 265),
(614, 'MANAJEMEN KESEKRETARIATAN DAN PERKANTORAN', NULL, 'PRODI', NULL, NULL, 15, 267),
(626, 'BUDIDAYA PERAIRAN', NULL, 'PRODI', NULL, NULL, 14, 273),
(627, 'TEKNOLOGI INDUSTRI HASIL PERIKANAN', NULL, 'PRODI', NULL, NULL, 14, 274),
(639, 'PENDIDIKAN BIDAN', NULL, 'PRODI', NULL, NULL, 1, 285),
(640, 'PENDIDIKAN PROFESI AKUNTANSI', NULL, 'PRODI', NULL, NULL, 4, 286),
(691, 'KEPERAWATAN (KELAS GRESIK)', NULL, 'PRODI', NULL, NULL, 13, 311),
(616, 'TEKNIK KESEHATAN GIGI', NULL, 'PRODI', NULL, NULL, 15, 269),
(649, 'PSIKIATRI ANAK DAN REMAJA', NULL, 'PRODI', NULL, NULL, 1, 295),
(652, 'ANALIS MEDIS', 'Prodi', NULL, 306, NULL, 15, 264),
(684, 'NEUROLOGI', NULL, 'PRODI', NULL, NULL, 1, 309),
(689, 'Lembaga Ilmu Hayati, Teknik dan Rekayasa', 'Pusat Riset Rekayasa Molekul Hayati', NULL, NULL, 1, NULL, NULL),
(690, 'Fakultas Teknologi Maju dan Multidisiplin', NULL, 'FAKULTAS', 690, 1, 16, NULL),
(617, 'TEKNISI PERPUSTAKAAN', NULL, 'PRODI', NULL, NULL, 15, 270),
(628, 'TEKNOLOGI INDUSTRI HASIL PERIKANAN', NULL, 'PRODI', NULL, NULL, 14, 274),
(631, 'ILMU KESEHATAN', NULL, 'PRODI', NULL, NULL, 10, 277),
(634, 'SASTRA INDONESIA', NULL, 'PRODI', NULL, NULL, 12, 280),
(642, 'PENDIDIKAN DOKTER HEWAN (PDD BANYUWANGI)', NULL, 'PRODI', NULL, NULL, 6, 288),
(692, 'KEPERAWATAN (KELAS LAMONGAN)', NULL, 'PRODI', NULL, NULL, 13, 312),
(704, 'Badan Kerjasama dan Manajemen Pengembangan', 'Badan Kerjasama dan Manajemen Pengembangan', NULL, NULL, 1, NULL, NULL),
(707, ' Lembaga Ilmu Sosial, Humaniora dan Bisnis  ', 'LISHB', NULL, NULL, 1, NULL, NULL),
(697, 'Direktorat Inovasi dan Pengembangan Pendidikan', 'Direktorat Inovasi dan Pengembangan Pendidikan', NULL, 697, 1, NULL, NULL),
(700, 'ILMU ADMINISTRASI NEGARA', NULL, 'PRODI', NULL, NULL, 7, 313),
(702, 'Direktorat Pengembangan Karir, Inkubasi, Kewirausahaan dan Alumni', 'DPKIKA', NULL, NULL, 1, NULL, NULL),
(703, 'Unit Pendidikan Karakter Kebangsaan', 'UPKK', NULL, NULL, 1, NULL, NULL),
(706, 'Lembaga Inovasi, Pengembangan Jurnal, Penerbitan dan Hak Kekayaan Intelektual  ', 'LIPJPHKI', NULL, NULL, 1, NULL, NULL),
(699, 'Pusat Komunikasi dan Informasi Publik', NULL, NULL, 699, 1, NULL, NULL),
(696, 'Direktorat Logistik, Keamanan, Ketertiban dan Lingkungan 1', 'Direktur Logistik, Keamanan, Ketertiban dan Lingkungan', NULL, 696, 1, NULL, NULL),
(708, 'Airlangga Assessment Center', 'Airlangga Assessment Center', NULL, 708, 1, NULL, NULL),
(705, 'Badan Koordinasi Rumah Sakit dan Fasilitas Kesehatan ', 'BKRSFK', NULL, NULL, 1, NULL, NULL),
(698, 'Pusat Layanan Kesehatan', NULL, NULL, 698, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `jenjang`
--
ALTER TABLE `jenjang`
  ADD PRIMARY KEY (`id_jenjang`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_program_studi`),
  ADD KEY `id_jenjang` (`id_jenjang`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`) USING BTREE,
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tb_calon_ketua`
--
ALTER TABLE `tb_calon_ketua`
  ADD PRIMARY KEY (`calon_ketua_id`) USING BTREE,
  ADD KEY `tema_id` (`tema_id`),
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `tb_pemilih`
--
ALTER TABLE `tb_pemilih`
  ADD PRIMARY KEY (`pemilih_id`) USING BTREE,
  ADD KEY `id_program_studi` (`id_program_studi`);

--
-- Indexes for table `tb_saksi`
--
ALTER TABLE `tb_saksi`
  ADD PRIMARY KEY (`saksi_id`) USING BTREE;

--
-- Indexes for table `tb_suara`
--
ALTER TABLE `tb_suara`
  ADD PRIMARY KEY (`suara_id`) USING BTREE,
  ADD KEY `tema_id` (`tema_id`),
  ADD KEY `calon_id` (`calon_id`);

--
-- Indexes for table `tb_tema_pemilihan`
--
ALTER TABLE `tb_tema_pemilihan`
  ADD PRIMARY KEY (`tema_id`) USING BTREE;

--
-- Indexes for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  ADD PRIMARY KEY (`role_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_calon_ketua`
--
ALTER TABLE `tb_calon_ketua`
  MODIFY `calon_ketua_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_pemilih`
--
ALTER TABLE `tb_pemilih`
  MODIFY `pemilih_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_saksi`
--
ALTER TABLE `tb_saksi`
  MODIFY `saksi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_suara`
--
ALTER TABLE `tb_suara`
  MODIFY `suara_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_tema_pemilihan`
--
ALTER TABLE `tb_tema_pemilihan`
  MODIFY `tema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_user_role`
--
ALTER TABLE `tb_user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `program_studi_ibfk_1` FOREIGN KEY (`id_jenjang`) REFERENCES `jenjang` (`id_jenjang`);

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_user_role` (`role_id`);

--
-- Constraints for table `tb_calon_ketua`
--
ALTER TABLE `tb_calon_ketua`
  ADD CONSTRAINT `tb_calon_ketua_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `tb_tema_pemilihan` (`tema_id`),
  ADD CONSTRAINT `tb_calon_ketua_ibfk_2` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Constraints for table `tb_pemilih`
--
ALTER TABLE `tb_pemilih`
  ADD CONSTRAINT `tb_pemilih_ibfk_1` FOREIGN KEY (`id_program_studi`) REFERENCES `program_studi` (`id_program_studi`);

--
-- Constraints for table `tb_suara`
--
ALTER TABLE `tb_suara`
  ADD CONSTRAINT `tb_suara_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `tb_tema_pemilihan` (`tema_id`),
  ADD CONSTRAINT `tb_suara_ibfk_3` FOREIGN KEY (`calon_id`) REFERENCES `tb_calon_ketua` (`calon_ketua_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
