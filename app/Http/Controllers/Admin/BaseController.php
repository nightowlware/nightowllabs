<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\DB;


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
//        $users = DB::table('users')->simplePaginate(15);
        $search = request()->search;
        $users = User::where('name', 'like', '%'.$search.'%')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.manage_users', compact('users'));
    }
}
