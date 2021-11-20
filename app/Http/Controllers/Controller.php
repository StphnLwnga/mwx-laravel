<?php
// TAKE NOTE OF THIS***
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respondWithToken($token, $responseMsg, $data) {
        return \response() -> json([
            "success" => true,
            "message" => $responseMsg,
            "data" => $data,
            "token" => $token,
            "token_type" => "bearer",
        ], 200);
    }
}
