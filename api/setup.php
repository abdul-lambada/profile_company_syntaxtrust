<?php
include 'db.php';

// Tabel Produk (Layanan)
$q1 = "CREATE TABLE IF NOT EXISTS produk (
    id VARCHAR(50) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(50),
    harga VARCHAR(50),
    deskripsi TEXT,
    fitur TEXT,
    file_panduan VARCHAR(255),
    id_youtube VARCHAR(50)
)";
mysqli_query($conn, $q1);

// Tabel Klien Sekolah (Peta)
$q2 = "CREATE TABLE IF NOT EXISTS klien_sekolah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kota VARCHAR(100),
    lat DECIMAL(10, 8),
    lng DECIMAL(11, 8)
)";
mysqli_query($conn, $q2);

// Tabel Klien Web (Portofolio)
$q3 = "CREATE TABLE IF NOT EXISTS klien_web (
    id VARCHAR(50) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    gambar VARCHAR(255),
    kategori VARCHAR(50),
    tahun VARCHAR(10),
    deskripsi TEXT,
    tantangan TEXT,
    solusi TEXT,
    url VARCHAR(255)
)";
mysqli_query($conn, $q3);

// Tabel Mitra (Partner Logos)
$q_mitra = "CREATE TABLE IF NOT EXISTS mitra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    logo VARCHAR(255)
)";
mysqli_query($conn, $q_mitra);

// Tabel Pesan
$q4 = "CREATE TABLE IF NOT EXISTS pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    layanan VARCHAR(100),
    isi_pesan TEXT,
    status ENUM('baru', 'dibaca', 'selesai') DEFAULT 'baru',
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $q4);

// Tabel Pengaturan
$q_set = "CREATE TABLE IF NOT EXISTS pengaturan (
    kunci VARCHAR(50) PRIMARY KEY,
    nilai TEXT
)";
mysqli_query($conn, $q_set);

// Default Pengaturan
$default_settings = [
    'nama_situs' => 'SyntaxTrust',
    'wa_number' => '628123456789',
    'email_kontak' => 'info@syntaxtrust.com',
    'deskripsi_footer' => 'SyntaxTrust adalah partner teknologi visioner yang membantu institusi pendidikan dan korporasi melalui integritas kode.'
];

foreach($default_settings as $key => $val) {
    mysqli_query($conn, "INSERT IGNORE INTO pengaturan (kunci, nilai) VALUES ('$key', '$val')");
}

// Tabel Pengguna (Admin)
$q5 = "CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100)
)";
mysqli_query($conn, $q5);

// Masukkan admin default jika belum ada
$check_user = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='admin'");
if(mysqli_num_rows($check_user) == 0){
    $pass_default = password_hash("admin", PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO pengguna (username, password, nama_lengkap) VALUES ('admin', '$pass_default', 'Admin SyntaxTrust')");
}

echo "OK";
?>
