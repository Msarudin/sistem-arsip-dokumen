<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= esc($title ?? 'Sistem Arsip') ?></title>

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <style>
        body { font-size: .9rem; }
        .sidebar {
            min-height: calc(100vh - 56px);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar .nav-link { font-weight: 500; color: #333; padding: .75rem 1rem; }
        .sidebar .nav-link.active { color: #007bff; font-weight: 600; background-color: #e9ecef; }
        .sidebar .nav-link:hover { color: #0056b3; background-color: #f1f3f5; }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <?php $uri = service('uri')->getSegment(1); ?>

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top px-3">
        <a class="navbar-brand font-weight-bold fw-bold" href="<?= base_url('dashboard') ?>">Sistem Arsip</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-bs-toggle="collapse" data-target="#sidebarMenu" data-bs-target="#sidebarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="ml-auto ms-auto d-none d-md-flex align-items-center">
            <span class="text-white mr-3 me-3">Halo, <?= esc(session()->get('nama')) ?></span>
            <a class="btn btn-outline-light btn-sm" href="<?= base_url('logout') ?>" onclick="konfirmasiLogout(event, this.href)">Sign out</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Menu Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse p-0">
                <div class="pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri == 'kategori') ? 'active' : '' ?>" href="<?= base_url('kategori') ?>">Manajemen Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri == 'arsip') ? 'active' : '' ?>" href="<?= base_url('arsip') ?>">Manajemen Arsip</a>
                        </li>
                        <li class="nav-item d-md-none border-top mt-2 pt-2">
                            <a class="nav-link text-danger" href="<?= base_url('logout') ?>" onclick="konfirmasiLogout(event, this.href)">Sign out</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Konten Utama -->
            <main class="col-md-9 col-lg-10 px-4 pt-3 d-flex flex-column" style="min-height: calc(100vh - 56px);">
                <div>
                    <?= $this->renderSection('content') ?>
                </div>

                <!-- Footer Copyright -->
                <footer class="mt-auto py-3 border-top text-center text-muted">
                    <small>&copy; <?= date('Y') ?> Muhamad Sarudin Efendi. All rights reserved.</small>
                </footer>
            </main>
        </div>
    </div>

    <script src="<?= base_url('js/jquery-3.8.0.min.js') ?>"></script>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('js/sweetalert2.all.min.js') ?>"></script>

    <script>
        // Konfirmasi Sign Out SweetAlert2
        function konfirmasiLogout(event, url) {
            event.preventDefault();

            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Sesi Anda akan diakhiri dan Anda harus login kembali.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#6e62e5',
                timer: 3000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
                confirmButtonText: 'OK',
                confirmButtonColor: '#d33',
                timer: 3000
            });
        <?php endif; ?>
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>
