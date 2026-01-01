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
    $stmt = $conn->prepare("SELECT * FROM mitra WHERE id = ?");
    $stmt->bind_param("i", $id_edit);
    $stmt->execute();
    $edit_data = $stmt->get_result()->fetch_assoc();
}

// Tambah / Update Mitra
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    
    $is_edit = !empty($_POST['edit_id']);
    $logo_path = $edit_data ? $edit_data['logo'] : '';

    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === 0) {
        $target_dir = "uploads/mitra/";
        if (!file_exists($target_dir)) mkdir($target_dir, 0777, true);
        
        $file_ext = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
        $new_filename = "mitra_" . time() . "_" . rand(1000, 9999) . "." . $file_ext;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            if ($is_edit && !empty($edit_data['logo']) && file_exists($edit_data['logo'])) {
                unlink($edit_data['logo']);
            }
            $logo_path = $target_file;
        }
    }

    if ($is_edit) {
        $edit_id = $_POST['edit_id'];
        $stmt = $conn->prepare("UPDATE mitra SET nama=?, logo=? WHERE id=?");
        $stmt->bind_param("ssi", $nama, $logo_path, $edit_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO mitra (nama, logo) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama, $logo_path);
    }

    if ($stmt->execute()) {
        header("Location: mitra.php?msg=success");
        exit;
    } else {
        $error = "Gagal menyimpan data: " . $stmt->error;
    }
}

// Hapus Mitra
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $stmt_get = $conn->prepare("SELECT logo FROM mitra WHERE id = ?");
    $stmt_get->bind_param("i", $id_hapus);
    $stmt_get->execute();
    $data_del = $stmt_get->get_result()->fetch_assoc();
    if ($data_del && !empty($data_del['logo']) && file_exists($data_del['logo'])) {
        unlink($data_del['logo']);
    }

    $stmt = $conn->prepare("DELETE FROM mitra WHERE id = ?");
    $stmt->bind_param("i", $id_hapus);
    if($stmt->execute()) {
        header("Location: mitra.php?msg=deleted");
        exit;
    }
}

if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'success') $message = "Mitra berhasil disimpan!";
    if($_GET['msg'] == 'deleted') $message = "Mitra berhasil dihapus!";
}

$hasil = mysqli_query($conn, "SELECT * FROM mitra");
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-5 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title"><?php echo $edit_data ? 'Edit Mitra' : 'Tambah Mitra Baru'; ?></h4>
                <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                <form method="POST" enctype="multipart/form-data" class="forms-sample">
                    <?php if($edit_data): ?>
                        <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label>Nama Perusahaan / Mitra</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit_data ? $edit_data['nama'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Logo Mitra</label>
                        <?php if($edit_data && $edit_data['logo']): ?>
                            <div class="mb-2"><img src="<?php echo $edit_data['logo']; ?>" style="max-width: 100px; filter: invert(0);"></div>
                        <?php endif; ?>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary text-white me-2">Simpan Mitra</button>
                    <?php if($edit_data): ?>
                        <a href="mitra.php" class="btn btn-light">Batal</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Daftar Mitra</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($s = mysqli_fetch_assoc($hasil)): ?>
                                <tr>
                                    <td class="bg-dark">
                                        <?php if($s['logo']): ?>
                                            <img src="<?php echo $s['logo']; ?>" style="width: 80px; height: auto; filter: brightness(0) invert(1);">
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="fw-bold"><?php echo $s['nama']; ?></span></td>
                                    <td>
                                        <a href="?edit=<?php echo $s['id']; ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                        <a href="?hapus=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus?')">Hapus</a>
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
