<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Perpustakaan - Login') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center" style="min-height:100vh;">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h4 class="text-center mb-4">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </h4>

          <!-- Pesan Error -->
          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
              <?= esc(session()->getFlashdata('error')) ?>
            </div>
          <?php endif; ?>

          <!-- Form Login -->
          <form action="<?= esc($action) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" name="email" id="email" 
                     class="form-control" placeholder="Email address" required autofocus
                     value="<?= old('email') ?>">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" name="password" id="password" 
                       class="form-control" placeholder="Password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  // Toggle Show/Hide Password
  $("#togglePassword").on("click", function() {
    let passInput = $("#password");
    let type = passInput.attr("type") === "password" ? "text" : "password";
    passInput.attr("type", type);
    $(this).find("i").toggleClass("bi-eye bi-eye-slash");
  });
</script>
</body>
</html>