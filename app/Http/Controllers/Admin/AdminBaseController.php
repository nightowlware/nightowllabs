<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;


class AdminBaseController extends Controller
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

}
