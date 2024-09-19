<x-guest-layout>

    <div class="flex justify-center font-bold text-xl">会員登録</div>
    <form method="POST" action="{{ route('user.register') }}" class="mt-8">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" value="メールアドレス" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="パスワード" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="text-center">
            <x-primary-button class="mt-8 w-full">
                登録する
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <a class="underline text-sm text-blue-500 hover:text-blue-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{ route('user.login') }}">
                ログインはこちら
            </a>
        </div>
    </form>
</x-guest-layout>
