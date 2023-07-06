-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 04:10 PM
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
  `nopol` varchar(50) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `foto_surat` longtext NOT NULL,
  `tanggal_expired` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_surat_tangki`
--

INSERT INTO `table_surat_tangki` (`id_surat`, `id_tangki`, `nopol`, `jenis_surat`, `foto_surat`, `tanggal_expired`, `status`) VALUES
(25, 2, '', 'PAJAK', 'STNK_-_KH_8505_AV_-_28_Feb_2023.png', '2023-02-28', 1),
(28, 3, '', 'KIR', 'KIR_A_8626_ZK_copy.jpg', '2023-06-21', 0),
(29, 2, '', 'STNK', 'PAS_FOTO_4X_6_-_M_TRI_ADE_SEPTIAWAN.jpg', '2023-06-30', 0);

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
(4, 'BENGKEL KAYUTANGI', 'Jl. Kayutangi ujung', '9090909090');

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
  `tgl_masuk` date NOT NULL,
  `keterangan` text NOT NULL,
  `biaya_perbaikan` varchar(50) NOT NULL,
  `foto_nota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perbaikan`
--

INSERT INTO `tb_perbaikan` (`id_perbaikan`, `id_service_masuk`, `tgl_masuk`, `keterangan`, `biaya_perbaikan`, `foto_nota`) VALUES
(2, 7, '2023-06-18', 'Gamti oli, filter oli, filter minyak.', 'Rp. 700.000', ''),
(3, 10, '2023-06-18', 'Beli ban baru ukuran 1000 1 buah dan selir ban 1 buah', 'Rp. 1.000.000', ''),
(5, 8, '2023-06-18', 'BAIKI RADIATOR WADAH ENGKOH PAL 6', 'Rp. 6.000.000', ''),
(6, 10, '2023-06-18', 'BELI BAN DI NAGAMAS BAN 2 BUAH', 'Rp. 2.500.000', '');

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
(1, 1, '2023-06-04', 'REMAJA BAN', '001', '750', 'dibelakang sebelah kanan'),
(2, 1, '2023-06-04', 'REMAJA BAN', '001', '750', 'dibelakang sebelah kanan');

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
  `biaya` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_service_masuk`
--

INSERT INTO `tb_service_masuk` (`id_service_masuk`, `id_supir_tangki`, `id_bengkel`, `tgl_masuk`, `keluhan`, `biaya`, `status`) VALUES
(7, 2, 2, '2023-06-10', 'Ganti Oli Transmisi', 'Rp. 300.000', 1),
(8, 4, 1, '2023-06-11', 'Radiator rusak', 'Rp. 300.000', 1),
(9, 5, 1, '2023-06-11', 'pergantian kampas rem,  ganti oli, perbaikan radiator.', 'Rp. 1.500.000', 0),
(10, 6, 3, '2023-06-18', 'ban rabit', 'Rp. 700.000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supir`
--

CREATE TABLE `tb_supir` (
  `id_supir` int(11) NOT NULL,
  `nama_supir` varchar(50) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `foto_supir` varchar(50) NOT NULL,
  `foto_sim` varchar(50) NOT NULL,
  `foto_ktp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supir`
--

INSERT INTO `tb_supir` (`id_supir`, `nama_supir`, `no_telp`, `foto_supir`, `foto_sim`, `foto_ktp`) VALUES
(1, 'Kasnuri anjir', '0897090909090', 'KASNURI_-_MAU.png', 'KASNURI_-_MAU.png', 'KASNURI_-_MAU.png'),
(2, 'M Tri Ade Septiawan', '0852-4682-0886', 'M_TRI_ADE_SEPTIAWAN_-_FOTO_2.jpg', 'SIM_WAWAN.jpg', 'febad731-81f4-4e63-9535-66535bd42f34.jpg'),
(3, 'JAMALI', '082155603699', 'JAMALI_-_FOTO.jpg', 'JAMALI_-_SIM.png', 'JAMALI_-_KTP.png'),
(4, 'SARMIDI', '081345458234', 'SARMIDI_-_FOTO.jpg', 'SIM_B_2_umum_-_ISMAIL.jpg', 'KTP_-_ISMAIL.jpg');

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
(4, 3, 4, '2023-06-10'),
(5, 1, 4, '2023-06-11'),
(6, 4, 5, '2023-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tangki`
--

CREATE TABLE `tb_tangki` (
  `id_tangki` int(11) NOT NULL,
  `nopol` varchar(50) DEFAULT NULL,
  `tahun_dibuat` varchar(11) DEFAULT NULL,
  `volume_tangki` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tangki`
--

INSERT INTO `tb_tangki` (`id_tangki`, `nopol`, `tahun_dibuat`, `volume_tangki`) VALUES
(1, 'KH 8505 AV', '2013', 5000),
(2, 'DA 8375 JE', '2011', 10000),
(3, 'DA 8322 TAP', '2006', 20000),
(4, 'DA 8641 CK', '2008', 10000),
(5, 'DA 8591 JG', '2021', 10000);

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
(1, 'admin', 'admin1', '$2y$10$STphH7zHEGhlbIs55h9vPeyDSZYLrsRZeMN95drCnk.2MuX/Lagf.', 0),
(2, 'coba1', 'COBA1', '$2y$10$/kgb.p2hPcATlYR21e2T6uZcT4oQUZjNVzYPsueTAiHc5m/6k6x16', 3),
(3, 'ary', 'ary', '$2y$10$jIKsox9oYFtjVKUObbbNvOaaeirce2rgG9b5JHWGhWGu.PsSXjxu.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_surat_tangki`
--
ALTER TABLE `table_surat_tangki`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_tangki` (`id_tangki`);

--
-- Indexes for table `tb_bengkel`
--
ALTER TABLE `tb_bengkel`
  ADD PRIMARY KEY (`id_bengkel`);

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
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_bengkel`
--
ALTER TABLE `tb_bengkel`
  MODIFY `id_bengkel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_perbaikan`
--
ALTER TABLE `tb_perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_seri_ban`
--
ALTER TABLE `tb_seri_ban`
  MODIFY `id_seri_ban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_service_masuk`
--
ALTER TABLE `tb_service_masuk`
  MODIFY `id_service_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_supir`
--
ALTER TABLE `tb_supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_supir_tangki`
--
ALTER TABLE `tb_supir_tangki`
  MODIFY `id_supir_tangki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_tangki`
--
ALTER TABLE `tb_tangki`
  MODIFY `id_tangki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `table_surat_tangki`
--
ALTER TABLE `table_surat_tangki`
  ADD CONSTRAINT `table_surat_tangki_ibfk_1` FOREIGN KEY (`id_tangki`) REFERENCES `tb_tangki` (`id_tangki`);

--
-- Constraints for table `tb_perbaikan`
--
ALTER TABLE `tb_perbaikan`
  ADD CONSTRAINT `tb_perbaikan_ibfk_1` FOREIGN KEY (`id_service_masuk`) REFERENCES `tb_service_masuk` (`id_service_masuk`);

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
