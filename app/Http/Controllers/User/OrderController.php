<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Posts;
use App\Orders;
use App\Sms;
use App\Helper\BBCode\BBCode;
use App\Transactions;
use App\Disputes;
use App\Reports;
use App\Sessions;

class OrderController extends Controller {
	public function index(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='trade';
		$id=$request->id;
		$uid=\Auth::user()->id;
		if(($row=Orders::find($id))==null) return view("user.notfound",$data);
		
		$path=realpath(__DIR__.'/../../../Helpers/BBCode/BBCode.php');
        include($path); 
		$bb=new BBCode();
		
		$row->autosms=$bb->render($row->autosms);
		
		if($row->uid==$uid) {
			$role=Orders::ROLE_BUYER;
		}else if($row->sellerid) {
			$role=Orders::ROLE_SELLER;
		}else{
			return view("user.notfound",$data);
		}
		$data['role']=$role;
		$data['dispute']=Disputes::where('orderid',$id)->orderBy('id')->get();
		$data['messages']=Sms::where('uid',$uid)->where('orderid')->orderBy('id')->get();
		
		$data=array_merge($data,$row->toArray());
		return view("user.order",$data);
	}
	public function release(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='trade';
		$captcha=session()->get('captcha');
		$request->validate([
			'captcha' => 'required|in:'.$captcha,
		], [
			'captcha.required' => __('auth.captcha-required'),
			'captcha.in' => __('auth.captcha-in') 
		]);
		$id=$request->id;
		$uid=\Auth::user()->id;
		if(($row=Orders::find($id))==null || $row->uid!=$uid) return view("user.notfound",$data);
		
		$row->completed=gmdate("Y-m-d H:i:s");
		$row->status=100;
		$row->save();

		if($post=Posts::find($row->pid)) {
			$post->sales++;
			$post->save();
		}
		if($trans=Transactions::where('uid',$uid)->where('wid',$row->id)->first()) {
			$trans->status=100;
			$trans->save();
		}
		if($row->sellerid>10000000 && $rowSeller=User::find($row->sellerid)) {
			$trans=Transactions::sell($row->sellerid,$row->seller,$row->price,__('app.sell', ['num'=>$row->id]),$row->id);
			$rowSeller->btc+=$trans->btcin;
			$rowSeller->calls++;
			$rowSeller->save();
			Sms::event(__lang('sms.event-order-finish',$row->id),$row->sellerid,$row->seller,$row->id);
		}
		return redirect()->back();
	}
	public function dispute(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='trade';
		$request->validate([
			'disputereason' => 'required|min:20|max:4096',
			'disputepasswd' => 'required|min:8|max:32',
		], [
			'disputereason.required' => __('post.note-required'),
			'disputereason.min' => __('post.note-min'),
			'disputereason.max' => __('post.note-max'),
			'disputepasswd.required' => __('auth.passwd-required'),
			'disputepasswd.min' => __('auth.passwd-min'),
			'disputepasswd.max' => __('auth.passwd-max'),
		]);
		
		$id=$request->id;
		$note=$request->disputereason;
		$rowUser=\Auth::user();
		$uid=$rowUser->id;
		$user=$rowUser->name;
		if(($row=Orders::find($id))==null || $row->uid!=$uid && $row->sellerid!=$uid) return view("user.notfound",$data);
		
		$row->status=Orders::STEP_DISPUTE;
		$row->save();
		Disputes::add($uid,$user,$row->id,$note);
		return redirect()->back();
	}
	public function report(Request $request) {
		$data=\App\Helper::param();
		$data['menu']='trade';
		$request->validate([
			'reportreason' => 'required|min:20|max:4096',
			'reportpasswd' => 'required|min:8|max:32',
		], [
			'reportreason.required' => __('post.note-required'),
			'reportreason.min' => __('post.note-min'),
			'reportreason.max' => __('post.note-max'),
			'reportpasswd.required' => __('auth.passwd-required'),
			'reportpasswd.min' => __('auth.passwd-min'),
			'reportpasswd.max' => __('auth.passwd-max'),
		]);
		
		$id=$request->id;
		$note=$request->reportreason;
		$rowUser=\Auth::user();
		$uid=$rowUser->id;
		$user=$rowUser->name;
		if(($row=Orders::find($id))==null || $row->uid!=$uid && $row->sellerid!=$uid) return view("user.notfound",$data);
		
		$row->status=Orders::STEP_REPORT;
		$row->save();
		Reports::add($uid,$user,$row->pid,$note);
		return redirect()->back();
	}
}
