<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;

class InvoiceController extends Controller {
    public function index(Request $request) {
        $data=[
            'slug'=>'invoice',
            'rows'=>Orders::all()
        ];
        return view('client.invoice', $data);
    }
}
