<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $data['title'] = 'Halaman User';
        return view('user/index', $data);
    }
}
