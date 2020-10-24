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
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nrp' => 'required',
            'class' => 'required'
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nrp' => $request->nrp,
            'class' => $request->class,
            'role' => 'student',
        ]);

        return response()->json([
            'message' => 'Successfully create account',
            'user' => $user
        ]);
    }

    public function registerLecturer(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'nip' => 'required',
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nip' => $request->nip,
            'role' => 'lecturer',
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