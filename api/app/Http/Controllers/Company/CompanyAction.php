<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Resources\Company\CompanyResourceCollection;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyAction
{
    /**
     * @param Request $request
     * @return JsonResource
     */
    public function __invoke(Request $request): JsonResource
    {
        $companies = Company::query()->filterByUser(auth()->user())->paginate();

        return new CompanyResourceCollection($companies);
    }
}
