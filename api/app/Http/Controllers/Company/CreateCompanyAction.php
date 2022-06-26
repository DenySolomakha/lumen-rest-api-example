<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Http\Validators\Company\CreateCompanyValidator;
use App\Models\User;
use App\Services\Company\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Throwable;

final class CreateCompanyAction extends Controller
{
    use CreateCompanyValidator;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(private readonly CompanyService $companyService)
    {
    }

    /**
     * @param Request $request
     * @return JsonResource
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResource
    {
        $this->validateRequest($request);

        /** @var User $user */
        $user = auth()->user();

        $company = $this->companyService->make($request->all(), $user);

        return new CompanyResource($company);
    }
}
