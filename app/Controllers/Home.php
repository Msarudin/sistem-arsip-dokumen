<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') || session()->get('user_id') || session()->get('nama')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'M. Sarudin E - Sistem Arsip Dokumen'
        ];

        return view('home', $data);
    }
}
