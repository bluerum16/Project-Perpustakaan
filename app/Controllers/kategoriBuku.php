<?php

namespace App\Controllers;
use App\Models\KategoriModel;
class kategoriBuku extends BaseController {

    protected $model;

    public function __construct()
    {
        $this->model = new KategoriModel();
    } 
    
    public function index()
    {
        $perpage = 10;
        $page = (int) ($this->request->getVar('kategoriBuku') ?? 1);
        $q = $this->request->getGet('q') ?? '';
        $sort = $this->request->getGet('sort') ?? 'id_kategori';

        $allowedsort = ['id_kategori', 'nama_kategori', 'judul', 'keterangan'];
        if(! in_array($sort, $allowedsort)){
            $sort = 'id_kategori';
        }
        
        if($q != '') {
            $this->model->groupStart()
                        ->like('id_kategori', $q)
                        ->orlike('nama_kategori', $q)
                        ->orlike('judul', $q)
                        ->orlike('keterangan', $q)
                        ->groupEnd();
        }

        $data = [
            'kategoriBuku' => $this->model->paginate(10),
            'pager' => $this->model->pager,
            'q' => $q,
            'sort' => $sort,
            'PerPage' => $perpage,
            'CurrentPage' => $page,
        ];

        // Menampilkan data ke tabel
        $data['kategoris'] = $this->model->findAll();
        return view('kategori/index', $data);
    }

    public function create() 
    {
    if ($this->request->getMethod() === 'POST') {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'judul'         => $this->request->getPost('judul'),
            'keterangan'    => $this->request->getPost('keterangan'),
        ];

        $this->model->save($data);
        return redirect()->to('/kategori');
    }
    return view('kategori/create'); 
    }
    
}