@extends('admin-header')

@section('content')

    <h1 class="m-8 text-3xl font-bold">ユーザ管理</h1>
    <div class="flex flex-col mx-auto mt-[5%]">
        <div class="flex flex-wrap w-[80%] mx-auto items-center">
            @foreach($items as $item)
                <div class="w-[40%] h-[40%] mx-[5%] md:w-[21%] md:h-[21%] md:mx-[2%] my-[5%]">
                    <a href="/admin/item?id={{$item->id}}"><img src="{{ asset('storage/'.$item->img_path)}}" alt="No Image"></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection