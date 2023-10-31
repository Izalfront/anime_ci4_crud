<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Home',];

        return view('pages/welcome_message', $data);
    }

    public function coba()
    {
        $data = ['title' => 'About',];

        return view('pages/coba', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'jalan' => 'haji izal no.012',
                    'kota' => 'jakarta'
                ],
                [
                    'tipe' => 'Kantor',
                    'jalan' => 'haji izal no.013',
                    'kota' => 'barabai'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}
