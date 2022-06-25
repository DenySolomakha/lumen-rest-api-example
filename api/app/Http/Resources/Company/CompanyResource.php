<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Models\Company\Company;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Company $this */
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'numberOfEmployers' => $this->number_of_employees,
            'slug' => $this->slug,
            'isActive' => $this->is_active,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'translations' => new CompanyTranslationResourceCollection($this->whenLoaded('translations'))
        ];
    }
}
