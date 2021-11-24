<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use \App\Models\MoworxUser;
use \App\Models\MoworxOrder;
use \App\Models\Unregistered;

use \App\Mail\MoworxMail;

class ProcessPaymentController extends Controller
{
	public function preprocess(Request $request)
	{
		if (
			!isset($request) || count($request->all()) == 0
			|| !isset($request['billing_first_name']) || !isset($request['billing_last_name'])
			|| !isset($request['billing_city']) || !isset($request['billing_state'])
			|| !isset($request['billing_email']) || !isset($request['product_name'])
			|| !isset($request['occupation']) || !isset($request['product_total']) || !isset($request['billing_country'])
		) {
			return Redirect::to(env('CHECKOUT_URL'));
		}

		$counties = [
			"KE01" => "Baringo",
			"KE02" => "Bomet",
			"KE03" => "Bungoma",
			"KE04" => "Busia",
			"KE05" => "Elgeyo-Marakwet",
			"KE06" => "Embu",
			"KE07" => "Garissa",
			"KE08" => "Homa Bay",
			"KE09" => "Isiolo",
			"KE10" => "Kajiado",
			"KE11" => "Kakamega",
			"KE12" => "Kericho",
			"KE13" => "Kiambu",
			"KE14" => "Kilifi",
			"KE15" => "Kirinyaga",
			"KE16" => "Kisii",
			"KE17" => "Kisumu",
			"KE18" => "Kitui",
			"KE19" => "Kwale",
			"KE20" => "Laikipia",
			"KE21" => "Lamu",
			"KE22" => "Machakos",
			"KE23" => "Makueni",
			"KE24" => "Mandera",
			"KE25" => "Marsabit",
			"KE26" => "Meru",
			"KE27" => "Migori",
			"KE28" => "Mombasa",
			"KE29" => "Murang’a",
			"KE30" => "Nairobi County",
			"KE31" => "Nakuru",
			"KE32" => "Nandi",
			"KE33" => "Narok",
			"KE34" => "Nyamira",
			"KE35" => "Nyandarua",
			"KE36" => "Nyeri",
			"KE37" => "Samburu",
			"KE38" => "Siaya",
			"KE39" => "Taita-Taveta",
			"KE40" => "Tana River",
			"KE41" => "Tharaka-Nithi",
			"KE42" => "Trans Nzoia",
			"KE43" => "Turkana",
			"KE44" => "Uasin Gishu",
			"KE45" => "Vihiga",
			"KE46" => "Wajir",
			"KE47" => "West Pokot",
		];

		$email = $request['billing_email'];
		$phone = $request['billing_phone'];
		$firstName = $request['billing_first_name'];
		$lastName = $request['billing_last_name'];
		$city = $request['billing_city'];
		$billing_state = $counties[$request['billing_state']];
		$productName = $request['product_name'];
		$occupation = $request['occupation'];
		$school = $request['learning_institution'];
		$course = $request['study_course'];
		$year = intval($request['study_year']);
		$product_total = $request['product_total'];
		$residence = $request['residential_address'];
		$sales_rep = $request['sales_rep'];
		$billing_country = 'Kenya';

		$address = isset($residence) ? strip_tags($residence) . ', ' : '';
		$address .= strip_tags($city) . ', ' . $billing_state;

		/** Check if user exists in unregistered and get the last userId */
		$unregisteredUserExists = Unregistered::where('email', $email)->exists();

		$userId = null;

		/** Find user details in unregistered Save unregistered user and return id */
		if ($unregisteredUserExists) {
			$userId = Unregistered::where('email', $email)->first()->id;
		} else {
			$userId = Unregistered::insertGetId([
				'first_name' => strip_tags($firstName),
				'last_name' => strip_tags($lastName),
				'phone' => strip_tags($phone),
				'email' => strip_tags($email),
				'address' => $address,
				'occupation' => strip_tags($occupation),
				'school' => strip_tags($school),
				'course' => strip_tags($course),
				'year' => $year,
				'sales_rep' => strip_tags($sales_rep),
			]);
		}

		/** Random thread generator for invoice numbers */
		function guidv4($data = null)
		{
			// Generate 16 bytes (128 bits) of random data or use the data passed into the function.
			$data = $data ?? random_bytes(16);
			assert(strlen($data) == 16);

			// Set version to 0100
			$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
			// Set bits 6-7 to 10
			$data[8] = chr(ord($data[8]) & 0x3f | 0x80);

			// Output the 36 character UUID.
			return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
		}

		$oid = guidv4();
		$oid = strtoupper('mwx_' . substr($oid, 0, 8));

		/** Send details to payment gateway */
		$live = env('IPAY_LIVE');
		$total = env('IPAY_TOTAL');
		$vid = env('IPAY_VID');
		$cbk = env('IPAY_CBK');

		$ipay_fields = array(
			"live" => $live,
			"oid" => $oid,
			"inv" => $oid,
			"ttl" => $total !== null ? $total : $product_total,
			"tel" => $phone,
			"eml" => $email,
			"vid" => $vid,
			"curr" => "KES",
			"p1" => "{$userId}",
			"p2" => $productName,
			"p3" => '',
			"p4" => '',
			"cbk" => $cbk,
			"cst" => "1",
			"crl" => "0"
		);

		$dataString = $ipay_fields['live'] . $ipay_fields['oid'] . $ipay_fields['inv'] . $ipay_fields['ttl'] . $ipay_fields['tel'] . $ipay_fields['eml'] . $ipay_fields['vid'] . $ipay_fields['curr'] . $ipay_fields['p1'] . $ipay_fields['p2'] . $ipay_fields['p3'] . $ipay_fields['p4'] . $ipay_fields['cbk'] . $ipay_fields['cst'] . $ipay_fields['crl'];

		$generated_hash = hash_hmac('sha1', $dataString, env('IPAY_HASHKEY'));

		$ipay_fields['hsh'] = $generated_hash;

		/** Display spinner while payment gateway loads */
		return view('prepayment', ['fields' => $ipay_fields, 'pay_url' => env('IPAY_PAY_URL')]);
	}

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

