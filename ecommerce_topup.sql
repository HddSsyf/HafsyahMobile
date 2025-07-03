-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2025 pada 07.44
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_topup`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `Id_admin` int(11) NOT NULL,
  `Username` varchar(15) DEFAULT NULL,
  `Password` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`Id_admin`, `Username`, `Password`) VALUES
(0, 'admin', '$2y$10$Qj2UoW.e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `games`
--

CREATE TABLE `games` (
  `Id_Game` int(11) NOT NULL,
  `Nama_Game` varchar(225) DEFAULT NULL,
  `Harga` int(11) DEFAULT NULL,
  `Gambar` text DEFAULT NULL,
  `Deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `games`
--

INSERT INTO `games` (`Id_Game`, `Nama_Game`, `Harga`, `Gambar`, `Deskripsi`) VALUES
(1, 'Call Of Duty Mobile', NULL, 'assets/images/4aefc2d8c6f526e0ad9f023ce5ba61f2.jpg', 'Game Perang'),
(2, 'Mobile Legends', 122333323, 'assets/images/25b37c36b1f4f9972ea91d2d7fe1c2ec.jpg', 'ffdsfsdfsgfs'),
(3, 'Free Fire', 100000, 'assets/images/b1ffef9d79c4aa7d8db300ba4aa57599.jpg', '1234444');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `Id_Pesanan` int(11) NOT NULL,
  `Nama_Game` varchar(100) NOT NULL,
  `User_ID` varchar(50) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Metode_Pembayaran` varchar(50) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Tanggal_Pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`Id_Pesanan`, `Nama_Game`, `User_ID`, `Jumlah`, `Metode_Pembayaran`, `Harga`, `Tanggal_Pesan`) VALUES
(1, 'Mobile Legends', '45454545', 2500, 'dana', 20000, '2025-06-27 18:28:45'),
(2, 'Call Of Duty Mobile', '22432423', 1000, 'dana', 10000, '2025-06-27 18:28:45'),
(3, 'Call Of Duty Mobile', '45454545', 2500, 'ovo', 20000, '2025-06-27 18:50:43'),
(4, 'Call Of Duty Mobile', '22432423', 5000, 'dana', 35000, '2025-06-27 18:50:43'),
(5, 'Call Of Duty Mobile', '22432423', 1000, 'dana', 10000, '2025-06-27 18:50:43'),
(6, 'Call Of Duty Mobile', '12314324324235', 2500, 'dana', 20000, '2025-06-27 20:14:25'),
(7, 'Free Fire', '12314324324235', 172, 'dana', 19000, '2025-06-27 20:39:54'),
(8, 'Mobile Legends', '45454545', 172, 'dana', 19000, '2025-06-27 20:51:57'),
(9, 'Mobile Legends', '11213213213', 257, 'dana', 28000, '2025-06-27 21:00:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `Transaksi_Id` int(11) NOT NULL,
  `User_Id` varchar(225) DEFAULT NULL,
  `Game_Id` int(11) DEFAULT NULL,
  `Jumlah_Topup` text DEFAULT NULL,
  `Metode_Pembayaran` text DEFAULT NULL,
  `Bukti_Pembayaran` text DEFAULT NULL,
  `Status_Transaksi` enum('Diproses','Selesai') DEFAULT NULL,
  `Tgl_Transaksi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `Id_Users` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`Id_Users`, `Username`, `Password`, `email`) VALUES
(1, 'adit', '$2y$10$CjacJC1MyOFMRj9KParm5.z3plW2ucdb/yS2OtQCvnAhq3KEXgsDi', 'haddidassyifae3.sa@gmail.com'),
(2, 'hhhh', '$2y$10$DVIkr7Lm1ptszzgGJ6Gs4uWhNiKF2oTYzdxgl1A8ovf6okTF1oNL.', 'haddidassyifae3.sa@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_admin`);

--
-- Indeks untuk tabel `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`Id_Game`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`Id_Pesanan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Transaksi_Id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_Users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `games`
--
ALTER TABLE `games`
  MODIFY `Id_Game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `Id_Pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `Id_Users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
