<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',

        'company_code',

        'email',
        'phone',

        'website',

        'logo',

        'primary_color',

        'address',

        'is_active',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
