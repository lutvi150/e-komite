-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2020 at 12:13 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-komite`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_user`
--

CREATE TABLE `tb_data_user` (
  `id_siswa` int(10) NOT NULL,
  `nisn` varchar(30) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(2) NOT NULL,
  `id_kelas` varchar(10) NOT NULL,
  `foto_siswa` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `status_akun_user` varchar(10) NOT NULL,
  `id_golongan` varchar(10) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_data_user`
--

INSERT INTO `tb_data_user` (`id_siswa`, `nisn`, `nama_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `id_kelas`, `foto_siswa`, `alamat`, `status_akun_user`, `id_golongan`, `no_hp`) VALUES
(4, '15500100083', 'Andre', 'Batusangkar', '17-01-2020', 'L', '3', 'upload/f14862fc95add6c76e5dc2793c2ce5f7.png', 'asda', '1', '3', '082285498005'),
(5, '15500100082', 'a', 'Batusangkar', '11-01-2020', 'P', '3', 'upload/2ff5b9204a21d7cd7073809f043033a6.png', 'ada', '1', '3', '082285498049'),
(6, '8989', 'Amalia', 'padang', '31-01-2020', 'P', '', 'upload/ba186ec90d36717c5c427c5aa5e9d70b.png', 'Padang\r\nPadang', '1', '', '082284488760');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(10) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(2, 'IPA 2'),
(3, 'IPA 2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sumbangan`
--

CREATE TABLE `tb_sumbangan` (
  `id_sumbangan` int(10) NOT NULL,
  `jenis_sumbangan` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `total` varchar(30) NOT NULL,
  `waktu` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `tgl_bayar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_sumbangan`
--

INSERT INTO `tb_sumbangan` (`id_sumbangan`, `jenis_sumbangan`, `nisn`, `total`, `waktu`, `status`, `tgl_bayar`) VALUES
(3, 'rutin', '15500100083', '40000', '1-2019', '-', '-'),
(4, 'rutin', '15500100082', '40000', '1-2019', '-', '-'),
(5, 'isidentil', '15500100083', '50000', '2020', '-', '-'),
(6, 'isidentil', '15500100082', '50000', '2020', '-', '-'),
(7, 'isidentil', '8989', '50000', '2020', '-', '-'),
(8, 'rutin', '15500100083', '40000', '3-2020', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarif`
--

CREATE TABLE `tb_tarif` (
  `id_tarif` int(10) NOT NULL,
  `golongan_komite` varchar(50) NOT NULL,
  `keterangan_komite` text NOT NULL,
  `tarif_komite` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tarif`
--

INSERT INTO `tb_tarif` (`id_tarif`, `golongan_komite`, `keterangan_komite`, `tarif_komite`) VALUES
(3, 'Golongan I', 'Penerima PKH', '40000'),
(5, 'Golongan II', 'Pemegang Kartu 1', '50000'),
(6, 'Golongan III', 'Pemegang BPJS', '60000'),
(7, 'Golongan IV', 'Pemegang', '70000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `tgl_transaksi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(10) NOT NULL,
  `status_akun` varchar(10) NOT NULL,
  `tgl_registrasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`, `status_akun`, `tgl_registrasi`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '1', '25-12-2019'),
(3, '15500100083', '0ce5883f69aa3140424457255c019a73', 'siswa', '1', '01-01-2020'),
(4, '15500100082', '471ed110040a9429c336a7d57df643cb', 'siswa', '1', '01-01-2020'),
(5, '8989', 'b66dc44cd9882859d84670604ae276e6', 'siswa', '1', '04-01-2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_data_user`
--
ALTER TABLE `tb_data_user`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `tb_sumbangan`
--
ALTER TABLE `tb_sumbangan`
  ADD PRIMARY KEY (`id_sumbangan`);

--
-- Indexes for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_data_user`
--
ALTER TABLE `tb_data_user`
  MODIFY `id_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_sumbangan`
--
ALTER TABLE `tb_sumbangan`
  MODIFY `id_sumbangan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_tarif`
--
ALTER TABLE `tb_tarif`
  MODIFY `id_tarif` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
