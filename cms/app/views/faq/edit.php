<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit FAQ</h5>
                <small class="text-muted float-end">FAQ CMS</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/faq/edit/<?php echo $data['id']; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="pertanyaan">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" value="<?php echo $data['pertanyaan']; ?>" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="jawaban">Jawaban</label>
                        <textarea class="form-control" id="jawaban" name="jawaban" rows="4" required><?php echo $data['jawaban']; ?></textarea>
                    </div>
                     <div class="mb-3">
                        <label class="form-label" for="urutan">Urutan</label>
                        <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo $data['urutan']; ?>" required />
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?php echo URLROOT; ?>/faq" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
