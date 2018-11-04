<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhaserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth', ['except' => 'echoPost']);
    }

    public function playground(Request $request) {
        return view('phaser');
    }
}
