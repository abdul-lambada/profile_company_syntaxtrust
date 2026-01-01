<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include_once '../api/db.php';

$message = "";
$error = "";

// Data untuk Edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM klien_sekolah WHERE id = ?");
    $stmt->bind_param("i", $id_edit);
    $stmt->execute();
    $edit_data = $stmt->get_result()->fetch_assoc();
}

// Tambah / Update Sekolah
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kota = $_POST['kota'];
    // Bersihkan nilai lat/lng dari spasi atau koma yang tidak sengaja terikut
    $lat = trim(str_replace(',', '.', $_POST['lat']));
    $lng = trim(str_replace(',', '.', $_POST['lng']));
    
    // Pastikan hanya mengambil angka/titik/minus dan ubah ke float untuk membuang karakter sampah (seperti titik di akhir)
    $lat = (float)preg_replace('/[^0-9.\-]/', '', $lat);
    $lng = (float)preg_replace('/[^0-9.\-]/', '', $lng);
    
    $is_edit = !empty($_POST['edit_id']);

    if ($is_edit) {
        $edit_id = $_POST['edit_id'];
        $stmt = $conn->prepare("UPDATE klien_sekolah SET nama=?, kota=?, lat=?, lng=? WHERE id=?");
        $stmt->bind_param("ssssi", $nama, $kota, $lat, $lng, $edit_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO klien_sekolah (nama, kota, lat, lng) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $kota, $lat, $lng);
    }

    if ($stmt->execute()) {
        header("Location: klien_sekolah.php?msg=success");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . $stmt->error;
    }
}

// Hapus Sekolah
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM klien_sekolah WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    if($stmt->execute()) {
        header("Location: klien_sekolah.php?msg=deleted");
        exit;
    }
}

if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'success') $message = "Data sekolah berhasil disimpan!";
    if($_GET['msg'] == 'deleted') $message = "Data sekolah berhasil dihapus!";
}

$hasil = mysqli_query($conn, "SELECT * FROM klien_sekolah");
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title"><?php echo $edit_data ? 'Edit Data Sekolah' : 'Tambah Klien Sekolah Baru'; ?></h4>
                <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                <form method="POST" class="forms-sample">
                    <?php if($edit_data): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Nama Sekolah / Institusi</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit_data ? $edit_data['nama'] : ''; ?>" placeholder="SMK Negeri 1..." required>
                    </div>
                    <div class="form-group">
                        <label>Kabupaten / Kota</label>
                        <input type="text" name="kota" class="form-control" value="<?php echo $edit_data ? $edit_data['kota'] : ''; ?>" placeholder="Jakarta Selatan" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group"><label>Latitude</label><input type="text" name="lat" class="form-control" value="<?php echo $edit_data ? $edit_data['lat'] : ''; ?>" placeholder="-6.234567"></div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"><label>Longitude</label><input type="text" name="lng" class="form-control" value="<?php echo $edit_data ? $edit_data['lng'] : ''; ?>" placeholder="106.123456"></div>
                        </div>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary text-white me-2">
                        <?php echo $edit_data ? 'Perbarui Sekolah' : 'Simpan Sekolah'; ?>
                    </button>
                    <?php if($edit_data): ?>
                        <a href="klien_sekolah.php" class="btn btn-light">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Lokasi Jaringan Sekolah</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Institusi</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($s = mysqli_fetch_assoc($hasil)): ?>
                                <tr>
                                    <td><span class="fw-bold"><?php echo $s['nama']; ?></span></td>
                                    <td><?php echo $s['kota']; ?></td>
                                    <td>
                                        <a href="?edit=<?php echo $s['id']; ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                        <a href="?hapus=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
