<?php

namespace App\Controllers;
use App\Models\KategoriModel;

class kategoriBuku extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model = new KategoriModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        
    }
}