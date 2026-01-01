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
    $stmt = $conn->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->bind_param("s", $id_edit);
    $stmt->execute();
    $edit_data = $stmt->get_result()->fetch_assoc();
}

// Tambah / Update Produk
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $fitur_raw = explode("\n", $_POST['fitur']);
    $fitur = json_encode(array_values(array_filter(array_map('trim', $fitur_raw))));
    $id_youtube = $_POST['id_youtube'];
    
    $is_edit = !empty($_POST['old_id']);
    $panduan_path = $edit_data ? $edit_data['file_panduan'] : '';

    // Handle Upload PDF Panduan
    if (isset($_FILES['file_panduan']) && $_FILES['file_panduan']['error'] === 0) {
        $target_dir = "uploads/docs/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        
        $file_ext = pathinfo($_FILES["file_panduan"]["name"], PATHINFO_EXTENSION);
        $new_filename = "guide_" . $id . "_" . time() . "." . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["file_panduan"]["tmp_name"], $target_file)) {
            if ($is_edit && !empty($edit_data['file_panduan']) && file_exists($edit_data['file_panduan'])) {
                unlink($edit_data['file_panduan']);
            }
            $panduan_path = $target_file;
        }
    }

    if ($is_edit) {
        $old_id = $_POST['old_id'];
        $stmt = $conn->prepare("UPDATE produk SET id=?, nama=?, kategori=?, harga=?, deskripsi=?, fitur=?, file_panduan=?, id_youtube=? WHERE id=?");
        $stmt->bind_param("sssssssss", $id, $nama, $kategori, $harga, $deskripsi, $fitur, $panduan_path, $id_youtube, $old_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO produk (id, nama, kategori, harga, deskripsi, fitur, file_panduan, id_youtube) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $id, $nama, $kategori, $harga, $deskripsi, $fitur, $panduan_path, $id_youtube);
    }

    if ($stmt->execute()) {
        header("Location: produk.php?msg=success");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . $stmt->error;
    }
}

// Hapus Produk
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    
    $stmt_get = $conn->prepare("SELECT file_panduan FROM produk WHERE id = ?");
    $stmt_get->bind_param("s", $id_hapus);
    $stmt_get->execute();
    $data_del = $stmt_get->get_result()->fetch_assoc();
    if ($data_del && !empty($data_del['file_panduan']) && file_exists($data_del['file_panduan'])) {
        unlink($data_del['file_panduan']);
    }

    $stmt = $conn->prepare("DELETE FROM produk WHERE id = ?");
    $stmt->bind_param("s", $id_hapus);
    if($stmt->execute()) {
        header("Location: produk.php?msg=deleted");
        exit;
    }
}

if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'success') $message = "Layanan berhasil disimpan!";
    if($_GET['msg'] == 'deleted') $message = "Layanan berhasil dihapus!";
}

$hasil = mysqli_query($conn, "SELECT * FROM produk");
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title"><?php echo $edit_data ? 'Edit Layanan' : 'Tambah Layanan Baru'; ?></h4>
                <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                
                <form method="POST" enctype="multipart/form-data" class="forms-sample">
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="old_id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label>ID Produk (Unique ID)</label>
                        <input type="text" name="id" class="form-control" value="<?php echo $edit_data ? $edit_data['id'] : ''; ?>" placeholder="pos-restoran" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Layanan</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit_data ? $edit_data['nama'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?php echo $edit_data ? $edit_data['kategori'] : ''; ?>" placeholder="Enterprise/Creative">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" value="<?php echo $edit_data ? $edit_data['harga'] : ''; ?>" placeholder="Rp 15jt">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?php echo $edit_data ? $edit_data['deskripsi'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Fitur (Satu per baris)</label>
                        <?php 
                        $fitur_val = "";
                        if($edit_data && $edit_data['fitur']) {
                            $arr = json_decode($edit_data['fitur'], true);
                            if(is_array($arr)) $fitur_val = implode("\n", $arr);
                        }
                        ?>
                        <textarea name="fitur" class="form-control" rows="5"><?php echo $fitur_val; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>File Panduan (PDF)</label>
                        <?php if($edit_data && $edit_data['file_panduan']): ?>
                            <div class="mb-1"><small class="text-success">File terunggah: <?php echo basename($edit_data['file_panduan']); ?></small></div>
                        <?php endif; ?>
                        <input type="file" name="file_panduan" class="form-control" accept=".pdf">
                    </div>
                    <div class="form-group">
                        <label>ID Video YouTube</label>
                        <input type="text" name="id_youtube" class="form-control" value="<?php echo $edit_data ? $edit_data['id_youtube'] : ''; ?>" placeholder="dQw4w9WgXcQ">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary me-2 text-white">
                        <?php echo $edit_data ? 'Perbarui Data' : 'Simpan Layanan'; ?>
                    </button>
                    <?php if($edit_data): ?>
                        <a href="produk.php" class="btn btn-light">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Daftar Layanan</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Panduan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($p = mysqli_fetch_assoc($hasil)): ?>
                                <tr>
                                    <td><span class="fw-bold"><?php echo $p['nama']; ?></span></td>
                                    <td><span class="badge badge-outline-primary"><?php echo $p['kategori']; ?></span></td>
                                    <td>
                                        <?php if($p['file_panduan']): ?>
                                            <i class="mdi mdi-file-pdf text-danger"></i>
                                        <?php endif; ?>
                                        <?php if($p['id_youtube']): ?>
                                            <i class="mdi mdi-youtube text-danger"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="?edit=<?php echo $p['id']; ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                        <a href="?hapus=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus?')">Hapus</a>
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
