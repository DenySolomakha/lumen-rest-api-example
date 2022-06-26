<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class CompanyAction extends Controller
{
    /**
     * @param string $identifier
     * @param Request $request
     * @return JsonResource
     */
    public function __invoke(string $identifier, Request $request): JsonResource
    {
        $companies = Company::query()
            ->filterByUser($request->attributes->get(User::class))
            ->filterByIdentifier($identifier)
            ->isActive()
            ->firstOrFail();

        return new CompanyResource($companies);
    }
}
