<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'Футболка Decentrathon',
                'description' => 'Вы получите футболку движения Decentrathon',
                'image' => 'https://i.ibb.co.com/SVtxL8T/IMG-20241019-213455.png', // Путь к изображению
                'price' => 1000,
            ],
            [
                'title' => 'Наклейки Decentrathon',
                'description' => 'Вы получите наклейки движения Decentrathon',
                'image' => 'https://i.ibb.co.com/zF69XZh/IMG-20241019-213509.png',
                'price' => 300,
            ],
            [
                'title' => 'Высадить дерево',
                'description' => 'Благотворительный фонд по высадке деревьев',
                'image' => 'https://img.freepik.com/premium-vector/beautiful-tree-realistic-on-a-white-background_1234575-2774.jpg',
                'price' => 500,
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }
    }
}
