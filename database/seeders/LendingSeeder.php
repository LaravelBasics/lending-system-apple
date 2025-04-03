<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lending;

class LendingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 特定のユーザー（例えばIDが1）のデータを100件作成
        Lending::factory()->count(1000)->create([
            'user_id' => 2, // 特定のユーザーIDを指定
        ]);

        // ダミーデータを挿入
        // Lending::factory()->count(100)->create(); // 他のユーザーに対するランダムなデータ
    }
}
