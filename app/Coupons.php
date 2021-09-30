<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Coupons extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'coupon';
    public static function valid($coupon,$use=false) {
        if($row=self::find($coupon)) {
            if($row->used==0) {
                if($use) {
                    $row->used=1;
                    $row->save();
                }
                return true;
            }
        }
        return false;
    }
}
