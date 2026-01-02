<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Konten Mobile App</h5>
                <small class="text-muted float-end">Mobile App CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/mobile_app/add" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="label_badge">Label Badge</label>
                                <input type="text" class="form-control" id="label_badge" name="label_badge" placeholder="Contoh: Mobile Apps" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="judul_utama">Judul Utama</label>
                                <input type="text" class="form-control" id="judul_utama" name="judul_utama" placeholder="Contoh: Belajar Dimana Saja" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gambar_mockup">Gambar Mockup (Path)</label>
                                <input type="text" class="form-control" id="gambar_mockup" name="gambar_mockup" placeholder="/images/app-mockup.png" required />
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="mb-3">
                                <label class="form-label">Link Store</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class='bx bxl-play-store'></i> PlayStore</span>
                                    <input type="text" class="form-control" name="playstore" placeholder="https://..." />
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class='bx bxl-apple'></i> AppStore</span>
                                    <input type="text" class="form-control" name="appstore" placeholder="https://..." />
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dynamic List for Features -->
                        <div class="col-md-6">
                            <div class="divider text-start">
                                <div class="divider-text">Daftar Fitur Unggulan</div>
                            </div>
                            <div id="features-container">
                                <div class="input-group mb-2 feature-item">
                                    <span class="input-group-text"><i class="bx bx-star"></i></span>
                                    <input type="text" class="form-control" name="features[]" placeholder="Nama Fitur" required>
                                    <button class="btn btn-outline-danger remove-feature" type="button"><i class="bx bx-trash"></i></button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-feature-btn">
                                <i class="bx bx-plus"></i> Tambah Fitur
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo URLROOT; ?>/mobile_app" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('features-container');
    const addBtn = document.getElementById('add-feature-btn');

    addBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2 feature-item';
        div.innerHTML = `
            <span class="input-group-text"><i class="bx bx-star"></i></span>
            <input type="text" class="form-control" name="features[]" placeholder="Nama Fitur" required>
            <button class="btn btn-outline-danger remove-feature" type="button"><i class="bx bx-trash"></i></button>
        `;
        container.appendChild(div);
    });

    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-feature')) {
            const item = e.target.closest('.feature-item');
            if (container.children.length > 1) {
                item.remove();
            } else {
                alert("Minimal harus ada satu fitur.");
            }
        }
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
