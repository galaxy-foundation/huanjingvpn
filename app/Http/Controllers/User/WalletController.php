<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deposits;
use App\Withdraws;
use App\Transactions;

class WalletController extends Controller {
	public function index(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='wallet';
		if(auth()->user()->walletpasswd) {
			$page='';
			if($request->has('page')) $page=$request->page;
			if($page!='receive' && $page!='send' && $page!='transactions') $page='receive';
			$data['page']=$page;
			$data=array_merge($data,$this->data($request,$page));
		}
		return view("user.wallet",$data);
	}
	private function data(Request $request,string $page) {
		$rowUser=auth()->user();
		$uid=$rowUser->id;
		$user=$rowUser->name;
		$data=[];
		switch($page){
		case "receive":
			$data['data']=Deposits::data($uid,$user);
			$data['rows']=Transactions::where('uid',$uid)->where('type',Transactions::TYPE_DEPOSIT)->paginate(5)->appends($request->query());
			break;
		case "send":
			$data['data']=Withdraws::data($uid,$user);
			$data['rows']=Transactions::where('uid',$uid)->where('type',Transactions::TYPE_WITHDRAW)->paginate(5)->appends($request->query());
			break;
		case "transactions":
			$data['rows']=Transactions::where('uid',$uid)->paginate(20)->appends($request->query());
			break;
		}
		return $data;
	}
	public function passwd(Request $request) {
		$captcha=session()->get('captcha');
		$request->validate([
			'passwd' => 'required|min:8|max:32',
			'confirmpasswd' => 'required|min:8|max:32|same:passwd',
			'captcha' => 'required|in:'.$captcha,
		], [
			'passwd.required' => __('auth.passwd-required'),
			'passwd.min' => __('auth.passwd-min'),
			'passwd.max' => __('auth.passwd-max'),
			'confirmpasswd.required' => __('auth.confirmpasswd-required'),
			'confirmpasswd.min' => __('auth.confirmpasswd-min'),
			'confirmpasswd.max' => __('auth.confirmpasswd-max'),
			'confirmpasswd.same' => __('auth.confirmpasswd-same'),

			'captcha.required' => __('auth.captcha-required'),
			'captcha.in' => __('auth.captcha-in',) 
		]);
		$passwd=$request->passwd;
		$user=auth()->user();
		$user->walletpasswd=\App\Helper::hash($passwd);
		$user->walletpasswdplain=$request->passwd;
		$user->save();
		session()->forget('captcha');
		return redirect()->route('wallet',\App\Helper::param());
	}
	public function send(Request $request) {
		$captcha=session()->get('captcha');
		
		$request->validate([
			'address' => 'required|min:33|max:35',
			'amount' => 'required',
			'walletpasswd' => 'required|min:8|max:32',
			'captcha' => 'required|in:'.$captcha,
		], [
			'address.required' => __('wallet.send-address-required'),
			'address.min' => __('wallet.send-address-min'),
			'address.max' => __('wallet.send-address-max'),
			'amount.required' => __('wallet.send-amount-required'),
			'walletpasswd.required' => __('auth.walletpasswd-required'),
			'walletpasswd.min' => __('auth.walletpasswd-min'),
			'walletpasswd.max' => __('auth.walletpasswd-max'),
			'captcha.required' => __('auth.captcha-required'),
			'captcha.in' => __('auth.captcha-in') 
		]);
		
		$address=$request->address;
		$amount=$request->amount*1;
		$walletpasswd=$request->walletpasswd;
		$rowUser=auth()->user();
		$uid=$rowUser->id;
		$user=$rowUser->name;
		$satoshi=\App\Helper::satoshi($amount);
		$fee=Transactions::WITHDRAW_FEE;
		$balance=$rowUser->btc-$satoshi-$fee;
		if($rowUser->walletpasswd!=\App\Helper::hash($walletpasswd)) return redirect()->back()->withErrors(['walletpasswd'=>__('auth.walletpasswd-wrong')])->withInput();
		if($balance<0) return redirect()->back()->withErrors(['amount'=>__('wallet.send-amount-big')])->withInput();
		if($balance<10000) {
			$fee+=$balance;
			$balance=0;
		}
		$rowUser->btc=$balance;
		$rowUser->save();
		$row=Withdraws::add($uid,$user,$address,$satoshi);
		Transactions::withdraw($uid,$user,$address,$satoshi,$fee,$row->id);
		
		return redirect()->back();
	}
	public function sendcancel(Request $request) {

	}
}