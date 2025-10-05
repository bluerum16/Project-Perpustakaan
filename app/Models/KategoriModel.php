<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends BaseAuditModel
{
    protected $table         = 'kategori_buku';
    protected $primaryKey    = 'id_kategori';
    protected $allowedFields = ['nama_kategori'];

    public function getAllKategori()
    {
        return $this->findAll();
    }
}