<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\CloudStorage;
use App\Models\ArchiveModel;
use App\Models\CategoryModel;

class Arsip extends BaseController
{
    public function index()
    {
        $archiveModel  = new ArchiveModel();
        $categoryModel = new CategoryModel();
        $editId        = $this->request->getGet('edit');

        return view('arsip/index', [
            'title'      => 'Manajemen Arsip - Sistem Arsip',
            'archives'   => $archiveModel->getArchivesWithCategory(),
            'categories' => $categoryModel->orderBy('nama_kategori', 'ASC')->findAll(),
            'editData'   => $editId ? $archiveModel->find($editId) : null,
        ]);
    }

    public function simpan()
    {
        $rules = [
            'judul'        => 'required',
            'category_id'  => 'required|numeric',
            'file_dokumen' => [
                'rules'  => 'uploaded[file_dokumen]|ext_in[file_dokumen,pdf,jpg,jpeg,png]',
                'errors' => [
                    'uploaded' => 'File dokumen wajib diunggah.',
                    'ext_in'   => 'Format file harus PDF, JPG, atau PNG.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $file     = $this->request->getFile('file_dokumen');
        $ekstensi = strtolower($file->getExtension());

        // Upload ke penyimpanan
        $cloud    = new CloudStorage();
        $cloudKey = $cloud->upload($file, 'arsip');

        if (!$cloudKey) {
            return redirect()->back()->withInput()->with('error', 'Gagal mengunggah dokumen ke penyimpanan.');
        }

        $archiveModel = new ArchiveModel();
        $archiveModel->insert([
            'category_id'  => $this->request->getPost('category_id'),
            'user_id'      => session()->get('user_id'),
            'judul'        => $this->request->getPost('judul'),
            'deskripsi'    => $this->request->getPost('deskripsi'),
            'file_dokumen' => $cloudKey,
            'tipe_file'    => $ekstensi,
        ]);

        return redirect()->to('/arsip')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function update($id)
    {
        $archiveModel = new ArchiveModel();
        $arsipLama    = $archiveModel->find($id);

        if (!$arsipLama) {
            return redirect()->to('/arsip')->with('error', 'Data arsip tidak ditemukan.');
        }

        $rules = [
            'judul'        => 'required',
            'category_id'  => 'required|numeric',
            'file_dokumen' => [
                'rules'  => 'ext_in[file_dokumen,pdf,jpg,jpeg,png]',
                'errors' => [
                    'ext_in' => 'Format file harus PDF, JPG, atau PNG.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $this->validator->getErrors()));
        }

        $dataUpdate = [
            'category_id' => $this->request->getPost('category_id'),
            'judul'       => $this->request->getPost('judul'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ];

        $file = $this->request->getFile('file_dokumen');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $cloud    = new CloudStorage();
            $cloudKey = $cloud->upload($file, 'arsip');

            if (!$cloudKey) {
                return redirect()->back()->withInput()->with('error', 'Gagal mengunggah file baru ke penyimpanan.');
            }

            // Hapus file lama di penyimpanan
            $cloud->delete($arsipLama['file_dokumen']);

            $dataUpdate['file_dokumen'] = $cloudKey;
            $dataUpdate['tipe_file']    = strtolower($file->getExtension());
        }

        $archiveModel->update($id, $dataUpdate);
        return redirect()->to('/arsip')->with('success', 'Arsip berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $archiveModel = new ArchiveModel();
        $arsip        = $archiveModel->find($id);

        if ($arsip) {
            $cloud = new CloudStorage();
            $cloud->delete($arsip['file_dokumen']);
            $archiveModel->delete($id);
        }

        return redirect()->to('/arsip')->with('success', 'Arsip berhasil dihapus.');
    }

    public function lihat($id)
    {
        $archiveModel = new ArchiveModel();
        $arsip        = $archiveModel->find($id);

        if (!$arsip || empty($arsip['file_dokumen'])) {
            return redirect()->to('/arsip')->with('error', 'Dokumen tidak ditemukan.');
        }

        $cloud = new CloudStorage();
        $url   = $cloud->getUrl($arsip['file_dokumen']);

        return redirect()->to($url);
    }

    public function download($id)
    {
        $archiveModel = new ArchiveModel();
        $arsip        = $archiveModel->find($id);

        if (!$arsip || empty($arsip['file_dokumen'])) {
            return redirect()->to('/arsip')->with('error', 'Dokumen tidak ditemukan.');
        }

        $ekstensi = !empty($arsip['tipe_file']) ? $arsip['tipe_file'] : pathinfo($arsip['file_dokumen'], PATHINFO_EXTENSION);
        $namaFile = url_title($arsip['judul'], '-', true) . '.' . $ekstensi;

        $cloud = new CloudStorage();
        $url   = $cloud->getDownloadUrl($arsip['file_dokumen'], $namaFile);

        return redirect()->to($url);
    }
}
