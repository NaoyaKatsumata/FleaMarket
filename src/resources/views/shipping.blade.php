@extends('header')

@section('content')

    <div class="flex flex-col w-[50%] mx-auto mt-[5%]">
        <h1 class="w-full mb-4 text-center text-3xl font-bold">出品登録</h1>
        <form action="/mypage" method="post" id="shipping" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <p class="text-red-500 text-end">※入力必須</p>
            <p class="font-bold">商品画像<span class="text-red-500">※</span></p>
            <div class="flex items-center justify-center" enctype="multipart/form-data">
                <div id="border" class="border border-gray-400 overflow-hidden w-full h-[120px]"></div>
                <img id="img">
                <label class="absolute w-[20%] mx-[15%] mx-auto cursor-pointer py-[5px] px-[10px] bg-red-500 text-white text-center rounded">
                    ファイルを選択
                    <input type="file" name="path" id="input" class="hidden">
                </label>
                <input type="hidden" name="userId" value="{{$userId}}">
            </div>
            <div class="mt-4 text-red-500" id="validationMessage"></div>
            <h2 class="mt-16 text-xl font-bold text-gray-500 border-b border-black">商品名の詳細</h2>
            <p class="font-bold mt-8">カテゴリー1<span class="text-red-500">※</span></p>
            <select id="mainCategory" name="mainCategory" class="w-full">
            <option value="">--選択してください--</option>
            @foreach($mainCategories as $mainCategory)
            <option value="{{$mainCategory->id}}">{{$mainCategory->category_name}}</option>
            @endforeach
            </select>
            <div class="mt-4 text-red-500" id="validationMessageCategory1"></div>

            <p class="font-bold mt-2">カテゴリー2<span class="text-red-500">※</span></p>
            <select id="subCategory" name="subCategory" class="w-full">
                <option value="">--選択してください--</option>
            </select>
            <div class="mt-4 text-red-500" id="validationMessageCategory2"></div>

            <p class="font-bold mt-2">商品の状態<span class="text-red-500">※</span></p>
            <select id="status" name="status" class="w-full">
                <option value="">--選択してください--</option>
                @foreach($statuses as $status)
                <option value="{{$status->id}}">{{$status->status}}</option>
                @endforeach
            </select>
            <div class="mt-4 text-red-500" id="validationMessageStatus"></div>

            <h2 class="mt-16 text-xl font-bold text-gray-500 border-b border-black">商品名と説明</h2>
            <p class="font-bold mt-8">商品名<span class="text-red-500">※</span></p>
            <input type="text" id="itemName" name="itemName" class="w-full rounded">
            <div class="mt-4 text-red-500" id="validationMessageItemName"></div>
            <p class="font-bold mt-8">商品の説明</p>
            <textarea class="w-full resize-none rounded" id="description" name="description" rows="3"></textarea>

            <h2 class="mt-16 text-xl font-bold text-gray-500 border-b border-black">販売価格</h2>
            <p class="font-bold mt-8">販売価格<span class="text-red-500">※</span></p>
            <input type="text" id="price" name="price" class="w-full rounded" placeholder="1000">
            <div class="mt-4 text-red-500" id="validationMessagePrice"></div>
            <button type="button" class="w-full my-16 py-[10px] bg-red-500 text-white text-center rounded" onclick="validateForm()">出品する</button>
        </form>

        <script>
            // カテゴリー選択
            const select1 = document.getElementById('mainCategory');
            const select2 = document.getElementById('subCategory');
            const options = {
                1: [
                    @foreach($subCategoriesClothes as $subCategory)
                    { value: '{{$subCategory->id}}', text: '{{$subCategory->category_name}}' },
                    @endforeach
                ],
                2: [
                    @foreach($subCategoriesBooks as $subCategory)
                    { value: '{{$subCategory->id}}', text: '{{$subCategory->category_name}}' },
                    @endforeach
                ],
                3: [
                    @foreach($subCategoriesOutdoor as $subCategory)
                    { value: '{{$subCategory->id}}', text: '{{$subCategory->category_name}}' },
                    @endforeach
                ],
                4: [
                    @foreach($subCategoriesFurniture as $subCategory)
                    { value: '{{$subCategory->id}}', text: '{{$subCategory->category_name}}' },
                    @endforeach
                ],
                5: [
                    @foreach($subCategoriesPhone as $subCategory)
                    { value: '{{$subCategory->id}}', text: '{{$subCategory->category_name}}' },
                    @endforeach
                ],
                6: [
                    @foreach($subCategoriesHomeEles as $subCategory)
                    { value: '{{$subCategory->id}}', text: '{{$subCategory->category_name}}' },
                    @endforeach
                ]
            };

            document.getElementById('mainCategory').addEventListener('change', function () {
                // 選択されたカテゴリーに対応するオプションを追加
                const selectedCategory = select1.value;

                if (selectedCategory && options[selectedCategory]) {
                    while (select2.childNodes.length > 0) {
                            select2.removeChild(select2.firstChild)
                        }
                    options[selectedCategory].forEach(function(option) {
                        const newOption = document.createElement('option');
                        newOption.value = option.value;
                        newOption.textContent = option.text;
                        select2.appendChild(newOption);
                    });
                }
            })

            // 写真アップロードのバリデーション
            document.querySelector('#input').addEventListener('change', (event) => {
                const file = event.target.files[0]

                if (!file) return
                // ファイルの種類とサイズのバリデーション
                const allowedTypes = ['image/jpeg', 'image/png']; // 許可するファイルタイプ
                const maxSize = 2 * 1024 * 1024; // 2MB
                let okFlg = true;

                if (!allowedTypes.includes(file.type)) {
                    validationMessage.textContent = '許可されていないファイルタイプです。JPEGまたはPNGのファイルを選択してください。';
                    okFlg = false;
                    return;
                }

                if (file.size > maxSize) {
                    validationMessage.textContent = 'ファイルサイズが大きすぎます。2MB以下のファイルを選択してください。';
                    okFlg = false;
                    return;
                }

                if(okFlg){
                    document.getElementById('border').style.display = 'none';
                    const reader = new FileReader()
                    validationMessage.textContent =""
                    reader.onload = (event) => {
                        document.querySelector('#img').src = event.target.result
                    }
                    reader.readAsDataURL(file)
                }
            })

            // 入力フォームのバリデーション
            function validateForm() {
                const input= document.getElementById('input');
                const mainCategory = document.getElementById('mainCategory');
                const subCategory = document.getElementById('subCategory');
                const status = document.getElementById('status');
                const itemName = document.getElementById('itemName');
                const price = document.getElementById('price');
                const validationMessage = document.getElementById('validationMessage');
                const validationMessageCategory1 = document.getElementById('validationMessageCategory1');
                const validationMessageCategory2 = document.getElementById('validationMessageCategory2');
                const validationMessageStatus = document.getElementById('validationMessageStatus');
                const validationMessageItemName = document.getElementById('validationMessageItemName');
                const validationMessagePrice = document.getElementById('validationMessagePrice');
                let errFlg = false;
                validationMessage.textContent = '';
                validationMessageCategory1.textContent = '';
                validationMessageCategory2.textContent = '';
                validationMessageStatus.textContent = '';
                validationMessageItemName.textContent = '';
                validationMessagePrice.textContent = '';

                if(input.value.length <= 0){
                    validationMessage.textContent = '商品の画像を選択してください';
                    errFlg = true;
                }else{
                    validationMessage.textContent = '';
                }

                if(mainCategory.value.length <= 0){
                    validationMessageCategory1.textContent = 'カテゴリー1を選択してください';
                    errFlg = true;
                }else{
                    validationMessageCategory1.textContent = '';
                }

                if(subCategory.value.length <= 0){
                    validationMessageCategory2.textContent = 'カテゴリー2を選択してください';
                    errFlg = true;
                }else{
                    validationMessageCategory2.textContent = '';
                }

                if(status.value.length <= 0){
                    validationMessageStatus.textContent = '商品の状態を選択してください';
                    errFlg = true;
                }else{
                    validationMessageStatus.textContent = '';
                }

                if(status.value.length <= 0){
                    validationMessageItemName.textContent = '商品名を選択してください';
                    errFlg = true;
                }else{
                    validationMessageItemName.textContent = '';
                }

                if(price.value.length <= 0){
                    validationMessagePrice.textContent = '販売価格を入力してください';
                    errFlg = true;
                }else{
                    validationMessagePrice.textContent = '';
                }

                if(errFlg){
                    return;
                }

                document.getElementById('shipping').submit();
            }
        </script>
    </div>
@endsection