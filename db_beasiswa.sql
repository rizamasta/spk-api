-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2015 at 08:05 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_beasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade`
--

CREATE TABLE IF NOT EXISTS `tbl_grade` (
  `id_grade` int(11) NOT NULL,
  `grade` varchar(3) NOT NULL,
  `ket_grade` varchar(25) NOT NULL,
  `nilai_atas` int(3) NOT NULL,
  `nilai_bawah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hasil`
--

CREATE TABLE IF NOT EXISTS `tbl_hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_kandidat` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `usia` int(11) NOT NULL,
  `s1` float NOT NULL,
  `s2` float NOT NULL,
  `s3` float NOT NULL,
  `s4` float NOT NULL,
  `s5` float NOT NULL,
  `hasil_s` float NOT NULL,
  `v1` float NOT NULL,
  `v2` float NOT NULL,
  `v3` float NOT NULL,
  `v4` float NOT NULL,
  `v5` float NOT NULL,
  `hasil_v` float NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kandidat`
--

CREATE TABLE IF NOT EXISTS `tbl_kandidat` (
  `id_kandidat` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `ipk` float NOT NULL,
  `kompetensi` float NOT NULL,
  `keg_mhs` float NOT NULL,
  `prestasi` float NOT NULL,
  `status` int(11) NOT NULL,
  `action` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_periode`
--

CREATE TABLE IF NOT EXISTS `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `nama_periode` varchar(6) NOT NULL,
  `tgl_create` date NOT NULL,
  `create_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  ADD PRIMARY KEY (`id_grade`);

--
-- Indexes for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tbl_kandidat`
--
ALTER TABLE `tbl_kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_grade`
--
ALTER TABLE `tbl_grade`
  MODIFY `id_grade` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kandidat`
--
ALTER TABLE `tbl_kandidat`
  MODIFY `id_kandidat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
