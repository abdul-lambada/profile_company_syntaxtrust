<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Solusi & Akses</h5>
                <small class="text-muted float-end">Solutions CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/solutions/add" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="label_kategori">Label Kategori</label>
                                <input type="text" class="form-control" id="label_kategori" name="label_kategori" placeholder="Contoh: UNTUK SEKOLAH" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="judul">Judul Utama</label>
                                <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Kelola Operasional Sekolah" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi singkat..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gambar_path">Path Gambar</label>
                                <input type="text" class="form-control" id="gambar_path" name="gambar_path" placeholder="/images/dashboard-sekolah.png" required />
                                <div class="form-text">Path relatif gambar dari folder public.</div>
                            </div>
                        </div>
                        
                        <!-- Dynamic List for Roles -->
                        <div class="col-md-6">
                            <div class="divider text-start">
                                <div class="divider-text">Daftar Peran (Roles)</div>
                            </div>
                            <div id="roles-container">
                                <div class="input-group mb-2 role-item">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="peran[]" placeholder="Nama Peran (ex: Admin)" required>
                                    <button class="btn btn-outline-danger remove-role" type="button"><i class="bx bx-trash"></i></button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-role-btn">
                                <i class="bx bx-plus"></i> Tambah Peran
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo URLROOT; ?>/solutions" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('roles-container');
    const addBtn = document.getElementById('add-role-btn');

    // Add Role Field
    addBtn.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'input-group mb-2 role-item';
        div.innerHTML = `
            <span class="input-group-text"><i class="bx bx-user"></i></span>
            <input type="text" class="form-control" name="peran[]" placeholder="Nama Peran" required>
            <button class="btn btn-outline-danger remove-role" type="button"><i class="bx bx-trash"></i></button>
        `;
        container.appendChild(div);
    });

    // Remove Role Field (Delegation)
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-role')) {
            const item = e.target.closest('.role-item');
            // Ensure at least one input remains
            if (container.children.length > 1) {
                item.remove();
            } else {
                alert("Minimal harus ada satu peran.");
            }
        }
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
