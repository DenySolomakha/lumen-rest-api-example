<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Language::factory()->count(2)->state(new Sequence(
            [
                'name' => Language::getSupportedLanguages()[Language::EN],
                'code' => Language::EN,
            ],
            [
                'name' => Language::getSupportedLanguages()[Language::UK],
                'code' => Language::UK,
            ],
        ))->create();
    }
}
