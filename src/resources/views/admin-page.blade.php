@extends('admin-header')

@section('content')

    <h1 class="m-8 text-3xl font-bold">ユーザ管理</h1>
    <div class="flex flex-col mx-auto mt-[5%]">
            <div class="items-center w-[50%] mx-auto">
            <table>
                <tr>
                    <th class="w-[30%]">名前</th>
                    <th class="w-[40%]">email</th>
                    <th class="w-[20%]"></th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center pb-4">{{$user->name}}</td>
                        <td class="pb-4">{{$user->email}}</td>
                        <td class="flex items-center pb-4">
                            <form class="mh-auto" action="/admin-page" method="post">
                                @csrf
                                <div class="w-[20%]">
                                    <input type="hidden" name="name" value="{{$user->name}}" >
                                    <input type="hidden" name="email" value="{{$user->email}}" >
                                    <input type="submit" class="px-[10px] py-[5px] rounded-[10px] bg-blue-500 text-white" name="" value="削除">
                                </div>
                            </form>
                            <form class="mh-auto mx-4" action="/admin-message" method="post">
                                @csrf
                                <div class="w-[20%]">
                                    <input type="hidden" name="name" value="{{$user->name}}" >
                                    <input type="hidden" name="email" value="{{$user->email}}" >
                                    <input type="hidden" name="userId" value="{{$user->id}}" >
                                    <input type="submit" class="px-[10px] py-[5px] rounded-[10px] bg-blue-500 text-white" name="" value="メッセージ作成">
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection