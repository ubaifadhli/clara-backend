<?php

namespace App\Http\Controllers;

use App\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $asset = new Asset;
        $asset->name = $request->name;
        $asset->quantity = $request->quantity;
        $asset->available = $request->quantity;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = time()."-".$image->getClientOriginalName();
            $image->move('assets', $fileName);
            $asset->image = $fileName;
        } else {
            $asset->image = "no-image.png";
        }
        $asset->save();
        return response()->json([
            'message' => 'Successfully create asset',
            'asset' => $asset
        ]);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $asset = Asset::findOrFail($id);
        $asset->name = $request->name;
        $asset->quantity = $request->quantity;
        $asset->available = $request->quantity;
        if($request->hasFile('image')){
            unlink('assets/'.$asset->image);
            $image = $request->file('image');
            $fileName = time()."-".$image->getClientOriginalName();
            $image->move('assets', $fileName);
            $asset->image = $fileName;
        }
        $asset->save();
        return response()->json([
            'message' => 'Successfully update asset',
            'asset' => $asset
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asset = Asset::findOrFail($id);
        if($asset->image != 'no-image.png'){
            unlink('assets/'.$asset->image);
        }
        $asset->delete();
        return response()->json([
            'message' => 'Successfully delete asset',
            'asset' => $asset
        ]);
    }

    public function search(Request $request){
        $name = $request->query('name');

        if($name == null){
            return redirect('api/asset');
        }

        $name = '%'.$name.'%';
        $assets = Asset::where('name', 'like', $name)->get();

        return response()->json($assets);
    }

    public function sort(Request $request){
        $sort = $request->query('sortBy', 'asc');

        if ($sort == 'asc'){
            $assets = Asset::orderBy('name')->paginate(8);
        } else if ($sort == 'desc'){
            $assets = Asset::orderBy('name', 'desc')->paginate(8);
        }

        return response()->json($assets);
    }

    private function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'quantity' => ['required', 'gt:0']
        ]);
    }
}
