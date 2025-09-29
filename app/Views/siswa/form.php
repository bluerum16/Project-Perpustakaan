<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?= base_url('image/book.png')?>">
</head>
<body class="bg-light">

<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background: linear-gradient(135deg,#0d47a1,#1976d2);">
  <div class="card shadow-lg p-4" style="width: 400px; border-radius: 12px;">
    <p class="text-muted mb-1">Please enter your details</p>
    <h3 class="mb-4"><b>Sign in to your account</b></h3>

    <form action="<?= site_url('siswa/login') ?>" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <input type="email" class="form-control" name="email" placeholder="Email address" required>
      </div>
      <div class="mb-3">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
      </div>
      <button type="submit" class="btn btn-primary w-100">Sign In</button>
    </form>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>