<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    public function index($key, $id)
    {
        return view('app', [
            'id' => $id,
            'key' => $key
        ]);
    }
}
