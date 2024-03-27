-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Mar 2024 pada 04.25
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
-- Database: `tugas2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pribadi`
--

CREATE TABLE `data_pribadi` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `npm` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `hobby` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_pribadi`
--

INSERT INTO `data_pribadi` (`id`, `nik`, `nama_lengkap`, `npm`, `tanggal_lahir`, `tempat_lahir`, `no_telepon`, `hobby`, `email`) VALUES
(1, '5252552525525255', 'rinomakin', 51210089, '2003-02-21', 'lamalaka', '082144111528', 'bola', 'rinomakin@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_pribadi`
--
ALTER TABLE `data_pribadi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD UNIQUE KEY `npm` (`npm`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_pribadi`
--
ALTER TABLE `data_pribadi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
