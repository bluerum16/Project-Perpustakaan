<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        body{
            padding-top: 2rem;
            display: flex;
            justify-content: center;
            width: 100%;
            height: 100vh;
            align-items: flex-start;
        }
        .form-box{
            display: flex;
            background-color: white;
            flex-direction: column;
            padding: 10px;
            height: 50%;
            width: 80%;
            margin: 0 auto;
            justify-content: center;
            align-items: flex-start;
            gap: 20px;
        }
        .form-control{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            width: 500px;
        }
        .search-form{
            display: flex;
            gap: 10px;
            max-width: 500px;
        }
        .btn.btrn-primary{
            gap: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="form-box shadow-sm rounded">
        <h2>Peminjaman Buku</h2>
            <form action="" method="get" class="search-form">
                <input type="text" name="q" class="form-control" placeholder="Cari Kategori" value="<?= esc($q ?? '') ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach($kategoris as $kategori): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($kategori['nama_kategori']); ?></td>
                    <td><?= esc($kategori['Judul']); ?></td>
                    <td><?= esc($kategori['keterangan']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div>
        <?= $pager->links('kategoriBuku', 'bootstrap_full'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>