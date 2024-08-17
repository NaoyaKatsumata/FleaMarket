<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;

class ItemController extends Controller
{
    public function toBuyPage(Request $request){
        $userId=$request->userId;
        $itemId=$request->itemId;

        return view('/purchase',['userId'=>$userId,'itemId'=>$itemId]);
    }
}
