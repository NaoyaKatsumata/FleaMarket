@extends('header')

@section('content')
    <!-- ユーザID取得 -->
    @auth
        @php
            $myListFlg = false;
            $userId=Auth::user()->id;
        @endphp
    @else
        @php
            $myListFlg = false;
            $userId='';
        @endphp
    @endauth

    <div class="flex flex-col md:flex-row w-[80%] mx-auto mt-[5%]">
        <div class="w-full md:w-1/2">
            <div class="w-[70%] mx-auto">
                <img src="{{ asset('storage/'.$item->img_path)}}" alt="No Image">
            </div>
        </div>
        <div class="w-full md:w-1/2 pb-16">
            <div class="w-[80%] mx-auto">
                <h1 class="mt-[10px] text-2xl font-bold">{{$item->name}}</h1>
                <p class="mt-[10px] text-xs">{{$item->brand}}</p>
                <p class="mt-[10px] text-2xl">¥{{$item->price}}</p>
                <div class="flex mt-[10px]">

                    <!-- お気に入り登録＆お気に入り数表示 -->
                    <form action="/item?id={{$item->id}}" method="post" class="flex flex-col items-center">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="itemId" value="{{$item->id}}">
                        <input type="hidden" name="userId" value="{{$userId}}">
                        @php
                            foreach($myLists as $myList){
                                if($myList->user_id == $userId){
                                    $myListFlg=true;
                                    break;
                                }
                            }
                        @endphp
                        @if($myListFlg)
                            <input type="image" src="{{asset('img/star_yellow.svg')}}" class="w-[20px]">
                        @else
                            <input type="image" src="{{asset('img/star_gray.svg')}}" class="w-[20px]">
                        @endif
                        <div class="text-xs">{{$myListCount}}</div>
                    </form>
                    <form action="/comment" method="post" class="flex flex-col justify-center items-center">
                        @csrf
                        <input type="image" src="{{asset('img/comment.svg')}}" class="w-[20px] ml-[20px]">
                        <input type="hidden" name="itemId" value="{{$item->id}}">
                        <div class="ml-[20px] text-xs">{{$commentCount}}</div>
                    </form>

                </div>

                <!-- 購入するボタン -->
                <form action="/purchase" method="post">
                    @csrf
                    <input type="hidden" name="itemId" value="{{$item->id}}">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <input type="submit" class="w-full mt-[20px] py-[5px] bg-red-500 text-white text-center" name="" value="購入する">
                </form>

                <!-- 商品説明 -->
                <h1 class="mt-[50px] text-2xl font-bold">商品説明</h1>
                <p class="whitespace-pre">{{$item->comment}}</p>
                <h1 class="mt-[50px] text-2xl font-bold">商品の情報</h1>
                <div class="flex mt-[20px]">
                    <p>カテゴリー</p>
                    <div class="ml-[50px] px-[20px] bg-gray-300 rounded-[10px]">{{$mainCategory->category_name}}</div>
                    <div class="ml-[20px] px-[20px] bg-gray-300 rounded-[10px]">{{$subCategory->category_name}}</div>
                </div>

                <!-- 商品情報 -->
                <div class="flex mt-[20px]">
                    <p>商品の状態</p>
                    <div class="ml-[50px] px-[20px]">{{$item->status}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection