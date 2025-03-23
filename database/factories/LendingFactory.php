<?php

namespace Database\Factories;

use App\Models\Lending;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lending>
 */
class LendingFactory extends Factory
{
    protected $model = Lending::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ja_JP');// 日本語？

        // 品名リストを用意
        $itemNames = [
            'PC体験用No1', 'PC体験用No2', 'PC体験用No3', 'PC体験用No4', 'PC体験用No5',
            'PC体験用No6', 'PC体験用No7', 'PC体験用No8', 'PC体験用No9', 'PC体験用No10',
            'PCプログラミング用No1', 'PCプログラミング用No2', 'PCプログラミング用No3', 'PCプログラミング用No4', 'PCプログラミング用No5',
            'PCプログラミング用No6', 'PCプログラミング用No7', 'PCプログラミング用No8', 'PCプログラミング用No9', 'PCプログラミング用No10',
            'PCオフィス用No1', 'PCオフィス用No2', 'PCオフィス用No3', 'PCオフィス用No4', 'PCオフィス用No5',
            'PCオフィス用No6', 'PCオフィス用No7', 'PCオフィス用No8', 'PCオフィス用No9', 'PCオフィス用No10',
            'マウスNo1', 'マウスNo2', 'マウスNo3', 'マウスNo4', 'マウスNo5', 'マウスNo6', 'マウスNo7',
            '傘No1', '傘No2', '傘No3', '傘No4', '傘No5', '傘No6', '傘No7',
            'webカメラ', '三脚',
        ];

        $returnDate = $faker->optional()->dateTimeBetween('now', '+1 year');

        return [
            'name' => $faker->name, // ランダムな名前
            'item_name' => $faker->randomElement($itemNames), // ランダムな品名
            'lend_date' => $faker->dateTimeBetween('2020-01-01', '2024-12-31')->format('Y-m-d'), // ランダムな貸出日
            'return_date' => $returnDate ? $returnDate->format('Y-m-d') : null, // 返却日（1年後のランダムな日付、NULL可）
        ];
    }
}
