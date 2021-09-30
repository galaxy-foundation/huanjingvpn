<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class Admins extends Authenticatable {
    use Notifiable;
    
    protected $guard = 'admin';

    protected $fillable = [
        'name','password',
    ];

    protected $hidden = [
        'password'
    ];
    public static function support() {
        return self::where('name','support')->first();
    }
    public static function live() {
        return self::where('id','>','10000000');
    }
    public static function common($sessid, $slug) {
		return [
			'sessid'=>$sessid,
			'currentslug'=>$slug,
			'adminuser'=>Auth::guard('admin')->user()->name
		];
    }
    
}
