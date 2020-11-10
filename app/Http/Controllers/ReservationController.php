<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller {
    
    public function index() {
        $reservations = Reservation::paginate(8);
        return response()->json($reservations);
    }

    public function create(Request $request) {
        $this->validator($request->all())->validate();
        $asset = Asset::findOrFail($request->asset_id)->makeHidden(['_id'])->toArray();
        if($request->quantity != 0){
            $asset['quantity'] = $request->quantity;
        }
        $user = Auth::user();
        $reservation = Reservation::create([
            'description' => $request->description,
            'begin' => $request->begin,
            'end' => $request->end,
            'user' => (object)$user,
            'asset' => (object)$asset,
            'status' => 'Waiting on approval'
        ]);
        return response()->json([
            'message' => 'Successfully create new reservation',
            'reservation' => $reservation
        ]);
    }

    private function validator(array $data) {
        return Validator::make($data, [
            'description' => ['required', 'string'],
            'begin' => ['required', 'date'],
            'end' => ['required', 'date'],
            'asset_id' => ['required'],
        ]);
    }

    public function read($id) {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
    }

    public function update(Request $request, $id) {
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status
        ]);
        return response()->json([
            'message' => 'Status updated successfully',
            'reservation' => $reservation
        ]);
    }

    public function recent(){
        $reservations = Reservation::orderBy('begin', 'desc')->limit(5)->get();
        return response()->json($reservations);
    }

}