		$val1 = $request["id"];
		$val2 = $request["ivm"];
		$val3 = $request["qwh"];
		$val4 = $request["afd"];
		$val5 = $request["poi"];
		$val6 = $request["uyt"];
		$val7 = $request["ifd"];

		/** Transaction verification */
		$ipnurl = "https://www.ipayafrica.com/ipn/?vendor=" . $val . "&id=" . $val1 . "&ivm=" .
			$val2 . "&qwh=" . $val3 . "&afd=" . $val4 . "&poi=" . $val5 . "&uyt=" . $val6 . "&ifd=" . $val7;
		$fp = fopen($ipnurl, "rb");
		$status = stream_get_contents($fp, -1, -1);

		fclose($fp);

		function password_generate($chars)
		{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz?/\\-_=*&%$#!@';
			return substr(str_shuffle($data), 0, $chars);
		}

		/** Retrieve user from unregistered table now readyto be registered */
		$userIdUnreg = intval($request['p1']);

		$unregUser = Unregistered::findOrFail($userIdUnreg);

		$firstName = $unregUser['first_name'];
		$lastName = $unregUser['last_name'];
		$email =  $unregUser['email'];
		$phone = $unregUser['phone'];
		$address = $unregUser['address'];
		$occupation = $unregUser['occupation'];
		$school = $unregUser['school'];
		$course = $unregUser['course'];
		$year = $unregUser['year'];
		$sales_rep = $unregUser['sales_rep'];

		$paid = $request['mc'];
		$channel = $request['channel'];
		$orderId = $request['txncd'];
		$invoiceId = $request['id'];

		if ($val == 'demo') {
			$state = 'Success<sup>*</sup>  <i class="far fa-check-circle" style="color:#8ec444;"></i>';
			$message = 'The transaction is valid. *(This message is for demo purposes only. The appropriate status & message will be diplayed here once in LIVE mode)';
		} else {
			switch ($status) {
				case 'aei7p7yrx4ae34':
					$state = 'Success  <i class="far fa-check-circle" style="color:#8ec444;"></i>';
					$message = 'The transaction is valid.';
					break;

				case 'bdi6p2yy76etrs':
					$state = 'Pending <i class="fas fa-clock" style="color:#8ec444;"></i>';
					$message = 'Incoming Mobile Money Transaction Not found. Please try again in 5 minutes.';
					break;

				case 'cr5i3pgy9867e1':
					$state = 'Used <i class="fas fa-recycle" style="color:#8ec444;"></i>';
					$message = 'This code has been used already';
					break;

				case 'dtfi4p7yty45wq':
					$state = 'Less <i class="fas fa-battery-empty" text-danger"></i>';
					$message = 'The amount that you have sent via mobile money is LESS than what was required';
					break;

				case 'eq3i7p5yt7645e':
					$state = 'More <i class="fas fa-arrow-circle-up" style="color:#8ec444;"></i>';
					$message = 'The amount that you have sent via mobile money is MORE than what was required';
					break;

				default:
					$state = 'Failed <i class="fas fa-times-circle text-danger"></i>';
					$message = 'Failed transaction. Not all parameters fulfilled. ';
					break;
			}
		}

