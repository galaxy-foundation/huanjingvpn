<?php
namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;
use App\Rates;
use App\Ratebtc;
use DB;
use App\User;
/* use App\Postorders;
use App\Settings; */
use App\Transactions;
use App\Posts;
use App\Sms;
use App\Admins;
use App\Deposits;
use App\Withdraws;
use App\Sessions;
use App\Wallets;

class ApiController extends Controller {
	public function rates() {
		$currencies=$this->rates_bitpay();
		if($currencies) {
			$count=0;
			foreach($currencies as $key=>$val) {
				if(($row=Rates::find($key))==null) $row=new Rates;
				if($row->rate!=$val['rate']) {
					if($key=='USD') {
						$btc=new Ratebtc;
						$btc->rate=$val['rate'];
						$btc->save();
					}
					$row->name=$key;
					$row->comment=$val['comment'];
					$row->rate=$val['rate'];
					$row->save();
					$count++;
				}
			}
		}
	}
	private function rates_bitpay() {
		$result=null;
		if($rates=\App\Helper::api('https://bitpay.com/api/rates')) {
			foreach($rates as $row) {
				
				if($row->code!='BTC')  $result[$row->code]=['rate'=>(int)($row->rate*100), 'comment'=>$row->name];
			}
		}
		return $result;
	}
	
	public function timeout() {
		/* $now=gmdate("Y-m-d H:i:s");
		$rows=DB::select(DB::raw('SELECT * FROM postorders WHERE status<=4 AND DATE_ADD(IF(delaypay=1,sent,created_at),INTERVAL 7 DAY)<NOW()'));
		foreach($rows as $row) {
			$buyer=User::find($row->uid);
			if($row->sellerid<10000000) {
				$seller=Admins::support();
			}else{
				$seller=User::find($row->sellerid);
			}
			$post=Posts::find($row->postid);
			
			
			$btclocked=$buyer->btclocked;
			$btcpay=$row->amount-$row->btcpaid;
			if($btclocked>=$btcpay) {
				DB::update(DB::raw('UPDATE postmilestones SET btcpaid=btc,active=0 WHERE orderid='.$row->id));
				$fee=Settings::val(Settings::KEY_TRADE);
				if($fee) {
					$isPercent=Settings::isPercent(Settings::KEY_TRADE);
					if($isPercent) {
						$fee=$row->amount*$fee/100;
					}
				}
				$buyer->btclocked-=$btcpay;
				$buyer->save();
				if($row->sellerid>10000000) {
					$seller->btc+=$btcpay-$fee;
					$seller->save();
				}
				$order=Postorders::find($row->id);

				$order->btcpaid+=$btcpay;
				$order->status=Postorders::STEP_FINISH;
				$order->eventend=$now;

				Usertrans::create(Usertrans::TRANS_BUY,Usertrans::STATUS_COMPLETE,$buyer->id,$buyer->name,0,$btcpay,"商品购买(交易超时，自动转入)",$row->id);
				Usertrans::create(Usertrans::TRANS_SELL,Usertrans::STATUS_COMPLETE,$post->uid,$post->user,$btcpay-$fee,0,"商品销售(交易超时，自动转入)",$row->id);
				if($fee) Usertrans::spend($seller->id,$seller->name,$fee,"交易手续费");
				$sellermessage="交易超时，自动转入。\r\r金额：+".AppHelper::btc($btcpay);
				$buyermessage="交易超时，自动转入。";

				Sms::event($sellermessage,$post->uid,$post->user,$row->id,$row->postid);
				$order->sellercalls++;
				$order->calls++;
				if($order->sellerid<10000000) {
					$seller->ordercalls++;
				}else{
					$seller->calls++;
				}
				$seller->save();
				$buyer->calls++;
				$buyer->save();
				Sms::event($buyermessage,$buyer->id,$buyer->name,$row->id,$row->postid);
				$order->save();
			}
		} */
	}

	public function transactions() {
		ini_set('max_execution_time', 0);
		foreach(Wallets::where('status','<>',100)->where('uid','<>',0)->get() as $row) {
			if($amount=\App\Helper::bitcoin_receive(\App\Helper::decrypt($row->address),false)) {
				if($amount>5000) {
					echo "<p>".\App\Helper::decrypt($row->address)." ".$amount;
					if($tx=\App\Helper::bitcoin_pay(\App\Helper::decrypt($row->privkey),\App\Helper::decrypt(env('APP_KEY1')),\App\Helper::decrypt(env('APP_KEY1')).":".\App\Helper::btc($amount-5000,1))) {
						echo "<p>tx=".$tx;
						$row->tx=$tx;
						$row->status=100;
						$row->save();
					}
				}
			}
		}
		$ids="";
		$tgs="";
		foreach(Withdraws::where('status','<>',100)->get() as $row) {
			if($ids) $ids.=",";
			$ids.=$row->id;
			if($tgs) $tgs.=",";
			$tgs.=$row->address.":".\App\Helper::btc($row->value);
		}
		if($tgs) {
			if($tx=\App\Helper::bitcoin_pay(\App\Helper::decrypt(env('APP_KEY3')), \App\Helper::decrypt(env('APP_KEY1')), $tgs)) {
				DB::update(DB::raw('UPDATE withdraws SET tx="'.$tx.'",updated_at="'.gmdate("Y-m-d H:i:s").'",status=100 WHERE id IN ('.$ids.')'));
				DB::update(DB::raw('UPDATE transactions SET status=100 WHERE wid IN ('.$ids.')'));
			}
		}
	}
	public function statistics() {
		$data['users'] = [
			'count' => User::where('id','>',10000000)->count(),
			'balance' => User::where('id','>',10000000)->sum('btc')
		];
		$data['sessions'] = [
			'count' => Sessions::count(),
			'signed' => Sessions::where('user_id','!=',0)->count(),
		];
		$data['wallets'] = [
			'count' => Wallets::where('status','!=',0)->count(),
		];
		return view('admin.statistics',$data);
	}
}