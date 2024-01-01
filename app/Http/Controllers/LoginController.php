<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Validator;



class LoginController extends Controller
{
    // public function login(Request $request) {
    //     $credentials = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
    //     if (! auth()::attempt($credentials)) {
    //         throw ValidationException::withMessages([
    //             'email' => [
    //                 __('auth.failed'),
    //             ]
    //         ]);
    //     }
    //     return $request->user();
    // }
    // public function logout(Request $request){
    //    return auth()->logout();
    // }
    // public function csrfCookie(Request $request) {
    //     return response()->json(['message' => 'CSRF cookie set']);
    // }


    public function loginUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Response(['message' => $validator->errors()], 401);
        }

        if (Auth::attempt($request->all())) {

            $user = Auth::user();

            $userToken =  $user->createToken('MyApp')->plainTextToken;

            return Response(['token' => $userToken], 200);
        }

        return Response(['message' => 'email or password wrong'], 401);
    }

    //register user
    public function register(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|string',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|string|min:3|confirmed',
        // ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 201);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function userDetails(): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            return Response(['data' => $user], 200);
        }

        return Response(['data' => 'Unauthorized'], 401);
    }
    /**
     * Display the specified resource.
     */
    public function logout(): Response
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return Response(['data' => 'User Logout successfully.'], 200);
    }
}