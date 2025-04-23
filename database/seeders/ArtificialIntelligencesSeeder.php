<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtificialIntelligencesSeeder extends Seeder
{
    public function run()
    {
        DB::table('artificial_intelligences')->insert([
            ['id' => 1, 'name' => 'AI Image Generator', 'paid' => 1, 'trial' => '7 дней', 'conversion_from' => null, 'conversion_to' => null],
            ['id' => 2, 'name' => 'AI Video Processor', 'paid' => 0, 'trial' => '14 дней', 'conversion_from' => 'basic', 'conversion_to' => 'pro'],
        ]);
    }
}
