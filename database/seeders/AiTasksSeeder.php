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
        $data = [];

        // id искусственных интеллектов: от 1 до 20
        $task_counter = 1;

        for ($ai_id = 1; $ai_id <= 20; $ai_id++) {
            // На каждый ai_id приходится 2 task_id
            $data[] = [
                'ai_id' => $ai_id,
                'task_id' => $task_counter++
            ];
            $data[] = [
                'ai_id' => $ai_id,
                'task_id' => $task_counter++
            ];

            // Чтобы не выйти за пределы 146 задач
            if ($task_counter > 146) break;
        }

        DB::table('ai_tasks')->insert($data);
    }
}
