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
        <div class="flex h-full items-center">
            <div class="pl-4 pr-2 text-4xl text-white font-mono font-bold">CT</div>
            <div class="text-2xl text-white font-mono font-bold">COACHTECH</div>
        </div>
        <form action="" method="post" class="flex ml-8 items-center w-1/2">
            @csrf
            @method('patch')
            <input type="search" name="search" class="w-full" placeholder="何をお探しですか?">
        </form>
        <div class="flex items-center mx-4 text-white">
            @auth
            <ul class="flex">
                <li class="inline-flex mx-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                            ログアウト
                        </a>
                    </form>
                </li>
                <li class="inline-flex mx-6"><a href="/">マイページ</a></li>
                <li class="inline-flex mx-6 px-4 text-black bg-white rounded-md"><a href="/sell">出品</a></li>
            </ul>
            @else
            <ul class="flex">
                <li class="inline-flex mx-6"><a href="/login">ログイン</a></li>
                <li class="inline-flex mx-6"><a href="/register">会員登録</a></li>
                <li class="inline-flex mx-6 px-4 text-black bg-white rounded-md"><a href="/sell">出品</a></li>
            </ul>
            @endauth
        </div>
    </header>
    <!-- コンテンツ -->
    <body class="font-sans text-gray-900 antialiased">
        @yield('content')
    </body>
</html>