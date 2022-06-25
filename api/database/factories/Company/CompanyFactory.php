<?php

declare(strict_types=1);

namespace Database\Factories\Company;

use App\Models\Company\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Company::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'number_of_employees' => $this->faker->numberBetween(5, 3500),
            'slug' => $this->faker->slug,
            'is_active' => $this->faker->boolean,
        ];
    }
}
