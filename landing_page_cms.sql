-- SIKES Landing Page Content Database (Lengkap dengan Peta)
-- Generated: 2026-01-02
-- File ini berisi skema dan data awal untuk konten dinamis landing page termasuk Peta Klien.

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+07:00";

-- --------------------------------------------------------
-- 1. HERO SECTION
-- --------------------------------------------------------
CREATE TABLE `konten_hero` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul_utama` varchar(255) NOT NULL,
  `judul_highlight` varchar(255) NOT NULL,
  `sub_judul` text NOT NULL,
  `teks_tombol_utama` varchar(50) NOT NULL,
  `teks_tombol_sekunder` varchar(50) NOT NULL,
  `teks_tombol_tersier` varchar(50) NOT NULL,
  `label_badge` varchar(100) NOT NULL,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_hero` (`judul_utama`, `judul_highlight`, `sub_judul`, `teks_tombol_utama`, `teks_tombol_sekunder`, `teks_tombol_tersier`, `label_badge`) VALUES
('Kelola Keuangan Sekolah', 'Lebih Cerdas.', 'Sistem manajemen SPP dan keuangan sekolah terintegrasi. Modern, aman, dan transparan untuk sekolah masa depan.', 'Mulai Sekarang', 'Contoh Laporan', 'Unduh Proposal (PDF)', 'Terpercaya oleh 100+ Sekolah');

-- --------------------------------------------------------
-- 2. MOBILE APP SECTION (Aplikasi Mobile)
-- --------------------------------------------------------
CREATE TABLE `konten_aplikasi_mobile` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label_badge` varchar(100) NOT NULL,
  `judul_utama` varchar(255) NOT NULL,
  `judul_highlight` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `fitur_list_json` json NOT NULL,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_aplikasi_mobile` (`label_badge`, `judul_utama`, `judul_highlight`, `deskripsi`, `fitur_list_json`) VALUES
('Portal Wali Murid', 'Pantau Keuangan Sekolah dari', 'Genggaman', 'Berikan kenyamanan maksimal bagi orang tua siswa. Tanpa perlu antre di sekolah, tanpa perlu konfirmasi manual yang ribet.', '[
  {"judul": "Notifikasi Tagihan Otomatis", "deskripsi": "Pengingat tagihan dikirim langsung ke WhatsApp sebelum jatuh tempo."},
  {"judul": "Kemudahan Pembayaran Digital", "deskripsi": "Mendukung QRIS, Virtual Account, dan Transfer Bank. Terverifikasi otomatis."},
  {"judul": "Riwayat Transparan", "deskripsi": "Akses history pembayaran SPP, Uang Gedung, dan lainnya kapan saja."}
]');

-- --------------------------------------------------------
-- 3. SOLUTION SECTION (Solusi)
-- --------------------------------------------------------
CREATE TABLE `konten_solusi` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label_kategori` varchar(100) NOT NULL,
  `judul_utama` varchar(255) NOT NULL,
  `judul_highlight` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `peran_list_json` json NOT NULL,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_solusi` (`label_kategori`, `judul_utama`, `judul_highlight`, `deskripsi`, `peran_list_json`) VALUES
('Multi-Role Access Control', 'Didesain untuk Setiap', 'Kebutuhan', 'Sistem kami dibangun dengan hak akses granular (RBAC) tinggi yang memastikan data aman dan setiap pengguna memiliki alat yang mereka butuhkan.', '[
  {"nama": "Bendahara Sekolah", "deskripsi": "Kelola seluruh data keuangan, buat tagihan massal, hingga ekspor laporan harian & bulanan."},
  {"nama": "Petugas Kasir", "deskripsi": "Input transaksi harian secara cepat, validasi pembayaran di tempat, dan cetak struk otomatis."},
  {"nama": "Wali Murid", "deskripsi": "Pantau tagihan anak melalui portal mandiri, riwayat pembayaran, dan terima notifikasi WhatsApp."}
]');

