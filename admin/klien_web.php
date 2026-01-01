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
    $stmt = $conn->prepare("SELECT * FROM klien_web WHERE id = ?");
    $stmt->bind_param("s", $id_edit);
    $stmt->execute();
    $edit_data = $stmt->get_result()->fetch_assoc();
}

// Tambah / Update Klien Web
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];
    $tantangan = $_POST['tantangan'];
    $solusi = $_POST['solusi'];
    $url = $_POST['url'];
    
    $is_edit = !empty($_POST['old_id']);
    $gambar_path = $edit_data ? $edit_data['gambar'] : '';

    // Handle Upload Gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        
        $file_ext = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
        $new_filename = "portfolio_" . time() . "_" . rand(1000, 9999) . "." . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Hapus gambar lama jika ada
            if ($is_edit && !empty($edit_data['gambar']) && file_exists($edit_data['gambar'])) {
                unlink($edit_data['gambar']);
            }
            $gambar_path = $target_file;
        }
    }

    if ($is_edit) {
        $old_id = $_POST['old_id'];
        $stmt = $conn->prepare("UPDATE klien_web SET id=?, nama=?, gambar=?, kategori=?, tahun=?, deskripsi=?, tantangan=?, solusi=?, url=? WHERE id=?");
        $stmt->bind_param("ssssssssss", $id, $nama, $gambar_path, $kategori, $tahun, $deskripsi, $tantangan, $solusi, $url, $old_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO klien_web (id, nama, gambar, kategori, tahun, deskripsi, tantangan, solusi, url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $id, $nama, $gambar_path, $kategori, $tahun, $deskripsi, $tantangan, $solusi, $url);
    }

    if ($stmt->execute()) {
        header("Location: klien_web.php?msg=success");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . $stmt->error;
    }
}

// Hapus Portofolio
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    
    // Hapus file gambar terlebih dahulu
    $stmt_get = $conn->prepare("SELECT gambar FROM klien_web WHERE id = ?");
    $stmt_get->bind_param("s", $id_hapus);
    $stmt_get->execute();
    $data_del = $stmt_get->get_result()->fetch_assoc();
    if ($data_del && !empty($data_del['gambar']) && file_exists($data_del['gambar'])) {
        unlink($data_del['gambar']);
    }

    $stmt = $conn->prepare("DELETE FROM klien_web WHERE id = ?");
    $stmt->bind_param("s", $id_hapus);
    if($stmt->execute()) {
        header("Location: klien_web.php?msg=deleted");
        exit;
    }
}

if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'success') $message = "Portfolio berhasil disimpan!";
    if($_GET['msg'] == 'deleted') $message = "Portfolio berhasil dihapus!";
}

$hasil = mysqli_query($conn, "SELECT * FROM klien_web");
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title"><?php echo $edit_data ? 'Edit Portofolio' : 'Tambah Portofolio Website'; ?></h4>
                <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data" class="forms-sample">
                    <?php if($edit_data): ?>
                        <input type="hidden" name="old_id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label>ID Portofolio (Slug URL)</label>
                        <input type="text" name="id" class="form-control" value="<?php echo $edit_data ? $edit_data['id'] : ''; ?>" placeholder="nama-proyek" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Website</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit_data ? $edit_data['nama'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Project</label>
                        <?php if($edit_data && $edit_data['gambar']): ?>
                            <div class="mb-2">
                                <img src="<?php echo $edit_data['gambar']; ?>" alt="Preview" style="max-width: 150px; border-radius: 10px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="gambar" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group"><label>Kategori</label><input type="text" name="kategori" class="form-control" value="<?php echo $edit_data ? $edit_data['kategori'] : ''; ?>" placeholder="E-commerce"></div>
                        </div>
                        <div class="col-6">
                            <div class="form-group"><label>Tahun</label><input type="text" name="tahun" class="form-control" value="<?php echo $edit_data ? $edit_data['tahun'] : ''; ?>" placeholder="2023"></div>
                        </div>
                    </div>
                    <div class="form-group"><label>URL Demo Website</label><input type="text" name="url" class="form-control" value="<?php echo $edit_data ? $edit_data['url'] : ''; ?>" placeholder="https://..."></div>
                    <div class="form-group"><label>Ringkasan Proyek</label><textarea name="deskripsi" class="form-control" rows="3"><?php echo $edit_data ? $edit_data['deskripsi'] : ''; ?></textarea></div>
                    <div class="form-group"><label>Tantangan</label><textarea name="tantangan" class="form-control" rows="3"><?php echo $edit_data ? $edit_data['tantangan'] : ''; ?></textarea></div>
                    <div class="form-group"><label>Solusi</label><textarea name="solusi" class="form-control" rows="3"><?php echo $edit_data ? $edit_data['solusi'] : ''; ?></textarea></div>
                    <button type="submit" name="simpan" class="btn btn-primary text-white me-2">
                        <?php echo $edit_data ? 'Perbarui Portofolio' : 'Simpan Proyek'; ?>
                    </button>
                    <?php if($edit_data): ?>
                        <a href="klien_web.php" class="btn btn-light">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Portofolio Dipublikasi</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Preview</th>
                                <th>Proyek</th>
                                <th>Tahun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($s = mysqli_fetch_assoc($hasil)): ?>
                                <tr>
                                    <td>
                                        <?php if($s['gambar']): ?>
                                            <img src="<?php echo $s['gambar']; ?>" alt="thumb" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                        <?php else: ?>
                                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border-radius: 8px;">
                                                <i class="mdi mdi-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="fw-bold"><?php echo $s['nama']; ?></span></td>
                                    <td><?php echo $s['tahun']; ?></td>
                                    <td>
                                        <a href="?edit=<?php echo $s['id']; ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                        <a href="?hapus=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus portofolio ini?')">Hapus</a>
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
