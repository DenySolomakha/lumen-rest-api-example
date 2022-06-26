<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResourceCollection;
use App\Models\Company\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CompaniesAction extends Controller
{
    /**
     * @param Request $request
     * @return JsonResource
     */
    public function __invoke(Request $request): JsonResource
    {
        $companies = Company::query()
            ->filterByUser($request->attributes->get(User::class))
            ->isActive()
            ->paginate();

        return new CompanyResourceCollection($companies);
    }
}
