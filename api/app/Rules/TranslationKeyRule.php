<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Language;
use Illuminate\Contracts\Validation\Rule;

class TranslationKeyRule implements Rule
{
    private string $message;

    /**
     * @return void
     */
    public function __construct(
        private Language $language
    ) {
    }

    /**
     * @param string $attribute
     * @param $locales
     * @return bool
     */
    public function passes($attribute, $locales): bool
    {
        $languages = $this->retrieveLanguageCodes();

        foreach ($locales as $locale => $value) {
            if ($this->isLowercase($locale) === false) {
                $this->message = sprintf('Translation language "%s", must be in lowercase.', $locale);

                return false;
            }

            if ($this->languageExists($locale, $languages) === false) {
                $this->message = sprintf('Translation language "%s", does not supported.', $locale);

                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    private function retrieveLanguageCodes(): array
    {
        return $this->language::query()->get()->map(function (Language $language): string {
            return $language->code;
        })->toArray();
    }

    /**
     * @param int|string $key
     * @return bool
     */
    private function isLowercase(int|string $key): bool
    {
        return mb_strtolower($key) === $key;
    }

    /**
     * @param int|string $locale
     * @param array $languages
     * @return bool
     */
    private function languageExists(int|string $locale, array $languages): bool
    {
        return in_array($locale, $languages, true);
    }
}
