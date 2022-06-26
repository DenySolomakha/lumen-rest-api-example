<?php

declare(strict_types=1);

namespace App\Services\Company;

use App\Models\Company\Company;
use App\Models\Company\CompanyTranslation;
use App\Models\User;
use Illuminate\Support\Collection;
use Throwable;

final class CompanyService
{
    /**
     * @throws Throwable
     */
    public function make(array $request, User $user): Company
    {
        $company = new Company();
        $company->withUser($user);
        $company->number_of_employees = $request['numberOfEmployees'];
        $company->slug = $request['slug'];
        $company->is_active = $request['isActive'];
        $company->saveOrFail();

        $translations = (new Collection($request['translations']))
            ->map(function (array $requestTranslation, string $locale): CompanyTranslation {
                $translation = new CompanyTranslation();
                $translation->language = $locale;
                $translation->title = $requestTranslation['title'];
                $translation->description = $requestTranslation['description'] ?? '';
                $translation->meta_title = $requestTranslation['metaTitle'] ?? null;
                $translation->meta_description = $requestTranslation['metaDescription'] ?? null;

                return $translation;
            })->flatten();

        $company->translations()->saveMany($translations);

        return Company::query()->filterByIdentifier($company->id)->isActive()->firstOrFail();
    }
}