-- --------------------------------------------------------
-- 4. TRUST BADGES (Lencana Kepercayaan)
-- --------------------------------------------------------
CREATE TABLE `konten_lencana_kepercayaan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `ikon_svg_path` text NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_lencana_kepercayaan` (`label`, `ikon_svg_path`, `urutan`) VALUES
('SSL Secured', 'M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 6c1.4 0 2.5 1.1 2.5 2.5V11c.8 0 1.5.7 1.5 1.5v4c0 .8-.7 1.5-1.5 1.5h-5c-.8 0-1.5-.7-1.5-1.5v-4c0-.8.7-1.5 1.5-1.5v-1.5C9.5 8.1 10.6 7 12 7zm0 1c-.8 0-1.5.7-1.5 1.5V11h3V9.5c0-.8-.7-1.5-1.5-1.5z', 1),
('Cloud Infrastructure', 'M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96z', 2),
('Daily Backup', 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-2.09c-2.13.08-3.91.76-3.91.76s1.51-2.05 3.91-2.48V10.5l3.5 3-3.5 3z', 3),
('27001 Ready', 'ISO', 4);

-- --------------------------------------------------------
-- 5. TIM (Landing Page Team)
-- --------------------------------------------------------
CREATE TABLE `konten_tim` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `url_foto` varchar(255) NOT NULL,
  `kutipan` text NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_tim` (`nama`, `jabatan`, `url_foto`, `kutipan`, `urutan`) VALUES
('Abdul Kholik', 'Founder & Lead Developer', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=400&h=400', 'Misi kami bukan sekadar membuat software, tapi membangun budaya transparansi dan akuntabilitas di pendidikan Indonesia.', 1),
('Sarah Wijaya', 'Head of Customer Success', 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=400&h=400', 'Kami memastikan setiap bendahara sekolah, se-awam apapun dengan teknologi, bisa menggunakan SIKES dalam waktu kurang dari 1 jam.', 2),
('Rudi Hartono', 'Senior Security Engineer', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=400&h=400', 'Keamanan data finansial sekolah adalah prioritas mutlak. Kami menerapkan standar enkripsi setara perbankan.', 3);

-- --------------------------------------------------------
-- 6. TESTIMONI (Testimonials)
-- --------------------------------------------------------
CREATE TABLE `konten_testimoni` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `isi_testimoni` text NOT NULL,
  `url_avatar` varchar(255) NOT NULL,
  `rating` int(1) NOT NULL DEFAULT 5,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_testimoni` (`nama`, `peran`, `isi_testimoni`, `url_avatar`, `rating`, `urutan`) VALUES
('Dr. H. Ahmad Subarjo', 'Kepala Sekolah SMA 1', 'Sejak menggunakan SIKES, transparansi keuangan sekolah kami meningkat drastis. Wali murid sangat mengapresiasi kemudahan akses tagihan via WhatsApp.', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100', 5, 1),
('Ibu Ratna Sari', 'Bendahara Yayasan', 'Fitur ekspor laporan sangat membantu saya dalam rapat bulanan. Data akurat, rapi, dan bisa langsung dicetak dalam format PDF standar akuntansi.', 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=100', 5, 2),
('Bapak Budi Santoso', 'Wali Murid', 'Sangat praktis! Saya tidak perlu lagi antre di sekolah untuk membayar SPP. Cukup cek status di portal dan bukti bayar langsung terkirim otomatis.', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=100', 5, 3);

-- --------------------------------------------------------
-- 7. PAKET HARGA (Pricing Plans)
-- --------------------------------------------------------
CREATE TABLE `konten_paket_harga` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_paket` varchar(255) NOT NULL,
  `label_harga` varchar(50) NOT NULL COMMENT 'contoh: 499rb, Custom',
  `deskripsi` varchar(255) NOT NULL,
  `fitur_json` json NOT NULL COMMENT 'Array JSON berisi daftar fitur',
  `populer` boolean DEFAULT false,
  `tema_warna` varchar(50) DEFAULT 'slate',
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_paket_harga` (`nama_paket`, `label_harga`, `deskripsi`, `fitur_json`, `populer`, `tema_warna`, `urutan`) VALUES
('Starter', '499rb', 'Cocok untuk sekolah kecil atau PAUD', '[\"Hingga 200 Siswa\", \"Manajemen SPP Dasar\", \"Cetak Kwitansi A4\", \"Export Excel & PDF\", \"Backup Database Manual\"]', 0, 'slate', 1),
('Professional', '899rb', 'Paling populer untuk SMP/SMA/SMK', '[\"Siswa Tak Terbatas\", \"WhatsApp Auto-Reminder\", \"Cetak Struk Thermal\", \"Multi-Role Access Control\", \"Audit Log Lengkap\", \"Support 24/7\"]', 1, 'emerald', 2),
('Enterprise', 'Custom', 'Solusi kustom untuk grup yayasan besar', '[\"Multi-Sekolah Integrasi\", \"API Kustom\", \"White-label Branding\", \"Server Dedicated\", \"Maintenance Prioritas\"]', 0, 'slate', 3);

-- --------------------------------------------------------
-- 8. FAQ (Pertanyaan Umum)
-- --------------------------------------------------------
CREATE TABLE `konten_faq` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_faq` (`pertanyaan`, `jawaban`, `urutan`) VALUES
('Apakah data keuangan sekolah kami aman?', 'Tentu. SIKES menggunakan enkripsi AES-256 dan mematuhi standar keamanan OWASP Top 10. Kami juga melakukan backup database otomatis setiap hari untuk memastikan data Anda tidak pernah hilang.', 1),
('Bagaimana cara kerja WhatsApp Reminder?', 'Sistem akan secara otomatis mengirimkan pesan pengingat ke nomor WhatsApp orang tua siswa saat tagihan diterbitkan, 3 hari sebelum jatuh tempo, dan saat pembayaran berhasil diverifikasi.', 2),
('Apakah SIKES bisa digunakan untuk sekolah tingkat apa saja?', 'Ya, SIKES dirancang fleksibel untuk PAUD, SD, SMP, SMA/SMK, hingga Perguruan Tinggi dan Lembaga Kursus.', 3),
('Apakah ada biaya instalasi di awal?', 'Untuk paket Starter dan Professional, tidak ada biaya instalasi. Anda cukup berlangganan bulanan dan sistem siap digunakan dalam waktu kurang dari 24 jam.', 4),
('Dapatkan saya mencetak laporan dalam format Excel?', 'Sangat bisa. Semua data transaksi, daftar tunggakan, dan rekap harian dapat diekspor ke format Excel (.xlsx) dan PDF dengan satu klik.', 5);

-- --------------------------------------------------------
-- 9. FITUR (Features)
-- --------------------------------------------------------
CREATE TABLE `konten_fitur` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `path_ikon_svg` text NOT NULL,
  `tema_warna` varchar(50) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_fitur` (`judul`, `deskripsi`, `path_ikon_svg`, `tema_warna`, `urutan`) VALUES
('Dashboard Interaktif', 'Visualisasi data keuangan real-time dengan ApexCharts untuk memudahkan pengambilan keputusan.', 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'emerald', 1),
('Manajemen Keuangan', 'Kelola master tarif, tagihan siswa, dan berbagai metode pembayaran secara otomatis.', 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'indigo', 2),
('WhatsApp Reminder', 'Pengingat otomatis via Fonnte API untuk tagihan yang akan atau sudah jatuh tempo.', 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'green', 3),
('Export & Cetak', 'Cetak kwitansi A4 atau thermal (58mm/80mm) serta export data lengkap ke Excel & PDF.', 'M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z', 'rose', 4),
('Keamanan Tinggi', 'CSRF & XSS protection, SQL injection prevention, serta audit log untuk setiap aktivitas kritis.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'amber', 5),
('Backup & Recovery', 'Sistem backup database native PHP yang aman dan mudah diunduh kapan saja.', 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'blue', 6);

-- --------------------------------------------------------
-- 10. CARA KERJA (How It Works)
-- --------------------------------------------------------
CREATE TABLE `konten_cara_kerja` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomor_langkah` varchar(10) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `path_ikon_svg` text NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_cara_kerja` (`nomor_langkah`, `judul`, `deskripsi`, `path_ikon_svg`, `urutan`) VALUES
('01', 'Registrasi & Setup', 'Daftarkan sekolah Anda dan kustomisasi pos-pos pembayaran (SPP, Gedung, Seragam) sesuai kebutuhan.', 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z', 1),
('02', 'Migrasi Data Siswa', 'Import data siswa dan tagihan lama dengan satu klik menggunakan template Excel yang kami sediakan.', 'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12', 2),
('03', 'Aktivasi WhatsApp', 'Hubungkan nomor WhatsApp sekolah untuk fitur notifikasi tagihan dan bukti pembayaran otomatis.', 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z', 3),
('04', 'Go Digital!', 'Sistem siap digunakan. Wali murid bayar via transfer, dan laporan keuangan sekolah tercatat otomatis.', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 4);

-- --------------------------------------------------------
-- 11. STATISTIK (Stats)
-- --------------------------------------------------------
CREATE TABLE `konten_statistik` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_statistik` (`label`, `nilai`, `deskripsi`, `urutan`) VALUES
('Uptime', '99.9%', 'Sistem selalu siap melayani', 1),
('Enkripsi Data', 'AES-256', 'Metode enkripsi standar militer', 2),
('Keamanan', 'OWASP', 'Patuh terhadap top 10 OWASP', 3),
('Backup', '24/7', 'Pencadangan data berkala', 4);

-- --------------------------------------------------------
-- 12. PETA KLIEN (Client Map)
-- --------------------------------------------------------
CREATE TABLE `konten_peta_klien` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_sekolah` varchar(255) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `koordinat_x` int(11) NOT NULL,
  `koordinat_y` int(11) NOT NULL,
  `status` enum('aktif', 'nonaktif') DEFAULT 'aktif',
  `urutan` int(11) DEFAULT 0,
  `dibuat_pada` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `konten_peta_klien` (`nama_sekolah`, `kota`, `koordinat_x`, `koordinat_y`, `urutan`) VALUES
('Sekolah A (Medan)', 'Medan', 135, 110, 1),
('Sekolah B (Padang)', 'Padang', 150, 135, 2),
('Sekolah C (Palembang)', 'Palembang', 175, 160, 3),
('Sekolah D (Jakarta)', 'Jakarta', 235, 245, 4),
('Sekolah E (Bandung)', 'Bandung', 275, 250, 5),
('Sekolah F (Surabaya)', 'Surabaya', 330, 250, 6),
('Sekolah G (Pontianak)', 'Pontianak', 280, 150, 7),
('Sekolah H (Balikpapan)', 'Balikpapan', 350, 150, 8),
('Sekolah I (Makassar)', 'Makassar', 500, 180, 9),
('Sekolah J (Palu)', 'Palu', 505, 155, 10),
('Sekolah K (Bali)', 'Bali', 440, 270, 11),
('Sekolah L (Jayapura)', 'Jayapura', 730, 210, 12),
('Sekolah M (Merauke)', 'Merauke', 690, 230, 13);


SET FOREIGN_KEY_CHECKS=1;
COMMIT;
