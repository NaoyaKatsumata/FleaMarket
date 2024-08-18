<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\User;
use App\Models\Pay_method;


class PurchaseController extends Controller
{
    public function toEditAddressOrPay(Request $request){
        $itemId = $request->itemId;
        $userId = $request->userId;
        $payMethodAll = Pay_method::all();

        if($request->has('editAddress')){
            return view('address',['itemId'=>$itemId,'userId'=>$userId]);
        }else{
            $user = User::where('id','=',$userId)
            ->first();
            if(is_null($user->pay_method)){
                $payMethod = null;
            }else{
                $payMethod = Pay_method::where('id','=',$user->pay_method)
                ->first();
            }
            return view('pay',['itemId'=>$itemId,'userId'=>$userId,'payMethodAll'=>$payMethodAll,'payMethod'=>$payMethod]);
        }
    }
}
