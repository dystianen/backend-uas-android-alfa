<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MobilModel;
use App\Models\UserModel;

class MobilController extends BaseController
{
    protected $mobilModel;
    protected $userModel;

    public function __construct()
    {
        $this->mobilModel = new MobilModel();
        $this->userModel  = new UserModel();
    }

    // GET all
    public function index()
    {
        $data = $this->mobilModel->findAll();
        return $this->response->setJSON($data);
    }

    // GET by ID
    public function show($id = null)
    {
        $data = $this->mobilModel->find($id);
        if (!$data) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($data);
    }

    // CREATE
    public function create()
    {
        $rules = [
            'merk'  => 'required',
            'model' => 'required',
            'tahun' => 'required|exact_length[4]|numeric',
            'warna' => 'required',
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,2048]' // max 2MB
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => false, 'errors' => $this->validator->getErrors()]);
        }

        // Upload file
        $photo = $this->request->getFile('photo');
        $fileName = $photo->getRandomName();
        $photo->move('uploads/mobil', $fileName);

        $data = [
            'merk'  => $this->request->getPost('merk'),
            'model' => $this->request->getPost('model'),
            'tahun' => $this->request->getPost('tahun'),
            'warna' => $this->request->getPost('warna'),
            'photo' => $fileName
        ];

        $this->mobilModel->insert($data);

        return $this->response->setJSON(['status' => true, 'message' => 'Mobil berhasil ditambahkan']);
    }

    // UPDATE
    public function update($id = null)
    {
        $mobil = $this->mobilModel->find($id);
        if (!$mobil) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        $rules = [
            'merk'  => 'required',
            'model' => 'required',
            'tahun' => 'required|exact_length[4]|numeric',
            'warna' => 'required',
            'photo' => 'if_exist|is_image[photo]|max_size[photo,2048]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => false, 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'merk'  => $this->request->getPost('merk'),
            'model' => $this->request->getPost('model'),
            'tahun' => $this->request->getPost('tahun'),
            'warna' => $this->request->getPost('warna'),
        ];

        // Jika ada file foto baru
        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $fileName = $photo->getRandomName();
            $photo->move('uploads/mobil', $fileName);

            // Hapus foto lama jika ada
            if (!empty($mobil['photo']) && file_exists('uploads/mobil/' . $mobil['photo'])) {
                unlink('uploads/mobil/' . $mobil['photo']);
            }

            $data['photo'] = $fileName;
        }

        $this->mobilModel->update($id, $data);

        return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil diupdate']);
    }

    // DELETE
    public function delete($id = null)
    {
        $mobil = $this->mobilModel->find($id);
        if (!$mobil) {
            return $this->response->setJSON(['status' => false, 'message' => 'Data tidak ditemukan']);
        }

        // Hapus file foto jika ada
        if (!empty($mobil['photo']) && file_exists('uploads/mobil/' . $mobil['photo'])) {
            unlink('uploads/mobil/' . $mobil['photo']);
        }

        $this->mobilModel->delete($id);

        return $this->response->setJSON(['status' => true, 'message' => 'Data berhasil dihapus']);
    }
}
