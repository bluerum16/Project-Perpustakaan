<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Form Sekolah') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card shadow-sm mx-auto" style="max-width:800px;">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Form Sekolah') ?></h4>
        <a href="<?= site_url('sekolah') ?>" class="btn btn-outline-secondary btn-sm">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>

      <!-- Tampilkan error validation -->
      <?php 
      if (session()->getFlashdata('validation')) 
          $validation = session()->getFlashdata('validation');
      ?>
      <?php if (isset($validation) && $validation->getErrors()): ?>
        <div class="alert alert-danger">
          <ul class="mb-0">
            <?php foreach ($validation->getErrors() as $err): ?>
              <li><?= esc($err) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?= esc($action) ?>" method="post" class="row g-3">
        <?= csrf_field() ?>

        <div class="col-12">
          <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
          <input type="text" name="nama_sekolah" class="form-control" maxlength="150"
                 value="<?= old('nama_sekolah', $sekolah['nama_sekolah'] ?? '') ?>" required>
        </div>

        <div class="col-12">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control" rows="4"><?= old('alamat', $sekolah['alamat'] ?? '') ?></textarea>
        </div>

        <div class="col-md-6">
          <label class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" name="email" class="form-control" maxlength="254"
                 value="<?= old('email', $sekolah['email'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
          <input type="text" name="no_telfon" class="form-control" maxlength="20"
                 value="<?= old('no_telfon', $sekolah['no_telfon'] ?? '') ?>" required>
        </div>

        <div class="col-12 d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="<?= site_url('sekolah') ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>