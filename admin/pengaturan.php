<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include_once '../api/db.php';

$message = "";

if (isset($_POST['simpan'])) {
    $stmt = $conn->prepare("UPDATE pengaturan SET nilai = ? WHERE kunci = ?");
    foreach($_POST['set'] as $key => $val) {
        $stmt->bind_param("ss", $val, $key);
        $stmt->execute();
    }
    $message = "Pengaturan berhasil diperbarui!";
}

$q = mysqli_query($conn, "SELECT * FROM pengaturan");
$settings = [];
while($row = mysqli_fetch_assoc($q)) {
    $settings[$row['kunci']] = $row['nilai'];
}

include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Situs Dasar</h4>
                <p class="card-subtitle">Konfigurasi umum yang tampil di website publik.</p>
                
                <?php if ($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                
                <form method="POST" class="forms-sample mt-4">
                    <div class="form-group">
                        <label>Nama Situs</label>
                        <input type="text" name="set[nama_situs]" class="form-control" value="<?php echo $settings['nama_situs']; ?>">
                    </div>
                    <div class="form-group">
                        <label>WhatsApp (Format: 628...)</label>
                        <input type="text" name="set[wa_number]" class="form-control" value="<?php echo $settings['wa_number']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Email Kontak</label>
                        <input type="email" name="set[email_kontak]" class="form-control" value="<?php echo $settings['email_kontak']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Footer</label>
                        <textarea name="set[deskripsi_footer]" class="form-control" rows="4"><?php echo $settings['deskripsi_footer']; ?></textarea>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary text-white me-2">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-rounded bg-primary">
            <div class="card-body text-white">
                <h4 class="card-title text-white">Panduan Pengaturan</h4>
                <p>Ubah pengaturan di sini untuk memperbarui informasi kontak di website Astro tanpa harus mengubah kode sumber.</p>
                <ul class="mt-4">
                    <li><strong>Nama Situs</strong>: Muncul di Title dan Logo Teks.</li>
                    <li><strong>WhatsApp</strong>: Digunakan oleh sistem redirect formulir kontak.</li>
                    <li><strong>Email</strong>: Informasi footer.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
