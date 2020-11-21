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
        $asset = Asset::findOrFail($request->asset_id)->makeHidden(['available'])->toArray();
        $asset['quantity'] = (int) $request->quantity;
        $id = Auth::id();
        $user = User::findOrFail($id)->toArray();
        $reservation = Reservation::create([
            'description' => $request->description,
            'begin' => date_format(date_create($request->begin), 'd F Y'),
            'end' => date_format(date_create($request->end), 'd F Y'),
            'user' => (object)$user,
            'asset' => (object)$asset,
        ]);

        $reservation->history()->create([
            'datetime' => date('d F Y, H:i')
        ]);

        return response()->json([
            'message' => 'Successfully create new reservation',
            'reservation' => $reservation
        ]);
    }

    public function search(Request $request){
        $assetName = $request->query('asset');
        $status = $request->query('status');

        if ($assetName == null && $status == null){
            if(Auth::user()->role == 'Lecturer'){
                return redirect('api/reservations');
            } else {
                return redirect('api/reservations/student');
            }
        } else if ($assetName != null && $status == null) {
            $assetName = '%'.$assetName.'%';
            $reservations = Reservation::where('asset.name', 'like', $assetName)->paginate(8);
            return response()->json($reservations);
        } else if ($assetName == null && $status != null) {
            $reservations = Reservation::where('status', $status)->paginate(8);
            return response()->json($reservations);
        } else {
            $assetName = '%'.$assetName.'%';
            $reservations = Reservation::where('asset.name', 'like', $assetName)
                            ->where('status', $status)->paginate(8);
            return response()->json($reservations);
        }
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

        $reservation->history()->create([
            'datetime' => date('d F Y, H:i'),
            'status' => $request->status,
            'description' => $request->description
        ]);

        if ($request->status == 'On Reservation'){
            $asset = Asset::findOrFail($reservation->asset->_id);
            $asset->available -= $reservation->asset->quantity;
            $asset->save();
        } else if ($request->status == 'Returned'){
            $asset = Asset::findOrFail($reservation->asset->_id);
            $asset->available += $reservation->asset->quantity;
            $asset->save();
        }

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

    public function assetRequest(Request $request, $id){
        $asset = Asset::findOrFail($id);
        $reservation = Reservation::where('asset.name', $asset->name)->get();

        $date_begin = date_create($request->begin);
        $date_finish = date_create($request->end);
        $interval = date_diff($date_begin, $date_finish);

        $day = (int)$date_begin->format('d');
        $array = [];

        for($i = $day; $i <= $day + (int) $interval->format('%a'); $i++){
            $quantity = $asset->quantity;
            foreach($reservation as $r){
                $reservation_begin = (int)date_format(date_create($r->begin), 'd');
                $reservation_end = (int)date_format(date_create($r->end), 'd');

                if ($i >= $reservation_begin && $i <= $reservation_end){
                    $quantity -= $r->asset->quantity;
                }
            }
            array_push($array, $quantity);
        }

        $min = $array[0];

        for($i = 0; $i < count($array); $i++){
            if ($array[$i] < $min){
                $min = $array[$i];
            }
        }

        if ($min < (int)$request->quantity){
            return response()->json([
                'status' => 'NOT AVAILABLE'
            ]);
        } else {
            return response()->json([
                'status' => 'AVAILABLE'
            ]);
        }
    }

}
