<?php

namespace Database\Seeders;

use App\Repositories\SettingRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingRepository::create([
            'footer_text' => 'Developed by ITE DEVELOPMENT',
            'currency_position' => 'Left',
        ]);
    }
}
