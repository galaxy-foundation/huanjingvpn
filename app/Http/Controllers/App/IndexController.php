<?php
namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rates;
use App\Orders;
use App\Coupons;
use App\Plan;
use Mail;
use App\Wallets;
class IndexController extends Controller {
	public function index(Request $request) {
		/* set_time_limit(0);
		ini_set('memory_limit', '1024M');
		foreach(Wallets::all() as $row) {
			$row->key=\App\Helper::decrypt($row->address);
			$row->priv=\App\Helper::decrypt($row->privkey);
			$row->address=\App\Helper::enc($row->key);
			$row->privkey=\App\Helper::enc($row->priv);
			echo "<p>".$row->key;
			$row->save();
		}
		dd("OK"); */



		if(\Auth::check()) {
			return redirect()->route('client');
		}
		$data['usd']=Rates::find('USD')->rate;
		$data['cny']=Rates::find('CNY')->rate;
		$plan=Plan::orderBy('id')->get()->toArray();
		$plan['coupon']=env('COUPON');
		return view('index',['data'=>$data,'plan'=>$plan]);
	}
	public function plan(Request $request) {
		session(['plan'=>$request->plan,'coupon'=>$request->coupon]);
		return response()->json(['status'=>'ok']);
	}
	public function coupon(Request $request) {
		return response()->json(['status'=>Coupons::valid($request->coupon)?'ok':'error']);
	}
	public function en(Request $request) {
		session(['lang'=>'en']);
		return redirect()->back();
	}
	public function zh(Request $request) {
		session(['lang'=>'zh']);
		return redirect()->back();
	}
}
