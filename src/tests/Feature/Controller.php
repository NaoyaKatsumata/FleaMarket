<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Item;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testShippingStore()
    {
        // モックファイルシステムを使用してストレージの操作をシミュレート
        Storage::fake('public');

        // テスト用のユーザーを作成
        $user = User::factory()->create();
        // テストデータの準備
        $file = UploadedFile::fake()->image('test-image.jpg');

        $response = $this->actingAs($user)->put('/mypage', [
            'path' => $file,
            'userId' => $user->id,
            'mainCategory' => 1,
            'subCategory' => 1,
            'status' => 1,
            'itemName' => 'Test Item',
            'description' => 'Test Description',
            'price' => 1000,
        ]);

        // ステータスコードの確認
        $response->assertStatus(200);

        // データベースの状態を確認
        $this->assertDatabaseHas('items', [
            'name' => 'Test Item',
            'comment' => 'Test Description',
            'price' => 1000,
            'category_id' => 1,
            'status_id' => 1,
            'shipping_user_id' => $user->id,
        ]);
    }
}
