<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coba ambil dari $_POST (form-urlencoded)
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $layanan = isset($_POST['layanan']) ? $_POST['layanan'] : '';
    $pesan = isset($_POST['pesan']) ? $_POST['pesan'] : '';

    // Jika kosong, coba ambil dari JSON payload
    if (empty($nama)) {
        $json = json_decode(file_get_contents("php://input"), true);
        if ($json) {
            $nama = isset($json['nama']) ? $json['nama'] : '';
            $email = isset($json['email']) ? $json['email'] : '';
            $layanan = isset($json['layanan']) ? $json['layanan'] : '';
            $pesan = isset($json['pesan']) ? $json['pesan'] : '';
        }
    }

    if (!empty($nama) && !empty($email)) {
        $nama = mysqli_real_escape_string($conn, $nama);
        $email = mysqli_real_escape_string($conn, $email);
        $layanan = mysqli_real_escape_string($conn, $layanan);
        $pesan = mysqli_real_escape_string($conn, $pesan);

        $sql = "INSERT INTO pesan (nama, email, layanan, isi_pesan) VALUES ('$nama', '$email', '$layanan', '$pesan')";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["success" => true, "message" => "Pesan berhasil disimpan."]);
        } else {
            echo json_encode(["success" => false, "error" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "Nama dan Email wajib diisi."]);
    }
}
?>
