<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller {
    public function index(Request $request) {
        $data=[

            'slug'=>'account',
            'name'=>auth()->user()->name
        ];
        return view('client.passwd', $data);
    }
}
