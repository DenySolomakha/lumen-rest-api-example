<?php

declare(strict_types=1);

namespace Database\Factories\Company;

use App\Models\Company\Company;
use App\Models\Company\CompanyTranslation;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyTranslationFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = CompanyTranslation::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'language' => Language::factory(),
            'title' => $this->faker->company(),
            'description' => $this->faker->realText(700),
            'meta_title' => sprintf('%s | %s', $this->faker->company(), env('APP_NAME')),
            'meta_description' => sprintf('%s | %s', $this->faker->realText(50), env('APP_NAME')),
        ];
    }
}
