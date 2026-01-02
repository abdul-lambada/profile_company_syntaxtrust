<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Konten Hero Section</h5>
        <a href="<?php echo URLROOT; ?>/hero/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Hero
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Utama</th>
                    <th>Highlight</th>
                    <th>Sub Judul</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                    // Simple flash message check (simulated)
                    if(isset($_GET['status']) && $_GET['status'] == 'success') : ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        Data berhasil disimpan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php foreach($data['heroes'] as $hero) : ?>
                <tr>
                    <td><i class="bx bx-hash"></i> <strong><?php echo $hero->id; ?></strong></td>
                    <td>
                        <span class="fw-medium"><?php echo $hero->judul_utama; ?></span>
                    </td>
                    <td>
                        <span class="badge bg-label-info me-1"><?php echo $hero->judul_highlight; ?></span>
                    </td>
                    <td><?php echo substr($hero->sub_judul, 0, 40) . '...'; ?></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewModal"
                                    data-judul="<?php echo htmlspecialchars($hero->judul_utama); ?>"
                                    data-highlight="<?php echo htmlspecialchars($hero->judul_highlight); ?>"
                                    data-subjudul="<?php echo htmlspecialchars($hero->sub_judul); ?>"
                                    data-badge="<?php echo htmlspecialchars($hero->label_badge); ?>"
                                    data-btn1="<?php echo htmlspecialchars($hero->teks_tombol_utama); ?>"
                                    data-btn2="<?php echo htmlspecialchars($hero->teks_tombol_sekunder); ?>"
                                    data-btn3="<?php echo htmlspecialchars($hero->teks_tombol_tersier); ?>"
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/hero/edit/<?php echo $hero->id; ?>">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a class="dropdown-item text-danger" href="javascript:void(0);"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-id="<?php echo $hero->id; ?>"
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
                    <a class="page-link" href="<?php echo URLROOT; ?>/hero?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/hero?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/hero?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>

                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/hero?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/hero?page=<?php echo $data['pagination']['total_pages']; ?>">
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
                <h5 class="modal-title" id="viewModalTitle">Detail Hero Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Badge</label>
                        <div id="viewBadge" class="form-control-plaintext badge bg-label-primary"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Judul Utama</label>
                        <p id="viewJudul" class="fw-bold"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Judul Highlight</label>
                        <p id="viewHighlight" class="text-primary fw-bold"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Sub Judul</label>
                        <p id="viewSubjudul"></p>
                    </div>
                </div>
                <div class="divider">
                    <div class="divider-text">Tombol CTA</div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label class="form-label">Tombol 1</label>
                        <input type="text" id="viewBtn1" class="form-control" readonly>
                    </div>
                    <div class="col mb-0">
                        <label class="form-label">Tombol 2</label>
                        <input type="text" id="viewBtn2" class="form-control" readonly>
                    </div>
                </div>
                 <div class="row mt-2">
                     <div class="col mb-0">
                        <label class="form-label">Tombol 3</label>
                        <input type="text" id="viewBtn3" class="form-control" readonly>
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
        
        // Extract info from data-* attributes
        var judul = button.getAttribute('data-judul');
        var highlight = button.getAttribute('data-highlight');
        var subjudul = button.getAttribute('data-subjudul');
        var badge = button.getAttribute('data-badge');
        var btn1 = button.getAttribute('data-btn1');
        var btn2 = button.getAttribute('data-btn2');
        var btn3 = button.getAttribute('data-btn3');

        // Update the modal's content.
        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewJudul').textContent = judul;
        modalBody.querySelector('#viewHighlight').textContent = highlight;
        modalBody.querySelector('#viewSubjudul').textContent = subjudul;
        modalBody.querySelector('#viewBadge').textContent = badge;
        modalBody.querySelector('#viewBtn1').value = btn1;
        modalBody.querySelector('#viewBtn2').value = btn2;
        modalBody.querySelector('#viewBtn3').value = btn3;
    });

    // Delete Modal Logic
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/hero/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
