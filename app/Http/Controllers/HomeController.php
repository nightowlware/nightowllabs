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
        // see echoPost()
        $echoPosts = EchoPost::where('user_id', 0)->get();
        return view('echo')->with('echoPosts', $echoPosts);
    }

    public function echoPost(Request $request) {
        try {
            $echo = new EchoPost();

            $echo->html = "<strong>HEADERS</strong><br>";
            $echo->html .= json_encode($request->headers->all(), JSON_PRETTY_PRINT);
            $echo->html .= "<br><br>";
            $echo->html .= "<strong>BODY</strong><br>";
            $echo->html .= json_encode($request->all(), JSON_PRETTY_PRINT);

            // save all posts under ficiticious "0" user
            $echo->user_id = 0;
            $echo->save();

            return response()->json(['Success' => 'The Echo POST was successfully processed.'], 200);
        } catch (\Exception $e) {
            throw $e;
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
