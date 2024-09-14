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
            <a href="/" class="ml-8"><img src="{{asset('img/logo.svg')}}" alt="ロゴ"></a>
        </div>
        
        <div class="flex items-center mx-4 text-white">
            @auth
            <ul class="flex">
                <li class="inline-flex mx-2 md:mx-6">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="route('admin.logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                            ログアウト
                        </a>
                    </form>
                </li>
                <li class="inline-flex mx-2 md:mx-6">
                    <a href='/admin-page'>ユーザ</a>
                </li>
                <li class="inline-flex mx-2 md:mx-6">
                    <a href='/admin-items'>商品一覧</a>
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