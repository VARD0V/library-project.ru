<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AiTransformationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        // id искусственных интеллектов: от 1 до 20
        for ($ai_id = 1; $ai_id <= 20; $ai_id++) {
            // Для каждого ai_id задаём transformation_id = номеру ai
            $transformation_id = $ai_id;

            $data[] = [
                'ai_id' => $ai_id,
                'transformation_id' => $transformation_id
            ];
        }

        DB::table('ai_transformations')->insert($data);
    }
}
