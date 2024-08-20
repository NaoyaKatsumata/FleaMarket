<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Item;

class MypageController extends Controller
{
    public function show(Request $request){
        $userId = $request->userId;
        $user = User::where('id','=',$userId)
        ->first();
        $shippingItems = Item::where('shipping_user_id','=',$userId)
        ->get();

        return view('mypage',['user'=>$user,'shippingItems'=>$shippingItems]);
    }

    public function showProfile(Request $request){
        $userId = $request->userId;
        $user = User::where('id','=',$userId)
        ->first();
        return view('/userProfile',['userId'=>$userId,'user'=>$user]);
    }

    public function editProfile(Request $request){
        $userId = $request->userId;
        $userName = $request->userName;
        $postCode = $request->postCode;
        $address = $request->address;
        $building = $request->building;

        $user = User::where('id','=',$userId)
        ->first();
        $user->update([
            'name'=>$userName,
            'shipping_address' => $postCode.' '.$address.' '.$building
        ]);

        $user = User::where('id','=',$userId)
        ->first();

        return view('mypage',['user'=>$user]);
    }

    public function store(Request $request)
    {
        $file=$request->file('path');
        $userId=$request->userId;
        $fileName = $file->getClientOriginalExtension();
        // dd($fileName);
        // $fileName=$file->getClientOriginalName();
        $imgName=Str::random(32).'.'.$fileName;

        if(is_null($file)){
            $fileName='';
        }else{
            // $fileName=$file->getClientOriginalName();
            $file->storeAs('public/img',$imgName);
        }

        $user = User::where('id','=',$userId)
        ->first();

        $user->update([
            'img_user'=>'img/'.$imgName,
        ]);
        $user = User::where('id','=',$userId)
        ->first();

        return view('/userProfile',['userId'=>$userId,'user'=>$user]);
    }
}
