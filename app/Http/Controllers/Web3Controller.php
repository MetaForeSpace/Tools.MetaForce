<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Web3Controller extends Controller
{
    public function index()
    {
        return view('pages/web3');
    }
}
