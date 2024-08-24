<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Comment;

class TopPageController extends Controller
{
    public function getItems(){
        $items = Item::where('sell_flg','=','0')
        ->get();
        // dd($items);
        return view('top',['items'=>$items]);
    }

    public function getRecommendMyList(Request $request){
        if($request->has('myList')){
            $items = My_list::join('items','items.id','=','my_lists.item_id')
            ->where('my_lists.user_id','=',$request->userId)
            ->get();
            $topPageFlg=1;
        }else{
            $items = Item::where('sell_flg','=','0')
            ->get();
            $topPageFlg=0;
        }

        return view('top',['items'=>$items,'topPageFlg'=>$topPageFlg]);
    }

    public function search(Request $request){
        $items = Item::where('name','like','%'.$request->search.'%')
        ->get();

        return view('top',['items'=>$items]);
    }

    public function show(Request $request){
        $buyFlg = $request->buyFlg;
        $item = Item::select('items.id','items.name','items.brand','items.img_path','items.comment','items.price','items.category_id','statuses.status')
        ->join('statuses','items.status_id','=','statuses.id')
        ->where('items.id','=',$request->id)
        ->first();
        $subCategoryId = $item->category_id;
        $subCategory = Sub_category::where('id','=',$subCategoryId)->first();
        $mainCategory = Main_category::where('id','=',$subCategory->main_category_id)->first();

        $myLists = My_list::where('item_id','=',$request->id)
        ->get();
        $myListCount = $myLists->count();

        $comments = Comment::select('comments.comment','users.name')
        ->join('users','users.id','=','comments.user_id')
        ->where('item_id','=',$request->id)
        ->get();
        $commentCount = $comments->count();

        return view('item',['item'=>$item,'mainCategory'=>$mainCategory,'subCategory'=>$subCategory,'myLists'=>$myLists,'myListCount'=>$myListCount,'comments'=>$comments,'commentCount'=>$commentCount,'buyFlg'=>$buyFlg]);
    }

    public function myPage(Request $request){
        $userId = $request->userId;
    }
}
