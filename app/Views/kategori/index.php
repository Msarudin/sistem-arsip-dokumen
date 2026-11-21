<?php 
/** @var array|null $editData */ 
/** @var array $categories */ 
?>

<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

    <div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Manajemen Kategori</h1>
    </div>

    <div class="row">
        <!-- Form Tambah / Edit Kategori -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <?= $editData ? 'Edit Kategori' : 'Tambah Kategori Baru' ?>
                </div>
                <div class="card-body">
                    <form action="<?= $editData ? base_url('kategori/update/' . $editData['id']) : base_url('kategori/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group mb-3">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" placeholder="Surat Masuk, SK, Laporan" value="<?= esc($editData['nama_kategori'] ?? '') ?>" autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-block">
                            <?= $editData ? 'Simpan Perubahan' : 'Tambah Kategori' ?>
                        </button>
                        <?php if ($editData) : ?>
                            <a href="<?= base_url('kategori') ?>" class="btn btn-secondary w-100 btn-block mt-2">Batal</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Kategori -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold fw-bold">Daftar Kategori</span>
                    <div style="width: 240px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light text-muted">
                                <svg xmlns="http://w3.org" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </span>
                            <input type="text" id="searchKategori" class="form-control" placeholder="Cari nama kategori..." autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="thead-light table-light">
                                <tr>
                                    <th width="60">No</th>
                                    <th>Nama Kategori</th>
                                    <th class="text-nowrap text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tabelKategori">
                                <?php if (empty($categories)) : ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">Belum ada data kategori.</td>
                                    </tr>
                                <?php else : ?>
                                    <?php $no = 1; foreach ($categories as $kat) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= esc($kat['nama_kategori']) ?></td>
                                            <td class="text-nowrap text-center">
                                                <a href="<?= base_url('kategori?edit=' . $kat['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= base_url('kategori/hapus/' . $kat['id']) ?>" class="btn btn-danger btn-sm" onclick="konfirmasiHapus(event, this.href)">Hapus</a>
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
// Konfirmasi hapus SweetAlert2
function konfirmasiHapus(event, url) {
    event.preventDefault(); // Mencegah link langsung terbuka

    Swal.fire({
        title: 'Yakin menghapus kategori ?',
        text: "Data kategori yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url; // Melanjutkan ke base_url('kategori/hapus/...')
        }
    });
}

// Pencarian kategori secara real-time
document.getElementById('searchKategori').addEventListener('keyup', function() {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tabelKategori tr');

    rows.forEach(function(row) {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
    });
});
</script>
<?= $this->endSection() ?>
