<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomikModel;

class Komik extends BaseController
{

    protected $komikModel;

    public function __construct()
    {
        $this->komikModel =  new KomikModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/detail', $data);
    }

    public function create()
    {
        session();
        $data = [
            'title' => 'Tambah data',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function store()
    {
        $komikModel = new KomikModel();
        $validation = \Config\Services::validation();
        if (!$this->validate(
            [
                'judul' => 'required|is_unique[komik.judul]',
                'penulis' => 'required',
                'penerbit' => 'required',
            ],
            [
                'sampul' => 'uploaded[sampul]|max_size[sampul,3024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]'
            ],
            [
                'sampul' => [
                    'uploaded' => 'Pilih file sampul terlebih dahulu.',
                    'max_size' => 'Ukuran file sampul tidak boleh lebih dari 3MB.',
                    'is_image' => 'File harus berupa gambar (JPG, JPEG, atau PNG).',
                    'mime_in' => 'File harus berupa gambar (JPG, JPEG, atau PNG).'
                ]
            ]
        )) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to('/komik/create');
        }
        // upload file
        $fileSampul = $this->request->getFile('sampul');
        // memindahkan file folder img
        $fileSampul->move('img');
        // ambil nama file sampul
        $namaSampul = $fileSampul->getName();

        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => url_title($this->request->getVar('judul'), '-', true),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ];



        $komikModel->insert($data);

        session()->setFlashdata('message', 'Data komik berhasil ditambahkan.');

        return redirect()->to('/komik/index');
    }

    public function delete($id)
    {
        // cari file
        $komik = $this->komikModel->find($id);

        // cek jika gambar default.jpg
        if ($komik['sampul'] != 'default.jpg') {
            // hapus img 
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);

        return redirect()->to('/komik/index');
    }

    public function edit($slug)
    {
        session();
        $komik = $this->komikModel->getKomik($slug);

        if (!$komik) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = [
            'title' => 'Edit data',
            'validation' => \Config\Services::validation(),
            'komik' => $komik
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {

        // ambil data lama
        $komiklama = $this->komikModel->find($id);

        // aturan validasi untuk judul
        $rule_judul = 'required';
        if ($komiklama['judul'] !== $this->request->getVar('judul')) {
            $rule_judul .= '|is_unique[komik.judul]';
        }

        $validation = \Config\Services::validation();
        if (!$this->validate(
            [
                'judul' => $rule_judul,
                'penulis' => 'required',
                'penerbit' => 'required',
                'sampul' => 'uploaded[sampul]|max_size[sampul,3024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]'
            ],
            [
                'sampul' => [
                    'uploaded' => 'Pilih file sampul terlebih dahulu.',
                    'max_size' => 'Ukuran file sampul tidak boleh lebih dari 3MB.',
                    'is_image' => 'File harus berupa gambar (JPG, JPEG, atau PNG).',
                    'mime_in' => 'File harus berupa gambar (JPG, JPEG, atau PNG).'
                ]
            ]
        )) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to('/komik/edit' . $this->request->getVar('slug'));
        }

        // Cek apakah file sampul baru diunggah atau tidak
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == UPLOAD_ERR_NO_FILE) {
            $namaSampul = $komiklama['sampul']; // Gunakan sampul yang lama
        } else {
            // Upload file sampul baru
            $fileSampul->move('img');
            $namaSampul = $fileSampul->getName();
        }

        $data = [
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => url_title($this->request->getVar('judul'), '-', true),
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ];

        $this->komikModel->update($id, $data);

        session()->setFlashdata('message', 'Data komik berhasil diubah.');

        return redirect()->to('/komik/index');
    }
}
