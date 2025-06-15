<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtificialIntelligencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('artificial_intelligences')->insert([
            ['id' => 1,'name' => 'AI Image Generator', 'paid' => 1, 'trial' => '7 ', 'description' => 'Супер технически продвинутый ИИ для генерации изображений.', 'link' => 'https://chat.asenh.ai/ '],
            ['id' => 2,'name' => 'TextMaster Pro', 'paid' => 1, 'trial' => '14 ', 'description' => 'Генерация и редактирование текстов на любом языке.', 'link' => 'https://textmasterpro.com '],
            ['id' => 3,'name' => 'CodeCraft AI', 'paid' => 1, 'trial' => null, 'description' => 'Помощник разработчика, пишет код за секунды.', 'link' => 'https://codecraftai.dev '],
            ['id' => 4,'name' => 'VoiceSynth', 'paid' => 1, 'trial' => '3 ', 'description' => 'Создание реалистичного голоса из текста.', 'link' => 'https://voicesynth.io '],
            ['id' => 5,'name' => 'AutoVideoGen', 'paid' => 1, 'trial' => '7 ', 'description' => 'Автоматическая генерация видео по скрипту.', 'link' => 'https://autovideogen.net '],
            ['id' => 6,'name' => 'ChatBot Studio', 'paid' => 1, 'trial' => '14 ', 'description' => 'Создание чат-ботов без знания программирования.', 'link' => 'https://chatbotstudio.org '],
            ['id' => 7,'name' => 'DeepDesign AI', 'paid' => 1, 'trial' => null, 'description' => 'Дизайн сайтов и логотипов с помощью искусственного интеллекта.', 'link' => 'https://deepdesignai.app '],
            ['id' => 8,'name' => 'DataMind', 'paid' => 1, 'trial' => '7 ', 'description' => 'Анализ данных и построение диаграмм одним кликом.', 'link' => 'https://datamind.tools '],
            ['id' => 9,'name' => 'PhotoFixer', 'paid' => 0, 'trial' => null, 'description' => 'Бесплатное улучшение качества фотографий.', 'link' => 'https://photofixer.free '],
            ['id' => 10,'name' => 'ScriptWriter AI', 'paid' => 1, 'trial' => '5 ', 'description' => 'Написание сценариев и сюжетов для фильмов и сериалов.', 'link' => 'https://scriptwriterai.tv '],
            ['id' => 11,'name' => 'SmartTranslater', 'paid' => 1, 'trial' => '10 ', 'description' => 'Перевод текста между всеми языками мира.', 'link' => 'https://smarttranslater.world '],
            ['id' => 12,'name' => 'MusicComposer AI', 'paid' => 1, 'trial' => '7 ', 'description' => 'Создание музыки под любое видео или настроение.', 'link' => 'https://musiccomposerai.art '],
            ['id' => 13,'name' => 'AdGenerator', 'paid' => 1, 'trial' => null, 'description' => 'Автоматическое создание рекламных текстов и объявлений.', 'link' => 'https://adgenerator.marketing '],
            ['id' => 14,'name' => 'SEO Helper AI', 'paid' => 1, 'trial' => '7 ', 'description' => 'Оптимизация контента под поисковые системы.', 'link' => 'https://seohelperai.com '],
            ['id' => 15,'name' => 'AI Presenter', 'paid' => 1, 'trial' => '3 ', 'description' => 'Создание презентаций по одному описанию.', 'link' => 'https://aipresenter.slides '],
            ['id' => 16,'name' => 'PDF Analyzer', 'paid' => 0, 'trial' => null, 'description' => 'Бесплатный анализ PDF документов и выделение ключевой информации.', 'link' => 'https://pdfanalyzer.free '],
            ['id' => 17,'name' => 'LogoMaker AI', 'paid' => 1, 'trial' => '7 ', 'description' => 'Создание уникальных логотипов за считанные минуты.', 'link' => 'https://logomakerai.design '],
            ['id' => 18,'name' => 'SocialPostGen', 'paid' => 1, 'trial' => '14 ', 'description' => 'Автоматическая генерация постов для соцсетей.', 'link' => 'https://socialpostgen.media '],
            ['id' => 19,'name' => 'EmailAssistant', 'paid' => 1, 'trial' => null, 'description' => 'Умный помощник для написания деловых писем.', 'link' => 'https://emailassistant.office '],
            ['id' => 20,'name' => '3D Model Creator', 'paid' => 1, 'trial' => '7 ', 'description' => 'Создание 3D моделей из текстового описания.', 'link' => 'https://3dmodelcreator.studio '],
        ]);
    }
}
