<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscussionCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discussion_categories')->insert([
            ['id' => 1, 'name' => 'Общие вопросы', 'code' => 'general'],
            ['id' => 2, 'name' => 'Технические вопросы', 'code' => 'technical'],
        ]);
    }
}
