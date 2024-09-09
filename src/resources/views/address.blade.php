@extends('header')

@section('content')
    @php
        $userId=Auth::user()->id;
    @endphp
    <div class="flex flex-col w-[80%] mx-auto mt-[5%]">
        <p class="w-full text-center text-3xl font-bold">住所の変更</p>
        <form action="/purchase" method="post" class="w-[70%] mx-auto ">
            @csrf
            @method('patch')
            <div class="mt-[30px]">
                <p>郵便番号</p>
                <input type="text" class="w-full mt-4" name="postCode" placeholder="000-0000">
            </div>
            <div class="mt-[30px]">
                <p>住所</p>
                <input type="text" class="w-full mt-4" name="address" placeholder="〇〇県〇〇市〇〇 1-1-1">
            </div>
            <div class="mt-[30px]">
                <p>建物名</p>
                <input type="text" class="w-full mt-4" name="building" placeholder="〇〇寮">
            </div>
            <input type="hidden" name="itemId" value="{{$itemId}}">
            <input type="hidden" name="userId" value="{{$userId}}">
            <input type="submit" class="w-full mt-16 py-2 text-white bg-red-500" name="editAddress" value="更新する">
        </form>
    </div>
@endsection