<?php

namespace Database\Seeders;

use App\Models\Company\Company;
use App\Models\Company\CompanyTranslation;
use App\Models\Language;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run():void
    {
        User::factory()
            ->count(5)
            ->has(
                Company::factory()
                    ->count(random_int(4, 7))
                    ->has(
                        CompanyTranslation::factory()
                            ->count(2)
                            ->state(new Sequence(
                                    ['language' => Language::EN],
                                    ['language' => Language::UK],
                                )
                            ),
                        'translations'),
                'companies')
            ->create();
    }
}
