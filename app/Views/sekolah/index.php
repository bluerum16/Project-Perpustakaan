<!-- app/Views/sekolah/index.php -->
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Daftar Sekolah') ?></title>

  <!-- Bootstrap 5 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-white bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url() ?>">Perpustakaan</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="<?= site_url('sekolah') ?>">Sekolah</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Daftar Sekolah') ?></h4>
        <a href="<?= site_url('sekolah/create') ?>" class="btn btn-success">
          <i class="bi bi-plus-lg"></i> Tambah Sekolah
        </a>
      </div>

      <!-- Flashdata -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('success') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= session()->getFlashdata('error') ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>

      <!-- Table -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
                <th style="width:60px">No.</th>

                <!-- kolom sortable -->
                <th>
                <a href="<?= site_url('sekolah?sort=nama_sekolah&order='.(($sort=='nama_sekolah' && $order=='asc')?'desc':'asc')) ?>" class="text-decoration-none text-dark">
                    Nama Sekolah
                    <?php if ($sort=='nama_sekolah'): ?>
                    <i class="bi bi-caret-<?= $order=='asc'?'up':'down' ?>-fill"></i>
                    <?php endif; ?>
                </a>
                </th>

                <th>
                <a href="<?= site_url('sekolah?sort=email&order='.(($sort=='email' && $order=='asc')?'desc':'asc')) ?>" class="text-decoration-none text-dark">
                    Email
                    <?php if ($sort=='email'): ?>
                    <i class="bi bi-caret-<?= $order=='asc'?'up':'down' ?>-fill"></i>
                    <?php endif; ?>
                </a>
                </th>

                <th>
                <a href="<?= site_url('sekolah?sort=no_telfon&order='.(($sort=='no_telfon' && $order=='asc')?'desc':'asc')) ?>" class="text-decoration-none text-dark">
                    No. Telp
                    <?php if ($sort=='no_telfon'): ?>
                    <i class="bi bi-caret-<?= $order=='asc'?'up':'down' ?>-fill"></i>
                    <?php endif; ?>
                </a>
                </th>

                <th style="width:220px">Aksi</th>
            </tr>
            </thead>

            <?php if (! empty($sekolah)): ?>
              <?php $no = ($currentPage - 1) * $perPage; ?>
              <?php foreach ($sekolah as $s): ?>
                <tr>
                  <td><?= ++$no ?></td>
                  <td><?= esc($s['nama_sekolah']) ?></td>
                  <td><?= esc($s['email']) ?></td>
                  <td><?= esc($s['no_telfon']) ?></td>
                  <td>
                    <a href="<?= site_url('sekolah/show/'.$s['id_sekolah']) ?>" class="btn btn-sm btn-outline-primary me-1">Detail</a>
                    <a href="<?= site_url('sekolah/edit/'.$s['id_sekolah']) ?>" class="btn btn-sm btn-primary me-1">Edit</a>

                    <!-- Form delete kecil, gunakan POST + CSRF -->
                    <form action="<?= site_url('sekolah/delete/'.$s['id_sekolah']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus <?= esc($s['nama_sekolah']) ?>?')">
                      <?= csrf_field() ?>
                      <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-4">Belum ada data sekolah.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <!-- Pager (Bootstrap styling wrapper) -->
      <?php if (! empty($sekolah)): ?>
        <nav class="d-flex justify-content-center mt-3" aria-label="Page navigation">
          <!--
            $pager->links() akan mengeluarkan markup default CI Pager.
            Jika ingin full Bootstrap styling, buat custom Pager template di app/Views/Pager/
          -->
          <?= $pager->links('sekolah', 'bootstrap_full') ?>
        </nav>
      <?php endif; ?>

    </div>
  </div>
</div>

<!-- Bootstrap 5 JS (Bundle includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>

<!-- Optional: Icon (Bootstrap Icons CDN) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>