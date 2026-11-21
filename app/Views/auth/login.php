<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= esc($title ?? 'Login - Sistem Arsip') ?></title>

  <!-- Memanggil CSS Lokal dari public/css/ -->
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
</head>
<body class="bg-light">

  <!-- Navbar Atas -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top px-3">
      <a class="navbar-brand font-weight-bold fw-bold" href="<?= base_url('/') ?>">Sistem Arsip Dokumen</a>

      <div class="ml-auto ms-auto d-flex align-items-center">
          <a class="btn btn-outline-light btn-sm" href="<?= base_url('/') ?>">Halaman Home</a>
      </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: calc(100vh - 56px);">
      <div class="col-md-5">
        
        <div class="card shadow-sm">
          <div class="card-header bg-dark text-white text-center">
            <h4 class="mb-0">Silakan Login</h4>
          </div>
          <div class="card-body p-4">

            <!-- Pesan error menggunakan alert Bootstrap -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/proses') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required autofocus>
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-block w-100">Masuk</button>
                </div>
            </form>

          </div>
            <div class="card-footer text-center text-muted">
              <small>&copy; <?= date('Y') ?> Muhamad Sarudin Efendi. All rights reserved.</small>
            </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Memanggil JS Lokal dari public/js/ -->
  <script src="<?= base_url('js/jquery-3.8.0.min.js') ?>"></script>
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
