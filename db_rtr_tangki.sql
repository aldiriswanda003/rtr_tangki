-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 03:06 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rtr_tangki`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_surat_tangki`
--

CREATE TABLE `table_surat_tangki` (
  `id_surat` int(11) NOT NULL,
  `id_tangki` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `foto_surat` longtext NOT NULL,
  `tanggal_expired` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_surat_tangki`
--

INSERT INTO `table_surat_tangki` (`id_surat`, `id_tangki`, `id_supir`, `jenis_surat`, `foto_surat`, `tanggal_expired`, `status`) VALUES
(28, 3, 0, 'KIR', 'KIR_A_8626_ZK_copy.jpg', '2023-07-25', 0),
(31, 5, 0, 'PAJAK', 'IMG-20230708-WA0001.jpg', '2023-07-15', 1),
(32, 5, 0, 'KIR', 'KIR_-_DA_8591_JG_-_EXP_03_AGUSTUS_2023.jpg', '2023-07-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_angkutan`
--

CREATE TABLE `tb_angkutan` (
  `id_angkutan` int(11) NOT NULL,
  `id_supir_tangki` int(11) NOT NULL,
  `id_tujuan` int(11) NOT NULL,
  `tgl_berangkat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_angkutan`
--

INSERT INTO `tb_angkutan` (`id_angkutan`, `id_supir_tangki`, `id_tujuan`, `tgl_berangkat`) VALUES
(3, 2, 1, '2023-07-21'),
(4, 2, 2, '2023-07-08'),
(5, 5, 1, '2023-07-07'),
(6, 4, 2, '2023-07-14'),
(8, 2, 1, '2023-06-07'),
(9, 4, 2, '2023-05-10'),
(10, 2, 2, '2023-05-06'),
(11, 2, 1, '2023-06-09'),
(12, 4, 2, '2023-07-13'),
(13, 5, 1, '2023-04-11'),
(14, 5, 2, '2023-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bengkel`
--

CREATE TABLE `tb_bengkel` (
  `id_bengkel` int(11) NOT NULL,
  `nama_bengkel` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_bengkel`
--

INSERT INTO `tb_bengkel` (`id_bengkel`, `nama_bengkel`, `alamat`, `no_telp`) VALUES
(1, 'H.ISUR', 'A. YANI PAL 18 KAB.BANJAR', '082154342099'),
(2, 'WARDAH SOLUTION', 'Jl. Jahri Saleh', '90909090'),
(3, 'BERKAH BERSAUDARA', 'Pal 17 Seberang SMA BANUA', '909090909'),
(4, 'BENGKEL KAYUTANGI', 'Jl. Kayutangi ujung', '9090909090'),
(8, 'bengkel jaka', 'jl. sungai jingah', '0896827646363');

-- --------------------------------------------------------

--
-- Table structure for table `tb_exp_surat`
--

CREATE TABLE `tb_exp_surat` (
  `id_exp_surat` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `perkiraan_biaya` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_exp_surat`
--

INSERT INTO `tb_exp_surat` (`id_exp_surat`, `id_surat`, `perkiraan_biaya`) VALUES
(21, 28, 1600000),
(22, 31, 6500000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pengeluaran` text NOT NULL,
  `biaya_pengeluaran` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `tanggal`, `nama_pengeluaran`, `biaya_pengeluaran`) VALUES
(1, '2023-06-14', 'bayar parkir di bengkel wardah', 100000),
(3, '2023-06-15', 'Biaya KIR 8372 ZD', 100000),
(4, '2023-06-16', 'Bayar Wifi Kantor RTR', 50000),
(5, '2023-07-17', 'KIR DA 8313 ZD', 1200000),
(7, '2023-07-21', 'KIR DA 8908 CB budi', 1100000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perbaikan`
--

CREATE TABLE `tb_perbaikan` (
  `id_perbaikan` int(11) NOT NULL,
  `id_service_masuk` int(11) NOT NULL,
  `tgl_perbaikan` date NOT NULL,
  `keterangan` text NOT NULL,
  `biaya_perbaikan` double NOT NULL,
  `foto_nota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perbaikan`
--

INSERT INTO `tb_perbaikan` (`id_perbaikan`, `id_service_masuk`, `tgl_perbaikan`, `keterangan`, `biaya_perbaikan`, `foto_nota`) VALUES
(3, 10, '2023-06-18', 'Beli ban baru ukuran 1000 1 buah dan selir ban 1 buah', 250000, 'DA_8375_JE_-_GEMUk.jpeg'),
(5, 8, '2023-06-18', 'BAIKI RADIATOR WADAH ENGKOH PAL 6', 550000, 'DA_8907_CB.jpeg'),
(6, 10, '2023-05-18', 'BELI BAN DI NAGAMAS BAN 2 BUAH', 3000000, 'DA_8936_TAO_-_PERBAIKAN_STEKL_GARDAN.jpeg'),
(7, 8, '2023-06-22', 'SERVICE RADIATOR', 4000000, 'DA_8375_JE_-_GEMUk.jpeg'),
(8, 7, '2023-06-24', 'BELAKANG KIRI 2', 100000, ''),
(10, 11, '2023-05-27', 'perbaikan kampas kopling dan kampas rem', 330000, 'DA_8313_ZD_-_OLI_MESIN_DLL.jpeg'),
(11, 13, '2023-07-03', 'perbaikan kelistrikan, kabel 1 roll, upah maintenance', 300000, 'DA_8936_TAO_-_PINION.jpeg'),
(12, 12, '2023-07-06', 'LAS TANGKI', 150000, 'KH_8505_AV_-_klahar_sel_buntut.jpeg'),
(13, 14, '2023-07-30', 'Tali gigi pagat, dibelikan di BUDI MOTOR Sparepart nya', 600000, 'DA_8197_JH_-_FILTER_UDARA.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_seri_ban`
--

CREATE TABLE `tb_seri_ban` (
  `id_seri_ban` int(11) NOT NULL,
  `id_tangki` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `tempat_beli` varchar(50) NOT NULL,
  `no_seri_ban` varchar(50) NOT NULL,
  `ukuran_ban` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_seri_ban`
--

INSERT INTO `tb_seri_ban` (`id_seri_ban`, `id_tangki`, `tanggal_beli`, `tempat_beli`, `no_seri_ban`, `ukuran_ban`, `keterangan`) VALUES
(5, 1, '2023-07-17', 'HASNUR BAN', 'BAN 0221', '750.20', 'ditaruh didepan sebelah kiri'),
(7, 9, '2023-07-29', 'REMAJA BAN', 'GT 002', '1000 - 20', 'BELAKANG KIRI 2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_service_masuk`
--

CREATE TABLE `tb_service_masuk` (
  `id_service_masuk` int(11) NOT NULL,
  `id_supir_tangki` int(11) NOT NULL,
  `id_bengkel` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `keluhan` text NOT NULL,
  `biaya` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_service_masuk`
--

INSERT INTO `tb_service_masuk` (`id_service_masuk`, `id_supir_tangki`, `id_bengkel`, `tgl_masuk`, `keluhan`, `biaya`, `status`) VALUES
(9, 5, 1, '2023-06-11', 'pergantian kampas rem,  ganti oli, perbaikan radiator. Beli Kampas Kopling + Upah pasang kampas kopling, Perbaiki Kelistrikan.', 1500000, 0),
(10, 6, 3, '2023-06-18', 'ban rabit', 150000, 0),
(11, 6, 1, '2023-05-27', 'kampas kopling', 200000, 1),
(12, 2, 4, '2023-05-24', 'Ban Pecah jarrr', 200000, 1),
(13, 6, 4, '2023-07-02', 'lampu mati', 200000, 1),
(14, 9, 8, '2023-07-30', 'Pagat Tali gigi', 600000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supir`
--

CREATE TABLE `tb_supir` (
  `id_supir` int(11) NOT NULL,
  `nama_supir` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email_supir` varchar(50) NOT NULL,
  `foto_supir` varchar(50) NOT NULL,
  `foto_sim` varchar(50) NOT NULL,
  `foto_ktp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supir`
--

INSERT INTO `tb_supir` (`id_supir`, `nama_supir`, `no_telp`, `email_supir`, `foto_supir`, `foto_sim`, `foto_ktp`) VALUES
(1, 'Kasnuri anjir', '0823-5052-9288', '', 'KASNURI_-_MAU.png', 'KTP_-_KASNURI.jpg', 'KTP_-_KASNURI.jpg'),
(2, 'M Tri Ade Septiawan', '0852-4682-0886', '', 'M_TRI_ADE_SEPTIAWAN_-_FOTO_2.jpg', 'SIM_WAWAN.jpg', 'febad731-81f4-4e63-9535-66535bd42f34.jpg'),
(3, 'JAMALI', '082155603699', '', 'JAMALI_-_FOTO.jpg', 'JAMALI_-_SIM.png', 'JAMALI_-_KTP.png'),
(4, 'SARMIDI', '081345458234', 'devina.tirtha43@gmail.com', 'SARMIDI_-_FOTO.jpg', 'SIM_B_II_UMUM_-_SARMIDI.jpg', 'SARMIDI_-_KTP.jpg'),
(6, 'M. BUDI PRAYITNO', '081258422869', '', 'BUDI_-_FOTO_3.jpg', 'SIM_-_BUDI.jpg', 'KTP_-BUDI.jpg'),
(7, 'RAMADANI', '082214720840', '', 'RAMADANI_4x6.jpg', 'SIM_BII_UMUM_-_RAMADANI.jpg', 'KTP_-_RAMADANI.jpg'),
(8, 'AKHMAD RIDUAN', '081256894940', '', 'AKHMAD_RIDUAN_-_FOTO_2.jpg', 'SIM_RIDUAN.jpg', 'KTP_ridwan_asli.jpg'),
(9, 'JUNAIDI', '085245063554', '', 'PAS_FOTO_4_X_6_JUNAIDI_1.png', 'SIM_B_2_UMUM_-_JUNAIDI.jpg', 'KTP_-_JUNAIDI.jpg'),
(10, 'AULIA RAHMAN', '081258237185', 'pt.rahmattaufikramadan@gmail.com', 'FOTO_RAHMAN.png', 'SIM_B1_UMUM_-_AULIA_RAHMAN.jpg', 'KTP_-_AULIA_RAHMAN.jpg'),
(11, 'MUHAMMAD ISMAIL', '081345458234', 'pt.rahmattaufikramadan@gmail.com', 'MUHAMMAD_ISMAIL_-_FOTO_2.jpg', 'SIM_B_2_umum_-_ISMAIL.jpg', 'KTP_-_ISMAIL.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supir_tangki`
--

CREATE TABLE `tb_supir_tangki` (
  `id_supir_tangki` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_tangki` int(11) NOT NULL,
  `tanggal_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supir_tangki`
--

INSERT INTO `tb_supir_tangki` (`id_supir_tangki`, `id_supir`, `id_tangki`, `tanggal_update`) VALUES
(2, 3, 3, '2023-06-06'),
(5, 9, 9, '2023-06-11'),
(6, 4, 5, '2023-06-18'),
(7, 11, 4, '2023-07-26'),
(8, 1, 1, '2023-07-26'),
(9, 2, 2, '2023-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tangki`
--

CREATE TABLE `tb_tangki` (
  `id_tangki` int(11) NOT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `tahun_dibuat` varchar(11) DEFAULT NULL,
  `volume_tangki` int(11) DEFAULT NULL,
  `foto_depan` varchar(50) NOT NULL,
  `foto_belakang` varchar(50) NOT NULL,
  `foto_kiri` varchar(50) NOT NULL,
  `foto_kanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tangki`
--

INSERT INTO `tb_tangki` (`id_tangki`, `nopol`, `tahun_dibuat`, `volume_tangki`, `foto_depan`, `foto_belakang`, `foto_kiri`, `foto_kanan`) VALUES
(1, 'KH 8505 AV', '2013', 5000, '', '', '', ''),
(2, 'DA 8375 JE', '2011', 10000, '', '', '', ''),
(3, 'DA 8322 TAP', '2006', 20000, '', '', '', ''),
(4, 'DA 8641 CK', '2008', 10000, '', '', '', ''),
(5, 'DA 8591 JG', '2021', 10000, '', '', '', ''),
(9, 'W 8018 UD', '2012', 16000, 'FOTO_DEPAN_-_W_8018_UD.jpg', 'FOTO_belakang_-_W_8018_UD.jpg', 'FOTO_kiri_-_W_8018_UD.jpg', 'FOTO_kanan_-_W_8018_UD.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tujuan`
--

CREATE TABLE `tb_tujuan` (
  `id_tujuan` int(11) NOT NULL,
  `nama_tujuan` varchar(100) NOT NULL,
  `kilometer_pp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tujuan`
--

INSERT INTO `tb_tujuan` (`id_tujuan`, `nama_tujuan`, `kilometer_pp`) VALUES
(1, 'PT. BSS - Kandangan', 240),
(2, 'PT. ARUTMIN INDONESIA - KINTAP', 340);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `nama`, `password`, `level`) VALUES
(1, 'admin', 'admin1', '$2y$10$cM37T1xmMrLlmmyEDXIpdu/q4q7.TxFGLrinLAo87NBlyyKil7zi6', 0),
(2, 'coba1', 'COBA1', '$2y$10$/kgb.p2hPcATlYR21e2T6uZcT4oQUZjNVzYPsueTAiHc5m/6k6x16', 2),
(3, 'ary', 'ary', '$2y$10$jIKsox9oYFtjVKUObbbNvOaaeirce2rgG9b5JHWGhWGu.PsSXjxu.', 1),
(4, 'admin2', 'Jaka Permana', '$2y$10$aN4zNgD3rGEu8TJ7wP.ApO6zr4rWN9uZWduh3X.N0BZJDP7/KvP3u', 0),
(5, 'devinabos', 'Devina', '$2y$10$JUTH5jAnVVD3AxLCuJv9leqP66Sz35Luc8OHfdWymZYRw81gq5D0m', 1),
(6, 'bayunug', 'Bayu Nugroho', '$2y$10$kIHuyHv8llmMPM2HESMF3.ujGZIIKLYj6VBgEJAx03Ui6Cm6QCiZG', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_surat_tangki`
--
ALTER TABLE `table_surat_tangki`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_tangki` (`id_tangki`),
  ADD KEY `id_supir` (`id_supir`);

--
-- Indexes for table `tb_angkutan`
--
ALTER TABLE `tb_angkutan`
  ADD PRIMARY KEY (`id_angkutan`),
  ADD KEY `id_tangki` (`id_supir_tangki`),
  ADD KEY `id_tujuan` (`id_tujuan`);

--
-- Indexes for table `tb_bengkel`
--
ALTER TABLE `tb_bengkel`
  ADD PRIMARY KEY (`id_bengkel`);

--
-- Indexes for table `tb_exp_surat`
--
ALTER TABLE `tb_exp_surat`
  ADD PRIMARY KEY (`id_exp_surat`),
  ADD KEY `id_tangki` (`id_surat`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `tb_perbaikan`
--
ALTER TABLE `tb_perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `id_service_masuk` (`id_service_masuk`);

--
-- Indexes for table `tb_seri_ban`
--
ALTER TABLE `tb_seri_ban`
  ADD PRIMARY KEY (`id_seri_ban`),
  ADD KEY `id_tangki` (`id_tangki`);

--
-- Indexes for table `tb_service_masuk`
--
ALTER TABLE `tb_service_masuk`
  ADD PRIMARY KEY (`id_service_masuk`),
  ADD KEY `id_supir_tangki` (`id_supir_tangki`),
  ADD KEY `id_bengkel` (`id_bengkel`);

--
-- Indexes for table `tb_supir`
--
ALTER TABLE `tb_supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `tb_supir_tangki`
--
ALTER TABLE `tb_supir_tangki`
  ADD PRIMARY KEY (`id_supir_tangki`),
  ADD KEY `id_supir` (`id_supir`),
  ADD KEY `id_tangki` (`id_tangki`);

--
-- Indexes for table `tb_tangki`
--
ALTER TABLE `tb_tangki`
  ADD PRIMARY KEY (`id_tangki`);

--
-- Indexes for table `tb_tujuan`
--
ALTER TABLE `tb_tujuan`
  ADD PRIMARY KEY (`id_tujuan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_surat_tangki`
--
ALTER TABLE `table_surat_tangki`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_angkutan`
--
ALTER TABLE `tb_angkutan`
  MODIFY `id_angkutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_bengkel`
--
ALTER TABLE `tb_bengkel`
  MODIFY `id_bengkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_exp_surat`
--
ALTER TABLE `tb_exp_surat`
  MODIFY `id_exp_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_perbaikan`
--
ALTER TABLE `tb_perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_seri_ban`
--
ALTER TABLE `tb_seri_ban`
  MODIFY `id_seri_ban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_service_masuk`
--
ALTER TABLE `tb_service_masuk`
  MODIFY `id_service_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_supir`
--
ALTER TABLE `tb_supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_supir_tangki`
--
ALTER TABLE `tb_supir_tangki`
  MODIFY `id_supir_tangki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_tangki`
--
ALTER TABLE `tb_tangki`
  MODIFY `id_tangki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_tujuan`
--
ALTER TABLE `tb_tujuan`
  MODIFY `id_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_surat_tangki`
--
ALTER TABLE `table_surat_tangki`
  ADD CONSTRAINT `table_surat_tangki_ibfk_1` FOREIGN KEY (`id_tangki`) REFERENCES `tb_tangki` (`id_tangki`);

--
-- Constraints for table `tb_seri_ban`
--
ALTER TABLE `tb_seri_ban`
  ADD CONSTRAINT `tb_seri_ban_ibfk_1` FOREIGN KEY (`id_tangki`) REFERENCES `tb_tangki` (`id_tangki`);

--
-- Constraints for table `tb_service_masuk`
--
ALTER TABLE `tb_service_masuk`
  ADD CONSTRAINT `tb_service_masuk_ibfk_1` FOREIGN KEY (`id_supir_tangki`) REFERENCES `tb_supir_tangki` (`id_supir_tangki`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_supir_tangki`
--
ALTER TABLE `tb_supir_tangki`
  ADD CONSTRAINT `tb_supir_tangki_ibfk_2` FOREIGN KEY (`id_supir`) REFERENCES `tb_supir` (`id_supir`),
  ADD CONSTRAINT `tb_supir_tangki_ibfk_3` FOREIGN KEY (`id_tangki`) REFERENCES `tb_tangki` (`id_tangki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
