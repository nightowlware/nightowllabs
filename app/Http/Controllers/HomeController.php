<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EchoPost;
use App\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'echoPost']);
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
        $echoPosts = EchoPost::orderBy('created_at', 'desc')->take(25)->get();
        return view('echo')->with('echoPosts', $echoPosts);
    }

    public function echoPost(Request $request) {
        try {
            $echo = new EchoPost();

            $echo->headers = json_encode($request->headers->all(), JSON_PRETTY_PRINT);
            $echo->body = json_encode($request->all(), JSON_PRETTY_PRINT);

            // save all posts under ficiticious "0" user
            $echo->user_id = 0;
            $echo->save();

            return response()->json(['Success' => 'The Echo POST was successfully processed.'], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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

    public function fileshare(Request $request) {
        return view('fileshare');
    }

    public function filesharePost(Request $request) {
        $time = Carbon::now();

        // Fetch the file from the form. This must match "paramName" in the javascript
        $file = $request->file('file');

        $folder = $time->format('Y-m-d') . '/' . str_random(50);
        $filename = $file->getClientOriginalName();

        $filePath = Storage::putFileAs($folder, request()->file, $filename, 'public');

        if ($filePath) {
            $url = Storage::url($filePath);
            return response()->json($url, 200);
        } else {
            return response()->json('Error: could not upload file.', 400);
        }
    }

    public function checklists(Request $request) {
        return "Under construction!";
    }
}
