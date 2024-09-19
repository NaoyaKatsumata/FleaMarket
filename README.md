# fleaMarket
<h1>coachtechフリマサービス</h1>
<img src="img/mainview.png" alt="test">
<h1>概要</h1>
<p>ある企業が開発した独自のフリマアプリ</p>
<h1>githubリンク</h1>
<p>https://github.com/NaoyaKatsumata/fleaMarket</p>
<h1>機能</h1>
<ul>
    <li>ユーザ会員登録</li>
    <li>ユーザログイン</li>
    <li>ログアウト</li>
    <li>商品一覧表示</li>
    <li>商品詳細取得</li>
    <li>商品お気に入り一覧表示</li>
    <li>ユーザ情報表示</li>
    <li>ユーザ購入商品一覧表示</li>
    <li>ユーザ出品商品一覧表示</li>
    <li>プロフィール変更</li>
    <li>商品お気に入り追加</li>
    <li>商品お気に入り削除</li>
    <li>商品コメント追加</li>
    <li>出品</li>
    <li>商品購入</li>
    <li>管理者登録</li>
    <li>管理者ログイン</li>
    <li>ユーザ削除</li>
    <li>管理者からのメール送信</li>
    <li>商品コメント削除</li>
</ul>
<h1>使用技術</h1>
<ul>
    <li>laravel：9.52.16</li>
    <li>php：8.1.29</li>
    <li>composer：2.7.9</li>
    <li>DB：Mysql</li>
</ul>
<h1>テーブル設計</h1>
<p>adminsテーブル</p>
<img src="img/admins.png">
<p>usersテーブル</p>
<img src="img/users.png">
<p>itemsテーブル</p>
<img src="img/items.png">
<p>commentsテーブル</p>
<img src="img/comments.png">
<p>my listsテーブル</p>
<img src="img/mylists.png">
<p>main_categoriesテーブル</p>
<img src="img/main_categories.png">
<p>sub_categoriesテーブル</p>
<img src="img/sub_categories.png">
<p>statusesテーブル</p>
<img src="img/statuses.png">
<p>pay methodsテーブル</p>
<img src="img/paymethods.png">
<h1>ER図</h1>
<img src="img/ER.png">
<h1>環境構築</h1>
<ul>
    <li>githubからファイルをローカルへ<br>
        　URL->https://github.com/NaoyaKatsumata/fleaMarket
    </li>
    <li>クローンしたフォルダに移動</li>
    <li>dockerが起動しているのを確認し、ビルド<br>
        　docker-compose up -d --build
    </li>
    <li>composerをインストール<br>
        　docker-compose exec php bash<br>composer install
    </li>
    <li>.envファイルをコピーし編集<br>
        　cp .env.example .env<br>
        　nano .env<br>
        　(テキストエディタがない場合はインストール)<br>
        　apt install nano<br>
        　.env編集箇所<br>
        　DB_CONNECTION=mysql<br>
        　DB_HOST=mysql<br>
        　DB_PORT=3306<br>
        　DB_DATABASE=laravel_db<br>
        　DB_USERNAME=laravel_user<br>
        　DB_PASSWORD=laravel_pass<br>
        <br>
        　MAIL_MAILER=smtp<br>
        　MAIL_HOST=smtp.gmail.com<br>
        　MAIL_PORT=587<br>
        　MAIL_USERNAME=naoyakatsumata0708@gmail.com<br>
        　MAIL_PASSWORD="sjkm dwkn ihjx fxvy"<br>
        　MAIL_ENCRYPTION=tls<br>
        　MAIL_FROM_ADDRESS=naoyakatsumata0708@gmail.com<br>
        　MAIL_FROM_NAME="${APP_NAME}"<br>
        <br>
        　STRIPE_SECRET_KEY=sk_test_51Ps2R304yADrhrdliSOQHA8tHEQrJRi6ejYIDgEJM49iejC8SmPDLnNOSE30RWqnskznliIrnexhoBk7c69G1FCg00PqIK8exV<br>
        　STRIPE_PUBLIC_KEY=pk_test_51Ps2R304yADrhrdltk3Z2vMblFDpOPnzktddDa2fvNQ7pFd05FGnIMGDMjQ1gvjO7d5cM7ZOwmQ4EX8dZcaEQtg700b4nDnti8
        </li>
        <li>keyの作成<br>
        　php artisan key:generate
        </li>
        <li>npmのインストール<br>
        コンテナから出る<br>
        　exit<br>
        srcに移動<br>
        　cd src<br>
        npmをインストール<br>
        　npm install
        </li>
        <li>npmを起動
        　npm run dev</li>
        <li>ダミーデータの投入<br>
        　docker-compose exec php bash<br>
        　php artisan migrate<br>
        　php artisan db:seed</li>
        <li>ストレージとリンク<br>
        　php artisan storage:link</li>
        <li>ユーザの作成<br>
        　ユーザの作成・ログインはナビゲーションから<br>
        　管理者の作成->http://localhost/admin/register<br>
        　　　ログイン->http://localhost/admin/login</li>
</ul>