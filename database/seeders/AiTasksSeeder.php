<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ai_tasks')->insert([
            ['id' => 1, 'task_id' => 1, 'ai_id' => 1],
            ['id' => 2, 'task_id' => 2, 'ai_id' => 2],
            ['id' => 3, 'task_id' => 3, 'ai_id' => 1],
            ['id' => 4, 'task_id' => 4, 'ai_id' => 2],
        ]);    }
}
