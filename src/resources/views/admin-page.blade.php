@extends('admin-header')

@section('content')

    <h1 class="m-8 text-3xl font-bold">ユーザ管理</h1>
    <div class="flex flex-col mx-auto mt-[5%] w-[80%]">
        <table class="table-fixed w-full md:w-full md:mx-auto">
            <tr>
                <td class="font-bold text-2xl">名前</td>
                <td class="font-bold text-2xl">email</td>
                <th class=""></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td class="pb-4 break-words whitespace-normal">{{$user->name}}</td>
                    <td class="pb-4 break-words whitespace-normal">{{$user->email}}</td>
                    <td class="flex flex-col items-center pb-4 md:flex-row">
                        <form class="mh-auto mb-2 w-full md:w-[50%] md:mb-0" action="/admin-page" method="post">
                            @csrf
                            <div class="w-fll">
                                <input type="hidden" name="name" value="{{$user->name}}" >
                                <input type="hidden" name="email" value="{{$user->email}}" >
                                <input type="submit" class="w-full md:[150px] px-[10px] py-[5px] rounded-[10px] bg-blue-500 text-white" name="" value="削除">
                            </div>
                        </form>
                        <form class="mh-auto w-full md:w-[50%] md:mx-4" action="/admin-message" method="post">
                            @csrf
                            <div class="w-full">
                                <input type="hidden" name="name" value="{{$user->name}}" >
                                <input type="hidden" name="email" value="{{$user->email}}" >
                                <input type="hidden" name="userId" value="{{$user->id}}" >
                                <input type="submit" class="break-words whitespace-normal w-full md:[150px] px-[10px] py-[5px] rounded-[10px] bg-blue-500 text-white" name="" value="メッセージ作成">
                            </div>
                        </form>
                    </>
                </tr>
            @endforeach
        </table>
    </div>
@endsection