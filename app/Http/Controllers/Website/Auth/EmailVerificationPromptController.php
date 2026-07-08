<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;

class EmailVerificationPromptController extends Controller
{
    public function __invoke()
    {
        return view('website.auth.verify-email');
    }
}