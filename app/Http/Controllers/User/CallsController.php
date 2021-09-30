<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallsController extends Controller {
	public function index(Request $request) {
        $data=\App\Helper::param();
        $data['menu']='calls';
		return view("user.calls",$data);
	}
}
