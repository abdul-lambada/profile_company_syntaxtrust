<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Paket Harga</h5>
                <small class="text-muted float-end">Pricing CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/pricing/add" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="nama_paket">Nama Paket</label>
                                <input type="text" class="form-control" id="nama_paket" name="nama_paket" placeholder="Contoh: Basic, Pro, Enterprise" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="harga">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Contoh: Rp 500,000 / bln" required />
                            </div>
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_populer" name="is_populer" />
                                    <label class="form-check-label" for="is_populer">
                                        Tandai sebagai <strong>Paket Populer</strong> (Rekomendasi)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="deskripsi_singkat">Deskripsi Singkat</label>
                                <textarea class="form-control" id="deskripsi_singkat" name="deskripsi_singkat" rows="3" placeholder="Deskripsi singkat untuk sub-judul..." required></textarea>
                            </div>
                             <div class="mb-3">
                                <label class="form-label" for="urutan">Urutan</label>
                                <input type="number" class="form-control" id="urutan" name="urutan" placeholder="1" required />
                            </div>
                        </div>
                        
                        <!-- Dynamic Features List -->
                        <div class="col-12 mt-3">
                            <div class="divider text-start">
                                <div class="divider-text fw-bold"><i class="bx bx-list-check"></i> Daftar Fitur</div>
                            </div>
                            <div id="features-container">
                                <div class="input-group mb-2">
                                    <span class="input-group-text"><i class="bx bx-check"></i></span>
                                    <input type="text" class="form-control" name="fitur[]" placeholder="Fitur paket..." required />
                                    <button class="btn btn-outline-danger" type="button" onclick="removeFeature(this)">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addFeature()">
                                <i class="bx bx-plus"></i> Tambah Fitur Lain
                            </button>
                        </div>

                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/pricing" class="btn btn-outline-secondary mt-4">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function addFeature() {
    var container = document.getElementById('features-container');
    var div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <span class="input-group-text"><i class="bx bx-check"></i></span>
        <input type="text" class="form-control" name="fitur[]" placeholder="Fitur paket..." />
        <button class="btn btn-outline-danger" type="button" onclick="removeFeature(this)">
            <i class="bx bx-trash"></i>
        </button>
    `;
    container.appendChild(div);
}

function removeFeature(btn) {
    if(document.querySelectorAll('#features-container .input-group').length > 1){
        btn.closest('.input-group').remove();
    } else {
        alert('Minimal harus ada 1 fitur.');
    }
}
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
