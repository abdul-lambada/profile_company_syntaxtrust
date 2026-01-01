<?php
include 'includes/header.php';

$message = "";

// Tambah/Update Sekolah
if (isset($_POST['simpan'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $kota = mysqli_real_escape_string($conn, $_POST['kota']);
  $lat = mysqli_real_escape_string($conn, $_POST['lat']);
  $lng = mysqli_real_escape_string($conn, $_POST['lng']);

  $q = "INSERT INTO klien_sekolah (nama, kota, lat, lng) VALUES ('$nama', '$kota', '$lat', '$lng')";
  if (mysqli_query($conn, $q)) $message = "Data sekolah berhasil ditambahkan!";
}

if (isset($_GET['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_GET['hapus']);
  mysqli_query($conn, "DELETE FROM klien_sekolah WHERE id='$id'");
  header("Location: klien_sekolah.php");
  exit;
}

$hasil = mysqli_query($conn, "SELECT * FROM klien_sekolah");
?>

<div class="row">
  <div class="col-md-5 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <h4 class="card-title">Tambah Klien Sekolah Baru</h4>
        <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
        <form method="POST" class="forms-sample">
          <div class="form-group"><label>Nama Sekolah / Institusi</label><input type="text" name="nama" class="form-control" placeholder="SMK Negeri 1..." required></div>
          <div class="form-group"><label>Kabupaten / Kota</label><input type="text" name="kota" class="form-control" placeholder="Jakarta Selatan" required></div>
          <div class="row">
            <div class="col-6">
              <div class="form-group"><label>Latitude</label><input type="text" name="lat" class="form-control" placeholder="-6.234567"></div>
            </div>
            <div class="col-6">
              <div class="form-group"><label>Longitude</label><input type="text" name="lng" class="form-control" placeholder="106.123456"></div>
            </div>
          </div>
          <button type="submit" name="simpan" class="btn btn-primary text-white me-2">Simpan Sekolah</button>
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
                    <a href="?hapus=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus data ini?')">Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
              <?php if (mysqli_num_rows($hasil) == 0): ?>
                <tr><td colspan="3" class="text-center">Belum ada data klien sekolah.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
