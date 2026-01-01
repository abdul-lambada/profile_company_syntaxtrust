-- Database for SyntaxTrust Company Profile
-- Created: 2026-01-01
-- With Dummy Data for Demonstrations

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `fitur` text DEFAULT NULL,
  `file_panduan` varchar(255) DEFAULT NULL,
  `id_youtube` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `kategori`, `harga`, `deskripsi`, `fitur`, `file_panduan`, `id_youtube`) VALUES
('sik-sekolah', 'EDISI Enterprise', 'Enterprise', 'Rp 15jt', 'Sistem Informasi Keuangan Sekolah (SIK) terintegrasi untuk manajemen SPP, Gaji, dan Inventaris yang presisi.', '[\"Manajemen SPP Digital\",\"Laporan Keuangan Real-time\",\"Sistem Penggajian Guru\",\"Integrasi Bank/Payment Gateway\",\"Dashboard Mobile Monitoring\"]', NULL, 'dQw4w9WgXcQ'),
('web-custom', 'EDISI Creative', 'Creative', 'Nego', 'Jasa pembuatan website premium dengan desain kustom, animasi halus, dan optimasi performa tinggi.', '[\"Desain UI/UX Eksklusif\",\"Animasi Framer Motion\",\"Optimasi SEO Berkelanjutan\",\"Panel Admin Kustom\",\"Hosting & Domain Gratis 1 Thn\"]', NULL, 'dQw4w9WgXcQ');

-- --------------------------------------------------------

--
-- Table structure for table `klien_sekolah`
--

CREATE TABLE `klien_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klien_sekolah`
--

INSERT INTO `klien_sekolah` (`nama`, `kota`, `lat`, `lng`) VALUES
('SMA Negeri 1 Jakarta', 'Jakarta Pusat', -6.16850000, 106.83310000),
('SMK Telkom Malang', 'Malang', -7.97850000, 112.65670000),
('SMA Al-Azhar Pusat', 'Jakarta Selatan', -6.23510000, 106.79930000),
('SMA Negeri 3 Bandung', 'Bandung', -6.90770000, 107.61170000);

-- --------------------------------------------------------

--
-- Table structure for table `klien_web`
--

CREATE TABLE `klien_web` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tantangan` text DEFAULT NULL,
  `solusi` text DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klien_web`
--

INSERT INTO `klien_web` (`id`, `nama`, `gambar`, `kategori`, `tahun`, `deskripsi`, `tantangan`, `solusi`, `url`) VALUES
('indo-furniture', 'indo-furniture', NULL, 'E-Commerce', '2023', 'Platform jual beli furniture kelas atas dengan integrasi VR View.', 'Sistem loading yang lambat karena gambar 4K dalam jumlah besar.', 'Implementasi Next.js Image Optimization dan Progressive Loading.', 'https://example.com'),
('klinik-sehat', 'klinik-sehat', NULL, 'Healtcare', '2022', 'Sistem pendaftaran pasien online dan manajemen rekam medis digital.', 'Sinkronisasi data pasien secara real-time antar cabang.', 'Penggunaan WebSockets dan Database Cluster.', 'https://example.com');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`nama`, `logo`) VALUES
('Google Cloud', NULL),
('AWS Hosting', NULL),
('Midtrans Payment', NULL),
('Cloudflare', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `layanan` varchar(100) DEFAULT NULL,
  `isi_pesan` text DEFAULT NULL,
  `status` enum('baru','dibaca','selesai') DEFAULT 'baru',
  `dibuat_pada` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`nama`, `email`, `layanan`, `isi_pesan`, `status`) VALUES
('Budi Santoso', 'budi@perusahaan.com', 'EDISI Enterprise', 'Halo, kami tertarik untuk menggunakan sistem SIK di sekolah kami. Mohon kirim proposal.', 'baru'),
('Siti Aminah', 'siti@sekolah.sch.id', 'Custom UI/UX', 'Ingin bertanya mengenai harga pembuatan website untuk instansi sekolah saya.', 'dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `kunci` varchar(50) NOT NULL,
  `nilai` text DEFAULT NULL,
  PRIMARY KEY (`kunci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`kunci`, `nilai`) VALUES
('nama_situs', 'SyntaxTrust'),
('wa_number', '628123456789'),
('email_kontak', 'info@syntaxtrust.com'),
('deskripsi_footer', 'SyntaxTrust adalah partner teknologi visioner yang membantu institusi pendidikan dan korporasi melalui integritas kode.');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin SyntaxTrust');

COMMIT;
