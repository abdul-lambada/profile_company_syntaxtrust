<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Lencana / Mitra</h5>
                <small class="text-muted float-end">Trust Badges</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/badges/add" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="label">Label / Nama Mitra</label>
                        <input type="text" class="form-control" id="label" name="label" placeholder="Contoh: Kemendikbud" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="ikon_svg_path">SVG Path Icon</label>
                        <textarea class="form-control font-monospace" id="ikon_svg_path" name="ikon_svg_path" rows="5" placeholder="M12 2C6.48 2..." required></textarea>
                        <div class="form-text">Masukkan hanya atribut <code>d="..."</code> dari tag SVG Path.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/badges" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
