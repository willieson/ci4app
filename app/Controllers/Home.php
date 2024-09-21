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
}
