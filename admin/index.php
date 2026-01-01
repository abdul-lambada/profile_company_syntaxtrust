<?php
include 'includes/header.php';

// Cek jumlah data untuk statistik
$q_produk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
$total_produk = mysqli_fetch_assoc($q_produk)['total'];

$q_sekolah = mysqli_query($conn, "SELECT COUNT(*) as total FROM klien_sekolah");
$total_sekolah = mysqli_fetch_assoc($q_sekolah)['total'];

$q_web = mysqli_query($conn, "SELECT COUNT(*) as total FROM klien_web");
$total_web = mysqli_fetch_assoc($q_web)['total'];

$q_pesan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pesan");
$total_pesan = mysqli_fetch_assoc($q_pesan)['total'];
?>

<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="statistics-details d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="statistics-title">Total Layanan</p>
                                    <h3 class="rate-percentage"><?php echo $total_produk; ?></h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Klien Sekolah</p>
                                    <h3 class="rate-percentage"><?php echo $total_sekolah; ?></h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Klien Web</p>
                                    <h3 class="rate-percentage"><?php echo $total_web; ?></h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Pesan Baru</p>
                                    <h3 class="rate-percentage"><?php echo $total_pesan; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 d-flex flex-column">
                            <div class="row flex-grow">
                                <div class="col-12 grid-margin stretch-card">
                                    <div class="card card-rounded">
                                        <div class="card-body">
                                            <div class="d-sm-flex justify-content-between align-items-start">
                                                <div>
                                                    <h4 class="card-title card-title-dash">Pesan Kontak Terbaru</h4>
                                                    <p class="card-subtitle card-subtitle-dash">Data dari formulir website utama.</p>
                                                </div>
                                                <div>
                                                    <a href="pesan.php" class="btn btn-primary btn-lg text-white mb-0 me-0">Kelola Semua Pesan</a>
                                                </div>
                                            </div>
                                            <div class="table-responsive  mt-1">
                                                <table class="table select-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Waktu</th>
                                                            <th>Pengirim</th>
                                                            <th>Layanan Diminati</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $res_pesan = mysqli_query($conn, "SELECT * FROM pesan ORDER BY dibuat_pada DESC LIMIT 5");
                                                        while ($row = mysqli_fetch_assoc($res_pesan)):
                                                        ?>
                                                            <tr>
                                                                <td><?php echo date('d/m/Y H:i', strtotime($row['dibuat_pada'])); ?></td>
                                                                <td>
                                                                    <div class="d-flex ">
                                                                        <div>
                                                                            <h6><?php echo $row['nama']; ?></h6>
                                                                            <p><?php echo $row['email']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h6><?php echo $row['layanan']; ?></h6>
                                                                </td>
                                                                <td>
                                                                    <a href="pesan.php" class="btn btn-sm btn-outline-primary">Detail</a>
                                                                </td>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                        <?php if (mysqli_num_rows($res_pesan) == 0): ?>
                                                            <tr>
                                                                <td colspan="4" class="text-center">Belum ada pesan masuk.</td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
