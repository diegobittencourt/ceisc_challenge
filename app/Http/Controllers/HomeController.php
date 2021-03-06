<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postagem as ModelPostagem;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $array['postagens'] = ModelPostagem::get();

        return view('home', $array);
    }
}
