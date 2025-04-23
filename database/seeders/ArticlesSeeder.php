<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->insert([
            ['id' => 1, 'text' => 'Статья о Python: основы программирования.', 'title' => 'Основы Python', 'description' => 'Введение в язык программирования Python.', 'preview' => null, 'article_category_id' => 1, 'author_id' => 2],
            ['id' => 2, 'text' => 'Статья о машинном обучении.', 'title' => 'Машинное обучение', 'description' => 'Как работают алгоритмы машинного обучения.', 'preview' => null, 'article_category_id' => 2, 'author_id' => 3],
            ['id' => 3, 'text' => 'Статья о нейронных сетях.', 'title' => 'Нейронные сети', 'description' => 'Архитектура и применение нейронных сетей.', 'preview' => null, 'article_category_id' => 2, 'author_id' => 4],
            ['id' => 4, 'text' => 'Статья о JavaScript.', 'title' => 'JavaScript для начинающих', 'description' => 'Основы языка JavaScript.', 'preview' => null, 'article_category_id' => 1, 'author_id' => 2],
        ]);
    }
}
