<?php

namespace App\Controllers;
use App\Models\BukuModel;
use App\Models\KategoriModel;

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
        $page = (int) ($this->request->getGet('page_buku') ?? 1);

        $q = trim($this->request->getGet('q') ?? '');
        $sort = $this->request->getGet('sort') ?? 'id_buku';
        $order = strtolower($this->request->getGet('order')) === 'desc' ? 'desc' : 'asc';

        $allowedSort = ['id_buku', 'nama_buku', 'penulis', 'tahun_terbit', 'stok', 'nama_kategori'];
        if(!in_array($sort, $allowedSort)){
            $sort = 'id_buku';
        }

        if($q !== '') {
            $model = $model ->getBukuWithKategori()
                            ->groupStart()
                            ->like('nama_buku', $q)
                            ->orlike('penulis', $q)
                            ->orLike('tahun_terbit', $q)
                            ->orLike('stok', $q)
                            ->orLike('nama_kategori', $q)
                            ->groupEnd();
        }
        else {
            $model = $model ->getBukuWithKategori();
        }

        $data['buku'] = $model ->orderBy($sort, $order)
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

    public function create()
    {
        $kategoriModel = new KategoriModel();
        return view('buku/form', [
            'title' => 'Tambah Buku',
            'action' => site_url('buku/store'),
            'method' => 'post',
            'buku' => null,
            'kategori' => $kategoriModel->getAllKategori(),
            'validation' => $this->validation
        ]);
    }

    public function store()
    {
        $rules = [
            'nama_buku' => [
                'rules'  => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => 'Nama buku wajib diisi',
                    'min_length' => 'Nama buku minimal 3 karakter',
                    'max_length' => 'Nama buku maksimal 150 karakter',
                ]
            ],
            'penulis' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama penulis wajib diisi',
                    'min_length' => 'Nama penulis minimal 3 karakter',
                    'max_length' => 'Nama penulis maksimal 100 karakter',
                ]
            ],
            'tahun_terbit' => [
                'rules'  => 'required|integer|greater_than[999]|less_than[10000]',
                'errors' => [
                    'required'     => 'Tahun terbit wajib diisi',
                    'integer'      => 'Tahun terbit harus berupa angka',
                    'greater_than' => 'Tahun terbit minimal 1000',
                    'less_than'    => 'Tahun terbit maksimal 9999',
                ]
            ],
            'stok' => [
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required'                => 'Stok wajib diisi',
                    'integer'                 => 'Stok harus berupa angka',
                    'greater_than_equal_to'   => 'Stok minimal 0',
                ]
            ],
            'id_kategori' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'Kategori wajib dipilih',
                    'integer'  => 'Kategori tidak valid',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $this->model->save([
            'nama_buku' => $this->request->getPost('nama_buku'),
            'penulis' => $this->request->getPost('penulis'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori'),
        ]);

        return redirect()->to(site_url('buku'))->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show($id = null)
    {
        $row = $this->model->getDetailBuku($id);
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data buku tidak ditemukan: $id");
        }

        return view('buku/detail', [
            'buku' => $row,
            'title' => 'Detail Buku'
        ]);
    }

    public function edit($id = null)
    {
        $row = $this->model->getDetailBuku($id);
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data buku tidak ditemukan: $id");
        }

        $kategoriModel = new KategoriModel();

        return view('buku/form', [
            'title' => 'Edit Buku',
            'action' => site_url("buku/update/{$id}"),
            'method' => 'post',
            'buku' => $row,
            'kategori' => $kategoriModel->getAllKategori(),
            'validation' => $this->validation
        ]);
    }

    public function update($id = null)
    {
        $rules = [
            'nama_buku' => [
                'rules'  => 'required|min_length[3]|max_length[150]',
                'errors' => [
                    'required'   => 'Nama buku wajib diisi',
                    'min_length' => 'Nama buku minimal 3 karakter',
                    'max_length' => 'Nama buku maksimal 150 karakter',
                ]
            ],
            'penulis' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama penulis wajib diisi',
                    'min_length' => 'Nama penulis minimal 3 karakter',
                    'max_length' => 'Nama penulis maksimal 100 karakter',
                ]
            ],
            'tahun_terbit' => [
                'rules'  => 'required|integer|greater_than[999]|less_than[10000]',
                'errors' => [
                    'required'     => 'Tahun terbit wajib diisi',
                    'integer'      => 'Tahun terbit harus berupa angka',
                    'greater_than' => 'Tahun terbit minimal 1000',
                    'less_than'    => 'Tahun terbit maksimal 9999',
                ]
            ],
            'stok' => [
                'rules'  => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required'                => 'Stok wajib diisi',
                    'integer'                 => 'Stok harus berupa angka',
                    'greater_than_equal_to'   => 'Stok minimal 0',
                ]
            ],
            'id_kategori' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'Kategori wajib dipilih',
                    'integer'  => 'Kategori tidak valid',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        // pastikan data ada
        if (! $this->model->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data buku tidak ditemukan: $id");
        }

        $this->model->update($id, [
            'nama_buku' => $this->request->getPost('nama_buku'),
            'penulis' => $this->request->getPost('penulis'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'stok' => $this->request->getPost('stok'),
            'id_kategori' => $this->request->getPost('id_kategori'),
        ]);

        return redirect()->to(site_url('buku'))->with('success', 'Data buku berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to(site_url('buku'));
        }

        if (! $this->model->find($id)) {
            return redirect()->to(site_url('buku'))->with('error', 'Data tidak ditemukan.');
        }

        $this->model->delete($id);
        return redirect()->to(site_url('buku'))->with('success', 'Data buku berhasil dihapus.');
    }
};