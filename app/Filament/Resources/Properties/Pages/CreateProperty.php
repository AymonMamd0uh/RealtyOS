<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use App\Models\Company;
use Filament\Resources\Pages\CreateRecord;

class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $company = auth()->user()->company;

        $lastPropertyCount = $company
            ->properties()
            ->count();

        $data['company_id'] = $company->id;
        $data['user_id'] = auth()->id();

        $data['reference_number'] = sprintf(
            '%s-%06d',
            strtoupper($company->company_code),
            $lastPropertyCount + 1
        );

        return $data;
    }
}
