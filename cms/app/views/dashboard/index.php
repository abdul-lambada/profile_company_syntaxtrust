<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <!-- Welcome Card -->
    <div class="col-lg-8 mb-4 order-0">
        <div class="card h-100">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang di SIKES CMS! 🎉</h5>
                        <p class="mb-4">
                            Kamu sekarang memiliki kontrol penuh atas konten landing page. <br>
                            Gunakan menu di sidebar untuk mulai mengelola.
                        </p>
                        <a href="<?php echo URLROOT; ?>/features" class="btn btn-sm btn-outline-primary">Kelola Fitur</a>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="<?php echo ASSETS_PATH; ?>/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-star"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Fitur</span>
                        <h3 class="card-title mb-2"><?php echo $data['stats']['features_count']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-chat"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Testimoni</span>
                        <h3 class="card-title mb-2"><?php echo $data['stats']['testimonials_count']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row Stats -->
    <div class="col-12 col-md-8 col-lg-8 order-3 order-md-2">
        <div class="row">
             <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-group"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Tim</span>
                        <h3 class="card-title text-nowrap mb-1"><?php echo $data['stats']['team_count']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-dollar"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Paket</span>
                        <h3 class="card-title text-nowrap mb-1"><?php echo $data['stats']['pricing_count']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-map-alt"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Klien</span>
                        <h3 class="card-title text-nowrap mb-1"><?php echo $data['stats']['clients_count']; ?></h3>
                    </div>
                </div>
            </div>
             <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-question-mark"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">FAQ</span>
                        <h3 class="card-title text-nowrap mb-1"><?php echo $data['stats']['faq_count']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
