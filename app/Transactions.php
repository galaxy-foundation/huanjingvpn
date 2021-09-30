<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model {
	public const MINIMUM_DEPOSIT = 50000;
	public const WITHDRAW_FEE = 30000;
	public const POST_FEE = 10000;
	public const TRADE_FEE = 0.1; // 10%

	public const TYPE_DEPOSIT = 1;
	public const TYPE_WITHDRAW = 2;
	public const TYPE_BUY = 3;
	public const TYPE_SELL = 4;
	
	public static function deposit($uid,$user,$address,$amount) {
		$row=new self;
		$row->type=self::TYPE_DEPOSIT;
		$row->uid=$uid;
		$row->user=$user;
		$row->btcin=$amount;
		$row->status=100;
		$row->note=$address;
		$row->save();
		return $row;
	}
	public static function withdraw($uid,$user,$address,$amount,$fee,$wid) {
		$row=new self;
		$row->type=self::TYPE_WITHDRAW;
		$row->uid=$uid;
		$row->user=$user;
		$row->btcout=$amount;
		$row->btcfee=$fee;
		$row->status=0;
		$row->note=$address;
		$row->wid=$wid;
		$row->save();
		return $row;
	}
	public static function buy($uid,$user,$amount,$note,$wid) {
		$row=new self;
		$row->type=self::TYPE_BUY;
		$row->uid=$uid;
		$row->user=$user;
		$row->btcout=$amount;
		$row->status=0;
		$row->note=$note;
		$row->wid=$wid;
		$row->save();
		return $row;
	}
	public static function sell($uid,$user,$amount,$note,$wid) {
		$row=new self;
		$row->type=self::TYPE_SELL;
		$row->uid=$uid;
		$row->user=$user;
		$row->btcfee=$amount*self::TRADE_FEE;
		$row->btcin=$amount-$row->btcfee;
		$row->status=100;
		$row->note=$note;
		$row->wid=$wid;
		$row->save();
		return $row;
	}
	public static function status($status) {
		switch($status){
		case 0: 	return __('app.status-ready');
		case 50:	return __('app.status-cancel');
		case 100:	return __('app.status-success');
		}
		return __('app.status-unknown');
	}
}
