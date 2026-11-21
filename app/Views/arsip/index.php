<?php
/** @var array|null $editData */
/** @var array $archives */
/** @var array $categories */
?>

<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Arsip</h1>
    </div>

    <div class="row">
        <!-- Form Tambah / Edit Arsip -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <?= $editData ? 'Edit Arsip' : 'Upload Arsip Baru' ?>
                </div>
                <div class="card-body">
                    <!-- Wajib enctype="multipart/form-data" untuk upload file -->
                    <form id="formArsip" action="<?= $editData ? base_url('arsip/update/' . $editData['id']) : base_url('arsip/simpan') ?>" method="post" enctype="multipart/form-data" autocomplete="off">

                        <?= csrf_field() ?>

                        <div class="form-group mb-3">
                            <label for="judul">Judul Arsip <span class="text-danger">*</span></label>
                            <input type="text" id="judul" name="judul" class="form-control" 
                                   placeholder="Masukkan judul dokumen" 
                                   value="<?= esc($editData['judul'] ?? old('judul')) ?>" autocomplete="off" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="category_id">Kategori Arsip <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $kat) : ?>
                                    <option value="<?= $kat['id'] ?>" <?= ($editData['category_id'] ?? old('category_id')) == $kat['id'] ? 'selected' : '' ?>>
                                        <?= esc($kat['nama_kategori']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi <small class="text-muted">(Opsional)</small></label>
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" 
                                      placeholder="Keterangan singkat arsip..."><?= esc($editData['deskripsi'] ?? old('deskripsi')) ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="file_dokumen">
                                Dokumen (PDF, JPG, PNG) <?= $editData ? '<small class="text-muted">(Kosongkan jika tidak diganti)</small>' : '<span class="text-danger">*</span>' ?>
                            </label>
                            <input type="file" id="file_dokumen" name="file_dokumen" class="form-control-file form-control" 
                                   accept=".pdf,.jpg,.jpeg,.png" <?= $editData ? '' : 'required' ?>>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-block">
                            <?= $editData ? 'Simpan Perubahan' : 'Simpan Arsip' ?>
                        </button>
                        <?php if ($editData) : ?>
                            <a href="<?= base_url('arsip') ?>" class="btn btn-secondary w-100 btn-block mt-2">Batal</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Arsip -->
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold fw-bold">Daftar Dokumen Arsip</span>
                    <div style="width: 260px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light text-muted">
                                <svg xmlns="http://w3.org" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </span>
                            <input type="text" id="searchArsip" class="form-control" placeholder="Cari judul atau kategori..." autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="thead-light table-light">
                                <tr>
                                    <th width="50">No</th>
                                    <th>Judul & Deskripsi</th>
                                    <th>Kategori</th>
                                    <th class="text-nowrap text-center">File</th>
                                    <th class="text-nowrap text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelArsip">
                                <?php if (empty($archives)) : ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">Belum ada dokumen arsip yang diunggah.</td>
                                    </tr>
                                <?php else : ?>
                                    <?php $no = 1; foreach ($archives as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <strong><?= esc($row['judul']) ?></strong>
                                                <?php if (!empty($row['deskripsi'])) : ?>
                                                    <div class="text-muted small"><?= esc($row['deskripsi']) ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-info bg-info text-white">
                                                    <?= esc($row['nama_kategori'] ?? '-') ?>
                                                </span>
                                            </td>
                                            <td class="text-nowrap text-center">
                                                <?php if (!empty($row['file_dokumen'])) : ?>
                                                    <a href="<?= base_url('arsip/lihat/' . $row['id']) ?>" target="_blank" class="btn btn-info btn-sm text-white">
                                                        Lihat File
                                                    </a>
                                                    <a href="<?= base_url('arsip/download/' . $row['id']) ?>" class="btn btn-success btn-sm">
                                                        Download
                                                    </a>
                                                <?php else : ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-nowrap text-center">
                                                <a href="<?= base_url('arsip?edit=' . $row['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= base_url('arsip/hapus/' . $row['id']) ?>" class="btn btn-danger btn-sm" onclick="konfirmasiHapus(event, this.href)">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Loading SweetAlert2 saat upload/simpan file
document.getElementById('formArsip').addEventListener('submit', function() {
    Swal.fire({
        title: 'Sedang Mengunggah Dokumen...',
        text: 'Mohon tunggu, file sedang diproses.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
});

// Konfirmasi hapus SweetAlert2
function konfirmasiHapus(event, url) {
    event.preventDefault();

    Swal.fire({
        title: 'Yakin menghapus arsip ?',
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

// Pencarian arsip real-time (khusus kolom Judul, Deskripsi, dan Kategori)
document.getElementById('searchArsip').addEventListener('input', function() {
    let keyword = this.value.toLowerCase().trim();
    let rows = document.querySelectorAll('#tabelArsip tr');

    rows.forEach(function(row) {
        if (row.cells.length < 3) return;

        let judulDeskripsi = row.cells[1].textContent.toLowerCase();
        let kategori       = row.cells[2].textContent.toLowerCase();
        let cocok          = judulDeskripsi.includes(keyword) || kategori.includes(keyword);

        row.style.display = cocok ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>

