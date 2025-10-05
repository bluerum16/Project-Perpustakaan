<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user_login';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'username',
        'password',
        'email',
        'no_telfon',
        'role',
        'tanggal_daftar',
    ];

    // jika mau timestamps, aktifkan dan tambahkan kolom created_at/updated_at
    protected $useTimestamps = false;

    public function getLogin($email)
    {
        return $this->where('email', $email)
                ->first();
    }
}