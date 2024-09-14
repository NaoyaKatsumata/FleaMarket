@extends('header')

@section('content')

    <div class="flex flex-col w-[50%] mx-auto mt-[5%]">
        <p class="w-full mb-4 text-center text-3xl font-bold">プロフィール設定</p>
        <form action="/userProfile" method="post" id="uploadIMG" class="flex items-center" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="mr-10 rounded-full overflow-hidden w-[80px] h-[80px] md:w-[120px] md:h-[120px]">
                <img src="{{ asset('storage/'.$user->img_user)}}" name="image" class="w-full h-full object-cover bg-contain bg-center bg-cover bg-gray-300">
            </div>
            <label class="cursor-pointer py-[5px] px-[10px] bg-red-500 text-white text-center rounded">
                ファイルを選択
                <input type="file" name="path" id="image-input" class="hidden">
            </label>
            <input type="hidden" name="userId" value="{{$userId}}">
        </form>
        <div class="mt-4 text-red-500" id="validationMessage"></div>
        <form action="/mypage" method="post" id="updateAddress" class="mt-8">
            @csrf
            @method('patch')
            <p>ユーザ名</p>
            <input type="text" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="userName" value="{{$user->name}}"></input>
            <div class="text-red-500" id="validationMessagePostCode"></div>
            <p>郵便番号</p>
            <input type="text" id="postCode" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="postCode" value="{{$user->post_code}}"></input>
            <div class="text-red-500" id="validationMessageAddress"></div>
            <p>住所</p>
            <input type="text" id="address" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="address" value="{{$user->address}}"></input>
            <p>建物名</p>
            <input type="text" id="building" class="w-full mb-8 border-solid border-2 border-gray-300 rounded-[5px]" name="building" value="{{$user->building}}"></input>
            <input type="hidden" name="userId" value="{{$userId}}">
            <!-- <button type="submit" onclick="validateAddress()" class="w-full mt-[20px] py-[10px] bg-red-500 text-white text-center rounded" name="" value="登録する"> -->
            <button type="button" class="w-full mt-[20px] py-[10px] bg-red-500 text-white text-center rounded" onclick="validateAddress()">Submit</button>
        </form>

        <!-- 写真アップロードのバリデーション -->
        <script>
            document.getElementById('image-input').addEventListener('change', function () {
                const fileInput = document.getElementById('image-input');
                const file = fileInput.files[0];
                const validationMessage = document.getElementById('validationMessage');

                // 初期状態をクリア
                validationMessage.textContent = '';

                if (!file) {
                    validationMessage.textContent = 'ファイルが選択されていません。';
                    return;
                }

                // ファイルの種類とサイズのバリデーション
                const allowedTypes = ['image/jpeg', 'image/png']; // 許可するファイルタイプ
                const maxSize = 2 * 1024 * 1024; // 2MB

                if (!allowedTypes.includes(file.type)) {
                    validationMessage.textContent = '許可されていないファイルタイプです。JPEGまたはPNGのファイルを選択してください。';
                    return;
                }

                if (file.size > maxSize) {
                    validationMessage.textContent = 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。';
                    return;
                }

                document.getElementById('uploadIMG').submit();
            });

            // 住所のバリデーション
            function validateAddress() {
                const postCode = document.getElementById('postCode');
                const address = document.getElementById('address');
                
                if(postCode.value.length <= 0){
                    validationMessagePostCode.textContent = '郵便番号の入力は必須です';
                    validationMessageAddress.textContent = '';
                    return;
                }else{
                    validationMessagePostCode.textContent = '';
                }

                if(address.value.length <= 0){
                    validationMessageAddress.textContent = '住所の入力は必須です';
                    return;
                }else{
                    validationMessageAddress.textContent = '';
                }

                document.getElementById('updateAddress').submit();
            }
        </script>
    </div>
@endsection