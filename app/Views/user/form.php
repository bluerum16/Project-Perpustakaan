<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= esc($title ?? 'Form User') ?></title>

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
        username: {
          required: true,
          minlength: 3,
          maxlength: 150
        },
        password: {
          required: true,
          minlength: 8
        },
        ulangi_password: {
          required: true,
          equalTo: "input[name='password']"
        },
        email: {
          required: true,
          email: true,
          maxlength: 250
        },
        no_telfon: {
          required: true,
          digits: true,
          maxlength: 20
        },
        role: {
          required: true
        }
      },
      messages: {
        username: {
          required: "Nama user wajib diisi",
          minlength: "Minimal 3 karakter",
          maxlength: "Maksimal 150 karakter"
        },
        password: {
          required: "Password wajib diisi",
          minlength: "Password minimal 8 karakter"
        },
        ulangi_password: {
          required: "Ulangi password wajib diisi",
          equalTo: "Password tidak sama"
        },
        email: {
          required: "Email wajib diisi",
          email: "Format email tidak valid",
          maxlength: "Maksimal 250 karakter"
        },
        no_telfon: {
          required: "No. Telepon wajib diisi",
          digits: "Hanya boleh angka",
          maxlength: "Maksimal 20 digit"
        },
        role: {
          required: "Role wajib dipilih"
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
        <a href="<?= site_url('user') ?>" class="btn btn-outline-secondary btn-sm">
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
          <label class="form-label">Nama User <span class="text-danger">*</span></label>
          <input type="text" name="username" class="form-control" maxlength="150"
                 value="<?= old('username', $user['username'] ?? '') ?>" required>
        </div>

        <?php if (old('id_user', $user['id_user'] ?? 0) == 0): ?>
        <div class="col-md-6">
          <label class="form-label">Password <span class="text-danger">*</span></label>
          <input type="password" name="password" class="form-control" maxlength="250" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">Ulangi Password <span class="text-danger">*</span></label>
          <input type="password" name="ulangi_password" class="form-control" maxlength="250" required>
        </div>
        <?php endif; ?>

        <div class="col-md-6">
          <label class="form-label">Email <span class="text-danger">*</span></label>
          <input type="text" name="email" class="form-control" maxlength="250"
                 value="<?= old('email', $user['email'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
          <input type="text" name="no_telfon" class="form-control" maxlength="20"
                 value="<?= old('no_telfon', $user['no_telfon'] ?? '') ?>" required>
        </div>

        <div class="col-12">
          <label class="form-label">Role <span class="text-danger">*</span></label></label>
            <select name="role" class="form-control" required>
              <option value="">- Pilih -</option>
              <option value="siswa" <?= (old('role', $user['role'] ?? '') == 'siswa') ? 'selected' : '' ?>>Siswa</option>
              <option value="staff" <?= (old('role', $user['role'] ?? '') == 'staff') ? 'selected' : '' ?>>Staff</option>
              <option value="admin" <?= (old('role', $user['role'] ?? '') == 'admin') ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="col-12 d-flex gap-2">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
          </button>
          <a href="<?= site_url('user') ?>" class="btn btn-outline-secondary">Batal</a>
        </div>
      </form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>