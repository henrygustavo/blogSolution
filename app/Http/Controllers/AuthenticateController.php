<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\User;

class AuthenticateController extends Controller
{
	
	/**
	* @var \Tymon\JWTAuth\JWTAuth
			     */
	protected $jwt;
	
	public function __construct(JWTAuth $jwt){
		$this->jwt = $jwt;
       
		$this->middleware('jwt.auth.permissions:admin', ['only' => ['index','getAuthenticatedUser']]);
	}
	
      public function index() {
        // Retrieve all the users in the database and return them
       $users = User::all();
        return $users;
    }

	public function authenticate(LoginRequest $request){
		try {
			
			if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
				return response()->json(['error' =>'user_not_found'], 404);
			}
			
		}
		catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
			
			return response()->json(['error' =>'token_expired'], 500);
			
		}
		catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			
			return response()->json(['error' =>'token_invalid'], 500);
			
		}
		catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
			
			return response()->json(['error' => $e->getMessage()], 500);
			
		}
		
		$user = User::where('email', '=', $request['email'])->first();
		$role = $user->roles->first();
		$user ->claims = ['role' => $role->name];
		$token = $this->jwt->fromUser($user);
		
		return response()->json(compact('token'));
	}
	
	public function getAuthenticatedUser() {
		try {
			
			if (!$user = $this->jwt->parseToken()->authenticate()) {
				return response()->json(['error' => 'user_not_found'], 404);
			}
		}
		catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
			
			return response()->json(['error' => 'token_expired'], 500);
		}
		catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
			
			return response()->json(['error' => 'token_invalid'], 500);
		}
		catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
			
			return response()->json(['error' => 'token_absent'], 500);
		}
		
		// 		the token is valid and we have found the user via the sub claim
	    return response()->json($this->jwt->getPayload());
	}
}
