-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14 Okt 2018 pada 17.17
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `2018_sekripsi_yogya`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_tentor`
--

CREATE TABLE `absensi_tentor` (
  `absensi_id` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` enum('Hadir','Sakit','Alfa','Izin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `absensi_tentor`
--

INSERT INTO `absensi_tentor` (`absensi_id`, `detail_id`, `tanggal`, `keterangan`) VALUES
(1, 6, '2018-09-05 09:24:21', 'Hadir'),
(2, 1, '2018-09-05 09:39:53', 'Hadir'),
(3, 1, '2018-09-05 09:39:53', 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absens_siswa`
--

CREATE TABLE `absens_siswa` (
  `absens_siswa_id` int(11) NOT NULL,
  `id_jadwal_siswa` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `keterangan` enum('Hadir','Sakit','Alfa','Izin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absens_siswa`
--

INSERT INTO `absens_siswa` (`absens_siswa_id`, `id_jadwal_siswa`, `tanggal`, `keterangan`) VALUES
(1, 6, '2018-09-05 10:20:37', 'Hadir'),
(2, 6, '2018-09-05 10:20:37', 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `pass_admin` varchar(100) NOT NULL,
  `level` enum('admin','manager') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `pass_admin`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'direktur', '4fbfd324f5ffcdff5dbf6f019b02eca8', 'manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_jadwal`
--

CREATE TABLE `detail_jadwal` (
  `detail_id` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `id_mengampu` int(11) NOT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') NOT NULL,
  `jam` varchar(12) NOT NULL,
  `ruangan` varchar(12) NOT NULL,
  `program` enum('Privat','Kelas') NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`detail_id`, `jadwal_id`, `id_mengampu`, `hari`, `jam`, `ruangan`, `program`, `status`) VALUES
(1, 2, 8, 'Senin', '13:00-14:45', 'A', 'Privat', 0),
(2, 1, 4, 'Senin', '13:00-14:45', 'A', 'Privat', 0),
(3, 1, 5, 'Selasa', '13:00-14:45', 'A', 'Privat', 0),
(4, 1, 6, 'Rabu', '13:00-14:45', 'A', 'Privat', 0),
(5, 2, 8, 'Kamis', '15:00-16:45', 'A', 'Kelas', 0),
(6, 2, 13, 'Kamis', '15:00-16:45', 'A', 'Kelas', 0),
(7, 2, 13, 'Jumat', '13:00-14:45', 'A', 'Kelas', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pebayaran`
--

CREATE TABLE `detail_pebayaran` (
  `detail_pebayaran_id` int(11) NOT NULL,
  `pembayaran_id` int(11) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pebayaran`
--

INSERT INTO `detail_pebayaran` (`detail_pebayaran_id`, `pembayaran_id`, `bulan`, `biaya`) VALUES
(1, 1, 'Juli', 200000),
(2, 1, 'Agustus', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `tahunajaran` varchar(9) NOT NULL,
  `semester` enum('Ganjil','Genap') NOT NULL,
  `biaya` varchar(15) NOT NULL,
  `paket` varchar(30) NOT NULL,
  `type` enum('private','kelas') NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`jadwal_id`, `kelas_id`, `tahunajaran`, `semester`, `biaya`, `paket`, `type`, `status`) VALUES
(1, 1, '2018/2019', 'Ganjil', '250000', '0', 'kelas', 1),
(2, 2, '2018/2019', 'Ganjil', '200000', 'A', 'kelas', 1),
(3, 1, '2017/2018', 'Ganjil', '300000', 'A', 'private', 0),
(4, 1, '2017/2018', 'Ganjil', '300000', 'paket 1', 'private', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_siswa`
--

CREATE TABLE `jadwal_siswa` (
  `id_jadwal_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `jadwal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwal_siswa`
--

INSERT INTO `jadwal_siswa` (`id_jadwal_siswa`, `id_siswa`, `jadwal_id`) VALUES
(6, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kelas_id` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `jenjang` enum('SD','SMP','SMA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kelas_id`, `kelas`, `jenjang`) VALUES
(1, 'Kelas 6', 'SD'),
(2, 'kelas 3', 'SMP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `mapel_id` int(11) NOT NULL,
  `kode` varchar(8) NOT NULL,
  `mapel` varchar(20) NOT NULL,
  `kelas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`mapel_id`, `kode`, `mapel`, `kelas_id`) VALUES
(8, '', 'Matematika', 1),
(9, '', 'Bahasa Indonesia', 1),
(10, '', 'IPA', 1),
(11, '', 'IPS', 1),
(16, '', 'Matematika', 2),
(17, '', 'Bahasa Indonesia', 2),
(18, 'BHSI03', 'Bahasa Inggris', 2),
(20, 'SMP03IPA', 'IPA', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mengampu`
--

CREATE TABLE `mengampu` (
  `id_mengampu` int(11) NOT NULL,
  `tentor_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mengampu`
--

INSERT INTO `mengampu` (`id_mengampu`, `tentor_id`, `mapel_id`) VALUES
(4, 3, 8),
(5, 3, 9),
(6, 3, 10),
(7, 2, 11),
(8, 2, 16),
(9, 3, 11),
(10, 2, 9),
(11, 2, 10),
(12, 6, 8),
(13, 6, 16),
(14, 6, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `pembayaran_id` int(11) NOT NULL,
  `id_jadwal_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti_upload` varchar(100) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`pembayaran_id`, `id_jadwal_siswa`, `id_siswa`, `total_bayar`, `tanggal`, `bukti_upload`, `approve`) VALUES
(1, 6, 3, 400000, '2018-08-26', '20180827033317.jpeg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `nama_ortu` varchar(30) NOT NULL,
  `no_hp` varchar(18) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `alamat`, `gender`, `nama_ortu`, `no_hp`, `email`, `username`, `password`) VALUES
(1, 'Toni Siswa', 'JL. Mujamuju', 'L', 'Orang Tua Toni', '047466398', 'toni@orangtuanya.com', 'siswa', 'bcd724d15cde8c47650fda962968f102'),
(2, 'andi wijang prasetyo', 'selorejo 09/01 madu, mojosongo, boyolali', 'L', 'ayah', '085647067303', 'andy.wijang@gmail.com', 'andi', 'andi'),
(3, 'andi wijang prasetyo', 'selorejo 09/01 madu, mojosongo, boyolali', 'L', 'ayah', '085647067303', 'andy.wijang@gmail.com', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentor`
--

CREATE TABLE `tentor` (
  `tentor_id` int(11) NOT NULL,
  `tentor_nama` varchar(20) NOT NULL,
  `tentor_alamat` text NOT NULL,
  `tentor_telepon` varchar(18) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `tentor_username` varchar(30) NOT NULL,
  `tentor_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tentor`
--

INSERT INTO `tentor` (`tentor_id`, `tentor_nama`, `tentor_alamat`, `tentor_telepon`, `mapel_id`, `tentor_username`, `tentor_password`) VALUES
(2, 'Yoga suara nada', 'Yogyakarta', '35436464', 2, 'yoga', '807659cd883fc0a63f6ce615893b3558'),
(3, 'Muhamad Dani Kurniaw', 'petung//31', '123456', 2, 'dani', '55b7e8b895d047537e672250dd781555'),
(6, 'Rendy', 'Yogyakarta', '35436464', 0, 'rendy', '88ad32a14f7f7964d03dad411ffcc59b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_tentor`
--
ALTER TABLE `absensi_tentor`
  ADD PRIMARY KEY (`absensi_id`);

--
-- Indexes for table `absens_siswa`
--
ALTER TABLE `absens_siswa`
  ADD PRIMARY KEY (`absens_siswa_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `detail_pebayaran`
--
ALTER TABLE `detail_pebayaran`
  ADD PRIMARY KEY (`detail_pebayaran_id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `jadwal_siswa`
--
ALTER TABLE `jadwal_siswa`
  ADD PRIMARY KEY (`id_jadwal_siswa`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`mapel_id`);

--
-- Indexes for table `mengampu`
--
ALTER TABLE `mengampu`
  ADD PRIMARY KEY (`id_mengampu`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tentor`
--
ALTER TABLE `tentor`
  ADD PRIMARY KEY (`tentor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_tentor`
--
ALTER TABLE `absensi_tentor`
  MODIFY `absensi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `absens_siswa`
--
ALTER TABLE `absens_siswa`
  MODIFY `absens_siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `detail_pebayaran`
--
ALTER TABLE `detail_pebayaran`
  MODIFY `detail_pebayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jadwal_siswa`
--
ALTER TABLE `jadwal_siswa`
  MODIFY `id_jadwal_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `mapel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `mengampu`
--
ALTER TABLE `mengampu`
  MODIFY `id_mengampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tentor`
--
ALTER TABLE `tentor`
  MODIFY `tentor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7; 