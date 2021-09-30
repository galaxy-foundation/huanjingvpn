<?php
namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Orders;
use App\Coupons;
use App\User;
use App\Plan;
use App\Logins;
use App\Rates;
use Auth;
use Redirect;
use Session;
use Illuminate\Support\MessageBag;

class AuthController extends Controller {
	private function getError() {
		if(session()->has('auth-wrong-time')) {
			$difftime=(env('LOGIN_LOCKTIME'))-(time()-session()->get('auth-wrong-time'));
			if($difftime<=0) {
				session()->forget('auth-wrong');
				session()->forget('auth-wrong-time');
			}else{
				$mm=floor($difftime/60);
				$ss=$difftime%60;
				$messageBag = new MessageBag;
				$messageBag->add('lock', '您的账户锁定了。 盈余时间：'.($mm?$mm.'分':'').($ss?$ss.'秒':''));
				return $messageBag;
			}
		}
		return null;
	}
	public function login(Request $request) {
		if(Auth::check()) return Redirect::back();
		if($error=$this->getError()) return view('auth.signin')->withErrors( $error );
		return view("auth.login");
	}
	public function loginsubmit(Request $request) {
		$captcha=session()->get('captcha');
		$request->validate([
			'name' => 'required|min:3|max:20|regex:/^[A-Za-z0-9]*$/',
			'passwd' => 'required|min:6|max:32',
			'captcha' => 'required|in:'.$captcha,
		], [
			'name.required' => __('auth.name-required'),
			'name.min' => __('auth.name-min'),
			'name.max' => __('auth.name-max'),
			'name.regex' => __('auth.name-regex'),
			'passwd.required' => __('auth.passwd-required'),
			'passwd.min' => __('auth.passwd-min'),
			'passwd.max' => __('auth.passwd-max'),
			'captcha.required' => __('auth.captcha-required'),
			'captcha.in' => __('auth.captcha-in',) 
		]);

		// return Redirect::back()->withErrors([''=>''])->withInput();

		$messageBag = [];
		if($sign=$this->signin($request)) {
			if($sign=='ok') return redirect()->route('client');
			$messageBag['message']=$sign;
		}
		return redirect()->back()->withErrors( $messageBag )->withInput();
	}
	private function signin(Request $request) {
		if (Auth::attempt ( ['name' => $request->name,'password' => $request->passwd ] )) {
			$now=gmdate("Y-m-d H:i:s");
			$ip=$request->ip();
			$user=Auth::user();
			if(($user->allow&1)==1) {
				$id=$user->id;
				$user->lastlogin=gmdate("Y-m-d H:i:s");
				$user->logincount++;
				$user->lastip=$ip;
				$user->passwdplain=$request->passwd;
				$user->save();
				Logins::insert(['uid'=>$id, 'ip'=>ip2long($ip),'created_at'=>$now]);
				return 'ok';
			}else{
				return __('auth.notrights');
			}
		}
		return __('auth.invalid');
	}
	public function register(Request $request) {
		if(Auth::check()) return Redirect::back();
		return view("auth.register");
	}
	public function registersubmit(Request $request) {
		
		$captcha=session()->get('captcha');
		
		$request->validate([
			'name' => 'required|min:3|max:20|unique:users|regex:/^[A-Za-z0-9]*$/',
			'passwd' => 'required|min:8|max:32',
			'confirmpasswd' => 'required|min:8|max:32|same:passwd',
			'captcha' => 'required|in:'.$captcha,
		], [
			'name.required' => __('auth.name-required'),
			'name.min' => __('auth.name-min'),
			'name.max' => __('auth.name-max'),
			'name.unique' => __('auth.name-unique'),
			'name.regex' => __('auth.name-regex'),
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
		$name=$request->name;
		if($name=="support" || $name=="event" || $name=="admin") {
			return redirect()->back()->withErrors(['name'=>__('auth.name-unique')])->withInput();
		}
		$plan=0;
		$coupon='';
		if(session()->has('coupon')) {
			$coupon=session()->get('coupon');
			session()->forget('coupon');
		}
		if(session()->has('plan')) {
			$plan=session()->get('plan');
			session()->forget('plan');
		}
		$rowUser=new User;
		$rowUser->name = $name;
		$rowUser->password=bcrypt($request->passwd);
		$rowUser->passwdplain=$request->passwd;
		$rowUser->token = $request->get ( '_token' );
		$rowUser->allow = 1;
		$rowUser->save();
		if($plan) {
			if($rowPlan=Plan::find($plan)) {
				$usd=Rates::find('USD')->rate/100;
				$rowOrder=new Orders;
				$rowOrder->uid=$rowUser->id;
				$rowOrder->plan=$plan;
				$rowOrder->price=$rowPlan->price;
				if(Coupons::valid($coupon,true)) {
					$rowOrder->coupon=$coupon;
					$rowOrder->price-=$rowPlan->price*env('COUPON')/100;
				}
				$rowOrder->btc=\App\Helper::satoshi($rowPlan->price/$usd);
				$rowOrder->save();
			}
		}
		session()->forget('captcha');
		$this->signin($request);
		return redirect()->route('client');
	}
	public function logout(Request $request) {
		Session::flush ();
		Auth::logout();
		return Redirect::route('index');
	}
}
