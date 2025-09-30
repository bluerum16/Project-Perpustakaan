<?php

namespace App\Controllers;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new SiswaModel();
    }

    public function create()
    {
        $data = [
            'title' => 'Sistem Perpustakaan'
        ];
        return view('siswa/form');
    }
    
    public function login() {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        
        return redirect()->to('/');
    }
    
};