<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use \Auth;
// use \Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	protected $user;

	public function __construct()
	{
		$this->middleware("auth:api", ["except" => ["login", "register"]]);
		$this->user = new User;
	}

	public function register(Request $request)
	{

		/** User Password generating function */
		function password_generate($chars)
		{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz?/\\-_=*&%$#!@';
			return substr(str_shuffle($data), 0, $chars);
		}

		$password = password_generate(8);

		$data = [
			"name" => $request->name,
			"email" => $request->email,
			"password" => Hash::make($password),
		];
		$this->user->create($data);
		$responseMessage = "Successful Affiliate Registration";
		return response()->json([
			'success' => true,
			'message' => $responseMessage
		], 200);
	}

	public function login(Request $request)
	{
		
	}

	public function viewProfile()
	{
		
	}

	public function logout()
	{
		
	}
}
