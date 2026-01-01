<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit; }
$admin_nama = isset($_SESSION['admin_nama']) ? $_SESSION['admin_nama'] : 'Administrator';
include_once '../api/db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SyntaxTrust Admin</title>
  <link rel="stylesheet" href="src/assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="src/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="src/assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="src/assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="src/assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="src/assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="src/assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="src/assets/css/style.css">
  <link rel="shortcut icon" href="src/assets/images/favicon.png" />
  <style>
    .navbar .navbar-brand-wrapper .navbar-brand.brand-logo img { width: 40px; height: 40px; }
  </style>
</head>
<body class="with-welcome-text">
  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.php">
            <span class="fw-bold text-primary">SYNTAX<span class="text-dark">TRUST</span></span>
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
          <li class="nav-item fw-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Halo, <span class="text-black fw-bold"><?php echo $admin_nama; ?></span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item d-none d-lg-block me-3">
            <a href="../" target="_blank" class="btn btn-sm btn-outline-info">
                <i class="mdi mdi-earth me-1"></i> Lihat Website
            </a>
          </li>
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="bg-primary rounded-circle text-white p-2" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
                <?php echo substr($admin_nama, 0, 1); ?>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item" href="profil.php"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Profil Saya</a>
              <a class="dropdown-item" href="logout.php"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> Keluar</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
        <ul class="nav">
          <li class="nav-item <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Data Utama</li>
          <li class="nav-item <?php echo $current_page == 'produk.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="produk.php">
              <i class="menu-icon mdi mdi-package-variant"></i>
              <span class="menu-title">Layanan & Produk</span>
            </a>
          </li>
          <li class="nav-item nav-category">Klien</li>
          <li class="nav-item <?php echo $current_page == 'klien_sekolah.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="klien_sekolah.php">
              <i class="menu-icon mdi mdi-school"></i>
              <span class="menu-title">Sekolah</span>
            </a>
          </li>
          <li class="nav-item <?php echo $current_page == 'klien_web.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="klien_web.php">
              <i class="menu-icon mdi mdi-xml"></i>
              <span class="menu-title">Website Portfolio</span>
            </a>
          </li>
          <li class="nav-item nav-category">Komunikasi</li>
          <li class="nav-item <?php echo $current_page == 'pesan.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="pesan.php">
              <i class="menu-icon mdi mdi-message-text-outline"></i>
              <span class="menu-title">Pesan Masuk</span>
              <?php
              $q_new = mysqli_query($conn, "SELECT COUNT(*) as total FROM pesan WHERE status='baru'");
              $new_count = mysqli_fetch_assoc($q_new)['total'];
              if($new_count > 0) echo '<span class="badge badge-danger ms-2">'.$new_count.'</span>';
              ?>
            </a>
          </li>
          <li class="nav-item <?php echo $current_page == 'mitra.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="mitra.php">
              <i class="menu-icon mdi mdi-handshake-outline"></i>
              <span class="menu-title">Mitra Strategis</span>
            </a>
          </li>
          <li class="nav-item nav-category">Pengaturan</li>
          <li class="nav-item <?php echo $current_page == 'pengaturan.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="pengaturan.php">
              <i class="menu-icon mdi mdi-settings-outline"></i>
              <span class="menu-title">Konfigurasi Situs</span>
            </a>
          </li>
          <li class="nav-item <?php echo $current_page == 'profil.php' ? 'active' : ''; ?>">
            <a class="nav-link" href="profil.php" >
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Profil Akun</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="menu-icon mdi mdi-power"></i>
              <span class="menu-title">Keluar</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
