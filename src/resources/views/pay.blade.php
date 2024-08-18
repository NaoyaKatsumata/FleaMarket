@extends('header')

@section('content')
    @php
        $userId=Auth::user()->id;
    @endphp
    <div class="flex flex-col w-[80%] mx-auto mt-[5%]">
    <p class="w-full text-center text-3xl font-bold">支払い方法の変更</p>
        <form action="/purchase" method="post" class="flex flex-col w-[70%] mx-auto">
            @csrf
            @method('patch')
            @foreach($payMethodAll as $method)
            <div class="mt-4">
                <input type="radio" id="{{$method->id}}" name="methodId" value="{{$method->id}}">
                <label for="{{$method->id}}">{{$method->method}}</label>
            </div>
            @endforeach
            <input type="hidden" name="itemId" value="{{$itemId}}">
            <input type="hidden" name="userId" value="{{$userId}}">
            <input type="submit" class="my-16 py-2 text-white bg-red-500" name="editPay" value="更新する">
        </form>
    </div>
@endsection