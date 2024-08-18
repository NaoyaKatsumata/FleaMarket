<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Pay_method;

class ItemController extends Controller
{
    public function toBuyPage(Request $request){
        $userId = $request->userId;
        $itemId = $request->itemId;
        $item = Item::where('id','=',$itemId)
        ->first();
        $user = User::where('id','=',$userId)
        ->first();
        $pay = Pay_method::where('id','=',$user->pay_method)
        ->first();
        return view('/purchase',['user'=>$user,'item'=>$item,'pay'=>$pay]);
    }
}
