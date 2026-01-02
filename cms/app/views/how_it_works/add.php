<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Cara Kerja</h5>
                <small class="text-muted float-end">How It Works CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/how_it_works/add" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="nomor_langkah">Nomor Langkah (ex: 01, 02)</label>
                        <input type="text" class="form-control" id="nomor_langkah" name="nomor_langkah" placeholder="01" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Registrasi & Setup" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="path_ikon_svg">Ikon SVG Path</label>
                        <textarea class="form-control font-monospace" id="path_ikon_svg" name="path_ikon_svg" rows="3" placeholder="<path d='...' />" required></textarea>
                        <div class="form-text">Masukkan kode path SVG (d="...") atau elemen SVG penuh tanpa tag svg luar.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/how_it_works" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
