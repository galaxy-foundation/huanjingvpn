<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rates;
use App\Plan;
class PlanController extends Controller {
	public function index(Request $request) {
		$data['usd']=Rates::find('USD')->rate;
		$data['cny']=Rates::find('CNY')->rate;
		$plan=Plan::orderBy('id')->get()->toArray();
		$plan['coupon']=env('COUPON');
		return view('client.plan', ['slug'=>'plan','data'=>$data,'plan'=>$plan]);
	}
}
