<?php

namespace App\Http\Controllers\API;

use App\Checklist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Checklist::with('listItems')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $cl = new Checklist($request->all());

        // associate the new checklist to the current user
        $user = \Auth::user();
        $cl->user()->associate($user);

        $cl->save();

        return response()->json("Checklist Created.", 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return
     */
    public function show($id)
    {
        return Checklist::with('listItems')->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return
     */
    public function update(Request $request, $id)
    {
        $cl = $this->show($id);

        if ($cl) {
            $cl->fill($request->all());
            $cl->save();
            return response()->json("Checklist Updated.", 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Checklist::destroy($id);
        return response()->json("Checklist Destroyed.", 200);
    }
}
