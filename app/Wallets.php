<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Wallets extends Model {
    public $timestamps = false;
	public const STATUS_READY = 0;
	public const STATUS_CONFIRMING = 10;
	public const STATUS_COMPLETED = 100;

	public static function getAddress($uid,$user) {
		$now=gmdate("Y-m-d H:i:s");
		if($row=self::where('uid',$uid)->where('status','>',self::STATUS_READY)->where('checked',0)->first()){
			$row->checked=1;
			$row->save();
			return $row;
		}
		if($row=self::where('uid',$uid)->where('status','=',0)->where('expired_at','>',$now)->first()) {
			$row->expired_at=gmdate("Y-m-d H:i:s",strtotime($now)+43200);
			$row->save();
			return $row;
		}
		$row=self::orderBy('id')->where('status',0)->where('expired_at','<',$now)->orWhere('uid',0)->first();
		$row->uid=$uid;
		$row->user=$user;
		$row->created_at=$now;
		$row->expired_at=gmdate("Y-m-d H:i:s",strtotime($now)+43200);
		$row->save();
		return $row;
	}

    public static function data($uid,$user) {
		$now=gmdate("Y-m-d H:i:s");
		if($row=self::where('uid',$uid)->where('status','>',self::STATUS_READY)->where('checked',0)->first()){
			$row->checked=1;
			$row->save();
			return $row;
		}
		if($row=self::where('uid',$uid)->where('status','=',0)->first()) {
			
			if($amount=\App\Helper::bitcoin_receive(\App\Helper::decrypt($row->address))) {
				// $row->txs=$count;
				$row->value=$amount;
				$row->updated_at=$now;
				$row->status=self::STATUS_CONFIRMING;
				$row->checked=1;
				$row->save();
				Transactions::deposit($row->uid,$row->user,\App\Helper::decrypt($row->address),$amount);
				if($rowUser=\Auth::user()) {
					$rowUser->btc+=$row->value;
					$rowUser->save();
				}
			}
			return $row;
		}
		$row=self::where('uid',0)->orderBy('id')->first();
		$row->uid=$uid;
		$row->user=$user;
		$row->created_at=$now;
		$row->save();
		return $row;
	}
}
