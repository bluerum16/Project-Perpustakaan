<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Form Buku') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card shadow-sm mx-auto" style="max-width:800px;">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Form Buku') ?></h4>
        <a href="<?= site_url('buku') ?>" class="btn btn-outline-secondary btn-sm">
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
          <label class="form-label">Nama Buku <span class="text-danger">*</span></label>
          <input type="text" name="nama_buku" class="form-control" maxlength="150"
                 value="<?= old('nama_buku', $buku['nama_buku'] ?? '') ?>" required>
        </div>

        <div class="col-12">
          <label class="form-label">Penulis <span class="text-danger">*</span></label></label>
          <input type="text" name="penulis" class="form-control" maxlength="150" value="<?= old('penulis', $buku['penulis'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label></label>
          <input type="number" name="tahun_terbit" class="form-control" min="1000" max="9999"
                 value="<?= old('tahun_terbit', $buku['tahun_terbit'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Stok <span class="text-danger">*</span></label></label>
          <input type="number" name="stok" class="form-control" min="0" max="999"
                 value="<?= old('stok', $buku['stok'] ?? '') ?>" required>
        </div>

        <div class="col-12">
          <label class="form-label">Kategori <span class="text-danger">*</span></label></label>
            <select name="id_kategori" class="form-control" required>
                <option value="">- Pilih -</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori'] ?>" 
                        <?= (old('id_kategori', $buku['id_kategori'] ?? '') == $k['id_kategori']) ? 'selected' : '' ?>>
                        <?= $k['nama_kategori'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12 d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="<?= site_url('buku') ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>