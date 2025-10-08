<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Change Password') ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
  $(function () {
    $("form").validate({
      rules: {
        password: {
          required: true
        },
        new_password: {
          required: true,
          minlength: 8
        },
        ulangi_password: {
          required: true,
          equalTo: "input[name='new_password']"
        }
      },
      messages: {
        password: {
          required: "Password wajib diisi"
        },
        new_password: {
          required: "Password baru wajib diisi",
          minlength: "Password baru minimal 8 karakter"
        },
        ulangi_password: {
          required: "Ulangi password wajib diisi",
          equalTo: "Password tidak sama"
        }
      },
      errorClass: "is-invalid",
      validClass: "is-valid",
      errorElement: "div",
      errorPlacement: function(error, element) {
        error.addClass("invalid-feedback");
        if (element.parent(".input-group").length) {
          error.insertAfter(element.parent());
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass(errorClass).removeClass(validClass);
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass(errorClass).addClass(validClass);
      }
    });
  });
  </script>
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="card shadow-sm mx-auto" style="max-width:800px;">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><?= esc($title ?? 'Form User') ?></h4>
        <a href="<?= site_url('/') ?>" class="btn btn-outline-secondary btn-sm">
          <i class="bi bi-arrow-left"></i> Kembali
        </a>
      </div>

       <!-- Flashdata -->
      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
      <?php endif; ?>

      <form action="<?= esc($action) ?>" method="post" class="row g-3">
        <?= csrf_field() ?>

        <div class="col-12">
          <label class="form-label">Nama User</label>
          <input type="text" name="username" class="form-control" maxlength="150"
                 value="<?= old('username', $user['username'] ?? '') ?>" readonly>
        </div>

        <div class="col-md-12">
          <label class="form-label">Password <span class="text-danger">*</span></label>
          <input type="password" name="password" class="form-control" maxlength="250" required autofocus>
        </div>

        <div class="col-md-6">
          <label class="form-label">Password Baru <span class="text-danger">*</span></label>
          <input type="password" name="new_password" class="form-control" maxlength="250" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Ulangi Password <span class="text-danger">*</span></label>
          <input type="password" name="ulangi_password" class="form-control" maxlength="250" required>
        </div>

        <div class="col-12 d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="<?= site_url('/') ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>