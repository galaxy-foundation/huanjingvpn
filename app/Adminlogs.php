<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Adminlogs extends Model {
    public static function write($note) {
        $uid=Auth::guard('admin')->user()->id;
        $row=new self;
        $row->uid=$uid;
        $row->note=$note;
        $row->save();
    }
}
