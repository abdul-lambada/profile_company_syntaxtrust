<?php
include 'includes/header.php';

$message = "";

// Tambah Klien Web
if (isset($_POST['simpan'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
  $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $tantangan = mysqli_real_escape_string($conn, $_POST['tantangan']);
  $solusi = mysqli_real_escape_string($conn, $_POST['solusi']);
  $url = mysqli_real_escape_string($conn, $_POST['url']);

  $q = "INSERT INTO klien_web (id, nama, kategori, tahun, deskripsi, tantangan, solusi, url) VALUES ('$id', '$nama', '$kategori', '$tahun', '$deskripsi', '$tantangan', '$solusi', '$url')";
  if (mysqli_query($conn, $q)) $message = "Portfolio berhasil disimpan!";
}

if (isset($_GET['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_GET['hapus']);
  mysqli_query($conn, "DELETE FROM klien_web WHERE id='$id'");
  header("Location: klien_web.php");
  exit;
}

$hasil = mysqli_query($conn, "SELECT * FROM klien_web");
?>

<div class="row">
  <div class="col-md-5 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <h4 class="card-title">Tambah Portofolio Website</h4>
        <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
        <form method="POST" class="forms-sample">
          <div class="form-group"><label>ID Portofolio (Slug URL)</label><input type="text" name="id" class="form-control" placeholder="nama-proyek" required></div>
          <div class="form-group"><label>Nama Website</label><input type="text" name="nama" class="form-control" required></div>
          <div class="row">
            <div class="col-6">
              <div class="form-group"><label>Kategori</label><input type="text" name="kategori" class="form-control" placeholder="E-commerce"></div>
            </div>
            <div class="col-6">
              <div class="form-group"><label>Tahun</label><input type="text" name="tahun" class="form-control" placeholder="2023"></div>
            </div>
          </div>
          <div class="form-group"><label>URL Demo Website</label><input type="text" name="url" class="form-control" placeholder="https://..."></div>
          <div class="form-group"><label>Ringkasan Proyek</label><textarea name="deskripsi" class="form-control" rows="3"></textarea></div>
          <div class="form-group"><label>Tantangan yang Dihadapi</label><textarea name="tantangan" class="form-control" rows="3"></textarea></div>
          <div class="form-group"><label>Solusi SyntaxTrust</label><textarea name="solusi" class="form-control" rows="3"></textarea></div>
          <button type="submit" name="simpan" class="btn btn-primary text-white me-2">Simpan Proyek</button>
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
                <th>Proyek</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($s = mysqli_fetch_assoc($hasil)): ?>
                <tr>
                  <td><span class="fw-bold"><?php echo $s['nama']; ?></span></td>
                  <td><?php echo $s['tahun']; ?></td>
                  <td><span class="badge badge-outline-success"><?php echo $s['kategori']; ?></span></td>
                  <td>
                    <a href="?hapus=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus portofolio ini?')">Hapus</a>
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
