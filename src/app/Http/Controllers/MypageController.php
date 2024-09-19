<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Item;
use App\Models\Sub_category;
use App\Models\Main_category;
use App\Models\Status;

class MypageController extends Controller
{
    public function show(Request $request){
        $userId = $request->userId;
        $user = User::where('id','=',$userId)
        ->first();

        if($request->has('buyItem')){
            $items = Item::where('buy_user_id','=',$userId)
            ->get();
            $buyItemFlg=1;
        }else{
            $items = Item::where('shipping_user_id','=',$userId)
            ->get();
            $buyItemFlg=0;
        }
        
        return view('mypage',['user'=>$user,'items'=>$items,'buyItemFlg'=>$buyItemFlg]);
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
            'name' => $userName,
            'post_code' => $postCode,
            'address' => $address,
            'building' => $building,
        ]);

        $user = User::where('id','=',$userId)
        ->first();
        $items = Item::where('shipping_user_id','=',$userId)
        ->get();

        return view('mypage',['user'=>$user,'items'=>$items]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file=$request->file('path');
        $userId=$request->userId;
        $fileName = $file->getClientOriginalExtension();
        $imgName=Str::random(32).'.'.$fileName;

        if(is_null($file)){
            $fileName='';
        }else{
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

    public function shipping(Request $request)
    {
        $userId = $request->userId;
        $mainCategories = Main_category::all();
        $subCategoriesClothes = Sub_category::where('main_category_id','=','1')
        ->get();
        $subCategoriesBooks = Sub_category::where('main_category_id','=','2')
        ->get();
        $subCategoriesOutdoor = Sub_category::where('main_category_id','=','3')
        ->get();
        $subCategoriesFurniture = Sub_category::where('main_category_id','=','4')
        ->get();
        $subCategoriesPhone = Sub_category::where('main_category_id','=','5')
        ->get();
        $subCategoriesHomeEles = Sub_category::where('main_category_id','=','6')
        ->get();
        $statuses = Status::all();

        return view('/shipping',['userId'=>$userId,'statuses'=>$statuses,'mainCategories'=>$mainCategories,'subCategoriesClothes'=>$subCategoriesClothes,'subCategoriesBooks'=>$subCategoriesBooks,
        'subCategoriesOutdoor'=>$subCategoriesOutdoor,'subCategoriesFurniture'=>$subCategoriesFurniture,'subCategoriesPhone'=>$subCategoriesPhone,'subCategoriesHomeEles'=>$subCategoriesHomeEles,]);
    }

    public function shippingStore(Request $request){
        $file = $request->file('path');
        $userId = $request->userId;
        $mainCategoryId = $request->mainCategory;
        $subCategoryId = $request->subCategory;
        $statusId = $request->status;
        $itemName = $request->itemName;
        $description = $request->description;
        $price = (int)$request->price;

        $fileName = $file->getClientOriginalExtension();
        $imgName=Str::random(32).'.'.$fileName;

        if(is_null($file)){
            $fileName='';
        }else{
            $file->storeAs('public/img',$imgName);
        }

        $item = Item::create([
            'name' => $itemName,
            'img_path' => 'img/'.$imgName,
            'comment' => $description,
            'price' => $price,
            'category_id' => $subCategoryId,
            'status_id' => $statusId,
            'shipping_user_id' => $userId,
        ]);

        $user = User::where('id','=',$userId)
        ->first();
        $items = Item::where('shipping_user_id','=',$userId)
        ->get();

        return view('mypage',['user'=>$user,'items'=>$items]);
    }
}
