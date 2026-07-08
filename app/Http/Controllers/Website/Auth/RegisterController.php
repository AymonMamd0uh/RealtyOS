<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Actions\Auth\RegisterCompanyAction;
use App\Models\Plan;

class RegisterController extends Controller
{
    public function create()
    {
        $plan = Plan::find(request('plan'));

        return view('website.auth.register', compact('plan'));
    }
    public function store(
        RegisterCompanyRequest $request,
        RegisterCompanyAction $registerCompanyAction
    ) {
        DB::transaction(function () use ($request, $registerCompanyAction) {

            $registerCompanyAction->execute(
                $request->validated()
            );
        });

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
    private function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (Company::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
