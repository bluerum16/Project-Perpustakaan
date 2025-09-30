<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Detail Buku') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card mx-auto shadow-sm" style="max-width:800px;">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Detail Buku') ?></h4>
        <div>
          <a href="<?= site_url('buku/edit/'.$buku['id_buku']) ?>" class="btn btn-sm btn-primary me-1"><i class="bi bi-pencil"></i> Edit</a>
          <a href="<?= site_url('buku') ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>
      </div>

      <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9"><?= esc($buku['id_buku']) ?></dd>

        <dt class="col-sm-3">Nama Buku</dt>
        <dd class="col-sm-9"><?= esc($buku['nama_buku']) ?></dd>

        <dt class="col-sm-3">Penulis</dt>
        <dd class="col-sm-9"><?= nl2br(esc($buku['penulis'])) ?></dd>

        <dt class="col-sm-3">Tahun Terbit</dt>
        <dd class="col-sm-9"><?= esc($buku['tahun_terbit']) ?></dd>

        <dt class="col-sm-3">Stok</dt>
        <dd class="col-sm-9"><?= esc($buku['stok']) ?></dd>

        <dt class="col-sm-3">Kategori</dt>
        <dd class="col-sm-9"><?= esc($buku['nama_kategori']) ?></dd>
      </dl>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>