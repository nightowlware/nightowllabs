<?php

namespace App\Http\Controllers;


class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        return view('admin.manage_users');
    }
}
