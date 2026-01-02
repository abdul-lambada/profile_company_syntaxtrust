<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tim Kami</h5>
        <a href="<?php echo URLROOT; ?>/team/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Anggota
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama & Posisi</th>
                    <th>Social Media</th>
                    <th>Foto</th>
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
                        <div class="d-flex flex-column">
                            <span class="fw-bold"><?php echo $row->nama; ?></span>
                            <small class="text-muted"><?php echo $row->posisi; ?></small>
                        </div>
                    </td>
                    <td>
                        <?php if($row->link_linkedin): ?>
                            <a href="<?php echo $row->link_linkedin; ?>" target="_blank" class="text-secondary me-2"><i class="bx bxl-linkedin-square fs-4"></i></a>
                        <?php endif; ?>
                        <?php if($row->link_instagram): ?>
                            <a href="<?php echo $row->link_instagram; ?>" target="_blank" class="text-secondary"><i class="bx bxl-instagram-alt fs-4"></i></a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($row->foto_path): ?>
                            <div class="avatar avatar-sm">
                                <img src="<?php echo $row->foto_path; ?>" alt="Foto" class="rounded-circle">
                            </div>
                        <?php else: ?>
                            <span class="badge bg-label-secondary">No Img</span>
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
                                    data-nama="<?php echo htmlspecialchars($row->nama); ?>"
                                    data-posisi="<?php echo htmlspecialchars($row->posisi); ?>"
                                    data-foto="<?php echo htmlspecialchars($row->foto_path); ?>"
                                    data-linkedin="<?php echo htmlspecialchars($row->link_linkedin); ?>"
                                    data-instagram="<?php echo htmlspecialchars($row->link_instagram); ?>"
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/team/edit/<?php echo $row->id; ?>">
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
                    <a class="page-link" href="<?php echo URLROOT; ?>/team?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/team?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/team?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/team?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/team?page=<?php echo $data['pagination']['total_pages']; ?>">
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
                <h5 class="modal-title">Detail Tim</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="viewFoto" src="" class="rounded-circle mb-3 border shadow-sm" style="width: 120px; height: 120px; object-fit: cover; display: none;">
                <h3 id="viewNama" class="fw-bold mb-1"></h3>
                <h5 id="viewPosisi" class="text-primary mb-3"></h5>
                
                <div class="d-flex justify-content-center gap-2 mt-4">
                    <a id="viewLinkedin" href="#" target="_blank" class="btn btn-outline-secondary btn-icon" style="display: none;">
                        <i class="bx bxl-linkedin-square"></i>
                    </a>
                    <a id="viewInstagram" href="#" target="_blank" class="btn btn-outline-secondary btn-icon" style="display: none;">
                        <i class="bx bxl-instagram-alt"></i>
                    </a>
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
        var posisi = button.getAttribute('data-posisi');
        var foto = button.getAttribute('data-foto');
        var linkedin = button.getAttribute('data-linkedin');
        var instagram = button.getAttribute('data-instagram');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewNama').textContent = nama;
        modalBody.querySelector('#viewPosisi').textContent = posisi;

        // Handle Foto
        var imgEl = modalBody.querySelector('#viewFoto');
        if(foto && foto.trim() !== '') {
            imgEl.src = foto;
            imgEl.style.display = 'inline-block';
        } else {
            imgEl.style.display = 'none';
        }

        // Handle Social Links
        var lnkEl = modalBody.querySelector('#viewLinkedin');
        if(linkedin) { 
            lnkEl.href = linkedin; 
            lnkEl.style.display = 'inline-flex';
        } else { 
            lnkEl.style.display = 'none'; 
        }

        var igEl = modalBody.querySelector('#viewInstagram');
        if(instagram) { 
            igEl.href = instagram; 
            igEl.style.display = 'inline-flex';
        } else { 
            igEl.style.display = 'none'; 
        }
    });

    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/team/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
