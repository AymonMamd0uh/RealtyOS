<?php

namespace App\Filament\Resources\Properties\Pages;

use App\Filament\Resources\Properties\PropertyResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateProperty extends CreateRecord
{
    protected static string $resource = PropertyResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $company = auth()->user()->company;

        if (! $company->canCreateProperty()) {

            Notification::make()
                ->title('Property limit reached')
                ->body('You have reached the maximum number of properties allowed by your current subscription plan.')
                ->danger()
                ->persistent()
                ->send();

            $this->halt();
        }

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