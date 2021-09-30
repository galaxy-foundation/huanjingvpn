<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;

class HomeController extends Controller {
	public function index(Request $request) {
		$data=\App\Helper::param();
		$model=Posts::where('type',Posts::TRADE)->where('allow',100);
		$query='';
		if($request->has('q')) {
			$query=$request->q;
			$model=$model->where('title','regexp',$query);
		}
		$data['menu']='home';
		$data['query']=$query;
		$data['rows']=$model->orderBy('sales','desc')->orderBy('id','desc')->paginate(20)->appends($request->query());
		return view("user.home",$data);
	}
}
