@extends('header')

@section('content')
    <!-- ユーザID取得 -->
    @auth
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

                <!-- ボタンをクリックしてモーダルを開く -->
                <div class="flex flex-col justify-center items-center">
                    <input type="image" id="openModal" src="{{asset('img/comment.svg')}}" class="w-[20px] ml-[20px]">
                    <div class="ml-[20px] text-xs">{{$commentCount}}</div>
                </div>

                </div>

                <!-- 購入するボタン -->
                <form action="/purchase" method="post">
                    @csrf
                    <input type="hidden" name="itemId" value="{{$item->id}}">
                    <input type="hidden" name="userId" value="{{$userId}}">
                    <input type="submit" class="w-full mt-[20px] py-[5px] bg-red-500 text-white text-center" name="" value="購入する">
                </form>

                <!-- 商品説明 -->
                <h1 class="mt-[50px] text-2xl font-bold">商品説明</h1>
                <p class="whitespace-pre">{{$item->comment}}</p>
                <h1 class="mt-[50px] text-2xl font-bold">商品の情報</h1>
                <div class="flex mt-[20px]">
                    <p>カテゴリー</p>
                    <div class="ml-[50px] px-[20px] bg-gray-300 rounded-[10px]">{{$mainCategory->category_name}}</div>
                    <div class="ml-[20px] px-[20px] bg-gray-300 rounded-[10px]">{{$subCategory->category_name}}</div>
                </div>

                <!-- 商品情報 -->
                <div class="flex mt-[20px]">
                    <p>商品の状態</p>
                    <div class="ml-[50px] px-[20px]">{{$item->status}}</div>
                </div>
            </div>
        </div>

        <!-- モーダル -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="px-6 py-4 max-h-[500px] overflow-auto">
                <h2 class="text-lg font-semibold mb-4">コメント</h2>
                @foreach($comments as $comment)
                <div class="flex flex-col mb-4 py-4 border-solid border-2 border-gray-300 rounded-[10px]">
                    @if(!(is_null($comment->name)))
                    <p class="font-bold ml-4 mb-2 text-xl">{{$comment->name}}</p>
                    @else
                    <p class="font-bold ml-4 mb-2 text-xl">No name</p>
                    @endif
                    <p class="ml-2 text-sm">　{{$comment->comment}}</p>
                </div>
                @endforeach
                <div class="flex justify-end">
                    <button id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">閉じる</button>
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