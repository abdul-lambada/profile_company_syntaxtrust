<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_syntaxtrust";

// Buat database jika belum ada
$conn = mysqli_connect($host, $user, $pass);
$sql = "CREATE DATABASE IF NOT EXISTS $db";
mysqli_query($conn, $sql);

// Koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
