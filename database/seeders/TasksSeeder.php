<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['id' => 1, 'name' => 'Генерация изображений', 'code' => 'image_generation'],
            ['id' => 2, 'name' => 'Генерация видео', 'code' => 'video_generation'],
            ['id' => 3, 'name' => 'Перевод текста', 'code' => 'text_translation'],
            ['id' => 4, 'name' => 'Обработка аудио', 'code' => 'audio_processing'],
        ]);
    }
}
