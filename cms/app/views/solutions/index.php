<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Konten Solusi & Akses</h5>
        <a href="<?php echo URLROOT; ?>/solutions/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Solusi
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori Label</th>
                    <th>Judul Utama</th>
                    <th>Jumlah Peran</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                    // Simple flash message check
                    if(isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php foreach($data['solutions'] as $row) : 
                    // Count items in JSON
                    $roles = json_decode($row->peran_list_json, true);
                    $roleCount = is_array($roles) ? count($roles) : 0;
                ?>
                <tr>
                    <td><i class="bx bx-hash"></i> <strong><?php echo $row->id; ?></strong></td>
                    <td><span class="badge bg-label-info"><?php echo $row->label_kategori; ?></span></td>
                    <td><span class="fw-medium"><?php echo $row->judul; ?></span></td>
                    <td><span class="badge bg-secondary"><?php echo $roleCount; ?> Role</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewModal"
                                    data-label="<?php echo htmlspecialchars($row->label_kategori); ?>"
                                    data-judul="<?php echo htmlspecialchars($row->judul); ?>"
                                    data-deskripsi="<?php echo htmlspecialchars($row->deskripsi); ?>"
                                    data-img="<?php echo htmlspecialchars($row->gambar_path); ?>"
                                    data-roles='<?php echo $row->peran_list_json; ?>'
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/solutions/edit/<?php echo $row->id; ?>">
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
    
    <!-- Sneat Pagination -->
    <div class="card-footer d-flex justify-content-center">
        <?php if($data['pagination']['total_pages'] > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item first <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/solutions?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/solutions?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/solutions?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>

                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/solutions?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/solutions?page=<?php echo $data['pagination']['total_pages']; ?>">
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
                <h5 class="modal-title">Detail Solusi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <h6 id="viewLabel" class="text-primary"></h6>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <h5 id="viewJudul" class="fw-bold"></h5>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <p id="viewDeskripsi" class="text-muted"></p>
                        </div>
                         <div class="mb-3">
                            <label class="form-label">Path Gambar</label>
                            <code id="viewImg" class="d-block bg-light p-2 rounded"></code>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label mb-2">Daftar Peran (Roles)</label>
                        <ul id="viewRolesList" class="list-group">
                            <!-- Roles populated via JS -->
                        </ul>
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
                <p>Apakah Anda yakin ingin menghapus data solusi ini?</p>
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
        
        var label = button.getAttribute('data-label');
        var judul = button.getAttribute('data-judul');
        var deskripsi = button.getAttribute('data-deskripsi');
        var img = button.getAttribute('data-img');
        var rolesJson = button.getAttribute('data-roles');
        var roles = JSON.parse(rolesJson || '[]');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewLabel').textContent = label;
        modalBody.querySelector('#viewJudul').textContent = judul;
        modalBody.querySelector('#viewDeskripsi').textContent = deskripsi;
        modalBody.querySelector('#viewImg').textContent = img;

        var listGroup = modalBody.querySelector('#viewRolesList');
        listGroup.innerHTML = '';
        roles.forEach(function(role) {
            var li = document.createElement('li');
            li.className = 'list-group-item d-flex align-items-center';
            li.innerHTML = '<i class="bx bx-user me-2"></i>' + role;
            listGroup.appendChild(li);
        });
    });

    // Delete Modal Logic
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/solutions/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
