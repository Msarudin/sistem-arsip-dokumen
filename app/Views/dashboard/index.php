<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="alert alert-success">
        Selamat datang, <strong><?= esc(session()->get('nama')) ?></strong>.
    </div>

<?= $this->endSection() ?>
