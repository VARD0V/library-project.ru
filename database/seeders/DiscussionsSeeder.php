<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('discussions')->insert([
            ['id' => 1, 'text' => 'Обсуждение общих вопросов по программированию.', 'title' => 'Программирование', 'description' => 'Разговор о языках программирования.', 'preview' => 'previews/discussion1.jpg','status' => 1, 'discussion_category_id' => 1, 'author_id' => 1],
            ['id' => 2, 'text' => 'Обсуждение технических проблем.', 'title' => 'Технические проблемы', 'description' => 'Как решить сложные технические задачи.', 'preview' => 'previews/discussion2.jpg','status' => 1, 'discussion_category_id' => 2, 'author_id' => 3],
            ['id' => 3, 'text' => 'Как выбрать правильную библиотеку для ML-проекта?', 'title' => 'Выбор библиотек ML', 'description' => 'Сравнение TensorFlow, PyTorch и других.', 'preview' => 'previews/discussion3.jpg', 'status' => 1, 'discussion_category_id' => 3, 'author_id' => 2],
            ['id' => 4, 'text' => 'Проблемы с установкой CUDA под Windows.', 'title' => 'Ошибка установки CUDA', 'description' => 'Помогите разобраться с драйверами NVIDIA.', 'preview' => 'previews/discussion4.jpg', 'status' => 1, 'discussion_category_id' => 4, 'author_id' => 1],
            ['id' => 5, 'text' => 'Какие практики лучше всего подходят для обучения нейросетей?', 'title' => 'Лучшие практики', 'description' => 'Делимся опытом настройки гиперпараметров.', 'preview' => 'previews/discussion5.jpg', 'status' => 1, 'discussion_category_id' => 5, 'author_id' => 3],
            ['id' => 6, 'text' => 'Как ускорить обучение модели без потери качества?', 'title' => 'Оптимизация обучения', 'description' => 'Использование mixed precision и других методов.', 'preview' => 'previews/discussion6.jpg', 'status' => 1, 'discussion_category_id' => 7, 'author_id' => 2],
            ['id' => 7, 'text' => 'Как отладить модель, которая не обучается?', 'title' => 'Модель не обучается', 'description' => 'Что проверить: веса, лосс, данные.', 'preview' => 'previews/discussion7.jpg', 'status' => 1, 'discussion_category_id' => 6, 'author_id' => 1],
            ['id' => 8, 'text' => 'Как правильно тестировать ИИ-приложения?', 'title' => 'Тестирование ИИ-моделей', 'description' => 'Подходы к unit-тестам и интеграционным тестам.', 'preview' => 'previews/discussion8.jpg', 'status' => 1, 'discussion_category_id' => 6, 'author_id' => 3],
            ['id' => 9, 'text' => 'Как повысить производительность модели при inference?', 'title' => 'Производительность модели', 'description' => 'Quantization, pruning и другие методы.', 'preview' => 'previews/discussion9.jpg', 'status' => 1, 'discussion_category_id' => 7, 'author_id' => 2],
            ['id' => 10, 'text' => 'Как использовать ONNX для переноса моделей между фреймворками?', 'title' => 'ONNX и совместимость', 'description' => 'Примеры конвертации моделей.', 'preview' => 'previews/discussion10.jpg', 'status' => 1, 'discussion_category_id' => 3, 'author_id' => 1],
        ]);
    }
}
