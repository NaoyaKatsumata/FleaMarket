<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function editAddress(Request $request){
        return view('address');
    }
}
