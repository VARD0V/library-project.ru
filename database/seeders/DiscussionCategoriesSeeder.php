<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discussion_categories')->insert([
            ['id' => 1, 'name' => 'Общие вопросы', 'code' => 'general'],
            ['id' => 2, 'name' => 'Технические вопросы', 'code' => 'technical'],
            ['id' => 3, 'name' => 'Поддержка библиотек', 'code' => 'library_support'],
            ['id' => 4, 'name' => 'Настройка окружения', 'code' => 'setup'],
            ['id' => 5, 'name' => 'Лучшие практики', 'code' => 'best_practices'],
            ['id' => 6, 'name' => 'Отладка и тестирование', 'code' => 'debugging_testing'],
            ['id' => 7, 'name' => 'Производительность моделей', 'code' => 'model_performance'],
        ]);
    }
}
