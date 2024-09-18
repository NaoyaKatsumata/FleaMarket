@extends('header')

@section('content')
    <div class="flex flex-col w-[80%] mx-auto mt-[100px] items-center justify-center">
    <p>購入に失敗しました。<br>
       カード情報を見直しください</p>
        <form action="/" method="get">
            <input type="submit" class="mt-[30px] py-[10px] px-[20px] bg-red-500 text-white text-center rounded" name="" value="topへ戻る">
        </form>
    </div>
@endsection