<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Peta Sebaran Klien</h5>
        <a href="<?php echo URLROOT; ?>/client_map/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Lokasi
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama Sekolah</th>
                    <th>Kota</th>
                    <th>Koordinat (X, Y)</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                    if(isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php foreach($data['items'] as $row) : ?>
                <tr>
                    <td><span class="badge bg-label-secondary rounded-pill"><?php echo $row->urutan; ?></span></td>
                    <td><span class="fw-medium"><?php echo $row->nama_sekolah; ?></span></td>
                    <td><i class="bx bx-map-pin me-1"></i> <?php echo $row->kota; ?></td>
                    <td>
                        <span class="badge bg-label-info">
                            X: <?php echo $row->koordinat_x; ?>, Y: <?php echo $row->koordinat_y; ?>
                        </span>
                    </td>
                    <td>
                        <?php if($row->status == 'aktif'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Non-Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                   data-bs-toggle="modal"
                                   data-bs-target="#viewModal"
                                   data-nama="<?php echo htmlspecialchars($row->nama_sekolah); ?>"
                                   data-kota="<?php echo htmlspecialchars($row->kota); ?>"
                                   data-x="<?php echo $row->koordinat_x; ?>"
                                   data-y="<?php echo $row->koordinat_y; ?>"
                                   data-status="<?php echo $row->status; ?>"
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/client_map/edit/<?php echo $row->id; ?>">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a class="dropdown-item text-danger" href="javascript:void(0);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-id="<?php echo $row->id; ?>"
                                >
                                    <i class="bx bx-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div class="card-footer d-flex justify-content-center">
        <?php if($data['pagination']['total_pages'] > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item first <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/client_map?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/client_map?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/client_map?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/client_map?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/client_map?page=<?php echo $data['pagination']['total_pages']; ?>">
                        <i class="tf-icon bx bx-chevrons-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Lokasi Klien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Nama Sekolah</label>
                            <h5 id="viewNama" class="fw-bold"></h5>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <div id="viewKota" class="text-primary fw-medium"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Koordinat</label>
                            <code class="d-block bg-light p-2 rounded">
                                X: <span id="viewX"></span>, Y: <span id="viewY"></span>
                            </code>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <span id="viewStatus" class="badge"></span>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label class="form-label mb-2">Preview Posisi (Simulasi)</label>
                        <div class="border rounded bg-light position-relative" style="height: 300px; width: 100%; overflow: hidden; background-image: radial-gradient(#ccc 1px, transparent 1px); background-size: 20px 20px;">
                            <!-- Center Point Reference -->
                             <span class="position-absolute text-muted" style="top: 5px; left: 5px; font-size: 10px;">(0,0)</span>
                            
                            <!-- The Dot -->
                            <div id="mapDot" class="position-absolute bg-danger rounded-circle shadow-sm" 
                                 style="width: 16px; height: 16px; top: 0; left: 0; transform: translate(-50%, -50%); transition: all 0.5s ease; border: 2px solid white;">
                            </div>
                             <div id="mapTooltip" class="position-absolute bg-dark text-white text-xs px-2 py-1 rounded" 
                                style="top: 0; left: 0; transform: translate(-50%, -150%); white-space: nowrap; transition: all 0.5s ease;">
                                Lokasi
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1">* Area ini adalah simulasi skala koordinat.</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin data ini akan dihapus?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" action="" method="POST">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Modal Logic
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        var nama = button.getAttribute('data-nama');
        var kota = button.getAttribute('data-kota');
        var x = parseInt(button.getAttribute('data-x'));
        var y = parseInt(button.getAttribute('data-y'));
        var status = button.getAttribute('data-status');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewNama').textContent = nama;
        modalBody.querySelector('#viewKota').innerHTML = '<i class="bx bx-map-pin"></i> ' + kota;
        modalBody.querySelector('#viewX').textContent = x;
        modalBody.querySelector('#viewY').textContent = y;

        var statusBadge = modalBody.querySelector('#viewStatus');
        if(status == 'aktif'){
            statusBadge.className = 'badge bg-success';
            statusBadge.textContent = 'Aktif';
        } else {
            statusBadge.className = 'badge bg-secondary';
            statusBadge.textContent = 'Non-Aktif';
        }

        // Update Mini Map Dot Position
        // Asumsi Container size: Width ~450px (col-7), Height 300px.
        // Skala Asli Peta mungkin besar (misal 1000x500). Kita perlu scale down atau clamp.
        // Untuk demo ini, kita anggap koordinat langsung pixel relatif, tapi kita scale down 50% jika terlalu besar
        
        var scale = 0.5; 
        // Logic: Jika X > 400, kita anggap peta "besar" dan kita scale tampilan dot nya
        var displayX = x;
        var displayY = y;
        
        // Simple visualization: Clamp to container bounds to keep it visible
        // Container is roughly 100% width of col-md-7 inside modal -> approx 400px wide. 300px height.
        
        // Let's use % essentially if input is large like 800
        // Or just map pixel directly. Assuming user inputs pixel coordinates for the frontend map component.
        // We will just position it precisely.
        
        var dot = modalBody.querySelector('#mapDot');
        var tooltip = modalBody.querySelector('#mapTooltip');
        
        dot.style.left = x + 'px';
        dot.style.top = y + 'px';
        
        tooltip.style.left = x + 'px';
        tooltip.style.top = y + 'px';
        tooltip.textContent = nama;
    });

    // Delete Modal Logic
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/client_map/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
