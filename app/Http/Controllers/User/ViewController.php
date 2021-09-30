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
use App\Sessions;

class ViewController extends Controller {
	public function index(Request $request) {
        $id=$request->id;
        $etag=$request->etag;
        $data=\App\Helper::param();
        $data['menu']='home';
        if(!(($row=Posts::find($id)) && $row->etag==$etag)) return view("user.notfound",$data);
        $path=realpath(__DIR__.'/../../../Helpers/BBCode/BBCode.php');
        include($path); 
        $bb=new BBCode();
        $row->note=$bb->render($row->note);

        if($rowUser=User::find($row->uid)) {
            $online=Sessions::where('user_id',$row->uid)->orderBy('last_activity','desc')->first()?1:0;
            
            $data['userinfo']=[
                'online' => $online,
                'trades' => Posts::where('uid',$row->uid)->sum('sales'),
                'created' => $rowUser->created_at,
            ];
        }else{
            $data['userinfo']=[
                'online' => 0,
                'trades' => 0,
                'created' => "",
            ];
        }
        

        $data=array_merge($data,$row->toArray());
        return view("user.view",$data);
    }
    public function submit(Request $request) {
        $data=\App\Helper::param();
        $captcha=session()->get('captcha');
		$request->validate([
			'walletpasswd' => 'required|min:8|max:32',
			'captcha' => 'required|in:'.$captcha,
		], [
			'walletpasswd.required' => __('auth.walletpasswd-required'),
			'walletpasswd.min' => __('auth.walletpasswd-min'),
			'walletpasswd.max' => __('auth.walletpasswd-max'),
			'captcha.required' => __('auth.captcha-required'),
			'captcha.in' => __('auth.captcha-in') 
        ]);
        $pid=$request->pid;
        $walletpasswd=$request->walletpasswd;
        if(($post=Posts::find($pid))==null) {
            return view("user.notfound",$data);
        }
        
        $rowUser=\Auth::user();
        $uid=$rowUser->id;
        $user=$rowUser->name;
        $sellerid=$post->uid;
        $seller=$post->user;
        $price=$post->price;
        $balance=$rowUser->btc;
        $btc=$balance - $price;
        if($btc<0) return redirect()->back()->withErrors(['deposit'=>1]);
        if($rowUser->walletpasswd!=\App\Helper::hash($walletpasswd)) return redirect()->back()->withErrors(['walletpasswd'=>__('auth.walletpasswd-wrong')]);
        $rowUser->btc=$btc;
        $orderid=Orders::add($uid,$user,$sellerid,$seller,$pid,$post->title,$post->autosms,$price);
        Transactions::buy($uid,$user,$price,__('app.buy', ['num'=>$orderid]),$orderid);
        $rowUser->save();
        $data['id']=$orderid;
        return redirect()->route('order', $data);
    }
}
