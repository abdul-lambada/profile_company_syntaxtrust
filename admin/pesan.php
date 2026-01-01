<?php
include 'includes/header.php';

// Hapus Pesan
if (isset($_GET['hapus'])) {
  $id = mysqli_real_escape_string($conn, $_GET['hapus']);
  mysqli_query($conn, "DELETE FROM pesan WHERE id='$id'");
  header("Location: pesan.php");
  exit;
}

$hasil = mysqli_query($conn, "SELECT * FROM pesan ORDER BY dibuat_pada DESC");
?>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card card-rounded">
      <div class="card-body">
        <h4 class="card-title">Database Pesan Masuk</h4>
        <p class="card-subtitle">Semua pesan dari formulir kontak di website utama.</p>
        <div class="table-responsive mt-3">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Waktu</th>
                <th>Pengirim</th>
                <th>Layanan</th>
                <th>Isi Pesan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($s = mysqli_fetch_assoc($hasil)): ?>
                <tr>
                  <td><?php echo date('d M Y - H:i', strtotime($s['dibuat_pada'])); ?></td>
                  <td>
                    <span class="fw-bold"><?php echo $s['nama']; ?></span><br>
                    <small class="text-muted"><?php echo $s['email']; ?></small>
                  </td>
                  <td><span class="badge badge-info text-white"><?php echo $s['layanan']; ?></span></td>
                  <td>
                    <div style="max-width:350px; white-space: normal; line-height: 1.4;">
                      <?php echo nl2br($s['isi_pesan']); ?>
                    </div>
                  </td>
                  <td>
                    <a href="mailto:<?php echo $s['email']; ?>" class="btn btn-primary btn-sm text-white">Balas</a>
                    <a href="?hapus=<?php echo $s['id']; ?>" class="btn btn-danger btn-sm text-white" onclick="return confirm('Hapus pesan ini?')">Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
              <?php if (mysqli_num_rows($hasil) == 0): ?>
                <tr><td colspan="5" class="text-center">Belum ada pesan yang masuk.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
