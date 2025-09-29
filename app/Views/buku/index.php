<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('image/book.png')?>">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h3 class="mb-3"><?= esc($title) ?></h3>

  <!-- Form Pencarian -->
  <form method="get" class="row g-3 mb-4">
    <div class="col-md-4">
      <input type="text" name="q" value="<?= esc($q) ?>" class="form-control" placeholder="Cari buku...">
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Cari</button>
    </div>
    <div class="col-md-2">
      <a href="<?= site_url('buku/create') ?>" class="btn btn-success w-100">Tambah Buku</a>
    </div>
  </form>

  <!-- Tabel daftar buku -->
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID Buku</th>
        <th>Nama Buku</th>
        <th>Penulis</th>
        <th>Tahun Terbit</th>
        <th>Stok</th>
        <th>Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($buku)): ?>
        <?php foreach ($buku as $row): ?>
          <tr>
            <td><?= esc($row['id_buku']) ?></td>
            <td><?= esc($row['nama_buku']) ?></td>
            <td><?= esc($row['penulis']) ?></td>
            <td><?= esc($row['tahun_terbit']) ?></td>
            <td><?= esc($row['stok']) ?></td>
            <td><?= esc($row['id_kategori']) ?></td>
            <td>
              <a href="<?= site_url('buku/edit/'.$row['id_buku']) ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="<?= site_url('buku/delete/'.$row['id_buku']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php else: ?>
          <tr>
            <td colspan="7" class="text-center">Tidak ada data</td>
          </tr>
      <?php endif ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <div>
    <?= $pager->links('buku', 'bootstrap_full') ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
