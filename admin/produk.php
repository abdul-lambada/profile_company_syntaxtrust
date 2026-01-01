<?php
include 'includes/header.php';

$message = "";
$error = "";

// Tambah Produk
if (isset($_POST['tambah'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
  $harga = mysqli_real_escape_string($conn, $_POST['harga']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $fitur_raw = explode("\n", $_POST['fitur']);
  $fitur = json_encode(array_values(array_filter(array_map('trim', $fitur_raw))));

  $q = "INSERT INTO produk (id, nama, kategori, harga, deskripsi, fitur) VALUES ('$id', '$nama', '$kategori', '$harga', '$deskripsi', '$fitur')";
  if (mysqli_query($conn, $q)) {
    $message = "Layanan berhasil ditambahkan!";
  } else {
    $error = "Gagal menambah layanan: " . mysqli_error($conn);
  }
}

// Hapus Produk
if (isset($_GET['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_GET['hapus']);
  mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
  header("Location: produk.php");
  exit;
}

$hasil = mysqli_query($conn, "SELECT * FROM produk");
?>

<div class="row">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <h4 class="card-title">Tambah Layanan Baru</h4>
        <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
        <?php if ($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
        <form action="" method="POST" class="forms-sample">
          <div class="form-group">
            <label>ID Produk (Unique ID)</label>
            <input type="text" name="id" class="form-control" placeholder="Contoh: pos-restoran" required>
          </div>
          <div class="form-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Produk" required>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" placeholder="Enterprise / Creative">
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="text" name="harga" class="form-control" placeholder="Mulai dari Rp 5jt">
          </div>
          <div class="form-group">
            <label>Deskripsi Singkat</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
          </div>
          <div class="form-group">
            <label>Fitur Keunggulan (Satu fitur per baris)</label>
            <textarea name="fitur" class="form-control" rows="6" placeholder="Aman
Cepat
Responsif"></textarea>
          </div>
          <button type="submit" name="tambah" class="btn btn-primary me-2 text-white">Simpan Layanan</button>
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
                    <button class="btn btn-sm btn-info text-white" onclick="alert('Fitur edit segera hadir')">Edit</button>
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
