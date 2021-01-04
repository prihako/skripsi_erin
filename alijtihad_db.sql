-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2021 at 05:41 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alijtihad_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `nip`) VALUES
(1, 'admin', 'admin', 'admin', '16271261211');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` int(11) NOT NULL,
  `document_name` varchar(1000) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_document`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id_document`, `document_type`, `document_name`, `id_siswa`) VALUES
(1, 7, '26122017_10_45_15_AM_1514259915347_SLIP BRI pakai.jpg', 1),
(15, 6, '26122017_12_56_57_PM_1514267817322_KTP-ibu.jpg', 1),
(16, 5, '26122017_12_57_04_PM_1514267824448_KTP_Bapak.jpg', 1),
(17, 4, '26122017_12_57_16_PM_1514267836331_akta.jpg', 1),
(18, 3, '26122017_12_57_28_PM_1514267848079_skhun.png', 1),
(19, 2, '26122017_12_57_42_PM_1514267862313_Ijazah SMP.jpg', 1),
(20, 7, '03012018_11_14_38_AM_1514952878422_bukti-pembayaran.jpg', 2),
(21, 7, '03012018_12_55_07_PM_1514958907696_bukti-pembayaran.jpg', 3),
(22, 7, '03012018_01_11_12_PM_1514959872040_bukti-pembayaran.jpg', 4),
(23, 2, '03012018_04_21_02_PM_1514971262751_ijazah.jpg', 4),
(24, 3, '03012018_04_21_10_PM_1514971270617_skhun.jpg', 4),
(25, 4, '03012018_04_21_18_PM_1514971278058_akta-kelahiran.jpg', 4),
(26, 5, '03012018_04_21_25_PM_1514971285865_ktp_bapak2.jpg', 4),
(27, 6, '03012018_04_21_30_PM_1514971290259_KTP-ibu.jpg', 4),
(28, 2, '03012018_04_31_10_PM_1514971870288_Ijazah SMP.jpg', 2),
(29, 3, '03012018_04_31_16_PM_1514971876533_skhun.jpg', 2),
(30, 4, '03012018_04_31_20_PM_1514971880826_akta.jpg', 2),
(31, 5, '03012018_04_31_25_PM_1514971885474_KTP_Bapak.jpg', 2),
(32, 6, '03012018_04_31_32_PM_1514971892760_ktp_ibu.jpg', 2),
(40, 7, '04012018_09_09_37_PM_1515074977770_erina.jpg', 6),
(41, 7, '04012018_09_10_59_PM_1515075059205_erina.jpg', 6),
(42, 7, '04012018_09_11_03_PM_1515075063353_erina.jpg', 6),
(43, 2, '04012018_09_27_16_PM_1515076036092_erina.jpg', 6),
(44, 3, '04012018_09_27_26_PM_1515076046294_erina.jpg', 6),
(45, 4, '04012018_09_27_32_PM_1515076052732_erina.jpg', 6),
(46, 5, '04012018_09_27_38_PM_1515076058873_erina.jpg', 6),
(47, 5, '04012018_09_27_38_PM_1515076058994_erina.jpg', 6),
(48, 7, '05012018_06_17_39_AM_1515107859310_erina.jpg', 7),
(49, 7, '05012018_06_22_06_AM_1515108126820_erina.jpg', 7),
(50, 7, '05012018_06_34_11_AM_1515108851534_erina.jpg', 8),
(51, 2, '05012018_06_38_03_AM_1515109083278_ijazah depan.jpg', NULL),
(52, 2, '05012018_06_41_26_AM_1515109286578_Ijasah Depan.pdf', NULL),
(53, 2, '05012018_06_42_03_AM_1515109323311_ijazah depan.jpg', NULL),
(54, 2, '05012018_06_43_06_AM_1515109386257_ijazah depan.jpg', 8),
(55, 3, '05012018_06_43_16_AM_1515109396622_skhun.jpg', 8),
(56, 4, '05012018_06_43_28_AM_1515109408771_Kartu kuning.pdf', 8),
(57, 5, '05012018_06_43_44_AM_1515109424102_ktp.jpg', 8),
(58, 6, '05012018_06_43_53_AM_1515109433278_KTP.pdf', 8),
(59, 2, '05012018_06_44_52_AM_1515109492426_Ijasah Depan.pdf', NULL),
(60, 2, '05012018_06_45_00_AM_1515109500716_Ijasah Depan.pdf', NULL),
(61, 7, '05012018_07_52_41_AM_1515113561059_erina.jpg', 7),
(62, 2, '05012018_07_53_25_AM_1515113605868_Ijasah Depan.pdf', 7),
(63, 3, '05012018_07_54_23_AM_1515113663228_skhun.jpg', 7),
(64, 4, '05012018_07_54_45_AM_1515113685673_erina.jpg', 7),
(65, 5, '05012018_07_54_58_AM_1515113698125_ktp.jpg', 7),
(66, 6, '05012018_07_55_05_AM_1515113705514_erina.jpg', 7),
(67, 7, '05012018_08_03_49_AM_1515114229674_erina.jpg', 8),
(68, 7, '05012018_08_59_16_AM_1515117556878_erina.jpg', 1),
(69, 7, '18042018_02_37_30_PM_1524037050399_ktp.jpg', 2),
(70, 7, '24062018_05_35_15_PM_1529836515457_ktp.jpg', 4),
(71, 2, '24062018_05_37_24_PM_1529836644379_erina.jpg', NULL),
(72, 7, '24062018_05_46_31_PM_1529837191570_ijazah belakang.jpg', 5),
(73, 7, '24062018_06_44_44_PM_1529840684194_ijazah belakang.jpg', 20),
(74, 2, '24062018_06_45_10_PM_1529840710307_erina.jpg', 20),
(75, 3, '24062018_06_45_15_PM_1529840715981_ijazah belakang.jpg', 20),
(76, 4, '24062018_06_45_22_PM_1529840722648_ktp.jpg', 20),
(77, 5, '24062018_06_45_28_PM_1529840728231_ktp.jpg', 20),
(78, 6, '24062018_06_45_34_PM_1529840734405_erina.jpg', 20),
(79, 7, '08072018_01_47_22_PM_1531032442514_ktp.jpg', 21),
(80, 2, '08072018_01_49_44_PM_1531032584333_erina.jpg', 21),
(81, 3, '08072018_01_54_57_PM_1531032897933_erina.jpg', 21),
(82, 4, '08072018_01_55_13_PM_1531032913307_erina.jpg', 21),
(83, 5, '08072018_01_55_24_PM_1531032924601_erina.jpg', 21),
(84, 6, '08072018_01_55_30_PM_1531032930481_erina.jpg', 21),
(85, 7, '08072018_05_39_49_PM_1531046389608_erina.jpg', 22),
(86, 2, '08072018_05_43_19_PM_1531046599922_erina.jpg', 22),
(87, 3, '08072018_05_43_26_PM_1531046606185_erina.jpg', 22),
(88, 4, '08072018_05_43_31_PM_1531046611354_erina.jpg', 22),
(89, 5, '08072018_05_43_37_PM_1531046617020_erina.jpg', 22),
(90, 6, '08072018_05_43_43_PM_1531046623917_erina.jpg', 22),
(91, 6, '08072018_05_45_43_PM_1531046743211_erina.jpg', 22),
(92, 6, '08072018_05_45_47_PM_1531046747643_erina.jpg', 22),
(93, 6, '08072018_05_45_59_PM_1531046759919_erina.jpg', 22),
(94, 6, '08072018_05_46_25_PM_1531046785550_erina.jpg', 22),
(95, 7, '08072018_06_04_32_PM_1531047872686_erina.jpg', 23),
(96, 7, '08072018_06_05_11_PM_1531047911508_erina.jpg', 23),
(97, 7, '08072018_06_05_35_PM_1531047935495_erina.jpg', 23),
(98, 2, '08072018_06_06_23_PM_1531047983516_erina.jpg', 23),
(99, 3, '08072018_06_06_29_PM_1531047989643_erina.jpg', 23),
(100, 4, '08072018_06_06_35_PM_1531047995045_erina.jpg', 23),
(101, 5, '08072018_06_06_43_PM_1531048003885_erina.jpg', 23),
(102, 6, '08072018_06_06_52_PM_1531048012435_erina.jpg', 23),
(103, 6, '08072018_06_06_58_PM_1531048018262_erina.jpg', 23),
(104, 6, '08072018_06_07_19_PM_1531048039088_erina.jpg', 23),
(105, 6, '08072018_06_07_23_PM_1531048043605_erina.jpg', 23),
(106, 6, '08072018_06_07_53_PM_1531048073044_erina.jpg', 23),
(107, 7, '11072018_02_44_31_PM_1531295071608_1.jpg', 25),
(108, 2, '11072018_02_48_13_PM_1531295293428_ijazah depan.jpg', NULL),
(109, 3, '11072018_02_50_09_PM_1531295409855_skhun.jpg', 25),
(110, 2, '11072018_02_50_20_PM_1531295420761_ijazah depan.jpg', 25),
(111, 4, '11072018_02_51_19_PM_1531295479080_akta kelahiran.jpg', 25),
(112, 5, '11072018_02_52_07_PM_1531295527980_ktp bapak.jpg', 25),
(113, 6, '11072018_02_52_53_PM_1531295573106_ktp ibu.jpg', 25),
(114, 6, '11072018_02_52_58_PM_1531295578989_ktp ibu.jpg', 25),
(115, 2, '17072018_01_48_41_PM_1531810121347_ijazah depan.jpg', 29),
(116, 3, '17072018_01_48_53_PM_1531810133236_skhun.jpg', 29),
(117, 4, '17072018_01_49_03_PM_1531810143496_akta kelahiran.jpg', 29),
(118, 5, '17072018_01_49_13_PM_1531810153596_ktp bapak.jpg', 29),
(119, 6, '17072018_01_49_24_PM_1531810164174_ktp ibu.jpg', 29),
(120, 6, '17072018_01_51_31_PM_1531810291704_ktp ibu.jpg', 29),
(121, 7, '17072018_04_01_03_PM_1531818063491_bukti pendaftaran.jpg', 30),
(122, 7, '17072018_04_01_29_PM_1531818089659_bukti pendaftaran.jpg', 30),
(123, 2, '17072018_04_02_16_PM_1531818136637_ijazah depan.jpg', 30),
(124, 3, '17072018_04_02_26_PM_1531818146268_skhun.jpg', 30),
(125, 4, '17072018_04_02_34_PM_1531818154479_akta kelahiran.jpg', 30),
(126, 5, '17072018_04_02_43_PM_1531818163039_ktp bapak.jpg', 30),
(127, 6, '17072018_04_02_52_PM_1531818172040_ktp ibu.jpg', 30),
(128, 6, '17072018_04_03_24_PM_1531818204468_ktp ibu.jpg', 30),
(129, 7, '31072018_10_37_01_PM_1533051421936_bukti pendaftaran.jpg', 31),
(130, 2, '31072018_10_39_05_PM_1533051545418_ijazah depan.jpg', 31),
(131, 3, '31072018_10_39_22_PM_1533051562268_skhun.jpg', 31),
(132, 4, '31072018_10_40_01_PM_1533051601777_akta kelahiran.jpg', 31),
(133, 5, '31072018_10_40_11_PM_1533051611148_ktp bapak.jpg', 31),
(134, 6, '31072018_10_40_17_PM_1533051617045_ktp ibu.jpg', 31),
(135, 7, '01082018_07_23_32_PM_1533126212252_bukti pendaftaran.jpg', 31),
(136, 3, '03102018_01_44_56_PM_1538549096100_erina.jpg', 33),
(137, 2, '03102018_01_45_22_PM_1538549122799_erina.jpg', 33),
(138, 4, '03102018_01_45_29_PM_1538549129842_erina.jpg', 33),
(139, 5, '03102018_01_45_34_PM_1538549134450_erina.jpg', 33),
(140, 6, '03102018_01_45_41_PM_1538549141127_erina.jpg', 33),
(141, 6, '03102018_01_45_47_PM_1538549147349_erina.jpg', 33),
(142, 7, '03102018_02_16_59_PM_1538551019238_erina.jpg', 35),
(143, 2, '03102018_02_19_46_PM_1538551186937_erina.jpg', 35),
(144, 3, '03102018_02_19_53_PM_1538551193445_erina.jpg', 35),
(145, 4, '03102018_02_20_01_PM_1538551201350_erina.jpg', 35),
(146, 5, '03102018_02_20_09_PM_1538551209604_erina.jpg', 35),
(147, 6, '03102018_02_20_15_PM_1538551215684_erina.jpg', 35),
(148, 6, '03102018_02_20_22_PM_1538551223001_erina.jpg', 35);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_test`
--

