<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Item;
use App\Models\My_list;

class CommentController extends Controller
{
    public function store(Request $request){
        $itemId = $request->itemId;
        $userId = $request->userId;
        $comment = $request->comment;

        $store = Comment::create([
            'item_id' => $itemId,
            'user_id' => $userId,
            'comment' => $comment,
        ]);
        
        $item = Item::select('items.id','items.name','items.brand','items.img_path','items.comment','items.price','items.category_id','statuses.status')
        ->join('statuses','items.status_id','=','statuses.id')
        ->where('items.id','=',$itemId)
        ->first();
        $myLists = My_list::where('item_id','=',$itemId)
        ->get();
        $myListCount = $myLists->count();

        $comments = Comment::select('comments.comment','comments.id as comment_id','users.id as user_id','users.name','users.img_user')
        ->join('users','users.id','=','comments.user_id')
        ->where('item_id','=',$itemId)
        ->get();
        $commentCount = $comments->count();

        return view('comment',['item'=>$item,'myLists'=>$myLists,'myListCount'=>$myListCount,'comments'=>$comments,'commentCount'=>$commentCount]);
    }
}
