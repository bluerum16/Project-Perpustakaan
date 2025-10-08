<?php

namespace App\Controllers;

use App\Models\SekolahModel;

class Sekolah extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model = new SekolahModel();
        $this->validation = \Config\Services::validation();
    }

    // READ: daftar
    public function index()
    {
        $model = new \App\Models\SekolahModel();

        $perPage = 10;
        $page    = (int) ($this->request->getVar('page_sekolah') ?? 1);

        // Ambil parameter pencarian & sorting
        $q     = trim($this->request->getGet('q') ?? '');
        $sort  = $this->request->getGet('sort') ?? 'id_sekolah';
        $order = $this->request->getGet('order') ?? 'asc';

        // Whitelist kolom sorting untuk keamanan
        $allowedSort = ['id_sekolah','nama_sekolah','email','no_telfon'];
        if (! in_array($sort, $allowedSort)) {
            $sort = 'id_sekolah';
        }
        $order = strtolower($order) === 'desc' ? 'desc' : 'asc';

        // Jika ada query pencarian, tambahkan kondisi LIKE (nama/email/no_telfon)
        if ($q !== '') {
            $model = $model->groupStart()
                        ->like('nama_sekolah', $q)
                        ->orLike('email', $q)
                        ->orLike('no_telfon', $q)
                        ->groupEnd();
        }

        // Ambil data dengan sorting & paginate
        $data['sekolah'] = $model->orderBy($sort, $order)
                                ->paginate($perPage, 'sekolah');

        $data['pager'] = $model->pager;
        $data['currentPage'] = $page;
        $data['perPage'] = $perPage;
        $data['title'] = 'Daftar Sekolah';

        // Kirim parameter ke view supaya form & link dapat mempertahankannya
        $data['q'] = $q;
        $data['sort'] = $sort;
        $data['order'] = $order;

        return view('sekolah/index', $data);
    }

    // CREATE: tampilkan form
    public function create()
    {
        return view('sekolah/form', [
            'title' => 'Tambah Sekolah',
            'action' => site_url('sekolah/store'),
            'method' => 'post',
            'sekolah' => null,
            'validation' => $this->validation
        ]);
    }

    // CREATE: simpan
    public function store()
    {
        $rules = [
            'nama_sekolah' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama sekolah wajib diisi',
                    'min_length' => 'Nama sekolah minimal 3 karakter',
                    'max_length' => 'Nama sekolah maksimal 100 karakter',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[250]',
                'errors' => [
                    'required'    => 'Email wajib diisi',
                    'valid_email' => 'Email tidak valid',
                    'max_length'  => 'Email maksimal 250 karakter',
                ]
            ],
            'no_telfon' => [
                'rules'  => 'required|max_length[20]',
                'errors' => [
                    'required'   => 'No Telepon wajib diisi',
                    'max_length' => 'Password maksimal 20 karakter',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $this->model->save([
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'alamat'       => $this->request->getPost('alamat'),
            'email'        => $this->request->getPost('email'),
            'no_telfon'    => $this->request->getPost('no_telfon'),
        ]);

        return redirect()->to(site_url('sekolah'))->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    // READ: detail
    public function show($id = null)
    {
        $row = $this->model->find($id);
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data sekolah tidak ditemukan: $id");
        }

        return view('sekolah/detail', [
            'sekolah' => $row,
            'title' => 'Detail Sekolah'
        ]);
    }

    // UPDATE: tampilkan form edit
    public function edit($id = null)
    {
        $row = $this->model->find($id);
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data sekolah tidak ditemukan: $id");
        }

        return view('sekolah/form', [
            'title' => 'Edit Sekolah',
            'action' => site_url("sekolah/update/{$id}"),
            'method' => 'post',
            'sekolah' => $row,
            'validation' => $this->validation
        ]);
    }

    // UPDATE: simpan perubahan
    public function update($id = null)
    {
        $rules = [
            'nama_sekolah' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama sekolah wajib diisi',
                    'min_length' => 'Nama sekolah minimal 3 karakter',
                    'max_length' => 'Nama sekolah maksimal 100 karakter',
                ]
            ],
            'email' => [
                'rules'  => 'required|valid_email|max_length[250]',
                'errors' => [
                    'required'    => 'Email wajib diisi',
                    'valid_email' => 'Email tidak valid',
                    'max_length'  => 'Email maksimal 250 karakter',
                ]
            ],
            'no_telfon' => [
                'rules'  => 'required|max_length[20]',
                'errors' => [
                    'required'   => 'No Telepon wajib diisi',
                    'max_length' => 'Password maksimal 20 karakter',
                ]
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        // pastikan data ada
        if (! $this->model->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data sekolah tidak ditemukan: $id");
        }

        $this->model->update($id, [
            'nama_sekolah' => $this->request->getPost('nama_sekolah'),
            'alamat'       => $this->request->getPost('alamat'),
            'email'        => $this->request->getPost('email'),
            'no_telfon'    => $this->request->getPost('no_telfon'),
        ]);

        return redirect()->to(site_url('sekolah'))->with('success', 'Data sekolah berhasil diperbarui.');
    }

    // DELETE
    public function delete($id = null)
    {
        // sebaiknya delete dilakukan via POST untuk keamanan
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to(site_url('sekolah'));
        }

        if (! $this->model->find($id)) {
            return redirect()->to(site_url('sekolah'))->with('error', 'Data tidak ditemukan.');
        }

        $this->model->delete($id);
        return redirect()->to(site_url('sekolah'))->with('success', 'Data sekolah berhasil dihapus.');
    }
}