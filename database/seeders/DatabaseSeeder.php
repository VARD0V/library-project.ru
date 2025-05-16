<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            ArticleCategoriesSeeder::class,
            DiscussionCategoriesSeeder::class,
            ArticlesSeeder::class,
            DiscussionsSeeder::class,
            CommentsSeeder::class,
            TasksSeeder::class,
            TransformationsSeeder::class,
            ArtificialIntelligencesSeeder::class,
            AiTasksSeeder::class,
            AiTransformationsSeeder::class,
        ]);
    }
}
