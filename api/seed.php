<?php
include 'db.php';

// Seed Produk
$produk = [
    [
        'id' => 'sik-sekolah',
        'nama' => 'Sistem Informasi Keuangan Sekolah',
        'kategori' => 'Enterprise',
        'harga' => 'Rp 15jt',
        'deskripsi' => 'Solusi manajemen keuangan terpadu untuk semua jenjang pendidikan (SD, SMP, SMA/K). Integrasi SPP, Tabungan, dan Pelaporan BOS.',
        'fitur' => json_encode(['Manajemen SPP Otomatis', 'Sistem Tabungan Siswa', 'Laporan Real-time untuk Yayasan', 'Integrasi Pembayaran Digital', 'Dashboard Multi-user (Admin & Guru)', 'Backup Data Terenkripsi']),
        'file_panduan' => '/guides/sik-sekolah.pdf',
        'id_youtube' => 'dQw4w9WgXcQ'
    ],
    [
        'id' => 'custom-web',
        'nama' => 'Jasa Pembuatan Website Kustom',
        'kategori' => 'Creative',
        'harga' => 'Nego',
        'deskripsi' => 'Pengembangan website eksklusif yang dirancang khusus untuk profil perusahaan, platform e-learning, atau aplikasi web kompleks.',
        'fitur' => json_encode(['Desain UI/UX Eksklusif', 'Teknologi Modern (Astro/Next.js)', 'Optimasi SEO & Performa', 'Full Responsive di Semua Perangkat', 'Gratis Maintenance 3 Bulan', 'Konsultasi Arsitektur Kode']),
        'file_panduan' => '/guides/custom-web.pdf',
        'id_youtube' => 'dQw4w9WgXcQ'
    ]
];

foreach ($produk as $p) {
    $stmt = $conn->prepare("INSERT IGNORE INTO produk (id, nama, kategori, harga, deskripsi, fitur, file_panduan, id_youtube) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $p['id'], $p['nama'], $p['kategori'], $p['harga'], $p['deskripsi'], $p['fitur'], $p['file_panduan'], $p['id_youtube']);
    $stmt->execute();
}

// Seed Klien Sekolah
$sekolah = [
    ['SMK Negeri 1 Jakarta', 'Jakarta Pusat', -6.1751, 106.8650],
    ['SMA Al-Azhar', 'Bekasi', -6.2383, 106.9756],
    ['SMP Bintang Bangsa', 'Bandung', -6.9175, 107.6191],
    ['Yayasan Pendidikan Mulia', 'Surabaya', -7.2575, 112.7521],
    ['Pesantren Modern Risalah', 'Bogor', -6.5971, 106.7949],
];

foreach ($sekolah as $s) {
    $stmt = $conn->prepare("INSERT INTO klien_sekolah (nama, kota, lat, lng) SELECT ?, ?, ?, ? WHERE NOT EXISTS (SELECT 1 FROM klien_sekolah WHERE nama = ?)");
    $stmt->bind_param("ssdds", $s[0], $s[1], $s[2], $s[3], $s[0]);
    $stmt->execute();
}

// Seed Klien Web
$klien_web = [
    [
        'id' => 'indo-furniture',
        'nama' => 'IndoFurniture Store',
        'kategori' => 'E-Commerce',
        'tahun' => '2025',
        'deskripsi' => 'Platform e-commerce furniture mewah dengan integrasi AR (Augmented Reality).',
        'tantangan' => 'Menampilkan katalog ribuan produk dengan performa cepat.',
        'solusi' => 'Implementasi Static Site Generation (SSG) dan optimasi gambar on-the-fly.',
        'url' => 'https://example.com/furniture'
    ],
    [
        'id' => 'logistik-pro',
        'nama' => 'Logistik Pro Express',
        'kategori' => 'Platform Logistik',
        'tahun' => '2024',
        'deskripsi' => 'Sistem pelacakan logistik real-time untuk armada nasional.',
        'tantangan' => 'Sinkronisasi data GPS dari ribuan truk secara bersamaan.',
        'solusi' => 'Arsitektur microservices dengan WebSockets untuk update tanpa latensi.',
        'url' => 'https://example.com/logistics'
    ],
    [
        'id' => 'klinik-sehat',
        'nama' => 'Klinik Sehat Utama',
        'kategori' => 'Company Profile',
        'tahun' => '2025',
        'deskripsi' => 'Situs profil kesehatan dengan sistem janji temu terpadu.',
        'tantangan' => 'Meningkatkan konversi booking pasien online.',
        'solusi' => 'Desain UI yang ramah pengguna dengan alur booking 3 langkah.',
        'url' => 'https://example.com/clinic'
    ]
];

foreach ($klien_web as $w) {
    $stmt = $conn->prepare("INSERT IGNORE INTO klien_web (id, nama, kategori, tahun, deskripsi, tantangan, solusi, url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $w['id'], $w['nama'], $w['kategori'], $w['tahun'], $w['deskripsi'], $w['tantangan'], $w['solusi'], $w['url']);
    $stmt->execute();
}

echo "Data awal (seeding) dengan field bahasa Indonesia berhasil dimasukkan.";
?>
