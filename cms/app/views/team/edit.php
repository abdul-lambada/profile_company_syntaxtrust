<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Anggota Tim</h5>
                <small class="text-muted float-end">Team CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/team/edit/<?php echo $data['id']; ?>" method="POST">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $data['jabatan']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="url_foto">URL Foto</label>
                                <input type="text" class="form-control" id="url_foto" name="url_foto" value="<?php echo $data['url_foto']; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kutipan">Kutipan</label>
                                <textarea class="form-control" id="kutipan" name="kutipan" rows="4" required><?php echo $data['kutipan']; ?></textarea>
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="urutan">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo $data['urutan']; ?>" required />
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    <a href="<?php echo URLROOT; ?>/team" class="btn btn-outline-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
