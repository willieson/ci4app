<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
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