		$products = array('Know More' => 7175, 'Access More' => 7176, 'Make More' => 7177, 'Become More' => 7178);
		$productId = $products[$request['p2']];

		$mailResponse = '';

		/** Write to table */
		if ($state == "Success" || $val == "demo") {

			$userExists = MoworxUser::where('email', $email)->exists();
			if ($userExists) {
				/** Create new order in orders table */
				$userId = MoworxUser::where('email', $email)->first()->id;

				$orderExists = MoworxOrder::where([
					['userId', $userId],
					['orderId', $orderId],
					['invoiceId', $invoiceId],
				])->exists();

				if (!$orderExists) {
					$newOrder = MoworxOrder::create([
						'userId' => intval($userId),
						'productId' => intval($productId),
						'orderId' => $orderId,
						'invoiceId' => $invoiceId,
						'channel' => $channel,
						'cost' => floatval($paid),
					]);

					$newOrder->save();
				}
			} else {
				/** Generate user password */
				$plain_password = password_generate(8);
				$password_hash = Hash::make($plain_password);

				/** Create new user in users' table and associated order in orders table */
				$user = MoworxUser::create([
					'firstName' => $firstName,
					'lastName' => $lastName,
					'email' => $email,
					'phone' => $phone,
					'userAddress' => $address,
					'userPassword' => $password_hash,
					'role' => 'member',
					'occupation' => $occupation,
					'school' => $school,
					'course' => $course,
					'year' => $year,
					'sales_rep' => $sales_rep,
				])->orders()->create([
					'productId' => intval($productId),
					'orderId' => $orderId,
					'invoiceId' => $invoiceId,
					'channel' => $channel,
					'cost' => floatval($paid),
				]);

				$user->save();

				$details = [
					'credentials' => 'true',
					'name' => $firstName . ' ' . $lastName,
					'email' => $email,
					'password' => $plain_password,
					'productName' => $request['p2'],
					'dashboard' => env('DASHBOARD_URL'),
				];

				/** Send email with credentials and link to dashboard */
				$subject = 'Credentials';

				try {
					Mail::to($email)
						->bcc(env('MAIL_BCC_2'))
						->send(new MoworxMail($details, $subject));
					$mailResponse = 'success';
				} catch (\Exception $ex) {
					// $ex->getMessage();
					$mailResponse = 'failed';
				}
			}

			/** Delete user from unregistered table */
			$unregUser->delete();

			/** Send email confirming payment */
			// $details = null;
			$subject2 = 'Payment Confirmation';

			$details = [
				'paid' => 'true',
				'name' => $firstName . ' ' . $lastName,
				'email' => $email,
				'productName' => $request['p2'],
				'orderId' => $orderId,
				'invoiceId' => $invoiceId,
				'channel' => $channel,
				'cost' => $paid,
			];

			try {
				Mail::to($email)
					->bcc(env('MAIL_BCC_2'))
					->send(new MoworxMail($details, $subject2));
				$mailResponse = 'success';
			} catch (\Exception $ex) {
				// $ex->getMessage();
				$mailResponse = 'failed';
			}

			/** Send values to be displayed to user briefly */
			$values = isset($orderExists) && $orderExists === true ? [] : [
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'amount' => $paid,
				'channel' => $channel,
				'invoiceId' => $invoiceId,
				'cost' => $paid,
				'userid' => $userId ?? '',
				'state' => $state,
				'message' => $message,
				'productName' => $request['p2'],
				'dashboard' => env('DASHBOARD_URL'),
			];

			return view(
				'postpayment',
				[
					'values' => $values,
					'order_existed' => $orderExists ?? false,
					'mail_response' => $mailResponse,
				],
			);
		} else {
			/** * Handle other payment statuses */
			return view(
				'postpayment',
				[
					'error' => 'true',
					'state' => $state,
					'message' => $message,
				],
			);
		}
	}
}
