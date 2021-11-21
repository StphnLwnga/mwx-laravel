<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use \App\Mail\MoworxMail;
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

		function password_generate($chars)
		{
			$data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz?/\\-_=*&%$#!@';
			return substr(str_shuffle($data), 0, $chars);
		}

		$names = explode(',', $request['p1']);
		$firstName = strip_tags($names[0]);
		$lastName = strip_tags($names[1]);
		$email =  strip_tags($request['p2']);
		$phone = strip_tags($request['msisdn_idnum']);
		$address = strip_tags(str_replace("KE30", "Kenya", $request['p3']));
		$paid = $request['mc'];
		$channel = $request['channel'];
		// $productId = 
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
		$productId = $products[$request['p4']];

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
				/**
				 * Generate user password
				 * Create new user in users' table and associated order in orders table
				 * Send email with credentials and link to dashboard
				 */
				$plain_password = password_generate(8);
				$password_hash = Hash::make($plain_password);

				$user = MoworxUser::create([
					'firstName' => $firstName,
					'lastName' => $lastName,
					'email' => $email,
					'phone' => $phone,
					'userAddress' => $address,
					'userPassword' => $password_hash,
					'role' => 'member',
					'school' => $school ?? null,
					'course' => $course ?? null,
					'year' => $year ?? null,
					'sales_rep' => $sales_rep ?? null,
				])->orders()->create([
					'productId' => intval($productId),
					'orderId' => $orderId,
					'invoiceId' => $invoiceId,
					'channel' => $channel,
					'cost' => floatval($paid),
				]);

				$user->save();

				$details = [
					'title' => 'User Registration',
					'test' => 'This is a test message'
				];

				Mail::to('boywilder99@gmail.com')->send(new MoworxMail(['details' => $details]));

				if (Mail::failures()) {
					$mailResponse = 'Sorry! Please try again latter';
				} else {
					$mailResponse = 'Great! Successfully send in your mail';
				}
			}

			/** Send email confirming payment */
		} else {
			/** * Handle other payment statuses */
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
			'invoice' => $orderId,
			'userid' => $userId ?? '',
		];

		return view(
			'postpayment',
			[
				'value_dump' => $request->all(),
				'values' => $values,
				'order_existed' => $orderExists ?? false,
				'mail_response' => $mailResponse,
			],
		);
	}

	public function preprocess(Request $request)
	{
		if (!isset($request) || count($request->all()) == 0) {
			return Redirect::to(env('CHECKOUT_URL'));
		}

		$description = 'Process payment before sending to iPay';
		return view('prepayment', ['description' => $description]);
	}
}
