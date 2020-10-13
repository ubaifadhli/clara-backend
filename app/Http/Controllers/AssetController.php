<?php

namespace App\Http\Controllers;
use App\Asset;
class AssetController extends Controller
{

    public function create_dummy()
    {
        $asset = new Asset;
        $asset->test = 'testAsset';
        $asset->save();
        return $asset;
    }
}
