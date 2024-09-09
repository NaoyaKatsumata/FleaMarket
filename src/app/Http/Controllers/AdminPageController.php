<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Item;
use App\Models\My_list;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Comment;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class AdminPageController extends Controller
{
    public function getUsers(){
        $users = User::all();
        return view('admin-page',['users'=>$users]);
    }

    public function getItems(){
        $items = Item::all();
        return view('admin-items',['items'=>$items]);
    }

    public function delete(Request $request){
        $userName = $request->name;
        $userEmail = $request->email;
        User::where('email',$userEmail)->delete();
        $users = User::all();
        return view('admin-page',['users'=>$users]);
    }

    public function comment(Request $request){
        $itemId = $request->id;
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
        // dd($request,$comments,$commentCount);

        return view('admin-comment',['item'=>$item,'myLists'=>$myLists,'myListCount'=>$myListCount,'comments'=>$comments,'commentCount'=>$commentCount]);
    }

    public function commentDelete(Request $request){
        $itemId = $request->itemId;
        $commentId = $request->commentId;

        Comment::where('id','=',$commentId)->delete();
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
        // dd($request,$comments,$commentCount);

        return view('admin-comment',['item'=>$item,'myLists'=>$myLists,'myListCount'=>$myListCount,'comments'=>$comments,'commentCount'=>$commentCount]);
    }

    public function sendMail(Request $request){
        $comment = $request->comment;
        $toEmail = $request->toEmail;
        $userName = $request->userName;

        Mail::to($toEmail)->send(new SendMail($comment,$userName));

        $users = User::all();
        return view('admin-page',['users'=>$users]);
    }

    public function message(Request $request){
        $userName = $request->name;
        $userEmail = $request->email;

        return view('admin-message',['userName'=>$userName,'userEmail'=>$userEmail]);
    }
}
