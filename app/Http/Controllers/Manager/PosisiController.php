<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    public function index() {
        return view('pages.manager.posisi.index');
    }
}
