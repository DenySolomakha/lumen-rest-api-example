<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Models\Company\CompanyTranslation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyTranslationResourceCollection extends ResourceCollection
{
    public static $wrap = null;

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var CompanyTranslation $this */
        return $this->collection->toArray();
    }
}
