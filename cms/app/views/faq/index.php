<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pertanyaan (FAQ)</h5>
        <a href="<?php echo URLROOT; ?>/faq/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah FAQ
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban (Preview)</th>
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
                    <td>
                        <span class="fw-medium"><?php echo $row->pertanyaan; ?></span>
                    </td>
                    <td>
                        <span class="text-muted text-break" style="max-width: 300px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            <?php echo $row->jawaban; ?>
                        </span>
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
                                    data-pertanyaan="<?php echo htmlspecialchars($row->pertanyaan); ?>"
                                    data-jawaban="<?php echo htmlspecialchars($row->jawaban); ?>"
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/faq/edit/<?php echo $row->id; ?>">
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
                    <a class="page-link" href="<?php echo URLROOT; ?>/faq?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/faq?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/faq?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/faq?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/faq?page=<?php echo $data['pagination']['total_pages']; ?>">
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
                <h5 class="modal-title">Detail FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label text-primary fw-bold">Pertanyaan:</label>
                    <h5 id="viewPertanyaan"></h5>
                </div>
                <div class="mb-3">
                    <label class="form-label text-primary fw-bold">Jawaban:</label>
                    <p id="viewJawaban" class="bg-light p-3 rounded"></p>
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
        
        var pertanyaan = button.getAttribute('data-pertanyaan');
        var jawaban = button.getAttribute('data-jawaban');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewPertanyaan').textContent = pertanyaan;
        modalBody.querySelector('#viewJawaban').textContent = jawaban;
    });

    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/faq/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
