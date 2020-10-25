<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::paginate(8);
        return response()->json($assets);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asset = Asset::findOrFail($id);
        return response()->json($asset);
    }


    public function search(Request $request){
        $name = $request->query('name');

        if($name == null){
            return response()->json([
                'message' => 'Missing query value'
            ]);
        }

        $name = '%'.$name.'%';
        $assets = Asset::where('name', 'like', $name)->get();

        return response()->json($assets);
    }

    public function filter(Request $request){
        $type = $request->query('type', 'item');
        $assets = Asset::where('type', $type)->paginate(8);
        return response()->json($assets);
    }

    public function sort(Request $request){
        $sort = $request->query('sortBy', 'asc');

        if ($sort == 'asc'){
            $assets = Asset::orderBy('name')->paginate(8);
        } else if ($sort == 'desc'){
            $assets = Asset::orderBy('name', 'desc')->paginate(8);
        } else {
            return response()->json([
                'message' => 'Sort only ascending and descending'
            ]);
        }

        return response()->json($assets);
    }
}
