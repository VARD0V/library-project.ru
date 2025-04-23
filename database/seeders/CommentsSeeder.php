<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            ['id' => 1, 'text' => 'Отличная статья! Спасибо за подробное объяснение.', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 1],
            ['id' => 2, 'text' => 'Согласен, Python действительно мощный язык.', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 1],
            ['id' => 3, 'text' => 'Как решить проблему с зависанием программы?', 'user_id' => 4, 'discussion_id' => 1, 'article_id' => null],
            ['id' => 4, 'text' => 'Попробуйте перезапустить приложение.', 'user_id' => 2, 'discussion_id' => 1, 'article_id' => null],
            ['id' => 5, 'text' => 'Интересная тема про нейронные сети!', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 3],
        ]);
    }
}
