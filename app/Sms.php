<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Smsbody;

class Sms extends Model {
    public const SMS_SEND=0;
    public const SMS_RECEIVE=1;

    public static function send($note,$uid,$user,$uid2,$user2,$orderid=0) {
        $bodyid=Smsbody::addData($note);
        $row=new self;
        $row->type=Sms::SMS_SEND;
        $row->uid=$uid;
        $row->user=$user;
        $row->uid2=$uid2;
        $row->user2=$user2;
        $row->bodyid=$bodyid;
        $row->origin=0;
        $row->orderid=$orderid;
        $row->save();
        $origin=$row->id;
        $row=new self;
        $row->type=Sms::SMS_RECEIVE;
        $row->uid=$uid2;
        $row->user=$user2;
        $row->uid2=$uid;
        $row->user2=$user;
        $row->bodyid=$bodyid;
        $row->origin=$origin;
        $row->orderid=$orderid;
        $row->save();
    }
    public static function event($note,$uid,$user,$orderid,$accepted=false) {
        $bodyid=Smsbody::addData($note);
        $row=new self;
        $row->type=self::SMS_RECEIVE;
        $row->uid=$uid;
        $row->user=$user;
        $row->uid2=0;
        $row->user2="event";
        $row->bodyid=$bodyid;
        $row->origin=0;
        $row->orderid=$orderid;
        if($accepted) $row->accepted=gmdate("Y-m-d H:i:s");
        $row->save();
    }
}
