<?php

namespace Database\Seeders;

use App\Models\Company\Company;
use App\Models\Company\CompanyTranslation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run():void
    {
        User::factory()
            ->count(5)
            ->has(
                Company::factory()
                    ->count(3)
                    ->has(
                        CompanyTranslation::factory()
                            ->count(2)
                            ->state(new Sequence(
                                    ['language_id' => 1],
                                    ['language_id' => 2],
                                )
                            ),
                        'translations'),
                'companies')
            ->create();
    }
}
