<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('discussions')->insert([
            ['id' => 1, 'text' => 'Обсуждение общих вопросов по программированию.', 'title' => 'Программирование', 'description' => 'Разговор о языках программирования.', 'preview' => 'previews/discussion1.jpg','status' => 'Актуально', 'discussion_category_id' => 1, 'author_id' => 1],
            ['id' => 2, 'text' => 'Обсуждение технических проблем.', 'title' => 'Технические проблемы', 'description' => 'Как решить сложные технические задачи.', 'preview' => 'previews/discussion2.jpg','status' => 'Актуально', 'discussion_category_id' => 2, 'author_id' => 3],
        ]);
    }
}
