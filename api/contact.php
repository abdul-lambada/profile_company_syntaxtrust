<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if ($data) {
        $nama = mysqli_real_escape_string($conn, $data['nama']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $layanan = mysqli_real_escape_string($conn, $data['layanan']);
        $isi_pesan = mysqli_real_escape_string($conn, $data['pesan']);

        $sql = "INSERT INTO pesan (nama, email, layanan, isi_pesan) VALUES ('$nama', '$email', '$layanan', '$isi_pesan')";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["status" => "success", "pesan" => "Pesan Anda berhasil terkirim dan tersimpan."]);
        } else {
            echo json_encode(["status" => "error", "pesan" => mysqli_error($conn)]);
        }
    } else {
        echo json_encode(["status" => "error", "pesan" => "Data tidak valid."]);
    }
}
?>
