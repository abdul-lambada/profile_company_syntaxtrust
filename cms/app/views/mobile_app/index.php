<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Konten Aplikasi Mobile</h5>
        <a href="<?php echo URLROOT; ?>/mobile_app/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Konten
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Utama</th>
                    <th>Badge</th>
                    <th>Jumlah Fitur</th>
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

                <?php foreach($data['apps'] as $row) : 
                    $features = json_decode($row->fitur_list_json, true);
                    $featCount = is_array($features) ? count($features) : 0;
                ?>
                <tr>
                    <td><i class="bx bx-hash"></i> <strong><?php echo $row->id; ?></strong></td>
                    <td><span class="fw-medium"><?php echo $row->judul_utama; ?></span></td>
                    <td><span class="badge bg-label-primary"><?php echo $row->label_badge; ?></span></td>
                    <td><span class="badge bg-secondary"><?php echo $featCount; ?> Items</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewModal"
                                    data-badge="<?php echo htmlspecialchars($row->label_badge); ?>"
                                    data-judul="<?php echo htmlspecialchars($row->judul_utama); ?>"
                                    data-deskripsi="<?php echo htmlspecialchars($row->deskripsi); ?>"
                                    data-img="<?php echo htmlspecialchars($row->gambar_mockup); ?>"
                                    data-links='<?php echo $row->store_links_json; ?>'
                                    data-features='<?php echo $row->fitur_list_json; ?>'
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/mobile_app/edit/<?php echo $row->id; ?>">
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
                    <a class="page-link" href="<?php echo URLROOT; ?>/mobile_app?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/mobile_app?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/mobile_app?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/mobile_app?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/mobile_app?page=<?php echo $data['pagination']['total_pages']; ?>">
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
                <h5 class="modal-title">Detail Aplikasi Mobile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Badge</label>
                            <span id="viewBadge" class="badge bg-label-primary d-block w-auto text-start"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Utama</label>
                            <h5 id="viewJudul" class="fw-bold"></h5>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <p id="viewDeskripsi" class="text-muted"></p>
                        </div>
                         <div class="mb-3">
                            <label class="form-label">Store Links</label>
                            <div class="d-flex flex-column gap-2">
                                <small>🤖 PlayStore: <a href="#" id="viewPlayStore" target="_blank"></a></small>
                                <small>🍎 AppStore: <a href="#" id="viewAppStore" target="_blank"></a></small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="mb-3">
                            <label class="form-label">Fitur List</label>
                            <ul id="viewFeaturesList" class="list-group list-group-flush"></ul>
                        </div>
                         <div class="mb-3">
                            <label class="form-label">Mockup Image</label>
                            <code id="viewImg" class="d-block bg-light p-2 rounded"></code>
                        </div>
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
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        var badge = button.getAttribute('data-badge');
        var judul = button.getAttribute('data-judul');
        var deskripsi = button.getAttribute('data-deskripsi');
        var img = button.getAttribute('data-img');
        var links = JSON.parse(button.getAttribute('data-links') || '{}');
        var features = JSON.parse(button.getAttribute('data-features') || '[]');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewBadge').textContent = badge;
        modalBody.querySelector('#viewJudul').textContent = judul;
        modalBody.querySelector('#viewDeskripsi').textContent = deskripsi;
        modalBody.querySelector('#viewImg').textContent = img;

        var playLink = modalBody.querySelector('#viewPlayStore');
        playLink.textContent = links.playstore || '-';
        playLink.href = links.playstore || '#';

        var appLink = modalBody.querySelector('#viewAppStore');
        appLink.textContent = links.appstore || '-';
        appLink.href = links.appstore || '#';

        var listGroup = modalBody.querySelector('#viewFeaturesList');
        listGroup.innerHTML = '';
        features.forEach(function(item) {
            var li = document.createElement('li');
            li.className = 'list-group-item px-0 py-1';
            li.innerHTML = '<i class="bx bx-check-circle text-primary me-2"></i>' + item;
            listGroup.appendChild(li);
        });
    });

    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/mobile_app/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
