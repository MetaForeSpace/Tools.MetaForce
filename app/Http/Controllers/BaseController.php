<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function index(string $key, int $id)
    {
        return view('app', [
            'key' => $key,
            'id' => $id
        ]);
    }
}
