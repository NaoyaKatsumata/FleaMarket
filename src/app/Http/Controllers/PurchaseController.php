<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\User;
use App\Models\Pay_method;
use Illuminate\Support\Facades\Auth;


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

    public function checkout(Request $request){
        $user=User::findOrFail(Auth::id());
        $itemId = $request->id;
        $item = Item::where('id','=',$itemId)
        ->first();

        if($item->sell_flg == 1){
            return view('/');
        }
        // 在庫を減らす
        $item->update(['sell_flg'=>'1',
                       'buy_user_id'=>$user->id]);

        // envからシークレットキーを取得
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        // セッション作成
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],      //支払い方法
            'line_items' => [[
            'price_data' => [
                'currency' => 'jpy',                 //通貨
                'product_data' => [
                'name' => $item->name,                 //商品名
                ],
                'unit_amount' => $item->price,              //価格
            ],
            'quantity' => 1,                         //数
            ]],
            'mode' => 'payment',                     //支払い回数
            'success_url' => 'http://localhost/',    //成功後繊維ページ
            'cancel_url' => 'http://localhost/',     //キャンセル後遷移ページ
        ]);
        // 公開鍵を取得
        $publicKey = env('STRIPE_PUBLIC_KEY');
        // 公開鍵とセッション情報をviewに渡す必要がある
        return view('checkout',compact('session','publicKey'));
    }
}
