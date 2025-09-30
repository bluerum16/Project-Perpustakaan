<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table      = 'buku';
    protected $primaryKey = 'id_buku';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['nama_buku', 'penulis', 'tahun_terbit', 'stok', 'id_kategori'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // Dates
    // protected $useTimestamps = false;
    /*protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];*/

    /**
     * Ambil semua buku beserta kategori nya
     */
    public function getBukuWithKategori()
    {
        return $this->select('buku.*, kategori_buku.nama_kategori')
                    ->join('kategori_buku', 'kategori_buku.id_kategori = buku.id_kategori', 'left');
    }

    /**
     * Ambil detail buku by ID beserta kategori
     */
    public function getDetailBuku($id)
    {
        return $this->select('buku.*, kategori_buku.nama_kategori')
                    ->join('kategori_buku', 'kategori_buku.id_kategori = buku.id_kategori', 'left')
                    ->where('buku.id_buku', $id)
                    ->first();
    }
}