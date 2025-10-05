<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        //echo "password: ".password_hash('password123', PASSWORD_DEFAULT);
        //echo "<br>validated: ".password_verify('password123', '$2y$10$T3i1UDotVtZ8PiKPJ2wFBO3.kE1hzSjqEVLRCqbLDhoXH8n/iAeI2');

        $model = new \App\Models\UserModel();

        $perPage = 10;
        $page    = (int) ($this->request->getVar('page_user') ?? 1);

        $q     = trim($this->request->getGet('q') ?? '');
        $sort  = $this->request->getGet('sort') ?? 'id_user';
        $order = $this->request->getGet('order') ?? 'asc';

        $allowedSort = ['id_user','username','email','no_telfon', 'role'];
        if (! in_array($sort, $allowedSort)) {
            $sort = 'id_user';
        }
        $order = strtolower($order) === 'desc' ? 'desc' : 'asc';

        if ($q !== '') {
            $model = $model->groupStart()
                        ->like('username', $q)
                        ->orLike('email', $q)
                        ->orLike('no_telfon', $q)
                        ->groupEnd();
        }

        $data['user'] = $model->orderBy($sort, $order)
                                ->paginate($perPage, 'user');

        $data['pager'] = $model->pager;
        $data['currentPage'] = $page;
        $data['perPage'] = $perPage;
        $data['title'] = 'Daftar User';

        $data['q'] = $q;
        $data['sort'] = $sort;
        $data['order'] = $order;

        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/form', [
            'title' => 'Tambah User',
            'action' => site_url('user/store'),
            'method' => 'post',
            'user' => null,
            'validation' => $this->validation
        ]);
    }

    public function store()
    {
        $rules = [
            'username' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama user wajib diisi',
                    'min_length' => 'Nama user minimal 3 karakter',
                    'max_length' => 'Nama user maksimal 100 karakter',
                ]
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[250]',
                'errors' => [
                    'required'   => 'Password wajib diisi',
                    'min_length' => 'Password minimal 3 karakter',
                    'max_length' => 'Password maksimal 250 karakter',
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
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'email' => $this->request->getPost('email'),
            'no_telfon' => $this->request->getPost('no_telfon'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to(site_url('user'))->with('success', 'Data user berhasil ditambahkan.');
    }

    public function show($id = null)
    {
        $row = $this->model->find($id);
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data user tidak ditemukan: $id");
        }

        return view('user/detail', [
            'user' => $row,
            'title' => 'Detail User'
        ]);
    }

    public function edit($id = null)
    {
        $row = $this->model->find($id);
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data user tidak ditemukan: $id");
        }

        return view('user/form', [
            'title' => 'Edit User',
            'action' => site_url("user/update/{$id}"),
            'method' => 'post',
            'user' => $row,
            'validation' => $this->validation
        ]);
    }

    public function update($id = null)
    {
       $rules = [
            'username' => [
                'rules'  => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required'   => 'Nama user wajib diisi',
                    'min_length' => 'Nama user minimal 3 karakter',
                    'max_length' => 'Nama user maksimal 100 karakter',
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

        if (! $this->model->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data user tidak ditemukan: $id");
        }

        $this->model->update($id, [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_telfon' => $this->request->getPost('no_telfon'),
            'role' => $this->request->getPost('role'),
        ]);

        return redirect()->to(site_url('user'))->with('success', 'Data user berhasil diperbarui.');
    }

    public function delete($id = null)
    {
        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to(site_url('user'));
        }

        if (! $this->model->find($id)) {
            return redirect()->to(site_url('user'))->with('error', 'Data tidak ditemukan.');
        }

        $this->model->delete($id);
        return redirect()->to(site_url('user'))->with('success', 'Data user berhasil dihapus.');
    }

    public function login()
    {
        if ($this->request->getMethod() == 'POST') {
            $user = $this->model->getLogin($this->request->getPost('email'));
            if ($user) {
                if (password_verify($this->request->getPost('password'), $user["password"])) {
                    session()->set([
                        'id_user'  => $user['id_user'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role'     => $user['role'],
                        'logged_in' => true
                    ]);
                    
                    return redirect()->to(site_url('/'));
                }
                else {
                    return redirect()->to(site_url('user/login'))->withInput()->with('error', 'Email atau password salah.');
                }
            } else {
               return redirect()->to(site_url('user/login'))->withInput()->with('error', 'Email atau password salah.');
            }
        }

        return view('user/login', [
            'title' => 'Perpustakaan - Login',
            'action' => site_url('user/login'),
            'method' => 'post',
            'user' => null,
            'validation' => $this->validation
        ]);
    }

    public function logout()
    {
        if (session()->has('logged_in')) {
            session()->remove('id_user');
            session()->remove('username');
            session()->remove('email');
            session()->remove('role');
            session()->remove('logged_in');
            session()->destroy();

            return redirect()->to(site_url('user/login'));
        }
    }

    public function changepassword()
    {
        if ($this->request->getMethod() == 'POST') {
            $user = $this->model->find(session()->get('id_user'));
            if ($user) {
                if (password_verify($this->request->getPost('password'), $user['password'])) {
                    $this->model->update(session()->get('id_user'), [
                        'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
                    ]);

                    return redirect()->to(site_url('user/changepassword'))->with('success', 'Password user berhasil diperbarui.');
                }
                else {
                    return redirect()->to(site_url('user/changepassword'))->with('error', 'Password salah, ulangi kembali.');
                }
                
                return redirect()->to(site_url('/'));
            } else {
               return redirect()->to(site_url('user/changepassword'))->with('error', 'Session id user tidak valid.');
            }
        }

        $row = $this->model->find(session()->get('id_user'));
        if (! $row) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data user tidak ditemukan: $id");
        }

        return view('user/changepassword', [
            'title' => 'Change Password',
            'action' => site_url('user/changepassword'),
            'method' => 'post',
            'user' => $row,
            'validation' => $this->validation
        ]);
    }
}