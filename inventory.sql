-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 02:47 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_group`
--

CREATE TABLE `a_group` (
  `a_group_id` int(1) UNSIGNED NOT NULL,
  `a_group_level` int(1) UNSIGNED NOT NULL,
  `a_group_menu` int(1) UNSIGNED NOT NULL,
  `a_group_status` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_group`
--

INSERT INTO `a_group` (`a_group_id`, `a_group_level`, `a_group_menu`, `a_group_status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(10, 1, 10, 1),
(15, 1, 38, 1),
(96, 1, 51, 1),
(175, 1, 52, 1),
(176, 1, 53, 1),
(177, 1, 54, 1),
(178, 1, 55, 1),
(181, 1, 58, 1),
(230, 1, 59, 1),
(234, 1, 60, 1),
(274, 1, 61, 1),
(280, 1, 62, 1),
(286, 1, 63, 1);

-- --------------------------------------------------------

--
-- Table structure for table `a_level`
--

CREATE TABLE `a_level` (
  `a_level_id` int(1) UNSIGNED NOT NULL,
  `a_level_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_level`
--

INSERT INTO `a_level` (`a_level_id`, `a_level_name`) VALUES
(1, 'Administrator'),
(14, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `a_menu`
--

CREATE TABLE `a_menu` (
  `a_menu_id` int(1) UNSIGNED NOT NULL,
  `a_menu_name` varchar(255) NOT NULL,
  `a_menu_parentId` int(1) UNSIGNED NOT NULL,
  `a_menu_uri` varchar(255) NOT NULL,
  `a_menu_iconCls` varchar(255) NOT NULL,
  `a_menu_type` enum('dialog','messager','tabs','window') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Admin Menu';

--
-- Dumping data for table `a_menu`
--

INSERT INTO `a_menu` (`a_menu_id`, `a_menu_name`, `a_menu_parentId`, `a_menu_uri`, `a_menu_iconCls`, `a_menu_type`) VALUES
(1, 'Master', 0, '', 'icon-master', ''),
(2, 'Transaksi', 0, '', 'icon-transaksi', ''),
(3, 'Report', 0, '', 'icon-print', ''),
(4, 'Admin', 0, '', 'icon-admin', ''),
(5, 'Setting', 0, '', 'icon-setup', ''),
(6, 'Admin User', 4, 'admin/user', 'icon-man', 'tabs'),
(7, 'Admin Menu', 4, 'admin/menu', 'icon-menu', 'tabs'),
(8, 'General', 5, 'setting/general', 'icon-general', 'dialog'),
(10, 'Master Item', 1, 'master/item', 'icon-master', 'tabs'),
(38, 'Admin Group', 4, 'admin/group', 'icon-user', 'tabs'),
(51, 'Inquiry', 0, '', 'icon-inquiry', ''),
(52, 'Barang Masuk', 2, 'transaksi/in', 'icon-transaksi', 'tabs'),
(53, 'Barang Keluar', 2, 'transaksi/out', 'icon-transaksi', 'tabs'),
(54, 'Inquiry Stock', 51, 'inquiry/stock', 'icon-inquiry', 'tabs'),
(55, 'Master Project', 1, 'master/project', 'icon-master', 'tabs'),
(58, 'Inquiry Transaksi', 51, 'inquiry/trans', 'icon-inquiry', 'tabs'),
(59, 'Master Satuan', 1, 'master/uom', 'icon-master', 'tabs'),
(60, 'Master Supplier', 1, 'master/supplier', 'icon-master', 'tabs'),
(61, 'Master Customer', 1, 'master/customer', 'icon-master', 'tabs'),
(62, 'Invoice', 2, 'transaksi/invoice', 'icon-transaksi', 'tabs'),
(63, 'Penawaran', 2, 'transaksi/penawaran', 'icon-transaksi', 'tabs');

-- --------------------------------------------------------

--
-- Table structure for table `a_mn`
--

CREATE TABLE `a_mn` (
  `a_mn_id` int(1) UNSIGNED NOT NULL,
  `a_mn_name` varchar(50) NOT NULL,
  `a_mn_link` varchar(50) NOT NULL,
  `a_mn_icon` varchar(30) NOT NULL,
  `a_mn_parentId` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_mn`
--

INSERT INTO `a_mn` (`a_mn_id`, `a_mn_name`, `a_mn_link`, `a_mn_icon`, `a_mn_parentId`) VALUES
(1, 'Dashboard', '', 'fas fa-tachometer-alt', 0),
(2, 'Masters', '', 'fas fa-coins', 0),
(3, 'Transactions', '', 'fas fa-laptop', 0),
(4, 'Inquiry', '', 'fas fa-chart-bar', 0),
(5, 'Report', '', 'fas fa-chart-pie', 0),
(6, 'Admin', '', 'fas fa-user-tag', 0),
(7, 'Settings', '', 'fas fa-cogs', 0),
(8, 'Data User', 'admin/User', 'far fa-circle', 6),
(9, 'Data Menu', 'admin/Menu', 'far fa-circle', 6),
(10, 'Data Group', 'admin/Group', 'far fa-circle', 6),
(11, 'Business Partner', 'master/Bp', 'far fa-circle', 2),
(12, 'Item', 'master/Item', 'far fa-circle', 2),
(16, 'Category', 'master/Category', 'far fa-circle', 2),
(17, 'Uom', 'master/Uom', 'far fa-circle', 2),
(18, 'Type', 'master/Type', 'far fa-circle', 2),
(19, 'Material Receipt', 'transaksi/MaterialReceipt', 'far fa-circle', 3),
(20, 'Material Outgoing', 'transaksi/MaterialOutgoing', 'far fa-circle', 3),
(21, 'Sharing Incoming', 'transaksi/SharingIncoming', 'far fa-circle', 3),
(22, 'Sharing Outgoing', 'transaksi/SharingOutgoing', 'far fa-circle', 3),
(23, 'Balance Material', 'inquiry/BalanceMaterial', 'far fa-circle', 4),
(24, 'Daily Work Report', 'transaksi/Lkh', 'far fa-circle', 3);

-- --------------------------------------------------------

--
-- Table structure for table `a_mn_grp`
--

CREATE TABLE `a_mn_grp` (
  `a_mn_grp_id` int(1) UNSIGNED NOT NULL,
  `a_mn_grp_lvl` int(1) UNSIGNED NOT NULL,
  `a_mn_grp_menu` int(1) UNSIGNED NOT NULL,
  `a_mn_grp_sts` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `a_mn_grp`
--

INSERT INTO `a_mn_grp` (`a_mn_grp_id`, `a_mn_grp_lvl`, `a_mn_grp_menu`, `a_mn_grp_sts`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 1, 6, 1),
(7, 1, 7, 1),
(8, 1, 8, 1),
(9, 1, 9, 1),
(10, 1, 10, 1),
(11, 1, 11, 1),
(12, 1, 12, 1),
(43, 1, 16, 1),
(46, 1, 17, 1),
(49, 1, 18, 1),
(52, 1, 19, 1),
(55, 1, 20, 1),
(58, 1, 21, 1),
(61, 1, 22, 1),
(64, 1, 23, 1),
(67, 1, 24, 1),
(76, 14, 1, 1),
(77, 14, 2, 1),
(78, 14, 3, 0),
(79, 14, 4, 0),
(80, 14, 5, 0),
(81, 14, 6, 0),
(82, 14, 7, 0),
(83, 14, 8, 0),
(84, 14, 9, 0),
(85, 14, 10, 0),
(86, 14, 11, 1),
(87, 14, 12, 1),
(88, 14, 16, 1),
(89, 14, 17, 1),
(90, 14, 18, 1),
(91, 14, 19, 1),
(92, 14, 20, 1),
(93, 14, 21, 1),
(94, 14, 22, 1),
(95, 14, 23, 1),
(96, 14, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `a_user`
--

CREATE TABLE `a_user` (
  `a_user_id` int(1) UNSIGNED NOT NULL,
  `a_user_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `a_user_username` varchar(100) NOT NULL,
  `a_user_password` varchar(100) NOT NULL,
  `a_user_level` int(1) UNSIGNED NOT NULL,
  `a_user_proc` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Master User';

--
-- Dumping data for table `a_user`
--

INSERT INTO `a_user` (`a_user_id`, `a_user_name`, `a_user_username`, `a_user_password`, `a_user_level`, `a_user_proc`) VALUES
(1, 'Super User', 'super', '$2y$10$VgVsdCt6kPT6KQ5v.RI5u.flM395P.o6wiyzLbwIzLKfIGQkb8mKe', 1, 0),
(35, 'Admin', 'admin', '$2y$10$pVCJ0sEYF/cmY5yghpxIv.G4B8xHRWSeyO3xMRhKD1gfW.Y5m3mUi', 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `g_cond`
--

CREATE TABLE `g_cond` (
  `g_cond_id` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `g_cond`
--

INSERT INTO `g_cond` (`g_cond_id`) VALUES
(0);

-- --------------------------------------------------------

--
-- Table structure for table `m_bp`
--

CREATE TABLE `m_bp` (
  `m_bp_id` int(1) UNSIGNED NOT NULL,
  `m_bp_code` varchar(10) NOT NULL,
  `m_bp_name` varchar(50) NOT NULL,
  `m_bp_alt` text NOT NULL,
  `m_bp_tlp` varchar(30) NOT NULL,
  `m_bp_fax` varchar(30) NOT NULL,
  `m_bp_ctc` varchar(50) NOT NULL,
  `m_bp_jns` tinyint(1) NOT NULL,
  `m_bp_active` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_bp`
--

INSERT INTO `m_bp` (`m_bp_id`, `m_bp_code`, `m_bp_name`, `m_bp_alt`, `m_bp_tlp`, `m_bp_fax`, `m_bp_ctc`, `m_bp_jns`, `m_bp_active`) VALUES
(2, 'D101', 'PT. Astra Daihatsu Motor', 'Jl. Gaya Motor III No. 5 Sunter II Sungai Bambu Tanjung Priok, Jakarta Utara', '(021) 6511-792 Ext : 1162', '(021)  6511-945', 'Ibu. Ani Arsianti (Manager  Log)', 1, 1),
(3, '1231', 'Posco', 'karawang', '021', '(021)  6511-945', 'Agus', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_category`
--

CREATE TABLE `m_category` (
  `m_category_id` int(1) UNSIGNED NOT NULL,
  `m_category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_category`
--

INSERT INTO `m_category` (`m_category_id`, `m_category_name`) VALUES
(1, 'Asset'),
(2, 'Body'),
(3, 'Component'),
(4, 'Consumble'),
(5, 'Electrical Equipment'),
(6, 'Finish Good'),
(7, 'Finish Part'),
(8, 'Footring'),
(9, 'Hand Guard'),
(10, 'IT Asset & Tools'),
(11, 'Machinery'),
(12, 'Mother Sheet'),
(13, 'Neckring'),
(14, 'Office Equipment'),
(15, 'Process'),
(16, 'RMPR'),
(17, 'Raw Material'),
(18, 'Service'),
(19, 'Spare Part'),
(20, 'Standard'),
(21, 'Support Material'),
(22, 'Tooling'),
(23, 'Tools'),
(24, 'Transportasi'),
(25, 'Valve');

-- --------------------------------------------------------

--
-- Table structure for table `m_cust`
--

CREATE TABLE `m_cust` (
  `m_cust_id` int(1) UNSIGNED NOT NULL,
  `m_cust_name` text NOT NULL,
  `m_cust_contact` text NOT NULL,
  `m_cust_alt` text NOT NULL,
  `m_cust_tlp` varchar(50) NOT NULL,
  `m_cust_fax` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_cust`
--

INSERT INTO `m_cust` (`m_cust_id`, `m_cust_name`, `m_cust_contact`, `m_cust_alt`, `m_cust_tlp`, `m_cust_fax`) VALUES
(301, 'PT ABC Indonesia', 'Agus', 'KIIC Karawang Barat', '021', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_item`
--

CREATE TABLE `m_item` (
  `m_item_id` int(1) UNSIGNED NOT NULL,
  `m_item_name` varchar(50) NOT NULL,
  `m_item_price` decimal(9,0) NOT NULL,
  `m_item_uom` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_item`
--

INSERT INTO `m_item` (`m_item_id`, `m_item_name`, `m_item_price`, `m_item_uom`) VALUES
(10000001, 'KABEL LAN', '15000', 5),
(21000001, 'DOOR LOCK', '1250000', 1),
(33000023, 'CCTV', '500000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_project`
--

CREATE TABLE `m_project` (
  `m_project_id` int(1) UNSIGNED NOT NULL,
  `m_project_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_project`
--

INSERT INTO `m_project` (`m_project_id`, `m_project_name`) VALUES
(1, 'BANGUNAN'),
(2, 'JALAN'),
(3, 'JEMBATAN');

-- --------------------------------------------------------

--
-- Table structure for table `m_sts`
--

CREATE TABLE `m_sts` (
  `m_sts_id` int(1) UNSIGNED NOT NULL,
  `m_sts_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_sts`
--

INSERT INTO `m_sts` (`m_sts_id`, `m_sts_name`) VALUES
(1, 'Aktif'),
(2, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `m_sup`
--

CREATE TABLE `m_sup` (
  `m_sup_id` int(1) UNSIGNED NOT NULL,
  `m_sup_name` text NOT NULL,
  `m_sup_contact` text NOT NULL,
  `m_sup_alt` text NOT NULL,
  `m_sup_tlp` varchar(50) NOT NULL,
  `m_sup_fax` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_sup`
--

INSERT INTO `m_sup` (`m_sup_id`, `m_sup_name`, `m_sup_contact`, `m_sup_alt`, `m_sup_tlp`, `m_sup_fax`) VALUES
(111, 'CV Mukti Jaya', 'Alden', 'Jakarta', '021-222-111', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_type`
--

CREATE TABLE `m_type` (
  `m_type_id` int(1) UNSIGNED NOT NULL,
  `m_type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_type`
--

INSERT INTO `m_type` (`m_type_id`, `m_type_name`) VALUES
(1, 'Expense type'),
(2, 'Item'),
(3, 'Resource'),
(4, 'Service');

-- --------------------------------------------------------

--
-- Table structure for table `m_uom`
--

CREATE TABLE `m_uom` (
  `m_uom_id` int(1) UNSIGNED NOT NULL,
  `m_uom_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_uom`
--

INSERT INTO `m_uom` (`m_uom_id`, `m_uom_name`) VALUES
(1, 'Pcs'),
(2, 'Liter'),
(4, 'Gb'),
(5, 'meter');

-- --------------------------------------------------------

--
-- Table structure for table `s_ci_sessions`
--

CREATE TABLE `s_ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `s_ci_sessions`
--

INSERT INTO `s_ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('18plcn378lgfo41ldjclip6tp487hd5e', '::1', 1620546071, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303534353934393b),
('2f9ft16pfiffh6b10l47gtfgu4keklgk', '::1', 1622809551, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632323830393535313b),
('443so9qknmnl1l47c1biq1p5cgshvog2', '::1', 1620341770, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303334313737303b),
('50r34ipispcssto7vlh49a9ivlcki2hj', '::1', 1620331052, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333313035323b),
('5gjur0dbkqdgnfsv3m10vv1u4atm9bdd', '::1', 1620329073, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303332393037333b),
('6vk6k8le8dkbk8e4lni6e0uctagjpgte', '::1', 1620330367, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333303336373b),
('7hunl8si21dmg8i1av2h4ifeg7lago35', '::1', 1620547023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303534363832313b),
('bbba2miimaleb5lppt5sg3pqqccq7mej', '::1', 1621764144, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632313736343132383b757365726e616d657c733a353a227375706572223b69647c733a313a2231223b6e616d617c733a31303a2253757065722055736572223b6c6576656c7c733a313a2231223b69735f6c6f67696e7c623a313b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('cult3lm0frngdp3grjltl97f80ijf8bm', '::1', 1621764807, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632313736343830373b),
('d6j8th74oioi9th55diblhps9el5uv63', '::1', 1620331748, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333313734383b),
('deh541bsj79om3r4toipjjt8i05a4sql', '::1', 1620328731, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303332383733313b),
('e71pt656odejafnnr4v0ieub4er80ea9', '::1', 1620329809, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303332393830393b),
('eetukhv5en22vmvb3vmhtrhgjqi5joo6', '::1', 1620341331, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303334313333313b),
('eki3uoq9g6itmkj04c4qurkc4n15bhqf', '::1', 1622809901, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632323830393930313b757365726e616d657c733a353a227375706572223b69647c733a313a2231223b6e616d617c733a31303a2253757065722055736572223b6c6576656c7c733a313a2231223b69735f6c6f67696e7c623a313b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('fjbie3611n9g01mvh57iel0533vg2jin', '::1', 1620330742, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333303734323b),
('glv4ppukf7duvgtrosdd917e71n37i3b', '::1', 1620332432, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333323433323b),
('gtvotdcnuto0qj17j2iourj6jjirn97f', '::1', 1620329823, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303332393830393b),
('h77hfklasc2j0tc11bb05prssf16l5rm', '::1', 1620340670, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303334303637303b),
('hmvmmi11qo8i5ggrvhhug310crb7q86s', '::1', 1620546821, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303534363832313b),
('ii4t4tdte3c9a8bkq7eks0ur91bh0v15', '::1', 1620329440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303332393434303b),
('itd07egrclv0oqt0n1r4oro6d81kakgl', '::1', 1620545391, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303534353339313b),
('l2cn91ek8cgjqhhk79oj71q4ajb9s678', '::1', 1622810042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632323831303031303b5f5f63695f766172737c613a323a7b733a353a226572726f72223b733a333a226f6c64223b733a373a2273756363657373223b733a333a226f6c64223b7d757365726e616d657c733a353a227375706572223b69647c733a313a2231223b6e616d617c733a31303a2253757065722055736572223b6c6576656c7c733a313a2231223b69735f6c6f67696e7c623a313b),
('mgikqkdoop6di9kar1vktds21qts5o3p', '::1', 1620340987, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303334303938373b),
('n1qfls8tncntimi5q9jdsnqg4fr2odcs', '::1', 1620341770, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303334313737303b),
('nd8ollr284aofvm54u3aa4f8hgecpn2u', '::1', 1620331381, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333313338313b),
('sdpdse38vkgu534i8b902hqiqr29onnk', '::1', 1620332049, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333323034393b),
('se09g88acq30bhe0fgua505pka7h6n3h', '::1', 1620332460, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303333323433323b),
('td6bjcavvkntlh7vvhmuccrn7n6g081g', '::1', 1620545949, 0x5f5f63695f6c6173745f726567656e65726174657c693a313632303534353934393b);

-- --------------------------------------------------------

--
-- Table structure for table `t_in`
--

CREATE TABLE `t_in` (
  `t_in_id` int(1) UNSIGNED NOT NULL,
  `t_in_item` int(1) UNSIGNED NOT NULL,
  `t_in_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_in_price` decimal(9,0) NOT NULL,
  `t_in_qty` decimal(5,0) NOT NULL,
  `t_in_uom` int(1) UNSIGNED NOT NULL,
  `t_in_sup` int(1) UNSIGNED NOT NULL,
  `t_in_note` text NOT NULL,
  `t_in_user` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_in`
--

INSERT INTO `t_in` (`t_in_id`, `t_in_item`, `t_in_date`, `t_in_price`, `t_in_qty`, `t_in_uom`, `t_in_sup`, `t_in_note`, `t_in_user`) VALUES
(1, 33000023, '2021-01-07 08:17:55', '500000', '100', 1, 111, 'ok', 1),
(2, 33000023, '2021-01-07 08:18:58', '500000', '125', 1, 111, 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_inv_head`
--

CREATE TABLE `t_inv_head` (
  `t_inv_head_id` varchar(50) NOT NULL,
  `t_inv_head_date` date NOT NULL,
  `t_inv_head_cust` int(1) UNSIGNED NOT NULL,
  `t_inv_head_pay` decimal(10,2) NOT NULL,
  `t_inv_head_pay_date` date NOT NULL,
  `t_inv_head_sts` varchar(50) NOT NULL,
  `t_inv_head_usr` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_inv_head`
--

INSERT INTO `t_inv_head` (`t_inv_head_id`, `t_inv_head_date`, `t_inv_head_cust`, `t_inv_head_pay`, `t_inv_head_pay_date`, `t_inv_head_sts`, `t_inv_head_usr`) VALUES
('INV/1/BSC/I/2020', '2021-01-10', 301, '0.00', '2021-01-15', 'Piutang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_inv_line`
--

CREATE TABLE `t_inv_line` (
  `t_inv_line_id` int(1) UNSIGNED NOT NULL,
  `t_inv_line_head` varchar(50) NOT NULL,
  `t_inv_line_item` int(1) UNSIGNED NOT NULL,
  `t_inv_line_qty` decimal(6,2) NOT NULL,
  `t_inv_line_price` decimal(10,2) NOT NULL,
  `t_inv_line_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_inv_line`
--

INSERT INTO `t_inv_line` (`t_inv_line_id`, `t_inv_line_head`, `t_inv_line_item`, `t_inv_line_qty`, `t_inv_line_price`, `t_inv_line_amount`) VALUES
(2, 'INV/1/BSC/I/2020', 33000023, '2.00', '250000.00', '500000.00'),
(3, 'INV/1/BSC/I/2020', 21000001, '5.00', '2000000.00', '10000000.00'),
(4, 'INV/1/BSC/I/2020', 10000001, '20.00', '12500.00', '250000.00');

-- --------------------------------------------------------

--
-- Table structure for table `t_out`
--

CREATE TABLE `t_out` (
  `t_out_id` int(1) UNSIGNED NOT NULL,
  `t_out_item` int(1) UNSIGNED NOT NULL,
  `t_out_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_out_price` decimal(9,0) NOT NULL,
  `t_out_qty` decimal(5,0) NOT NULL,
  `t_out_uom` int(1) UNSIGNED NOT NULL,
  `t_out_serial` varchar(20) NOT NULL,
  `t_out_project` int(1) UNSIGNED NOT NULL,
  `t_out_note` text NOT NULL,
  `t_out_user` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_out`
--

INSERT INTO `t_out` (`t_out_id`, `t_out_item`, `t_out_date`, `t_out_price`, `t_out_qty`, `t_out_uom`, `t_out_serial`, `t_out_project`, `t_out_note`, `t_out_user`) VALUES
(1, 21000001, '2020-12-04 10:05:36', '75', '20', 1, 'ABC', 2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_pnw_head`
--

CREATE TABLE `t_pnw_head` (
  `t_pnw_head_id` int(1) UNSIGNED NOT NULL,
  `t_pnw_head_date` date NOT NULL,
  `t_pnw_head_cust` int(1) UNSIGNED NOT NULL,
  `t_pnw_head_ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pnw_head`
--

INSERT INTO `t_pnw_head` (`t_pnw_head_id`, `t_pnw_head_date`, `t_pnw_head_cust`, `t_pnw_head_ket`) VALUES
(1, '2021-01-10', 301, '');

-- --------------------------------------------------------

--
-- Table structure for table `t_pnw_line`
--

CREATE TABLE `t_pnw_line` (
  `t_pnw_line_id` int(1) UNSIGNED NOT NULL,
  `t_pnw_line_head` int(1) UNSIGNED NOT NULL,
  `t_pnw_line_item` int(1) UNSIGNED NOT NULL,
  `t_pnw_line_qty` decimal(6,2) NOT NULL,
  `t_pnw_line_price` decimal(10,2) NOT NULL,
  `t_pnw_line_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pnw_line`
--

INSERT INTO `t_pnw_line` (`t_pnw_line_id`, `t_pnw_line_head`, `t_pnw_line_item`, `t_pnw_line_qty`, `t_pnw_line_price`, `t_pnw_line_amount`) VALUES
(2, 1, 33000023, '1.00', '550000.00', '550000.00'),
(3, 1, 21000001, '1.00', '1500000.00', '1500000.00'),
(4, 1, 10000001, '1.00', '15000.00', '15000.00');

-- --------------------------------------------------------

--
-- Table structure for table `t_trans`
--

CREATE TABLE `t_trans` (
  `t_trans_id` int(1) UNSIGNED NOT NULL,
  `t_trans_cat` varchar(5) NOT NULL,
  `t_trans_cat_id` int(1) UNSIGNED NOT NULL,
  `t_trans_item` int(1) UNSIGNED NOT NULL,
  `t_trans_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `t_trans_price` decimal(9,0) NOT NULL,
  `t_trans_qty` decimal(5,0) NOT NULL,
  `t_trans_uom` int(1) UNSIGNED NOT NULL,
  `t_trans_serial` varchar(20) NOT NULL,
  `t_trans_project` int(1) UNSIGNED NOT NULL,
  `t_trans_note` text NOT NULL,
  `t_trans_user` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_trans`
--

INSERT INTO `t_trans` (`t_trans_id`, `t_trans_cat`, `t_trans_cat_id`, `t_trans_item`, `t_trans_date`, `t_trans_price`, `t_trans_qty`, `t_trans_uom`, `t_trans_serial`, `t_trans_project`, `t_trans_note`, `t_trans_user`) VALUES
(1, 'IN', 1, 33000023, '2021-01-07 08:17:55', '500000', '100', 1, '111', 0, 'ok', 1),
(2, 'IN', 2, 33000023, '2021-01-07 08:18:58', '500000', '125', 1, '111', 0, 'ok', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_group`
--
ALTER TABLE `a_group`
  ADD PRIMARY KEY (`a_group_id`),
  ADD KEY `a_group_level` (`a_group_level`),
  ADD KEY `a_group_menu` (`a_group_menu`);

--
-- Indexes for table `a_level`
--
ALTER TABLE `a_level`
  ADD PRIMARY KEY (`a_level_id`),
  ADD UNIQUE KEY `a_level_name` (`a_level_name`);

--
-- Indexes for table `a_menu`
--
ALTER TABLE `a_menu`
  ADD PRIMARY KEY (`a_menu_id`);

--
-- Indexes for table `a_mn`
--
ALTER TABLE `a_mn`
  ADD PRIMARY KEY (`a_mn_id`);

--
-- Indexes for table `a_mn_grp`
--
ALTER TABLE `a_mn_grp`
  ADD PRIMARY KEY (`a_mn_grp_id`);

--
-- Indexes for table `a_user`
--
ALTER TABLE `a_user`
  ADD PRIMARY KEY (`a_user_id`),
  ADD UNIQUE KEY `username` (`a_user_username`),
  ADD KEY `a_user_level` (`a_user_level`);

--
-- Indexes for table `m_bp`
--
ALTER TABLE `m_bp`
  ADD PRIMARY KEY (`m_bp_id`);

--
-- Indexes for table `m_category`
--
ALTER TABLE `m_category`
  ADD PRIMARY KEY (`m_category_id`);

--
-- Indexes for table `m_cust`
--
ALTER TABLE `m_cust`
  ADD PRIMARY KEY (`m_cust_id`);

--
-- Indexes for table `m_item`
--
ALTER TABLE `m_item`
  ADD PRIMARY KEY (`m_item_id`),
  ADD UNIQUE KEY `Nama_Barang` (`m_item_name`),
  ADD KEY `item_id` (`m_item_id`),
  ADD KEY `m_item_name` (`m_item_name`),
  ADD KEY `m_item_uom` (`m_item_uom`);

--
-- Indexes for table `m_project`
--
ALTER TABLE `m_project`
  ADD PRIMARY KEY (`m_project_id`),
  ADD UNIQUE KEY `Nama_Barang` (`m_project_name`),
  ADD KEY `item_id` (`m_project_id`),
  ADD KEY `m_item_name` (`m_project_name`);

--
-- Indexes for table `m_sts`
--
ALTER TABLE `m_sts`
  ADD PRIMARY KEY (`m_sts_id`);

--
-- Indexes for table `m_sup`
--
ALTER TABLE `m_sup`
  ADD PRIMARY KEY (`m_sup_id`);

--
-- Indexes for table `m_type`
--
ALTER TABLE `m_type`
  ADD PRIMARY KEY (`m_type_id`);

--
-- Indexes for table `m_uom`
--
ALTER TABLE `m_uom`
  ADD PRIMARY KEY (`m_uom_id`);

--
-- Indexes for table `s_ci_sessions`
--
ALTER TABLE `s_ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `t_in`
--
ALTER TABLE `t_in`
  ADD PRIMARY KEY (`t_in_id`),
  ADD KEY `t_in_user` (`t_in_user`),
  ADD KEY `t_in_item` (`t_in_item`),
  ADD KEY `t_in_uom` (`t_in_uom`);

--
-- Indexes for table `t_inv_head`
--
ALTER TABLE `t_inv_head`
  ADD PRIMARY KEY (`t_inv_head_id`);

--
-- Indexes for table `t_inv_line`
--
ALTER TABLE `t_inv_line`
  ADD PRIMARY KEY (`t_inv_line_id`);

--
-- Indexes for table `t_out`
--
ALTER TABLE `t_out`
  ADD PRIMARY KEY (`t_out_id`),
  ADD KEY `t_out_item` (`t_out_item`),
  ADD KEY `t_out_user` (`t_out_user`),
  ADD KEY `t_out_uom` (`t_out_uom`),
  ADD KEY `t_out_project` (`t_out_project`);

--
-- Indexes for table `t_pnw_head`
--
ALTER TABLE `t_pnw_head`
  ADD PRIMARY KEY (`t_pnw_head_id`);

--
-- Indexes for table `t_pnw_line`
--
ALTER TABLE `t_pnw_line`
  ADD PRIMARY KEY (`t_pnw_line_id`);

--
-- Indexes for table `t_trans`
--
ALTER TABLE `t_trans`
  ADD PRIMARY KEY (`t_trans_id`),
  ADD KEY `t_trans_item` (`t_trans_item`),
  ADD KEY `t_trans_user` (`t_trans_user`),
  ADD KEY `t_trans_uom` (`t_trans_uom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_group`
--
ALTER TABLE `a_group`
  MODIFY `a_group_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `a_level`
--
ALTER TABLE `a_level`
  MODIFY `a_level_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `a_menu`
--
ALTER TABLE `a_menu`
  MODIFY `a_menu_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `a_mn`
--
ALTER TABLE `a_mn`
  MODIFY `a_mn_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `a_mn_grp`
--
ALTER TABLE `a_mn_grp`
  MODIFY `a_mn_grp_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `a_user`
--
ALTER TABLE `a_user`
  MODIFY `a_user_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `m_bp`
--
ALTER TABLE `m_bp`
  MODIFY `m_bp_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_category`
--
ALTER TABLE `m_category`
  MODIFY `m_category_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `m_project`
--
ALTER TABLE `m_project`
  MODIFY `m_project_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_sts`
--
ALTER TABLE `m_sts`
  MODIFY `m_sts_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_type`
--
ALTER TABLE `m_type`
  MODIFY `m_type_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_uom`
--
ALTER TABLE `m_uom`
  MODIFY `m_uom_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_in`
--
ALTER TABLE `t_in`
  MODIFY `t_in_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_inv_line`
--
ALTER TABLE `t_inv_line`
  MODIFY `t_inv_line_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_out`
--
ALTER TABLE `t_out`
  MODIFY `t_out_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pnw_head`
--
ALTER TABLE `t_pnw_head`
  MODIFY `t_pnw_head_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pnw_line`
--
ALTER TABLE `t_pnw_line`
  MODIFY `t_pnw_line_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_trans`
--
ALTER TABLE `t_trans`
  MODIFY `t_trans_id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `a_group`
--
ALTER TABLE `a_group`
  ADD CONSTRAINT `a_group_ibfk_1` FOREIGN KEY (`a_group_menu`) REFERENCES `a_menu` (`a_menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `a_group_ibfk_2` FOREIGN KEY (`a_group_level`) REFERENCES `a_level` (`a_level_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `a_user`
--
ALTER TABLE `a_user`
  ADD CONSTRAINT `a_user_ibfk_1` FOREIGN KEY (`a_user_level`) REFERENCES `a_level` (`a_level_id`);

--
-- Constraints for table `m_item`
--
ALTER TABLE `m_item`
  ADD CONSTRAINT `m_item_ibfk_1` FOREIGN KEY (`m_item_uom`) REFERENCES `m_uom` (`m_uom_id`);

--
-- Constraints for table `t_in`
--
ALTER TABLE `t_in`
  ADD CONSTRAINT `t_in_ibfk_1` FOREIGN KEY (`t_in_user`) REFERENCES `a_user` (`a_user_id`),
  ADD CONSTRAINT `t_in_ibfk_2` FOREIGN KEY (`t_in_item`) REFERENCES `m_item` (`m_item_id`),
  ADD CONSTRAINT `t_in_ibfk_3` FOREIGN KEY (`t_in_uom`) REFERENCES `m_uom` (`m_uom_id`);

--
-- Constraints for table `t_out`
--
ALTER TABLE `t_out`
  ADD CONSTRAINT `t_out_ibfk_1` FOREIGN KEY (`t_out_item`) REFERENCES `m_item` (`m_item_id`),
  ADD CONSTRAINT `t_out_ibfk_2` FOREIGN KEY (`t_out_user`) REFERENCES `a_user` (`a_user_id`),
  ADD CONSTRAINT `t_out_ibfk_3` FOREIGN KEY (`t_out_uom`) REFERENCES `m_uom` (`m_uom_id`),
  ADD CONSTRAINT `t_out_ibfk_4` FOREIGN KEY (`t_out_project`) REFERENCES `m_project` (`m_project_id`);

--
-- Constraints for table `t_trans`
--
ALTER TABLE `t_trans`
  ADD CONSTRAINT `t_trans_ibfk_1` FOREIGN KEY (`t_trans_item`) REFERENCES `m_item` (`m_item_id`),
  ADD CONSTRAINT `t_trans_ibfk_2` FOREIGN KEY (`t_trans_user`) REFERENCES `a_user` (`a_user_id`),
  ADD CONSTRAINT `t_trans_ibfk_3` FOREIGN KEY (`t_trans_uom`) REFERENCES `m_uom` (`m_uom_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
