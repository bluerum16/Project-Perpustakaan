<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Detail Sekolah') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card mx-auto shadow-sm" style="max-width:800px;">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Detail Sekolah') ?></h4>
        <div>
          <a href="<?= site_url('sekolah/edit/'.$sekolah['id_sekolah']) ?>" class="btn btn-sm btn-primary me-1"><i class="bi bi-pencil"></i> Edit</a>
          <a href="<?= site_url('sekolah') ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>
      </div>

      <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9"><?= esc($sekolah['id_sekolah']) ?></dd>

        <dt class="col-sm-3">Nama Sekolah</dt>
        <dd class="col-sm-9"><?= esc($sekolah['nama_sekolah']) ?></dd>

        <dt class="col-sm-3">Alamat</dt>
        <dd class="col-sm-9"><?= nl2br(esc($sekolah['alamat'])) ?></dd>

        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9"><?= esc($sekolah['email']) ?></dd>

        <dt class="col-sm-3">No. Telepon</dt>
        <dd class="col-sm-9"><?= esc($sekolah['no_telfon']) ?></dd>
      </dl>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>