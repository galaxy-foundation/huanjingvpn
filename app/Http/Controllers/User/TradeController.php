<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;
class TradeController extends Controller {
	public function index(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='trade';
		$uid=\Auth::user()->id;
		$data['rows'] = Orders::where(function($query) use($uid){
			$query->where('uid', $uid)->orWhere('sellerid', $uid);
		})->orderBy('status')->orderBy('id','desc')->paginate(20)->appends($request->query());
		return view("user.trade",$data);
	}
}