-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2023 pada 08.12
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smks`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `password`, `peran`) VALUES
(9, 'admin', 'admin', '$2y$10$Vq8np/Cg/zL1EiJJTriERuObE4XfTf2M67M3E7CcToIdhilbrbnie', 'admin'),
(10, 'aditya', 'madityaprasetyo@gmail.com', '$2y$10$ZRq/ErGVTYGFdZZux0mXq.vHxdf4mp695tH95EHY0P8GsaLwmsugC', ''),
(11, 'guest', 'guest', '$2y$10$aVQKmEP1NRfLlri6E.laK.BfH4bHDOal6SUANoKLzu2QHpj2gFHcW', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE `portofolio` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portofolio`
--

INSERT INTO `portofolio` (`id`, `nama`, `gambar`, `email`) VALUES
(1, 'gambar1', '6548b4d76424a.png', 'https://www.instagram.com/p/CJBBtjKAbds/?igshid=Mz'),
(2, 'gambar2', 'gambar2.png', 'https://www.instagram.com/p/CJzpbnngtVz/?igshid=Mz'),
(3, 'gambar3', 'gambar3.png', 'https://www.instagram.com/p/CKDkQ0Xgns_/?igshid=Mz'),
(4, 'gambar4', 'gambar4.png', 'https://www.instagram.com/p/CJvY2lZglJg/?igshid=MT'),
(12, 'gambar5', '6549df6de00da.png', 'https://www.instagram.com/p/CI-RxeogBov/?utm_sourc'),
(13, 'gambar6', '6549deb042216.png', 'https://www.instagram.com/p/CJ5EdWUAsdR/?utm_sourc');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
