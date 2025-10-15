<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">


    <style>
        body{
            display:flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-box{
            display: grid;
            background-color: white;
            padding: 100px;
            border: 5px solid #FFFFFF;
            gap: 50px;
        }
        .form-row{
            display: grid;
            gap: 100px;
            padding: 20px;
            grid-template-columns: 120px 1fr;
        }
        .button-row{
            display: flex;
            justify-content: center;
            
            
        }
        input{
            border: 1px solid #DFE2E6;
            border-radius:5px;
        }
        #keterangan{
            border: 1px solid #DFE2E6;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding-bottom: 30px;
            
            
        }
        #keterangan_label{
            display: flex;   
        }
        #nama_kategori{
            width: 500px;
        }

    </style>
</head>
<body class="bg-light">
    <div class="form-box shadow-sm mb-5 rounded">
        <h2 style="display:flex; justify-content:center;">Peminjaman Buku</h2>
    <form action="" method="POST">
        <?= csrf_field() ?>
        <div class="form-row">
            <label for="nama_kategori">Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukkan kategori" required>
        </div>

        <div class="form-row">
            <label for="judul">Judul</label>
            <input type="text" id="judul" class="form-control" name="judul" placeholder="Masukkan judul" required>
        </div>

        <div class="form-row">
            <label id="keterangan_label" for="keterangan">Deskripsi</label>
            <textarea id="keterangan" class="form-control" name="keterangan" placeholder="Masukkan deskripsi" rows="3" required></textarea>
        </div>
        <div class="button-row">
            <button class="btn btn-primary w-100" type="submit">Submit</button>
        </div>
        
    </form>
</div>
</body>
</html>