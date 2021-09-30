<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smsbody extends Model {
    protected $table="smsbody";
    public $timestamps = false;

    public static function addData($contents) {
        $row=new self;
        $row->note=$contents;
        $row->save();
        return $row->id;
    }
}
