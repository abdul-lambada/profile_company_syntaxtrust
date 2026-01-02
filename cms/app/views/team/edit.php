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
                                <label class="form-label" for="posisi">Posisi / Jabatan</label>
                                <input type="text" class="form-control" id="posisi" name="posisi" value="<?php echo $data['posisi']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="foto_path">URL Foto</label>
                                <input type="text" class="form-control" id="foto_path" name="foto_path" value="<?php echo $data['foto_path']; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="link_linkedin">Link LinkedIn</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bxl-linkedin-square"></i></span>
                                    <input type="text" class="form-control" id="link_linkedin" name="link_linkedin" value="<?php echo $data['link_linkedin']; ?>" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="link_instagram">Link Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bx bxl-instagram-alt"></i></span>
                                    <input type="text" class="form-control" id="link_instagram" name="link_instagram" value="<?php echo $data['link_instagram']; ?>" />
                                </div>
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
