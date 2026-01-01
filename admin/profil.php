<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
include_once '../api/db.php';

$message = "";
$error = "";

// Pastikan admin_id ada di sesi
if(!isset($_SESSION['admin_id'])) {
    header("Location: logout.php");
    exit;
}

$user_id = $_SESSION['admin_id'];

// Ambil data user saat ini
$q_user = mysqli_query($conn, "SELECT * FROM pengguna WHERE id='$user_id'");
$user_data = mysqli_fetch_assoc($q_user);

if(!$user_data) {
    header("Location: logout.php");
    exit;
}

if(isset($_POST['update_profil'])){
    $nama = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    
    $stmt = $conn->prepare("UPDATE pengguna SET nama_lengkap=?, username=? WHERE id=?");
    $stmt->bind_param("ssi", $nama, $username, $user_id);
    if($stmt->execute()){
        $_SESSION['admin_nama'] = $nama;
        $message = "Profil berhasil diperbarui!";
        $user_data['nama_lengkap'] = $nama;
        $user_data['username'] = $username;
    } else {
        $error = "Gagal memperbarui profil.";
    }
}

if(isset($_POST['update_password'])){
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];
    
    if($password_baru === $konfirmasi){
        $hashed = password_hash($password_baru, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE pengguna SET password=? WHERE id=?");
        $stmt->bind_param("si", $hashed, $user_id);
        $stmt->execute();
        $message = "Password berhasil diubah!";
    } else {
        $error = "Konfirmasi password tidak cocok.";
    }
}

// Baru sertakan header setelah semua logika redirect/processing selesai
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Informasi Akun</h4>
                <?php if($message): ?><div class="alert alert-success"><?php echo $message; ?></div><?php endif; ?>
                <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $user_data['nama_lengkap']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user_data['username']; ?>" required>
                    </div>
                    <button type="submit" name="update_profil" class="btn btn-primary text-white">Update Profil</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h4 class="card-title">Ganti Password</h4>
                <form method="POST">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="konfirmasi_password" class="form-control" required>
                    </div>
                    <button type="submit" name="update_password" class="btn btn-warning text-white">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
