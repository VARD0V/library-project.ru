<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_categories')->insert([
            ['id' => 1, 'name' => 'Программирование', 'code' => 'programming'],
            ['id' => 2, 'name' => 'Искусственный интеллект', 'code' => 'ai'],
            ['id' => 3, 'name' => 'Машинное обучение', 'code' => 'machine_learning'],
            ['id' => 4, 'name' => 'Глубокое обучение', 'code' => 'deep_learning'],
            ['id' => 5, 'name' => 'Обработка естественного языка', 'code' => 'nlp'],
            ['id' => 6, 'name' => 'Компьютерное зрение', 'code' => 'computer_vision'],
            ['id' => 7, 'name' => 'Нейронные сети', 'code' => 'neural_networks'],
        ]);    }
}
