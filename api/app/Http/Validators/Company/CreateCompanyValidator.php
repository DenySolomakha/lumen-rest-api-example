<?php

declare(strict_types=1);

namespace App\Http\Validators\Company;

use App\Models\Language;
use App\Rules\TranslationKeyRule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

trait CreateCompanyValidator
{
    /**
     * @throws ValidationException
     */
    protected function validateRequest(Request $request): void
    {
        $this->validate($request, [
            'numberOfEmployees' => 'integer',
            'slug' => 'required|string:max:200|unique:companies',
            'translations' => ['required', 'array', new TranslationKeyRule(app(Language::class))],
            'translations.*.description' => 'required|max:3000',
            'translations.*.metaTitle' => 'max:100',
            'translations.*.metaDescription' => 'max:300',
        ]);
    }
}
