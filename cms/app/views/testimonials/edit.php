<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Testimoni</h5>
                <small class="text-muted float-end">Testimonials CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/testimonials/edit/<?php echo $data['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Klien</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="peran">Peran / Jabatan</label>
                                <input type="text" class="form-control" id="peran" name="peran" value="<?php echo $data['peran']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="rating">Rating (1-5)</label>
                                <select class="form-select" id="rating" name="rating">
                                    <option value="5" <?php echo $data['rating'] == 5 ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5)</option>
                                    <option value="4" <?php echo $data['rating'] == 4 ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4)</option>
                                    <option value="3" <?php echo $data['rating'] == 3 ? 'selected' : ''; ?>>⭐⭐⭐ (3)</option>
                                    <option value="2" <?php echo $data['rating'] == 2 ? 'selected' : ''; ?>>⭐⭐ (2)</option>
                                    <option value="1" <?php echo $data['rating'] == 1 ? 'selected' : ''; ?>>⭐ (1)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="url_avatar">URL Avatar / Foto</label>
                                <input type="text" class="form-control" id="url_avatar" name="url_avatar" value="<?php echo $data['url_avatar']; ?>" />
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="urutan">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo $data['urutan']; ?>" required />
                            </div>
                        </div>
                        <div class="col-12">
                             <div class="mb-3">
                                <label class="form-label" for="isi_testimoni">Isi Testimoni</label>
                                <textarea class="form-control" id="isi_testimoni" name="isi_testimoni" rows="4" required><?php echo $data['isi_testimoni']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    <a href="<?php echo URLROOT; ?>/testimonials" class="btn btn-outline-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
