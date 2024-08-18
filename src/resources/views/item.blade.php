@extends('header')

@section('content')
    @auth
        @php
            $userId=Auth::user()->id;
        @endphp
    @else
        @php
            $userId='';
        @endphp
    @endauth
    <div class="flex w-[80%] mx-auto mt-[5%]">
        <div class="w-1/2">
            <div class="w-[70%] mx-auto">
                <img src="{{ asset('storage/'.$item->img_path)}}" alt="No Image">
            </div>
        </div>
        <div class="w-1/2">
            <div class="w-[80%] mx-auto">
                <h1 class="mt-[10px] text-2xl font-bold">{{$item->name}}</h1>
                <p class="mt-[10px] text-xs">{{$item->brand}}</p>
                <p class="mt-[10px] text-2xl">¥{{$item->price}}</p>
                <div class="flex mt-[10px]">
                    <div class="flex flex-col items-center">
                        <img src="{{asset('img/star_gray.svg')}}" class="w-[20px]">
                        <div class="text-xs">3</div>
                    </div>
                    <div class="flex flex-col items-center">
                        <img src="{{asset('img/star_gray.svg')}}" class="w-[20px] ml-[20px]">
                        <div class="ml-[20px] text-xs">14</div>
                    </div>
                </div>
                <form action="/purchase" method="post">
                    @csrf
                    <input type="hidden" name="itemId" value="{{$item->id}}">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <input type="submit" class="w-full mt-[20px] py-[5px] bg-red-500 text-white text-center" name="" value="購入する">
                </form>
                <h1 class="mt-[50px] text-2xl font-bold">商品説明</h1>
                <p class="whitespace-pre">{{$item->comment}}</p>
                <h1 class="mt-[50px] text-2xl font-bold">商品の情報</h1>
                <div class="flex mt-[20px]">
                    <p>カテゴリー</p>
                    <div class="ml-[50px] px-[20px] bg-gray-300 rounded-[10px]">{{$mainCategory->category_name}}</div>
                    <div class="ml-[20px] px-[20px] bg-gray-300 rounded-[10px]">{{$subCategory->category_name}}</div>
                </div>
                <div class="flex mt-[20px]">
                    <p>商品の状態</p>
                    <div class="ml-[50px] px-[20px]">{{$item->status}}</div>
                </div>
            </div>
        </div>
    </div>
@endsection