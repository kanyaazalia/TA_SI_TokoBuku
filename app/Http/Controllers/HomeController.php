<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Method index mengembalikan view home dengan judul HOme
    public function index() {
        return view('home.index', [
            'title' => 'Home'
        ]);
    }
}
