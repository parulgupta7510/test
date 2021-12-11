<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class LoginController extends Controller {
    
    public function login(Request $request) {
    	$login = $request->validate([
    		'email' => 'required|string',
    		'password' => 'required|string'
    	]);

    	if( !Auth::attempt($login)) {
    		return response(['message' => 'Invalid Login credentials.']);
    	}

    	$user = Auth::user();
    	$accessToken = $user->createToken($user->email)->accessToken;
    	return response(['user' => Auth::user(), 'access_token' => $accessToken ]);
    }

    public function register(Request $request) {
    	$validator = Validator::make($request->all() , [
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required',
    		'password' => 'required|same:password'
    	]);

    	if( $validator->fails()) {
    		return response()->json($validator->errors(),202);
    	}

    	$input = $request->all();
    	$input['password'] = bcrypt($input['password']);

    	$user = User::create($input);

    	$responseArray = [];
    	$responseArray['token'] = $user->createToken($user->email)->accessToken;
    	$responseArray['name'] = $user->firstname . ' ' . $user->lastname;

    	return response()->json($responseArray,200);
   
    }
}
