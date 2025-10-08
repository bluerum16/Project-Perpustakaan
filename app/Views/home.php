<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu Utama</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('image/book.png')?>">
    <style>
      /* Minor custom styling */
      body { background-color: #f8f9fa; }
      .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
      }
      .nav-main {
        gap: .5rem;
      }
      .app-container { padding-top: 70px; }
      .card-menu { cursor: pointer; transition: transform .12s ease-in-out; }
      .card-menu:hover { transform: translateY(-4px); }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="<?= site_url('/') ?>">Perpustakaan</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
          <!-- Left: main menu links -->
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-main">
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('sekolah') ?>">Daftar Sekolah</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('buku') ?>">Daftar Buku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('user') ?>">Daftar User</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= site_url('auditlog') ?>">Audit Logs</a>
            </li>
          </ul>

          <!-- Right: user info -->
          <div class="d-flex align-items-center">
            <!-- Example small user card -->
            <div class="dropdown">
              <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name=<?=esc(session()->get('username')); ?>&background=0D6EFD&color=fff&size=128" alt="avatar" class="avatar me-2">
                <div class="d-none d-sm-block">
                  <div class="fw-semibold"><?=esc(session()->get('username')); ?></div>
                  <div class="text-muted small"><?=strtoupper(esc(session()->get('role'))); ?></div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="<?= site_url('user/show/'.esc(session()->get('id_user'))) ?>">Profil</a></li>
                <li><a class="dropdown-item" href="<?= site_url('user/changepassword') ?>">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="<?= site_url('user/logout') ?>">Logout</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </nav>

    <!-- Main container -->
    <div class="container app-container">
      <div class="row g-4">
        <!-- Welcome card -->
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <h5 class="card-title mb-1">Selamat datang, Fazli!</h5>
                <p class="card-text text-muted mb-0">Pilih menu di atas atau gunakan pintasan di bawah untuk mengelola data sekolah dan buku.</p>
              </div>
              <div>
                <a href="<?= site_url('buku') ?>" class="btn btn-primary">Kelola Buku</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Shortcut cards -->
        <div class="col-12 col-md-6">
          <a href="<?= site_url('sekolah') ?>" class="text-decoration-none text-dark">
            <div class="card card-menu h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Daftar Sekolah</h5>
                <p class="card-text">Lihat, tambah, dan edit data sekolah.</p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-md-6">
          <a href="<?= site_url('buku') ?>" class="text-decoration-none text-dark">
            <div class="card card-menu h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Daftar Buku</h5>
                <p class="card-text">Kelola katalog buku, stok.</p>
              </div>
            </div>
          </a>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>