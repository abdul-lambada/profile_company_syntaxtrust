<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Klien Peta</h5>
                <small class="text-muted float-end">Map CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/client_map/edit/<?php echo $data['id']; ?>" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama_sekolah">Nama Sekolah / Klien</label>
                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?php echo $data['nama_sekolah']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" value="<?php echo $data['kota']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="aktif" <?php echo $data['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="nonaktif" <?php echo $data['status'] == 'nonaktif' ? 'selected' : ''; ?>>Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="koordinat_x">Koordinat X (Horizontal)</label>
                                <input type="number" class="form-control" id="koordinat_x" name="koordinat_x" value="<?php echo $data['koordinat_x']; ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="koordinat_y">Koordinat Y (Vertikal)</label>
                                <input type="number" class="form-control" id="koordinat_y" name="koordinat_y" value="<?php echo $data['koordinat_y']; ?>" required />
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="urutan">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo $data['urutan']; ?>" required />
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
                    <a href="<?php echo URLROOT; ?>/client_map" class="btn btn-outline-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
