<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\Pay_method;

class AddressController extends Controller
{
    public function editAddressOrPay(Request $request){
        $userId = $request->userId;
        $itemId = $request->itemId;

        if($request->has('editAddress')){
            $postCode = $request->postCode;
            $address = $request->address;
            $building = $request->building;

            $user = User::where('id','=',$userId)
            ->first();
            $user -> update([
                'post_code' => $postCode,
                'address' => $address,
                'building' => $building,
            ]);
        }else{
            $payMethodId = $request->methodId;

            $user = User::where('id','=',$userId)
            ->first();
            dd($user);
            $user -> update([
                'pay_method' => $payMethodId
            ]);
        }

        $item = Item::where('id','=',$itemId)
            ->first();
            $user = User::where('id','=',$userId)
            ->first();
            $pay = Pay_method::where('id','=',$user->pay_method)
            ->first();

            return view('/purchase',['user'=>$user,'item'=>$item,'pay'=>$pay]);
    }
}
