@extends('header')

@section('content')
    @auth
        @php
            $userId=Auth::user()->id;
        @endphp
        <form action="/" method="post" class="flex mt-8 pb-2 border-b border-black">
            @csrf
            @method('PUT')
            @if(!(isset($topPageFlg)) or $topPageFlg == 0)
            <input type="submit" name="recommend" class="ml-32 text-red-500 font-bold" value="おすすめ">
            <input type="submit" name="myList" class="ml-16 text-gray-500 font-bold" value="マイリスト">
            <input type="hidden" name="userId" value="{{$userId}}">
            @else
            <input type="submit" name="recommend" class="ml-32 text-gray-500 font-bold" value="おすすめ">
            <input type="submit" name="myList" class="ml-16 text-red-500 font-bold" value="マイリスト">
            <input type="hidden" name="userId" value="{{$userId}}">
            @endif
        </form>
    @else
        <div class="flex mt-8 pb-2 border-b border-black">
            <input type="submit" name="recommend" class="ml-32 text-red-500 font-bold" value="おすすめ">
        </div>
    @endauth

    <div class="flex flex-wrap w-[80%] mx-auto items-center">
        @foreach($items as $item)
            <div class="w-[40%] h-[40%] md:w-[21%] md:h-[21%] md:mx-[2%] mx-[5%] my-[5%]">
                <a href="/item?id={{$item->id}}"><img src="{{ asset('storage/'.$item->img_path)}}" alt="No Image"></a>
            </div>
        @endforeach
    </div>
@endsection