<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Models\Company\CompanyTranslation;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyTranslationResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var CompanyTranslation $this */
        return [
            'id' => $this->id,
            'language' => $this->language,
            'title' => $this->title,
            'description' => $this->description,
            'metaTitle' => $this->meta_title,
            'metaDescription' => $this->meta_description,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
