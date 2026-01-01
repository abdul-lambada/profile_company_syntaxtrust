<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_syntaxtrust";
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
$sql = "ALTER TABLE klien_web ADD COLUMN gambar VARCHAR(255) AFTER nama";
if(mysqli_query($conn, $sql)) {
    echo "OK";
} else {
    $err = mysqli_error($conn);
    if (strpos($err, "Duplicate column name") !== false) {
        echo "ALREADY EXISTS";
    } else {
        echo $err;
    }
}
?>
