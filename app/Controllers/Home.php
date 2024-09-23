<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {

        // Cek apakah session status ada dan benar
        if (session()->get('status') !== 'true') {
            // Jika tidak ada session, redirect ke halaman login
            return redirect()->route('login');
        }

        // Ambil oauth_id dari session
        $user_id = session()->get('user_id');

        if ($user_id) {
            $user_data = $this->userModel->where('id', $user_id)->first();
        } else {
            $user_data = null;
        }


        $data = [
            'title' => 'Home | CI4 - Michael',
            'user_data' => $user_data
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
