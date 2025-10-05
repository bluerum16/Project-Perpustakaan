<?php

namespace App\Models;

use CodeIgniter\Model;

class SekolahModel extends BaseAuditModel
{
    protected $table            = 'sekolah';
    protected $primaryKey       = 'id_sekolah';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'nama_sekolah',
        'alamat',
        'email',
        'no_telfon'
    ];

    // jika mau timestamps, aktifkan dan tambahkan kolom created_at/updated_at
    protected $useTimestamps = false;
}