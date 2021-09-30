<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Wallets;
use App\Orders;
use App\Transactions;
use DB;

class DepositController extends Controller {
    public function index(Request $request) {
        $rowUser=\Auth::user();
        $uid=$rowUser->id;
        $user=$rowUser->name;
        $row=Wallets::getAddress($uid,$user);
        $row->address=\App\Helper::decrypt($row->address);
        $data['data']=$row;
        $data['order']=Orders::where('uid',$uid)->where('status','<>',100)->first();
        
        $data['slug']='deposit';
        $data['rows']=Transactions::where('uid',$uid)->where('type',Transactions::TYPE_DEPOSIT)->paginate(5)->appends($request->query());
        
        return view('client.deposit',$data);
    }
    public function check(Request $request) {
        
        return response()->json(['status'=>'ok']);
    }

}
