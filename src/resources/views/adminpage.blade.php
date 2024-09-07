@extends('admin-header')

@section('content')

    <div class="flex flex-col mx-auto mt-[5%]">
        <div class="flex items-center w-[80%] mx-auto">
            <h1>ユーザ管理</h1>
            @foreach($users as $user)
                <form action="" method="post">
                    @csrf
                    <div>
                        <p>{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                    </div>
                    <div></div>
                    <input type="hidden" name="name" value="{{$user->name}}" >
                    <input type="hidden" name="email" value="{{$user->email}}" >
                </form>
            @endforeach
        </div>
    </div>
@endsection