<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Peta Klien</h5>
                <small class="text-muted float-end">Map CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/client_map/add" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama_sekolah">Nama Sekolah / Klien</label>
                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Contoh: SMA Negeri 1 Medan" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="kota">Kota</label>
                                <input type="text" class="form-control" id="kota" name="kota" placeholder="Contoh: Medan" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="koordinat_x">Koordinat X (Horizontal)</label>
                                <input type="number" class="form-control" id="koordinat_x" name="koordinat_x" placeholder="0-800" required />
                                <div class="form-text">Posisi horizontal dari kiri peta (pixel/unit).</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="koordinat_y">Koordinat Y (Vertikal)</label>
                                <input type="number" class="form-control" id="koordinat_y" name="koordinat_y" placeholder="0-400" required />
                                <div class="form-text">Posisi vertikal dari atas peta (pixel/unit).</div>
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="urutan">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" placeholder="1" required />
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/client_map" class="btn btn-outline-secondary mt-3">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
