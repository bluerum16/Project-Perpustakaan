<?php

namespace App\Controllers;
use App\Models\BukuModel;

class buku extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model = new BukuModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $model = new \App\Models\BukuModel();
        $perPage = 10;
        $page = (int) ($this->request->getGet('page') ?? 1);

        $q = trim($this->request->getGet('q') ?? '');
        $sort = $this->request->getGet('sort') ?? 'id_buku';
        $order = strtolower($this->request->getGet('order')) === 'desc' ? 'desc' : 'asc';

        $allowedSort = ['id_buku', 'nama_buku', 'penulis', 'tahun_terbit', 'stok', 'id_kategori'];
        if(!in_array($sort, $allowedSort)){
            $sort = 'id_buku';
        }

        if($q !== ''){
            $model = $model ->groupStart()
                            ->like('nama_buku', $q)
                            ->orlike('penulis', $q)
                            ->orLike('tahun_terbit', $q)
                            ->groupEnd();
        }

        $data['buku'] = $model  ->orderBy($sort, $order)
                                ->paginate($perPage, 'buku');
        
        $data['pager'] = $model->pager;
        $data['currentPage'] = $page;
        $data['q'] = $q;
        $data['order'] = $order;
        $data['perPage'] = $perPage;
        $data['title'] = 'Daftar Buku';
        $data['sort'] = $sort;




        return view('buku/index', $data);
    }

    public function create() {
        return view('buku/create', [
            'title' => 'Tambah Buku'
        ]);
    }

    public function store() {
        $data = [
            'nama_buku'    => $this->request->getPost('nama_buku'),
            'penulis'      => $this->request->getPost('penulis'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok'         => $this->request->getPost('stok'),
            'id_kategori'  => $this->request->getPost('id_kategori'),
        ];

    }
};