CREATE TABLE IF NOT EXISTS `hasil_test` (
  `id_hasil_test` int(11) NOT NULL AUTO_INCREMENT,
  `id_siswa` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  PRIMARY KEY (`id_hasil_test`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `hasil_test`
--

INSERT INTO `hasil_test` (`id_hasil_test`, `id_siswa`, `id_mata_pelajaran`, `nilai`) VALUES
(13, 25, 1, 100),
(14, 25, 2, 90),
(15, 30, 1, 50),
(16, 30, 2, 100),
(17, 35, 1, 90),
(18, 35, 2, 100);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mata_pelajaran` varchar(100) NOT NULL,
  `nilai_minimum` int(11) NOT NULL,
  PRIMARY KEY (`id_mata_pelajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_mata_pelajaran`, `nama_mata_pelajaran`, `nilai_minimum`) VALUES
(1, 'Kalkulus 1', 70),
(2, 'Aljabar Linear', 80);

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE IF NOT EXISTS `orang_tua` (
  `orang_tua_id` int(11) NOT NULL AUTO_INCREMENT,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `pendidikan` int(11) NOT NULL,
  `pekerjaan` int(11) NOT NULL,
  `alamat_kantor` varchar(100) NOT NULL,
  `no_telp_kantor` varchar(12) NOT NULL,
  `kebangsaan` int(11) NOT NULL,
  `agama` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tipe_orang_tua` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`orang_tua_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`orang_tua_id`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `pendidikan`, `pekerjaan`, `alamat_kantor`, `no_telp_kantor`, `kebangsaan`, `agama`, `id_siswa`, `nama`, `tipe_orang_tua`) VALUES
(1, 'Jakarta', '2018-01-29', 'Jl. Jati 4 No. 8 Pondok Rezeki Kutabaru Pasar Kemis', '0215927379', 1, 1, 'Jl. Sudirman N0.8', '0215927379', 1, 1, 1, 'Bambang W', '1'),
(2, 'Tangerang', '2018-01-29', 'Jl. Manggis 1 Rt 08.Rw.05 Pondok makmur Kutabaru Pasar Kemis, Jl. Manggis 1 Rt 08.Rw.05 Pondok makmu', '0215927379', 1, 1, 'Jl. Kantor Manis kuning', '0215927379', 1, 1, 1, 'Sukiem', '2'),
(3, 'Jakarta', '1952-04-29', 'Jl. Anggur 2 Rt.08 Rw.08 Kebun Jeruk', '089889559967', 3, 1, 'Jl. Rambutan no 4 Rt.09 Rw. 06', '0215928299', 1, 1, 2, 'Jihan Sugianto', '1'),
(4, 'Tangerang', '1961-04-10', 'Jl. Oskar 4 Rt 09 Rw 06 Serpong', '089887997899', 3, 1, 'Jl. Jendral Sudirman Rt 06 Rw.009 Cimone Tangerang', '081889390286', 1, 1, 2, 'Citra Sandrika', '2'),
(5, 'Jakarta', '2018-04-27', 'Jl. Jati 2 No. 8 Pondok Rezeki Kutabaru Pasar Kemis', '089889576897', 3, 1, 'Jl. Rambutan no 4 Rt.09 Rw. 08', '0215927689', 1, 1, 3, 'Andi', '1'),
(6, 'Tangerang', '2018-04-07', 'Jl. Manggis 1 Rt 09.Rw.07 Pondok makmur Kutabaru Pasar Kemis, Jl. Manggis 1 Rt 08.Rw.05 Pondok makmu', '089733838796', 3, 1, 'Jl. Jendral Sudirman Rt 07 Rw.08 Cimone Tangerang', '0215927787', 1, 1, 3, 'Reni', '2'),
(7, 'Tangerang', '2018-06-19', 'Jl. Anggrek Kreasi Pondok Makmur', '08972637387', 3, 3, 'Jl. Sudirman ', '02159256466', 1, 1, 4, 'Yaya ', '1'),
(8, 'Jakarta', '2018-06-19', 'Jl. Mawar Pondok Mekar Asri', '089878369373', 3, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 4, 'Maryam', '2'),
(9, 'Jakarta', '2018-06-24', 'Jl. Anggrek Kreasi Pondok Makmur', '09876543', 1, 1, 'Jl. Sudirman ', '234567', 1, 1, 5, 'Test', '1'),
(10, 'Jakarta', '2018-06-28', 'Jl. Mawar Pondok Mekar Asri', '09876543', 1, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 5, 'Test', '2'),
(11, 'Tangerang', '2018-06-20', 'Jl. Anggrek Kreasi Pondok Makmur', '09876543', 1, 1, 'Jl. Sudirman ', '234567', 1, 1, 6, 'Yaya ', '1'),
(12, 'Jakarta', '2018-06-29', 'Jl. Mawar Pondok Mekar Asri', '09876543', 1, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 6, 'Maryam', '2'),
(13, 'Tangerang', '2018-06-14', 'Jl. Anggrek Kreasi Pondok Makmur', '09876543', 1, 1, 'Jl. Sudirman ', '234567', 1, 1, 20, 'Yaya ', '1'),
(14, 'Jakarta', '2018-06-29', 'Jl. Mawar Pondok Mekar Asri', '09876543', 1, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 20, 'Maryam', '2'),
(15, 'Tangerang', '2018-07-21', 'Jl. Anggrek 1 Kreasi Pondok Makmur ', '08972637387', 3, 2, 'Jl. Sudirman ', '02159256466', 1, 1, 21, 'Fafa', '1'),
(16, 'Jakarta', '2018-07-26', 'Jl. Mawar 2 Pondok Mekar Asri', '0898765433', 3, 3, 'Jl. Manggis 3 Pondok Asri', '0215928888', 1, 1, 21, 'Tita', '2'),
(17, 'Tangerang', '2018-07-19', 'Jl. Anggrek Kreasi Pondok Makmur', '08972637387', 3, 1, 'Jl. Sudirman ', '02159256466', 1, 1, 22, 'rfr', '1'),
(18, 'Jakarta', '2018-07-28', 'Jl. Mawar 2 Pondok Mekar Asri', '0898765433', 1, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 22, 'Maryam', '2'),
(19, 'Tangerang', '2018-07-21', 'Jl. Anggrek Kreasi Pondok Makmur', '08972637387', 3, 1, 'Jl. Sudirman ', '02159256466', 1, 1, 23, 'Fafa', '1'),
(20, 'Jakarta', '2018-06-09', 'Jl. Mawar Pondok Mekar Asri', '0898765433', 3, 2, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 23, 'Maryam', '2'),
(21, 'Tangerang', '2018-06-13', 'Jl. Anggrek Kreasi Pondok Makmur', '08972637387', 3, 2, 'Jl. Sudirman ', '02159256466', 1, 1, 24, 'Yaya ', '1'),
(22, 'Jakarta', '2018-07-27', 'Jl. Mawar Pondok Mekar Asri', '0898765433', 3, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 24, 'Maryam', '2'),
(23, 'Tangerang', '1956-07-07', 'Jl. Anggrek Kreasi Pondok Makmur', '08972637387', 3, 3, 'Jl. Sudirman ', '02159256466', 1, 1, 25, 'Yaya ', '1'),
(24, 'Jakarta', '1986-07-29', 'Jl. Mawar 2 Pondok Mekar Asri', '0898765433', 3, 1, 'Jl. Manggis 2 Pondok Asri', '0215928888', 1, 1, 25, 'Maryam', '2'),
(25, 'Jakarta', '2018-07-28', 'Jl. Anggrek 1 Kreasi Pondok Makmur ', '08972637387', 3, 1, 'Jl. Sudirman ', '02159256466', 1, 1, 26, 'Yaya ', '1'),
(26, 'Jakarta', '2018-06-29', 'Jl. Mawar 2 Pondok Mekar Asri', '0898765433', 3, 1, 'Jl. Manggis 2 Pondok Asri', '021592844849', 1, 1, 26, 'Maryam', '2'),
(29, 'Jakarta', '2018-06-19', 'Jl. Anggrek 1 Kreasi Pondok Makmur ', '08972637387', 3, 2, 'Jl. Sudirman ', '02159256466', 1, 1, 28, 'Yaya ', '1'),
(30, 'Tangerang', '2018-06-19', 'Jl. Anggrek 1 Kreasi Pondok Makmur ', '0898765433', 3, 2, 'Jl. Manggis 2 Pondok Asri', '0215928888', 1, 1, 28, 'Maryam', '2'),
(31, 'Tangerang', '1987-07-29', 'Jl. Melon 2 No. 9 Rt 08 Rw 02 ', '08972637387', 3, 2, 'Jl. Sudirman ', '02159256466', 1, 1, 29, 'Yaya ', '1'),
(32, 'Tangerang', '1988-07-28', 'Jl. Melon 2 No. 9 Rt 08 Rw 02 ', '0898765433', 3, 1, 'Jl. Manggis 2 Pondok Asri', '0215928888', 1, 1, 29, 'Maryam', '2'),
(33, 'Tangerang', '1987-07-29', 'Jl. Melon 2 No. 9 Rt 08 Rw 02 ', '09876543', 3, 1, 'Jl. Sudirman ', '02159256466', 1, 1, 30, 'Yaya ', '1'),
(34, 'Jakarta', '1988-07-28', 'Jl. Melon 2 No. 9 Rt 08 Rw 02 ', '0898765433', 3, 1, 'Jl. Manggis 3 Pondok Asri', '0215928888', 1, 1, 30, 'Maryam', '2'),
(41, 'Bogor', '2018-10-27', 'Jl. Pasar baru Tangeang', '0898789887', 3, 1, 'Jl. Moh Toha Pasar Baru Tangerang', '02189897898', 1, 1, 32, 'Fahmy', '1'),
(42, 'Jakarta', '2018-10-31', 'Jl. Pisang ', '021', 3, 1, 'Jl. Kebon Jeruk No.2 Jakarta', '089898797896', 1, 1, 32, 'Angel', '2'),
(43, 'Bogor', '2018-10-27', 'Jl. Pasar baru Tangeang', '0898789887', 3, 1, 'Jl. Moh Toha Pasar Baru Tangerang', '02189897898', 1, 1, 33, 'Fahmy', '1'),
(44, 'Jakarta', '2018-10-31', 'Jl. Pisang ', '021', 3, 1, 'Jl. Kebon Jeruk No.2 Jakarta', '089898797896', 1, 1, 33, 'Angel', '2'),
(45, 'Bogor', '2018-10-27', 'Jl. Pasar baru Tangeang', '0898789887', 3, 1, 'Jl. Moh Toha Pasar Baru Tangerang', '02189897898', 1, 1, 34, 'Fahmy', '1'),
(46, 'Jakarta', '2018-10-31', 'Jl. Pisang ', '021', 3, 1, 'Jl. Kebon Jeruk No.2 Jakarta', '089898797896', 1, 1, 34, 'Angel', '2'),
(47, 'Bogor', '2018-10-27', 'Jl. Pasar baru Tangeang', '0898789887', 3, 1, 'Jl. Moh Toha Pasar Baru Tangerang', '02189897898', 1, 1, 35, 'Fahmy', '1'),
(48, 'Jakarta', '2018-10-31', 'Jl. Pisang ', '021', 3, 1, 'Jl. Kebon Jeruk No.2 Jakarta', '089898797896', 1, 1, 35, 'Angel', '2');

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE IF NOT EXISTS `parameter` (
  `id_parameter` int(11) NOT NULL AUTO_INCREMENT,
  `column_name` varchar(50) NOT NULL,
  `param_value` varchar(50) NOT NULL,
  `param_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_parameter`),
  UNIQUE KEY `column_name` (`column_name`,`param_value`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id_parameter`, `column_name`, `param_value`, `param_name`) VALUES
(1, 'status', '1', 'MENUNGGU UPLOAD BUKTI PEMBAYARAN'),
(2, 'status', '2', 'MENUNGGU VERIFIKASI BUKTI PEMBAYARAN'),
(3, 'status', '3', 'MENUNGGU UPLOAD BERKAS'),
(4, 'status', '4', 'MENUNGGU VERIFIKASI BERKAS'),
(5, 'status', '5', 'PROSES PENDAFTARAN SELESAI, SILAHKAN CEKTAK KARTU UJIAN'),
(6, 'jenis_kelamin', '1', 'LAKI - LAKI'),
(7, 'jenis_kelamin', '2', 'PEREMPUAN'),
(8, 'agama', '1', 'ISLAM'),
(9, 'agama', '2', 'KRISTEN'),
(10, 'agama', '3', 'HINDU'),
(11, 'agama', '4', 'BUDHA'),
(12, 'agama', '5', 'KONGHUCU'),
(13, 'kebangsaan', '1', 'INDONESIA'),
(14, 'kebangsaan', '2', 'AMERIKA SERIKAT'),
(15, 'kebangsaan', '3', 'CHINA'),
(16, 'kebangsaan', '4', 'KOREA'),
(17, 'kebangsaan', '5', 'MALAYSIA'),
(18, 'bahasa', '1', 'INDONESIA'),
(19, 'bahasa', '2', 'INGGRIS'),
(20, 'bahasa', '3', 'CHINA'),
(21, 'bahasa', '4', 'KOREA'),
(22, 'bahasa', '5', 'MELAYU'),
(23, 'pendidikan', '1', 'SD'),
(24, 'pendidikan', '2', 'SMP'),
(25, 'pendidikan', '3', 'SMA'),
(26, 'pendidikan', '4', 'STRATA 1 (S1)'),
(27, 'pendidikan', '5', 'STRATA 2 (S2)'),
(28, 'pendidikan', '6', 'STRATA 3 (S3)'),
(29, 'document_type', '1', 'FOTO'),
(30, 'document_type', '2', 'IJAZAH/STTB'),
(31, 'document_type', '3', 'SKHUN'),
(32, 'document_type', '4', 'AKTA KELAHIRAN'),
(33, 'document_type', '5', 'KTP BAPAK'),
(34, 'document_type', '6', 'KTP_IBU'),
(35, 'pekerjaan', '1', 'PEGAWAI NEGERI SIPIL'),
(36, 'pekerjaan', '2', 'PEGAWAI SWASTA'),
(37, 'pekerjaan', '3', 'WIRASWASTA'),
(38, 'tipe_orang_tua', '1', 'BAPAK'),
(39, 'tipe_orang_tua', '2', 'IBU'),
(40, 'document_type', '7', 'BUKTI PEMBAYARAN');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `judul_pengumuman` varchar(250) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_pengumuman` datetime NOT NULL,
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul_pengumuman`, `isi_pengumuman`, `tanggal_pengumuman`) VALUES
(2, 'Hasil PSB SMK Al-Ijtihad Tangerang', 'Jumlah siswa yang diterima 50.\r\nJurusan Akuntansi (15), Administrasi Perkantoran (15), Multimedia (20)                                                   ', '2018-09-26 03:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `agama` int(1) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_siswa` varchar(30) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `no_telp` varchar(12) NOT NULL,
  `NO_INDUK` varchar(50) DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `anak_ke` int(11) NOT NULL,
  `jml_saudara` int(11) NOT NULL,
  `kebangsaan` int(11) NOT NULL,
  `bahasa` int(11) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=36 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `username`, `password`, `nama_lengkap`, `jenis_kelamin`, `agama`, `tempat_lahir`, `tanggal_lahir`, `alamat_siswa`, `foto`, `no_telp`, `NO_INDUK`, `tgl_masuk`, `anak_ke`, `jml_saudara`, `kebangsaan`, `bahasa`, `status`) VALUES
