<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\MessageBag;

class User extends Authenticatable {
    use Notifiable;

    public const MEMBER_TRADE = 1;
    public const MEMBER_BLOG = 2;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function hash(string $plain) {
        return AppHelper::hash($plain);
    }
    
    public static function checkWalletPassword($lockcheck=true) {
        if(!$lockcheck) {
            request()->validate([
                'passwd' => 'required|min:6|max:20',
            ], [
                'passwd.required' => '您必须输入密码。',
                'passwd.min' => '您输入的密码太短了。',
                'passwd.max' => '您输入的密码太长了。',
            ]);
        }
        
        if(session()->has('walletpasswd-wrong-time')) {
            $difftime=env('WALLET_LOCKTIME')-(time()-session()->get('walletpasswd-wrong-time'));
            if($difftime<=0) {
                session()->forget('walletpasswd-wrong');
                session()->forget('walletpasswd-wrong-time');
            }else{
                $mm=floor($difftime/60);
                $ss=$difftime%60;
                $messageBag = new MessageBag;
                $messageBag->add('lock', '您的资金密码锁定了。 盈余时间：'.($mm?$mm.'分':'').($ss?$ss.'秒':''));
                if($lockcheck) return $messageBag;
                return redirect()->back()->withErrors( $messageBag )->withInput();
            }
        }
        if(!$lockcheck) {
            $passwd=request('passwd');
            
            if ($passwd && self::hash($passwd) != auth()->user()->walletpasswd) {
                $wrong=0;
                if(session()->has('walletpasswd-wrong')) {
                    $wrong = session()->get('walletpasswd-wrong');
                }
                session(['walletpasswd-wrong' => (++$wrong)]);
                $messageBag = new MessageBag;
                if ($wrong>=3) {
                    session(['walletpasswd-wrong-time' => time()]);
                    $messageBag->add('lock', '您的资金密码锁定了。');
                }
                $messageBag->add('passwd', '资金密码错了。 （'.$wrong.'回）');
                
                return redirect()->back()->withErrors( $messageBag )->withInput();
            }
        }
        //session()->forget('walletpasswd-wrong');
        //session()->forget('walletpasswd-wrong-time');
        return null;
    }
    
    public static function lock($uid,$amount) {
        if($row=self::find($uid)) {
            if($row->btc>=$amount) {
                $row->btc-=$amount;
                $row->btclocked+=$amount;
                $row->save();
                return $row;
            }
        }
        return null;
    }

    public static function unlock($uid,$amount) {
        if($row=self::find($uid)) {
            if($row->btclocked>=$amount) {
                $row->btc+=$amount;
                $row->btclocked-=$amount;
                $row->save();
                return $row;
            }
        }
        return null;
    }
    public static function set_calls($uid) {
        if($row=self::find($uid)) {
            $row->calls++;
            $row->save();
            return $row;
        }
        return null;
    }
}
