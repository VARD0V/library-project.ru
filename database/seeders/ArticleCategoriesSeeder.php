<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_categories')->insert([
            ['id' => 1, 'name' => 'Программирование', 'code' => 'programming'],
            ['id' => 2, 'name' => 'Искусственный интеллект', 'code' => 'ai'],
        ]);    }
}
