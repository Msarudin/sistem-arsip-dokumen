<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

  <!-- Jumbotron Utama -->
  <div class="jumbotron bg-light py-5 mb-4 border-bottom">
    <div class="container">
      <h1 class="display-4 font-weight-bold fw-bold">Sistem Arsip Dokumen</h1>
      <p class="lead">
        Platform pengelolaan arsip digital sederhana untuk menyimpan, mengelompokkan kategori, mencari, dan mengunduh dokumen penting secara cepat dan terstruktur.
      </p>
      <p class="mt-4">
        <?php if (session()->get('isLoggedIn') || session()->get('nama')) : ?>
          <a class="btn btn-primary btn-lg" href="<?= base_url('dashboard') ?>" role="button">Buka Dashboard &raquo;</a>
        <?php else : ?>
          <a class="btn btn-primary btn-lg" href="<?= base_url('login') ?>" role="button">Masuk ke Sistem &raquo;</a>
        <?php endif; ?>
      </p>
    </div>
  </div>

  <!-- Grid 3 Kolom Fitur Utama -->
  <div class="container" id="fitur">
    <div class="row">
      <div class="col-md-4 mb-4">
        <h2>Manajemen Kategori</h2>
        <p>Kelompokkan dokumen berdasarkan jenisnya seperti Surat Masuk, Surat Keluar, SK, maupun Laporan agar struktur penyimpanan lebih rapi dan terorganisir.</p>
      </div>
      <div class="col-md-4 mb-4">
        <h2>Arsip Digital</h2>
        <p>Unggah dan simpan dokumen dalam format PDF, JPG, maupun PNG secara terpusat untuk meminimalkan risiko kehilangan atau kerusakan berkas fisik.</p>
      </div>
      <div class="col-md-4 mb-4">
        <h2>Pencarian & Unduh</h2>
        <p>Temukan dokumen yang dibutuhkan dalam hitungan detik melalui fitur pencarian cepat, lalu pratinjau langsung atau unduh salinannya kapan saja.</p>
      </div>
    </div>

    <hr>
  </div>

<?= $this->endSection() ?>
