<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Statistik</h5>
                <small class="text-muted float-end">Stats CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/stats/add" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="label">Label</label>
                        <input type="text" class="form-control" id="label" name="label" placeholder="Contoh: Pengguna Aktif" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="nilai">Nilai</label>
                        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Contoh: 15,000+" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="urutan">Urutan</label>
                        <input type="number" class="form-control" id="urutan" name="urutan" placeholder="1" required />
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/stats" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
