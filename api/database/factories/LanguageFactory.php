<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Language::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->country,
            'code' => $this->faker->languageCode,
        ];
    }
}
