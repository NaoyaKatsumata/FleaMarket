@extends('admin-header')

@section('content')
    <!-- ユーザID取得 -->
    @auth('users')
        @php
            $myListFlg = false;
            $userId=Auth::user()->id;
        @endphp
    @else
        @php
            $myListFlg = false;
            $userId='';
        @endphp
    @endauth

    <div class="flex w-[80%] mx-auto mt-[5%]">
        <div class="w-1/2">
            <div class="w-[70%] mx-auto">
                <img src="{{ asset('storage/'.$item->img_path)}}" alt="No Image">
            </div>
        </div>
        <div class="w-1/2">
            <div class="w-[80%] mx-auto">
                <h1 class="mt-[10px] text-2xl font-bold">{{$item->name}}</h1>
                <p class="mt-[10px] text-xs">{{$item->brand}}</p>
                <p class="mt-[10px] text-2xl">¥{{$item->price}}</p>
                <div class="flex mt-[10px]">

                    <!-- お気に入り登録＆お気に入り数表示 -->
                    <form action="/item?id={{$item->id}}" method="post" class="flex flex-col items-center">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="itemId" value="{{$item->id}}">
                        <input type="hidden" name="userId" value="{{$userId}}">
                        @php
                            foreach($myLists as $myList){
                                if($myList->user_id == $userId){
                                    $myListFlg=true;
                                    break;
                                }
                            }
                        @endphp
                        @if($myListFlg)
                            <input type="image" src="{{asset('img/star_yellow.svg')}}" class="w-[20px]">
                        @else
                            <input type="image" src="{{asset('img/star_gray.svg')}}" class="w-[20px]">
                        @endif
                        <div class="text-xs">{{$myListCount}}</div>
                    </form>

                    <div class="flex flex-col justify-center items-center">
                        <input type="image" id="openModal" src="{{asset('img/comment.svg')}}" class="w-[20px] ml-[20px]">
                        <div class="ml-[20px] text-xs">{{$commentCount}}</div>
                    </div>
                </div>

                <div class="mt-8 border border-gray-400 h-[400px] overflow-auto">
                    <div class="sticky  top-0 bg-white">
                        <h2 class="px-4 pt-4 text-lg font-semibold mb-4">コメント</h2>
                    </div>
                    <div class="px-6 pb-4">
                        @foreach($comments as $comment)
                            @if($comment->user_id == $userId)
                                <div class="flex">
                            @else
                                <div class="flex flex-row-reverse">
                            @endif
                                <div class="mx-2 rounded-full overflow-hidden w-[30px] h-[30px]">
                                    <img src="{{ asset('storage/'.$comment->img_user)}}" class="w-full h-full object-cover bg-contain bg-center bg-cover bg-gray-300">
                                </div>
                                @if(!(is_null($comment->name)))
                                    <p class="font-bold mb-2 text-xl">{{$comment->name}}</p>
                                @else
                                    <p class="font-bold mb-2 text-xl">No name</p>
                                @endif
                                @auth('admin')
                                    <form action="/comment" method="post" class="flex mr-auto ml-[0px]">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="commentId" value="{{$comment->comment_id}}">
                                        <input type="hidden" name="itemId" value="{{$item->id}}">
                                        <input type="submit" value="削除" class="">
                                    </form>
                                @endauth
                            </div>
                            <div class="flex flex-col mb-4 py-4 border-solid border-2 border-gray-300 rounded-[10px]">
                                <p class="ml-2 text-sm">　{{$comment->comment}}</p>
                            </div>
                        @endforeach
                        <div class="flex flex-col justify-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Tailwind CSSのJavaScriptが不要なので、以下のスクリプトで簡単にモーダルの表示を制御します -->
    <script>
        document.getElementById('openModal').addEventListener('click', function() {
            document.getElementById('modal').classList.remove('hidden');
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        document.getElementById('modal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });
    </script>
    </div>
@endsection