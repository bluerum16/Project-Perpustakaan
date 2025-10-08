<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Detail User') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card mx-auto shadow-sm" style="max-width:800px;">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Detail User') ?></h4>
        <div>
          <a href="<?= site_url('user/edit/'.$user['id_user']) ?>" class="btn btn-sm btn-primary me-1"><i class="bi bi-pencil"></i> Edit</a>
          <a href="<?= site_url('user') ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>
      </div>

      <dl class="row">
        <dt class="col-sm-3">ID</dt>
        <dd class="col-sm-9"><?= esc($user['id_user']) ?></dd>

        <dt class="col-sm-3">Nama User</dt>
        <dd class="col-sm-9"><?= esc($user['username']) ?></dd>

        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9"><?= esc($user['email']) ?></dd>

        <dt class="col-sm-3">No. Telepon</dt>
        <dd class="col-sm-9"><?= esc($user['no_telfon']) ?></dd>

        <dt class="col-sm-3">Role</dt>
        <dd class="col-sm-9"><?= esc($user['role']) ?></dd>
      </dl>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>