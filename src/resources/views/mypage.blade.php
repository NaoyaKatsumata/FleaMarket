@extends('header')

@section('content')

    <div class="flex flex-col mx-auto mt-[5%]">
        <div class="flex items-center w-[80%] mx-auto">
            <div class="mr-10 rounded-full overflow-hidden w-[120px] h-[120px]">
                <img src="{{ asset('storage/'.$user->img_user)}}" class="w-full h-full object-cover bg-contain bg-center bg-cover bg-gray-300">
            </div>
            @php
                if(is_null($user->name)){
                    $userName = "未設定";
                }else{
                    $userName = $user->name;
                }
            @endphp
            <p class="ml-8 text-3xl">{{$userName}}</p>
            <form action="/userProfile" method="post" class="ml-auto mr-[0px]">
                @csrf
                <input type="hidden" name="userId" value="{{$user->id}}">
                <input type="submit" class="p-2 text-red-500 border-solid border-2 border-red-500 rounded-[10px]" name="" value="プロフィールを編集">
            </form>
        </div>
        <form action="/mypage" method="post" class="flex mt-8 pb-2 border-b border-black">
            @csrf
            @if(!(isset($buyItemFlg)) or $buyItemFlg == 0)
            <input type="submit" name="sellItem" class="ml-32 text-red-500 font-bold" value="出品した商品">
            <input type="submit" name="buyItem" class="ml-16 text-gray-500 font-bold" value="購入した商品">
            <input type="hidden" name="userId" value="{{$user->id}}">
            @else
            <input type="submit" name="sellItem" class="ml-32 text-gray-500 font-bold" value="出品した商品">
            <input type="submit" name="buyItem" class="ml-16 text-red-500 font-bold" value="購入した商品">
            <input type="hidden" name="userId" value="{{$user->id}}">
            @endif
        </form>
        <div class="flex flex-wrap w-[80%] mx-auto items-center">
        @foreach($items as $item)
            <div class="w-[21%] h-[21%] mx-[2%] my-[5%]">
                <a href="/item?id={{$item->id}}&buyFlg=1"><img src="{{ asset('storage/'.$item->img_path)}}" alt="No Image"></a>
            </div>
        @endforeach
    </div>
    </div>
@endsection