<?php

namespace App\Actions\Auth;

use App\Models\Company;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterCompanyAction
{
    public function execute(array $data): User
    {
        $company = Company::create([
            'name'         => $data['company_name'],
            'slug'         => $this->generateUniqueSlug($data['company_name']),
            'company_code' => strtoupper(Str::random(8)),
            'email'        => $data['email'],
        ]);

        $user = User::create([
            'company_id' => $company->id,
            'name'       => $data['owner_name'],
            'email'      => $data['email'],
            'password'   => $data['password'],
        ]);

        $user->assignRole('Owner');

        Auth::login($user);

        return $user;
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
