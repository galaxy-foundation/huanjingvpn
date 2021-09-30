<?php

namespace App\Http\Controllers\Bitcoin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function index(Request $request) {
        return view('bitcoin.balance');
    }
    public function submit(Request $request) {
        $data=$request->data;
        $rows=[];
        $x = preg_split("/[\r\n]+/", $data);
        foreach($x as $r) {
            if($r=trim($r)) {
                $rows[]=[$r,\App\Helper::bitcoin_balance($r)];
            }
        }
        return view('bitcoin.balance',['rows'=>$rows]);
    }
}
