<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Testimoni Klien</h5>
        <a href="<?php echo URLROOT; ?>/testimonials/add" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Testimoni
        </a>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama & Peran</th>
                    <th>Rating</th>
                    <th>Avatar</th>
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
                            <small class="text-muted"><?php echo $row->peran; ?></small>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-label-warning">
                            <i class="bx bxs-star me-1"></i> <?php echo $row->rating; ?>
                        </span>
                    </td>
                    <td>
                        <?php if($row->url_avatar): ?>
                            <div class="avatar avatar-sm">
                                <img src="<?php echo $row->url_avatar; ?>" alt="Avatar" class="rounded-circle">
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
                                    data-peran="<?php echo htmlspecialchars($row->peran); ?>"
                                    data-rating="<?php echo htmlspecialchars($row->rating); ?>"
                                    data-avatar="<?php echo htmlspecialchars($row->url_avatar); ?>"
                                    data-isi="<?php echo htmlspecialchars($row->isi_testimoni); ?>"
                                >
                                    <i class="bx bx-show-alt me-1"></i> View
                                </a>
                                <a class="dropdown-item" href="<?php echo URLROOT; ?>/testimonials/edit/<?php echo $row->id; ?>">
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
                    <a class="page-link" href="<?php echo URLROOT; ?>/testimonials?page=1">
                        <i class="tf-icon bx bx-chevrons-left"></i>
                    </a>
                </li>
                <li class="page-item prev <?php echo !$data['pagination']['has_previous'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/testimonials?page=<?php echo $data['pagination']['previous_page']; ?>">
                        <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                </li>
                <?php for($i = 1; $i <= $data['pagination']['total_pages']; $i++): ?>
                <li class="page-item <?php echo $data['pagination']['current_page'] == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/testimonials?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item next <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/testimonials?page=<?php echo $data['pagination']['next_page']; ?>">
                        <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                </li>
                <li class="page-item last <?php echo !$data['pagination']['has_next'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="<?php echo URLROOT; ?>/testimonials?page=<?php echo $data['pagination']['total_pages']; ?>">
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
                <h5 class="modal-title">Detail Testimoni</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <img id="viewAvatar" src="" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover; display: none;">
                    <h4 id="viewNama" class="fw-bold mb-1"></h4>
                    <span id="viewPeran" class="badge bg-label-primary"></span>
                    <div id="viewRating" class="text-warning mt-2"></div>
                </div>
                <div class="bg-light p-3 rounded text-center fst-italic position-relative">
                    <i class="bx bxs-quote-left fs-3 text-secondary position-absolute top-0 start-0 translate-middle ms-3 mt-3"></i>
                    <p id="viewIsi" class="mb-0 px-4"></p>
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
        var peran = button.getAttribute('data-peran');
        var rating = parseInt(button.getAttribute('data-rating'));
        var avatar = button.getAttribute('data-avatar');
        var isi = button.getAttribute('data-isi');

        var modalBody = viewModal.querySelector('.modal-body');
        modalBody.querySelector('#viewNama').textContent = nama;
        modalBody.querySelector('#viewPeran').textContent = peran;
        modalBody.querySelector('#viewIsi').textContent = isi;
        
        // Handle Avatar
        var imgEl = modalBody.querySelector('#viewAvatar');
        if(avatar && avatar.trim() !== '') {
            imgEl.src = avatar;
            imgEl.style.display = 'inline-block';
        } else {
            imgEl.style.display = 'none';
        }

        // Handle Rating Stars
        var ratingHtml = '';
        for(var i=0; i<rating; i++) {
            ratingHtml += '<i class="bx bxs-star"></i>';
        }
        for(var j=rating; j<5; j++) {
            ratingHtml += '<i class="bx bx-star"></i>';
        }
        modalBody.querySelector('#viewRating').innerHTML = ratingHtml;
    });

    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = deleteModal.querySelector('#deleteForm');
        form.action = '<?php echo URLROOT; ?>/testimonials/delete/' + id;
    });
});
</script>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
