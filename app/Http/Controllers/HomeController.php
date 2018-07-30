<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EchoPost;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // Alias to function above
    public function home()
    {
        return $this->index();
    }

    public function echo() {
        $user = request()->user();
        return view('echo')->with('echoPosts', $user->echos);
    }

    public function echoPost(Request $request) {
        try {
            $user = $request->user();

            $echo = new EchoPost();
            $echo->html = json_encode($request->all(), JSON_PRETTY_PRINT);

            $user->echos()->save($echo);

            return response()->json(['Success' => 'The Echo POST was successfully processed.'], 200);
        } catch (\Exception $e) {
            return response()->json(['Failure' => "There was a problem with processing your Echo POST"], 500);
        }
    }

    /**
     * Show the crypto dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function crypto()
    {
        return view('crypto');
    }

    /**
     * Show the user's profile
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request)
    {
        $user = $request->user();

        if (!empty($request->all())) {
            // Be careful! Don't set any sensitive fields here!
            $user->name = $request->input('name');
            $user->save();
        }

        return view('profile')->with('user', request()->user());
    }
}
