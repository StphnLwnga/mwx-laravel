<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\MoworxUser;
use App\Models\MoworxOrder;
// use ReallySimpleJWT\Token;

class MoworxAuthController extends BaseController
{

  public function signin(Request $request)
  {
    $email = $request->email;
    $plain_pwd =  $request->userPassword;

    $userRecord = MoworxUser::where('email', $email)->first();

    if (!$userRecord) {
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }

    $passwordVerified = Hash::check($plain_pwd, $userRecord['userPassword']);

    if (!$passwordVerified) {
      return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }

    // Retrieve matching orders
    $orders = MoworxUser::find($userRecord['id'])->orders()->get();
    $userRecord['orders'] = $orders;

    $payload = [
      'iat' => time(),
      'uid' => $userRecord['id'],
      'email' => $userRecord['email'],
      'role' => $userRecord['role'],
      'exp' => time() + 172800,
      'iss' => 'localhost'
    ];

    // $token = Token::customPayload($payload, env('JWT_SECRET'));
    // $userRecord['token'] = $token;

    // return $this->sendResponse(['token' => $token], 'User sign in');

    return $this->sendResponse($userRecord, 'User record');
  }

  public function retrieveUsers()
  {
    $users = MoworxUser::all();

    return $this->sendResponse($users, 'Moworx product list retrieved successfully.');
  }

  public function registerAffiliate(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'confirm_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return $this->sendError('Error validation', $validator->errors());
    }

    $input = $request->all();
    // $input['password'] = Hash::make($input['pa'])
  }
}
