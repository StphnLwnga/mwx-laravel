<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use App\Models\MoworxUser;
use App\Models\MoworxOrder;

class ProcessPaymentController extends Controller
{
	public function processPayment(Request $request)
	{
		if (
			!isset($request) || count($request->all()) == 0
			|| !isset($request['id']) || !isset($request['ivm'])
			|| !isset($request['qwh']) || !isset($request['afd']) 
			|| !isset($request['poi']) || !isset($request['uyt']) 
			|| !isset($request['ifd']) 
		) {
			return Redirect::to(env('HOME_URL'));
		}

		$val = 'demo';

		$val1 = $_GET["id"];
		$val2 = $_GET["ivm"];
		$val3 = $_GET["qwh"];
		$val4 = $_GET["afd"];
		$val5 = $_GET["poi"];
		$val6 = $_GET["uyt"];
		$val7 = $_GET["ifd"];

		/** Transaction verification */
		$ipnurl = "https://www.ipayafrica.com/ipn/?vendor=" . $val . "&id=" . $val1 . "&ivm=" .
		$val2 . "&qwh=" . $val3 . "&afd=" . $val4 . "&poi=" . $val5 . "&uyt=" . $val6 . "&ifd=" . $val7;
		$fp = fopen($ipnurl, "rb");
		$status = stream_get_contents($fp, -1, -1);

		fclose($fp);

		function password_generate($chars) {
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz?/\\-_=*&%$#!@';
			return substr(str_shuffle($data), 0, $chars);
		}
		
		$names = explode(',', $request['p1']);
		$firstName = $names[0];
		$lastName = $names[1];

		return view('test', ['value_dump' => $request->all()]);
	}

	public function preprocess(Request $request)
	{
		if (!isset($request) || count($request->all()) == 0) {
			return Redirect::to(env('CHECKOUT_URL'));
		}

		$description = 'Process payment before sending to iPay';
		return view('test', ['description' => $description]);
	}
}
