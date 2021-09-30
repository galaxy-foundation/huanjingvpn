<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Deposits extends Model {
	public $timestamps = false;
	public static function data($uid,$user) {
		if($row=self::where('uid',$uid)->where('status',100)->where('checked',0)->first()){
			$row->checked=1;
			$row->save();
		}else if(($row=self::where('uid',$uid)->where('status','<>',100)->first())==null) {
			$utctime=gmdate("Y-m-d H:i:s");
			$row=self::where('uid',0)->orderBy('id')->first();
			$row->uid=$uid;
			$row->user=$user;
			$row->created_at=$utctime;
			$row->save();
		}else if($row->status==0 && $row->tx==null && ($txs=\App\Helper::bitcoin_receive($row->address)) && $count=count($txs)) {
			$tx=$txs[$count-1];
			$row->tx=$tx->txid;
			$row->value=\App\Helper::satoshi($tx->value);
			$row->updated_at=gmdate("Y-m-d H:i:s", $tx->time);
			$row->save();
		}
		return $row;
	}
}
