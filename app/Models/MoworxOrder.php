<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class MoworxOrder extends Model
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'moworx_orders';

	/**
	 * All model properties can be altered
	 * 
	 * @var array 
	 */
	protected $guarded = [];

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	// public $timestamps = false;

	public function user()
	{
		return $this->belongsTo(MoworxUser::class);
	}
}
