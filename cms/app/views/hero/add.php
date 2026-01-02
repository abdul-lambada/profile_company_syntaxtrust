<?php require APPROOT . '/views/layouts/header.php'; ?>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Hero Section</h5>
                <small class="text-muted float-end">Landing Page</small>
            </div>
            <div class="card-body">
                <form action="<?php echo URLROOT; ?>/hero/add" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="judul_utama">Judul Utama</label>
                        <input type="text" class="form-control" id="judul_utama" name="judul_utama" placeholder="Contoh: Kelola Keuangan Sekolah" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="judul_highlight">Judul Highlight (Warna Warni)</label>
                        <input type="text" class="form-control" id="judul_highlight" name="judul_highlight" placeholder="Contoh: Lebih Cerdas." required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="sub_judul">Sub Judul</label>
                        <textarea class="form-control" id="sub_judul" name="sub_judul" placeholder="Deskripsi singkat..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="label_badge">Label Badge</label>
                        <input type="text" class="form-control" id="label_badge" name="label_badge" placeholder="Contoh: Terpercaya oleh 100+ Sekolah" required />
                    </div>
                    
                    <div class="divider">
                        <div class="divider-text">Tombol / CTA</div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="teks_tombol_utama">Tombol Utama</label>
                            <input type="text" class="form-control" id="teks_tombol_utama" name="teks_tombol_utama" placeholder="Mulai Sekarang" required />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="teks_tombol_sekunder">Tombol Sekunder</label>
                            <input type="text" class="form-control" id="teks_tombol_sekunder" name="teks_tombol_sekunder" placeholder="Contoh Laporan" required />
                        </div>
                         <div class="col-md-4 mb-3">
                            <label class="form-label" for="teks_tombol_tersier">Tombol Tersier</label>
                            <input type="text" class="form-control" id="teks_tombol_tersier" name="teks_tombol_tersier" placeholder="Unduh Proposal" required />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?php echo URLROOT; ?>/hero" class="btn btn-outline-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>
