-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Feb 2023 pada 05.37
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_todo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_issue`
--

CREATE TABLE `tb_issue` (
  `id_issue` int(11) NOT NULL,
  `name_issue` varchar(150) NOT NULL,
  `hari` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('To do','Planing','Development','Done') NOT NULL,
  `id_user` int(11) NOT NULL,
  `gambar` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_issue`
--

INSERT INTO `tb_issue` (`id_issue`, `name_issue`, `hari`, `tanggal`, `jam`, `status`, `id_user`, `gambar`) VALUES
(8, 'MEMBUAT BANNER', 'Minggu', '2023-02-15', '0000-00-00 00:00:00', 'To do', 2, '63e52374435b0.jpg'),
(9, 'MEMBUAT NAVBAR', 'Minggu', '2023-02-10', '0000-00-00 00:00:00', 'Done', 1, '63e5292d7843f.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id_kegiatan` char(25) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(50) NOT NULL,
  `tempat` varchar(120) NOT NULL,
  `status` enum('To do','Done','Canceled') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id_kegiatan`, `nama_kegiatan`, `hari`, `tanggal`, `jam`, `tempat`, `status`, `id_user`) VALUES
('KGT-2023-02-080002', 'PRAMUKA', 'Kamis', '2023-02-09', '03:07', 'SMKN 4 BOJONEGORO', 'Done', 1),
('KGT-2023-02-080003', 'UPACARA', 'Senin', '2023-02-13', '07:26', 'SMKN 4 BOJONEGORO', 'Canceled', 1),
('KGT-2023-02-080004', 'UPACARA', 'Senin', '2023-02-14', '07:09', 'SMKN 4 BOJONEGORO', 'Canceled', 1),
('KGT-2023-02-080005', 'KEGIATAN PERPISAHAN', 'Kamis', '2023-02-09', '14:11', 'SMKN 4 BOJONEGORO', 'Done', 2),
('KGT-2023-02-090006', 'TUGAS WEB', 'Rabu', '2023-02-15', '07:40', 'LAB ATR', 'To do', 1),
('KGT-2023-02-090007', 'KEGIATAN PERPISAHAN', 'Senin', '2023-02-07', '10:53', 'SMKN 4 BOJONEGORO', 'To do', 1),
('KGT-2023-02-090008', 'TUGAS WEB', 'Rabu', '2023-02-15', '10:51', 'SMKN 4 BOJONEGORO', 'Done', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `foto` varchar(60) NOT NULL,
  `created_by` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nm_user`, `email`, `password`, `foto`, `created_by`) VALUES
(1, 'M.Amirul Fahmi', 'amirulfahmi148@gmail.com', '123', 'cvcxsxdx', '2023-02-08 10:15:05'),
(2, 'Alex Siswanto', 'amirulfahmi@gmail.com', '123', 'cvcxsxdx', '2023-02-08 13:33:38'),
(3, 'NOVITA', '', '', 'shshs', '0000-00-00 00:00:00'),
(4, 'NOVITA', 'amirulfahmi123@gmail.com', '123', 'shshs', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_issue`
--
ALTER TABLE `tb_issue`
  ADD PRIMARY KEY (`id_issue`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_issue`
--
ALTER TABLE `tb_issue`
  MODIFY `id_issue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
