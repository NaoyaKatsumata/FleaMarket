@extends('admin-header')

@section('content')

    <div class="w-[80%] mx-auto mt-[5%]">
        <h1 class="text-center text-3xl font-bold">コメント作成</h1>
        <p class="text-2xl">{{$userName}}様</p>
        <form action="/admin-page" method="post" class="flex flex-col items-center mt-16">
            @csrf
            @method('put')
            <textarea class="w-full resize-none text-3xl" rows="5" maxlength="255" name="comment"></textarea>
            <input type="hidden" name="toEmail" value="{{$userEmail}}">
            <input type="hidden" name="userName" value="{{$userName}}">
            <input type="submit" class="w-[100px] my-[30px] px-[20px] py-[5px] rounded-[10px] bg-blue-500 text-white" name="" value="送信">
        </form>
    </div>

@endsection