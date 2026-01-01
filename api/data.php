<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include 'db.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

switch ($aksi) {
    case 'produk':
        $hasil = mysqli_query($conn, "SELECT * FROM produk");
        $data = [];
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $baris['fitur'] = json_decode($baris['fitur']);
            $data[] = $baris;
        }
        echo json_encode($data);
        break;

    case 'sekolah':
        $hasil = mysqli_query($conn, "SELECT * FROM klien_sekolah");
        $data = [];
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $baris['koordinat'] = ['lat' => (float)$baris['lat'], 'lng' => (float)$baris['lng']];
            unset($baris['lat'], $baris['lng']);
            $data[] = $baris;
        }
        echo json_encode($data);
        break;

    case 'klien_web':
        $hasil = mysqli_query($conn, "SELECT * FROM klien_web");
        $data = [];
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $data[] = $baris;
        }
        echo json_encode($data);
        break;

    case 'mitra':
        $hasil = mysqli_query($conn, "SELECT * FROM mitra");
        $data = [];
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $data[] = $baris;
        }
        echo json_encode($data);
        break;

    case 'pengaturan':
        $hasil = mysqli_query($conn, "SELECT * FROM pengaturan");
        $data = [];
        while ($baris = mysqli_fetch_assoc($hasil)) {
            $data[$baris['kunci']] = $baris['nilai'];
        }
        echo json_encode($data);
        break;

    default:
        echo json_encode(["status" => "error", "pesan" => "Aksi tidak dikenal"]);
        break;
}
?>
