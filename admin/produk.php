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
    
    $is_edit = !empty($_POST['old_id']);

    if ($is_edit) {
        $old_id = $_POST['old_id'];
        $stmt = $conn->prepare("UPDATE produk SET id=?, nama=?, kategori=?, harga=?, deskripsi=?, fitur=? WHERE id=?");
        $stmt->bind_param("sssssss", $id, $nama, $kategori, $harga, $deskripsi, $fitur, $old_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO produk (id, nama, kategori, harga, deskripsi, fitur) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $id, $nama, $kategori, $harga, $deskripsi, $fitur);
    }

    if ($stmt->execute()) {
        $message = $is_edit ? "Layanan berhasil diperbarui!" : "Layanan berhasil ditambahkan!";
        if ($is_edit) { header("Location: produk.php?msg=success_update"); exit; }
    } else {
        $error = "Gagal menyimpan data: " . $stmt->error;
    }
}

// Hapus Produk
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM produk WHERE id = ?");
    $stmt->bind_param("s", $id_hapus);
    if($stmt->execute()) {
        header("Location: produk.php?msg=deleted");
        exit;
    }
}

if(isset($_GET['msg'])) {
    if($_GET['msg'] == 'success_update') $message = "Layanan berhasil diperbarui!";
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
                
                <form action="produk.php" method="POST" class="forms-sample">
                    <?php if ($edit_data): ?>
                        <input type="hidden" name="old_id" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label>ID Produk (Unique ID)</label>
                        <input type="text" name="id" class="form-control" value="<?php echo $edit_data ? $edit_data['id'] : ''; ?>" placeholder="Contoh: pos-restoran" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Layanan</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $edit_data ? $edit_data['nama'] : ''; ?>" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?php echo $edit_data ? $edit_data['kategori'] : ''; ?>" placeholder="Enterprise / Creative">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" value="<?php echo $edit_data ? $edit_data['harga'] : ''; ?>" placeholder="Mulai dari Rp 5jt">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="form-control" rows="4"><?php echo $edit_data ? $edit_data['deskripsi'] : ''; ?></textarea>
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
                        <textarea name="fitur" class="form-control" rows="6"><?php echo $fitur_val; ?></textarea>
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
                <h4 class="card-title">Daftar Layanan Tersedia</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Layanan</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($p = mysqli_fetch_assoc($hasil)): ?>
                                <tr>
                                    <td><code><?php echo $p['id']; ?></code></td>
                                    <td><span class="fw-bold"><?php echo $p['nama']; ?></span></td>
                                    <td><span class="badge badge-outline-dark"><?php echo $p['kategori']; ?></span></td>
                                    <td>
                                        <a href="?edit=<?php echo $p['id']; ?>" class="btn btn-sm btn-info text-white">Edit</a>
                                        <a href="?hapus=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus layanan ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($hasil) == 0): ?>
                                <tr><td colspan="4" class="text-center">Belum ada data.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
