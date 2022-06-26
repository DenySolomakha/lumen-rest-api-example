<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company\Company;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

final class CompanyAction extends Controller
{
    /**
     * @param string $identifier
     * @return JsonResource
     */
    public function __invoke(string $identifier): JsonResource
    {
        /** @var User $user */
        $user = auth()->user();

        $companies = Company::query()
            ->filterByUser($user)
            ->filterByIdentifier($identifier)
            ->isActive()->firstOrFail();

        return new CompanyResource($companies);
    }
}
