<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transactions;
use App\Posts;
use App\Incomes;

class PostController extends Controller {
	public function index(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='post';
		$uid=\Auth::user()->id;
		if(($row=Posts::where('uid',$uid)->where('allow',0)->first())==null) {
			$row=new \stdclass;
			$row->title='';
			$row->titlecolor='';
			$row->note='';
			$row->price='';
			$row->autosms='';
		}
		$data['data']=$row;
		return view("user.post",$data);
	}
	public function send(Request $request) {
		$captcha=session()->get('captcha');
		
		$request->validate([
			'title' => 'required|min:6|max:60',
			'note' => 'required|min:20|max:4096',
			'price' => 'required',
			'walletpasswd' => 'required|min:8|max:32',
			'captcha' => 'required|in:'.$captcha,
		], [
			'title.required' => __('post.title-required'),
			'title.min' => __('post.title-min'),
			'title.max' => __('post.title-max'),
			'note.required' => __('post.note-required'),
			'note.min' => __('post.note-min'),
			'note.max' => __('post.note-max'),
			'autosms.required' => __('post.autosms-required'),
			'autosms.min' => __('post.autosms-min'),
			'autosms.max' => __('post.autosms-max'),
			'price.required' => __('post.price-required'),
			'walletpasswd.required' => __('auth.walletpasswd-required'),
			'walletpasswd.min' => __('auth.walletpasswd-min'),
			'walletpasswd.max' => __('auth.walletpasswd-max'),
			'captcha.required' => __('auth.captcha-required'),
			'captcha.in' => __('auth.captcha-in') 
		]);
		$title=$request->title;
		$titlecolor=$request->titlecolor;
		$note=$request->note;
		$price=$request->price*1;
		$autosms=$request->autosms;
		$walletpasswd=$request->walletpasswd;
		$rowUser=\Auth::user();
		$uid=$rowUser->id;
		$user=$rowUser->name;
		$balance=$rowUser->btc;
		$btc=\App\Helper::btc($balance - Transactions::POST_FEE);
		
		if(($row=Posts::where('uid',$uid)->where('allow',0)->first())==null) {
			$row=new Posts;
			$row->uid=$uid;
			$row->user=$user;
			$row->type=Posts::TRADE;
		}
		$row->title=$title;
		$row->titlecolor=$titlecolor;
		$row->note=$note;
		$row->price=\App\Helper::satoshi($price);
		$row->autosms=$autosms;
		$row->save();
		if($btc<0) return redirect()->back()->withErrors(['deposit'=>1]);
		if($rowUser->walletpasswd!=\App\Helper::hash($walletpasswd)) return redirect()->back()->withErrors(['walletpasswd'=>__('auth.walletpasswd-wrong')]);

		$balance=$rowUser->btc-Transactions::POST_FEE;
		$rowUser->btc=$balance<10000?0:$balance;
		$rowUser->save();
		Transactions::spend($uid,$user,Transactions::TRADE_FEE,0,Transactions::POST_FEE,__('post.payfee'));
		Incomes::add(Transactions::POST_FEE,0,__('post.payfee'));
		$row->etag=\App\Helper::hash($row->id.".$uid.$price");
		$row->allow=100;
		$row->save();

		$data=\App\Helper::param();
		$data['id']=$row->id;
		$data['etag']=$row->etag;
		return redirect()->route('view',$data);
	}
}
