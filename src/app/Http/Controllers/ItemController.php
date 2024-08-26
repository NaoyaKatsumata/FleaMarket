<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Pay_method;
use App\Models\Comment;

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

    public function myList(Request $request){
        $userId = $request->userId;
        $itemId = $request->itemId;
        $myList = My_list::where('user_id','=',$userId)
        ->where('item_id','=',$itemId)
        ->first();

        if(!(is_null($myList))){
            $myList->delete();
        }else{
            My_list::create([
                'item_id' => $itemId,
                'user_id' => $userId
            ]);
        }

        return redirect('item?id='.$itemId);
    }

    public function comment(Request $request){
        $itemId = $request->itemId;
        $item = Item::select('items.id','items.name','items.brand','items.img_path','items.comment','items.price','items.category_id','statuses.status')
        ->join('statuses','items.status_id','=','statuses.id')
        ->where('items.id','=',$itemId)
        ->first();
        $myLists = My_list::where('item_id','=',$itemId)
        ->get();
        $myListCount = $myLists->count();

        $comments = Comment::select('comments.comment','users.id','users.name','users.img_user')
        ->join('users','users.id','=','comments.user_id')
        ->where('item_id','=',$itemId)
        ->get();
        $commentCount = $comments->count();
        // dd($request,$comments,$commentCount);

        return view('comment',['item'=>$item,'myLists'=>$myLists,'myListCount'=>$myListCount,'comments'=>$comments,'commentCount'=>$commentCount]);
    }
}
