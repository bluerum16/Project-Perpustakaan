<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Daftar User') ?></title>

  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-4">
  <div class="card shadow-sm mb-4">
    <div class="card-body">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Daftar User') ?></h4>
        <div>
          <a href="<?= site_url('user/create') ?>" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Tambah User
          </a>
          <a href="<?= site_url('/') ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
        </div>
      </div>

      <!-- Search form (GET) -->
      <form class="row g-2 mb-3" method="get" action="<?= site_url('user') ?>">
        <div class="col-md-4">
          <input type="search" name="q" class="form-control" placeholder="Cari nama, email, atau no. telp" value="<?= esc($q ?? '') ?>">
        </div>

        <!-- keep current sort/order when searching -->
        <input type="hidden" name="sort" value="<?= esc($sort ?? '') ?>">
        <input type="hidden" name="order" value="<?= esc($order ?? '') ?>">

        <div class="col-auto">
          <button type="submit" class="btn btn-outline-primary">Cari</button>
        </div>

        <?php if (! empty($q)): ?>
        <div class="col-auto">
          <a href="<?= site_url('user') ?>" class="btn btn-outline-secondary">Reset</a>
        </div>
        <?php endif; ?>
      </form>

      <!-- Flashdata -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th style="width:60px">No.</th>

              <?php
              // helper buat bikin link sort sambil mempertahankan q & page param
              $build_sort_url = function($field) use ($sort, $order) {
                  // current GET params
                  $qs = $_GET ?? [];
                  // toggle order jika sedang sort by this field
                  $nextOrder = ($sort === $field && $order === 'asc') ? 'desc' : 'asc';
                  $qs['sort'] = $field;
                  $qs['order'] = $nextOrder;
                  // reset page param supaya pindah ke halaman 1 saat ganti sort
                  foreach ($qs as $k => $v) {
                      if (strpos($k, 'page') === 0) {
                          unset($qs[$k]);
                      }
                  }
                  $query = http_build_query($qs);
                  return current_url() . ($query ? '?' . $query : '');
              };
              ?>

              <th>
                <a href="<?= esc($build_sort_url('Nama User')) ?>" class="text-decoration-none text-dark">
                  Nama User
                  <?php if (($sort ?? '') == 'username'): ?>
                    <i class="bi bi-caret-<?= ($order ?? '') == 'asc' ? 'up' : 'down' ?>-fill"></i>
                  <?php endif; ?>
                </a>
              </th>

              <th>
                <a href="<?= esc($build_sort_url('email')) ?>" class="text-decoration-none text-dark">
                  Email
                  <?php if (($sort ?? '') == 'email'): ?>
                    <i class="bi bi-caret-<?= ($order ?? '') == 'asc' ? 'up' : 'down' ?>-fill"></i>
                  <?php endif; ?>
                </a>
              </th>

              <th>
                <a href="<?= esc($build_sort_url('no_telfon')) ?>" class="text-decoration-none text-dark">
                  No. Telp
                  <?php if (($sort ?? '') == 'no_telfon'): ?>
                    <i class="bi bi-caret-<?= ($order ?? '') == 'asc' ? 'up' : 'down' ?>-fill"></i>
                  <?php endif; ?>
                </a>
              </th>

              <th>
                <a href="<?= esc($build_sort_url('role')) ?>" class="text-decoration-none text-dark">
                  Role
                  <?php if (($sort ?? '') == 'role'): ?>
                    <i class="bi bi-caret-<?= ($order ?? '') == 'asc' ? 'up' : 'down' ?>-fill"></i>
                  <?php endif; ?>
                </a>
              </th>

              <th style="width:26%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (! empty($user)): ?>
              <?php $no = (($currentPage ?? 1) - 1) * ($perPage ?? 10); ?>
              <?php foreach ($user as $s): ?>
                <tr>
                  <td><?= ++$no ?></td>
                  <td><?= esc($s['username']) ?></td>
                  <td><?= esc($s['email']) ?></td>
                  <td><?= esc($s['no_telfon']) ?></td>
                  <td><?= esc($s['role']) ?></td>
                  <td>
                    <a href="<?= site_url('user/show/'.$s['id_user']) ?>" class="btn btn-sm btn-outline-primary me-1">
                      <i class="bi bi-eye"></i> Detail
                    </a>
                    <a href="<?= site_url('user/edit/'.$s['id_user']) ?>" class="btn btn-sm btn-primary me-1">
                      <i class="bi bi-pencil"></i> Edit
                    </a>

                    <form action="<?= site_url('user/delete/'.$s['id_user']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus <?= esc($s['username']) ?>?')">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i> Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-4">Belum ada data.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pager -->
      <?php if (! empty($user)): ?>
        <nav class="d-flex justify-content-center mt-3" aria-label="Page navigation">
          <?= $pager->links('user', 'bootstrap_full') ?>
        </nav>
      <?php endif; ?>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>