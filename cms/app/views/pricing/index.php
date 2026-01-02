<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Paket Harga</h5>
        <a href="<?php echo URLROOT; ?>/pricing/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Paket
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Status Populer</th>
                    <th>Fitur</th>
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

                <?php foreach($data['items'] as $row) : 
                    $featuresKey = str_replace(['"', ' '], '', $row->fitur_list_json); // clean for counting
                    $featCount = count(json_decode($row->fitur_list_json, true) ?? []);
                ?>
                <tr>
                    <td><span class="badge bg-label-secondary rounded-pill"><?php echo $row->urutan; ?></span></td>
                    <td>
                        <span class="fw-bold"><?php echo $row->nama_paket; ?></span>
                    </td>
                    <td><span class="fw-medium text-success"><?php echo $row->harga; ?></span></td>
                    <td>
                        <?php if($row->is_populer): ?>
                            <span class="badge bg-label-warning"><i class="bx bxs-star me-1"></i> Populer</span>
                        <?php else: ?>
                            <span class="badge bg-label-secondary">Standard</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge bg-secondary"><?php echo $featCount; ?> Fitur</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewModal"
                                    data-nama="<?php echo htmlspecialchars($row->nama_paket); ?>"
                                    data-harga="<?php echo htmlspecialchars($row->harga); ?>"
                                    data-deskripsi="<?php echo htmlspecialchars($row->deskripsi_singkat); ?>"
                                    data-populer="<?php echo $row->is_populer; ?>"
                                    data-features='<?php echo $row->fitur_list_json; ?>'
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/pricing/edit/<?php echo $row->id; ?>">
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
                    <a class="page-link" href="<?php echo URLROOT; ?>/pricing?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/pricing?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/pricing?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/pricing?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/pricing?page=<?php echo $data['pagination']['total_pages']; ?>">
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Paket Harga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <span id="viewPopuler" class="badge bg-warning mb-2" style="display: none;">POPULER</span>
                    <h3 id="viewNama" class="fw-bold mb-1"></h3>
                    <h2 id="viewHarga" class="text-primary mb-2"></h2>
                    <p id="viewDeskripsi" class="text-muted"></p>
                </div>
                <div class="bg-light p-3 rounded">
                    <h6 class="fw-bold mb-3">Fitur Paket:</h6>
                    <ul id="viewFeatures" class="list-group list-group-flush bg-transparent">
                        <!-- Dynamic Features -->
                    </ul>
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
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        var nama = button.getAttribute('data-nama');
        var harga = button.getAttribute('data-harga');
        var deskripsi = button.getAttribute('data-deskripsi');
        var populer = button.getAttribute('data-populer');
        var features = JSON.parse(button.getAttribute('data-features') || '[]');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewNama').textContent = nama;
        modalBody.querySelector('#viewHarga').textContent = harga;
        modalBody.querySelector('#viewDeskripsi').textContent = deskripsi;
        
        var popBadges = modalBody.querySelector('#viewPopuler');
        if(populer == "1"){
            popBadges.style.display = 'inline-block';
        } else {
            popBadges.style.display = 'none';
        }

        var listContainer = modalBody.querySelector('#viewFeatures');
        listContainer.innerHTML = '';
        features.forEach(function(feat){
            var li = document.createElement('li');
            li.className = 'list-group-item bg-transparent border-0 py-1 ps-0';
            li.innerHTML = '<i class="bx bx-check text-success me-2"></i>' + feat;
            listContainer.appendChild(li);
        });
    });

    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/pricing/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
