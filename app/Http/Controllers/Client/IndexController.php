<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;

class IndexController extends Controller {
	public function index(Request $request) {
		$rowUser=\Auth::user();
		if(Orders::where('uid',$rowUser->id)->where('status',0)->first()) {
			if($rowUser->btc==0) {
				return redirect()->route('deposit');
			}
			return redirect()->route('invoice');
		}
		return redirect()->route('plan');
	}
}
