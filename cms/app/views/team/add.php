<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Anggota Tim</h5>
                <small class="text-muted float-end">Team CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/team/add" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh: Andi Pratama" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Contoh: Lead Developer" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="foto_upload">Upload Foto</label>
                                <input type="file" class="form-control" id="foto_upload" name="foto_upload" accept="image/*" />
                                <div class="form-text">Format: JPG, PNG, JPEG. Max: 2MB.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="kutipan">Kutipan</label>
                                <textarea class="form-control" id="kutipan" name="kutipan" rows="4" placeholder="Kutipan inspiratif..." required></textarea>
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="urutan">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" placeholder="1" required />
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/team" class="btn btn-outline-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
