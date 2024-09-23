<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {

        // Cek apakah session status ada dan benar
        if (session()->get('status') !== 'true') {
            // Jika tidak ada session, redirect ke halaman login
            return redirect()->route('login');
        }

        $data = [
            'title' => 'Home | CI4 - Michael'
        ];

        return view('index', $data);
    }

    public function connTest()
    {
        $db = \Config\Database::connect();
        if ($db->connect()) {
            echo "Koneksi ke database berhasil!";
        } else {
            echo "Koneksi ke database gagal!";
        }
    }
}
