<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register']]);
    // }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only(['email', 'password']);
    
        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        return $this->respondWithToken($token);
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function registerStudent(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nrp' => 'required',
            'grade' => 'required'
        ]);
        
        $user = User::create([
            'full_name' => $request->full_name,
            'nrp' => $request->nrp,
            'grade' => $request->grade,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Student',
        ]);

        return response()->json([
            'message' => 'Successfully create account',
            'user' => $user
        ]);
    }

    public function registerLecturer(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nip' => 'required',
        ]);
        
        $user = User::create([
            'full_name' => $request->full_name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Lecturer',
        ]);

        return response()->json([
            'message' => 'Successfully create account',
            'user' => $user
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    public function logout(){
        Auth::logout();
        return response()->json([
            'message' => 'Logout successfully'
        ]);
    }
    
}