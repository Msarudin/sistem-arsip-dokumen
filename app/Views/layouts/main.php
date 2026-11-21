<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= esc($title ?? 'Jumbotron Template') ?></title>

  <!-- Memanggil CSS Lokal dari public/css/ -->
  <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
  
  <style>
    body {
      padding-top: 3.5rem;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="<?= base_url() ?>">Sistem Arsip Dokumen</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"><a class="nav-link" href="<?= base_url() ?>">Home</a></li>
      </ul>
      <a href="<?= base_url('login') ?>" class="btn btn-outline-success my-2 my-sm-0">Login</a>
    </div>
  </nav>

  <main role="main">
    <?= $this->renderSection('content') ?>
  </main>

<footer class="container py-3 text-center text-muted">
    <p class="mb-0">&copy; <?= date('Y') ?> Muhamad Sarudin Efendi. All rights reserved.</p>
</footer>

  <!-- Memanggil JS Lokal dari public/js/ -->
  <script src="<?= base_url('js/jquery-3.8.0.min.js') ?>"></script>
  <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
