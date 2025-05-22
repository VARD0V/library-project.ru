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
            ['id' => 3, 'text' => 'Статья о нейронных сетях.', 'title' => 'Нейронные сети', 'description' => 'Архитектура и применение нейронных сетей.', 'preview' => null, 'article_category_id' => 2, 'author_id' => 1],
            ['id' => 4, 'text' => 'Статья о JavaScript.', 'title' => 'JavaScript для начинающих', 'description' => 'Основы языка JavaScript.', 'preview' => null, 'article_category_id' => 1, 'author_id' => 2],
            ['id' => 5, 'text' => 'Руководство по TensorFlow для начинающих.', 'title' => 'TensorFlow: первые шаги', 'description' => 'Установка и базовое использование TensorFlow.', 'preview' => null, 'article_category_id' => 2, 'author_id' => 3],
            ['id' => 6, 'text' => 'Как использовать PyTorch для глубокого обучения.', 'title' => 'PyTorch и нейросети', 'description' => 'Практическое руководство по созданию моделей на PyTorch.', 'preview' => null, 'article_category_id' => 4, 'author_id' => 2],
            ['id' => 7, 'text' => 'Трансформеры в NLP: что это и как работают.', 'title' => 'Трансформеры в обработке текста', 'description' => 'Разбор архитектуры трансформеров и их применения.', 'preview' => null, 'article_category_id' => 5, 'author_id' => 1],
            ['id' => 8, 'text' => 'YOLO: быстрое распознавание объектов в изображениях.', 'title' => 'Компьютерное зрение с YOLO', 'description' => 'Как работает модель YOLO и её преимущества.', 'preview' => null, 'article_category_id' => 6, 'author_id' => 2],
            ['id' => 9, 'text' => 'Сравнение фреймворков для компьютерного зрения.', 'title' => 'OpenCV vs MediaPipe', 'description' => 'Что выбрать для работы с изображениями и видео.', 'preview' => null, 'article_category_id' => 6, 'author_id' => 3],
            ['id' => 10, 'text' => 'Как подготовить данные для модели машинного обучения.', 'title' => 'Предобработка данных', 'description' => 'Очистка, нормализация и кодирование признаков.', 'preview' => null, 'article_category_id' => 3, 'author_id' => 1],
            ['id' => 11, 'text' => 'BERT и его применение в задачах NLP.', 'title' => 'BERT: от теории к практике', 'description' => 'Как использовать BERT для анализа текста.', 'preview' => null, 'article_category_id' => 5, 'author_id' => 2],
            ['id' => 12, 'text' => 'Как оптимизировать производительность моделей ИИ.', 'title' => 'Оптимизация ИИ-моделей', 'description' => 'Quantization, pruning и другие методы ускорения.', 'preview' => null, 'article_category_id' => 4, 'author_id' => 1],
            ['id' => 13, 'text' => 'Автоматическая генерация текста с помощью GPT.', 'title' => 'GPT и генерация текста', 'description' => 'Как работают языковые модели и их применение.', 'preview' => null, 'article_category_id' => 5, 'author_id' => 2],
            ['id' => 14, 'text' => 'Работа с изображениями в библиотеке Keras.', 'title' => 'Keras и компьютерное зрение', 'description' => 'Обучение моделей классификации изображений.', 'preview' => null, 'article_category_id' => 6, 'author_id' => 2],
        ]);
    }
}
