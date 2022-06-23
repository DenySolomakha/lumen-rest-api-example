<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

final class SignIn extends Controller
{
    public function __invoke(Request $request)
    {
       dd($request->all());
    }
}
