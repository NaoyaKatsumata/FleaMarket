@extends('header')

@section('content')

    <div class="flex flex-col w-[50%] mx-auto mt-[5%]">
        <p class="w-full text-center text-3xl font-bold">プロフィール設定</p>
        <form action="/userProfile" method="post" id="test" class="flex items-center" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mr-10 rounded-full overflow-hidden w-[120px] h-[120px]">
                <img src="{{ asset('storage/'.$user->img_user)}}" class="w-full h-full object-cover bg-contain bg-center bg-cover bg-gray-300">
            </div>
            <label class="cursor-pointer py-[5px] px-[10px] bg-red-500 text-white text-center rounded">
                ファイルを選択
                <input type="file" name="path" id="image-input" class="hidden">
            </label>
            <input type="hidden" name="userId" value="{{$userId}}">
        </form>
        <script>
            document.getElementById('image-input').addEventListener('change', function () {
                document.getElementById('test').submit();
            });
        </script>
        <form action="/mypage" method="post" class="mt-8">
            @csrf
            @method('patch')
            <p>ユーザ名</p>
            <input type="text" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="userName"></input>
            <p>郵便番号</p>
            <input type="text" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="postCode"></input>
            <p>住所</p>
            <input type="text" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="address"></input>
            <p>建物名</p>
            <input type="text" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="building"></input>
            <input type="hidden" name="userId" value="{{$userId}}">
            <input type="submit" class="w-full mt-[20px] py-[10px] bg-red-500 text-white text-center rounded" name="" value="登録する">
        </form>
    </div>
@endsection