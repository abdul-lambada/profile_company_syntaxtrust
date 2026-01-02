<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Fitur Unggulan</h5>
                <small class="text-muted float-end">Features CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/features/add" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="judul">Judul Fitur</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Manajemen Keuangan" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan fitur ini secara singkat..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="ikon_svg_path">SVG Path Icon</label>
                        <textarea class="form-control font-monospace" id="ikon_svg_path" name="ikon_svg_path" rows="5" placeholder="M12 2C6.48 2..." required></textarea>
                        <div class="form-text">Masukkan atribut <code>d="..."</code> dari tag SVG Path. Ambil dari ikon Boxicons atau Material Icons.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/features" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
