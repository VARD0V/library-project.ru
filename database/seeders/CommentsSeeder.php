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
            ['id' => 3, 'text' => 'Как решить проблему с зависанием программы?', 'user_id' => 3, 'discussion_id' => 1, 'article_id' => null],
            ['id' => 4, 'text' => 'Попробуйте перезапустить приложение.', 'user_id' => 2, 'discussion_id' => 1, 'article_id' => null],
            ['id' => 5, 'text' => 'Интересная тема про нейронные сети!', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 3],
            ['id' => 6, 'text' => 'Хорошо объяснили основы машинного обучения!', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 2],
            ['id' => 7, 'text' => 'Мне понравилось описание алгоритма kNN.', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 2],
            ['id' => 8, 'text' => 'TensorFlow мне кажется сложнее PyTorch.', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 5],
            ['id' => 9, 'text' => 'Будут ли примеры кода в этой статье?', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 5],
            ['id' => 10, 'text' => 'PyTorch удобнее для исследовательских задач.', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 6],
            ['id' => 11, 'text' => 'Хорошее введение в трансформеры, спасибо!', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 7],
            ['id' => 12, 'text' => 'Можно больше информации про аттеншн?', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 7],
            ['id' => 13, 'text' => 'YOLO — отличный выбор для реального времени.', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 8],
            ['id' => 14, 'text' => 'Стоит ли использовать YOLOv8 вместо v5?', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 8],
            ['id' => 15, 'text' => 'OpenCV лучше подходит для простых задач.', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 9],
            ['id' => 16, 'text' => 'Мне MediaPipe понравился больше, чем OpenCV.', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 9],
            ['id' => 17, 'text' => 'Как правильно нормализовать данные?', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 10],
            ['id' => 18, 'text' => 'Минимакс или Z-score — что лучше?', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 10],
            ['id' => 19, 'text' => 'BERT круто работает с длинными текстами!', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 11],
            ['id' => 20, 'text' => 'Нужны ли специальные GPU для BERT?', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 11],
            ['id' => 21, 'text' => 'Как уменьшить размер модели без потерь точности?', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 12],
            ['id' => 22, 'text' => 'Pruning помог мне ускорить вывод модели.', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 12],
            ['id' => 23, 'text' => 'GPT слишком прожорливый в плане ресурсов.', 'user_id' => 3, 'discussion_id' => null, 'article_id' => 13],
            ['id' => 24, 'text' => 'А есть аналоги GPT с меньшим потреблением памяти?', 'user_id' => 2, 'discussion_id' => null, 'article_id' => 13],
            ['id' => 25, 'text' => 'Классификация изображений — хорошее начало для новичков.', 'user_id' => 1, 'discussion_id' => null, 'article_id' => 14],
        ]);
    }
}
