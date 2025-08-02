<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            ['name' => 'スキンケア', 'sort_order' => 10],
            ['name' => 'ベースメイク', 'sort_order' => 20],
            ['name' => 'アイブロウ', 'sort_order' => 30],
            ['name' => 'アイシャドウ', 'sort_order' => 40],
            ['name' => 'アイライナー', 'sort_order' => 50],
            ['name' => 'マスカラ', 'sort_order' => 60],
            ['name' => 'チーク', 'sort_order' => 70],
            ['name' => 'リップ', 'sort_order' => 80],
            ['name' => 'ヘアケア', 'sort_order' => 90],
            ['name' => 'ボディケア', 'sort_order' => 100],
            ['name' => 'フレグランス', 'sort_order' => 110],
            ['name' => 'ネイル', 'sort_order' => 120],
            ['name' => 'その他', 'sort_order' => 130],

        ];
        foreach ($names as $item) {
            \App\Models\Category::updateOrCreate(
                ['name' => $item['name']],
                ['sort_order' => $item['sort_order']]
            );
        }
    }
}
