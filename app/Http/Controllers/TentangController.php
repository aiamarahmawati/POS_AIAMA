<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangController extends Controller
{
    /**
     * Menampilkan halaman Tentang aplikasi.
     */
    public function index()
    {
        return view('tentang');
    }
}