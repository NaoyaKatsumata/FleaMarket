<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- ヘッダー -->
    <header class="flex justify-between h-14 bg-black">
        <div class="flex items-center w-[25%]">
            <a href="/" class="w-full md:ml-8"><img src="{{asset('img/logo.svg')}}" alt="ロゴ"></a>
        </div>
        <form action="" method="post" class="flex ml-2 md:ml-4 items-center w-[40%]">
            @csrf
            @method('patch')
            <input type="search" name="search" class="w-full" placeholder="何をお探しですか?">
        </form>
        <div class="flex items-center justify-end text-white md:w-[35%] md:ml-8">
            @auth
            <ul class="flex">
                <li class="flex items-center">
                    <form method="POST" action="{{ route('user.logout') }}" class="mx-2 text-xs inline-flex md:text-base">
                        @csrf
                        <a href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                            ログアウト
                        </a>
                    </form>
                </li>
                <li class="inline-flex">
                    <form action="/mypage" method="post" class="mx-2 text-xs inline-flex md:text-base">
                        @csrf
                        <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                        <input type="submit" name="submit" value="マイページ">
                    </form>
                </li>
                <li class="inline-flex">
                    <form action="/shipping" method="post" class="mx-2 text-xs inline-flex md:text-base">
                        @csrf
                        <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                        <input type="submit" name="submit" class="px-4 py-2 text-xs md:text-base text-black bg-white rounded-md" value="出品">
                    </form>
                </li>
            </ul>
            @else
            <ul class="flex">
                <li class="mx-2 my-auto text-xs inline-flex md:text-base"><a href="/login">ログイン</a></li>
                <li class="mx-2 my-auto text-xs inline-flex md:text-base"><a href="/register">会員登録</a></li>
                <li class="inline-flex">
                <form action="/shipping" method="post" class="mx-2 text-xs inline-flex md:text-base">
                        @csrf
                        <input type="submit" name="submit" class="px-4 py-2 text-xs md:text-base text-black bg-white rounded-md" value="出品">
                    </form>
                </li>
                </li>
            </ul>
            @endauth
        </div>
    </header>
    <!-- コンテンツ -->
    <body class="font-sans text-gray-900 antialiased">
        @yield('content')
    </body>
</html>