(25, '12151331', 'amanda', 'Amanda  Restu Nindia Putri', 2, 1, 'Tangerang', '2000-04-28', 'Jl. Melon 2 No. 9 Rt 08 Rw 02 ', '11072018_02_36_31_PM_1531294591922_erina.jpg', '089879868686', '0004392188', '2018-06-29', 3, 3, 1, 1, '5'),
(30, '12159981', 'restu', 'Amanda Restu Nindia Putri', 2, 1, 'Tangerang', '2000-04-28', 'Jl. Melon 2 No. 9 Rt 08 Rw 02 ', '17072018_04_00_37_PM_1531818037526_amanda.jpg', '089879868686', '0004392188', '2018-06-29', 3, 3, 1, 1, '5'),
(35, '12156778', 'hana', 'Hana oki', 2, 1, 'Bogor', '2018-10-11', 'Jl.Angsana Raya No.26 Rt.01 Rw', '03102018_02_12_00_PM_1538550720775_erina.jpg', '087898797868', '7877654545658', '2018-10-06', 3, 3, 1, 1, '5');

-- --------------------------------------------------------

--
-- Table structure for table `tes`
--

CREATE TABLE IF NOT EXISTS `tes` (
  `id_tes` int(5) NOT NULL,
  `username` text NOT NULL,
  `tes_akademis` int(1) NOT NULL,
  `tes_akademis_bakat` int(1) NOT NULL,
  `tes_bakat` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_tes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tes`
--

INSERT INTO `tes` (`id_tes`, `username`, `tes_akademis`, `tes_akademis_bakat`, `tes_bakat`) VALUES
(17, '9948811776', 0, 0, 2),
(18, '0001517915', 0, 0, 1),
(19, '0007153235', 0, 0, 1),
(20, '178216271', 0, 0, 3),
(21, '9940630093', 0, 0, 2),
(22, '0000373465', 0, 0, 1),
(23, '9090909', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `waktutest`
--

CREATE TABLE IF NOT EXISTS `waktutest` (
  `id_waktutes` int(5) NOT NULL,
  `nama_test` varchar(25) NOT NULL,
  `keterangan` varchar(250) DEFAULT NULL,
  `waktu_test` datetime DEFAULT NULL,
  PRIMARY KEY (`id_waktutes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `waktutest`
--

INSERT INTO `waktutest` (`id_waktutes`, `nama_test`, `keterangan`, `waktu_test`) VALUES
(1, 'Tes Akademis', NULL, '2015-08-31 08:00:00'),
(5, 'Test Keahlian', 'Test Listrik', '2018-01-04 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
