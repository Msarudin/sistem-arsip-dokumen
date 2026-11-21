<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;

class Kategori extends BaseController
{
    public function index()
    {
        $model  = new CategoryModel();
        $editId = $this->request->getGet('edit');

        return view('kategori/index', [
            'title'      => 'Manajemen Kategori - Sistem Arsip',
            'categories' => $model->orderBy('id', 'DESC')->findAll(),
            'editData'   => $editId ? $model->find($editId) : null,
        ]);
    }

    public function simpan()
    {
        $model = new CategoryModel();
        $nama  = trim($this->request->getPost('nama_kategori'));

        if (empty($nama)) {
            return redirect()->back()->with('error', 'Nama kategori wajib diisi.');
        }

        $cekData = $model->where('LOWER(nama_kategori)', strtolower($nama))->first();
        if ($cekData) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori sudah ada, tidak boleh sama!');
        }

        $model->insert(['nama_kategori' => $nama]);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update($id)
    {
       $model = new CategoryModel();
        $nama  = trim($this->request->getPost('nama_kategori'));

        if (empty($nama)) {
            return redirect()->back()->with('error', 'Nama kategori wajib diisi.');
        }

        $cekData = $model->where('LOWER(nama_kategori)', strtolower($nama))
                         ->where('id !=', $id)
                         ->first();
        if ($cekData) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori sudah digunakan oleh kategori lain!');
        }

        $model->update($id, ['nama_kategori' => $nama]);
        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $model = new CategoryModel();

        try {
            $model->delete($id);
            return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->to('/kategori')->with('error', 'Kategori masih digunakan pada data arsip.');
        }
    }
}
