<?php

namespace App\Http\Controllers\API;

use App\ListItem;
use App\Checklist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
        return ListItem::orderBy('sort_order')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Checklist::find($request['checklist_id'])) {
            $li = new ListItem($request->all());
            $li->save();
            return response()->json("ListItem Created.", 200);
        } else {
            return response()->json("You don't have access to this checklist_id.", 403);
        }

    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ListItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $l = $this->show($id);

        if ($l) {
            $l->setText($request['text']);
            $l->save();
            return response()->json("ListItem Updated.", 200);
        } else {
            return response()->json("ListItem not found", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        ListItem::destroy($id);

        // Had to use this "raw" form of deletion since the line commented above
        // doesn't work due to the globalscope query in ListItem.
        \DB::table('list_items')->where('id', $id)->delete();

        return response()->json("ListItem Destroyed.", 200);
    }

    public function shiftAsc($id) {
        ListItem::find($id)->shiftAsc();
        return response()->json("ListItem Moved in Ascending Direction.", 200);
    }

    public function shiftDesc($id) {
        ListItem::find($id)->shiftDesc();
        return response()->json("ListItem Moved in Descending Direction.", 200);
    }
}
