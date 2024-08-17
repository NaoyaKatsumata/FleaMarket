@extends('header')

@section('content')
    <div class="flex w-[80%] mx-auto mt-[5%]">
        <div class="w-[60%]">
            <div class="flex">
                <img src="{{ asset('storage/img/HrhPeYbEzktR.jpg')}}" class="w-[30%]">
                <div class="ml-[100px]">
                    <h1 class="mb-[10px] text-2xl font-bold">商品名</h1>
                    <p class="text-xl">¥10,000</p>
                </div>
            </div>
            <div class="flex mt-[50px]">
                <p class="">支払い方法</p>
                <a href="/" class="text-blue-400">変更する</a>
            </div>
            <p class="mt-[50px]">配送先</p>
        </div>
    </div>
@endsection