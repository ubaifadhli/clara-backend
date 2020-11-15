<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller {

    public function indexStudent(Request $request){
        $limit = $request->query('limit', 0);

        if($limit > 0){
            $reservations = Reservation::where('user', (object) User::find(Auth::id())->toArray())
                ->orderBy('begin', 'desc')->limit(5)->get();
        } else {
            $reservations = Reservation::where('user', (object) User::find(Auth::id())->toArray())
                ->paginate(8);
        }
        return response()->json($reservations);
    }

    public function indexLecturer(Request $request){
        $limit = $request->query('limit', 0);

        if($limit > 0){
            $reservations = Reservation::orderBy('begin', 'desc')->limit(5)->get();
        } else {
            $reservations = Reservation::paginate(8);
        }
        return response()->json($reservations);
    }

    public function create(Request $request) {
        $this->validator($request->all())->validate();
        $asset = Asset::findOrFail($request->asset_id)->makeHidden(['_id', 'available'])->toArray();
        $asset['quantity'] = $request->quantity;
        $id = Auth::id();
        $user = User::findOrFail($id)->toArray();
        $reservation = Reservation::create([
            'description' => $request->description,
            'begin' => date_format(date_create($request->begin), 'd F Y, H:i'),
            'end' => date_format(date_create($request->end), 'd F Y, H:i'),
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
            'quantity' => ['required', 'gt:0']
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

    public function getCountReservation(Request $request){
        $status = $request->query('status', 'all');
        switch($status){
            case 'waiting':
                $count = Reservation::where('status', 'Waiting on approval')->count();
                break;
            case 'reserve':
                $count = Reservation::where('status', 'On Reservation')->count();
                break;
            case 'return':
                $count = Reservation::where('status', 'Returned')->count();
                break;
            case 'denied':
                $count = Reservation::where('status', 'Denied')->count();
                break;
            default:
                $count = Reservation::count();
        }
        return response()->json([ 'count' => $count ]);
    }

    public function getCountStudentReservation(Request $request){
        $status = $request->query('status', 'all');

        switch($status){
            case 'waiting':
                $count = Reservation::where('status', 'Waiting on approval')
                ->where('user', (object) User::find(Auth::id())->toArray())->count();
                break;
            case 'reserve':
                $count = Reservation::where('status', 'On Reservation')
                ->where('user', (object) User::find(Auth::id())->toArray())->count();
                break;
            case 'return':
                $count = Reservation::where('status', 'Returned')
                ->where('user', (object) User::find(Auth::id())->toArray())->count();
                break;
            case 'denied':
                $count = Reservation::where('status', 'Denied')
                ->where('user', (object) User::find(Auth::id())->toArray())->count();
                break;
            default:
                $count = Reservation::where('user', (object) User::find(Auth::id())->toArray())->count();
        }
        return response()->json([ 'count' => $count ]);
    }
}
