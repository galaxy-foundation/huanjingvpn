<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Orders extends Model {
	public const MONTHLY = 'monthly';
	public const ANNUALLY = 'annually';
	public static function status($status) {
		if($status==100) return __('client.order-paid');
		return __('client.order-unpaid');
	}
}
