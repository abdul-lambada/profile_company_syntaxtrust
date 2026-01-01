<?php
include 'includes/header.php';

// Update Status
if (isset($_GET['status']) && isset($_GET['id'])) {
    $stmt = $conn->prepare("UPDATE pesan SET status=? WHERE id=?");
    $stmt->bind_param("si", $_GET['status'], $_GET['id']);
    $stmt->execute();
    header("Location: pesan.php");
    exit;
}

// Hapus Pesan
if (isset($_GET['hapus'])) {
  $stmt = $conn->prepare("DELETE FROM pesan WHERE id=?");
  $stmt->bind_param("i", $_GET['hapus']);
  $stmt->execute();
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
        <div class="table-responsive mt-3">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Waktu</th>
                <th>Status</th>
                <th>Pengirim</th>
                <th>Layanan</th>
                <th>Isi Pesan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($s = mysqli_fetch_assoc($hasil)): ?>
                <tr>
                  <td><?php echo date('d/m/Y H:i', strtotime($s['dibuat_pada'])); ?></td>
                  <td>
                    <?php if($s['status'] == 'baru'): ?>
                        <span class="badge badge-danger">Baru</span>
                    <?php elseif($s['status'] == 'dibaca'): ?>
                        <span class="badge badge-warning">Dibaca</span>
                    <?php else: ?>
                        <span class="badge badge-success">Selesai</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <span class="fw-bold"><?php echo $s['nama']; ?></span><br>
                    <small class="text-muted"><?php echo $s['email']; ?></small>
                  </td>
                  <td><span class="badge badge-outline-info"><?php echo $s['layanan']; ?></span></td>
                  <td>
                    <div style="max-width:300px; white-space: normal; line-height: 1.4;">
                      <?php echo nl2br($s['isi_pesan']); ?>
                    </div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Tindakan
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?status=dibaca&id=<?php echo $s['id']; ?>">Tandai Dibaca</a></li>
                        <li><a class="dropdown-item" href="?status=selesai&id=<?php echo $s['id']; ?>">Tandai Selesai</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="mailto:<?php echo $s['email']; ?>">Balas Email</a></li>
                        <li><a class="dropdown-item text-danger" href="?hapus=<?php echo $s['id']; ?>" onclick="return confirm('Hapus?')">Hapus</a></li>
                      </ul>
                    </div>
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
