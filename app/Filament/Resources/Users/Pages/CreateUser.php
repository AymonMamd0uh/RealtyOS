<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected array $roleData = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->roleData['role'] = $data['role'] ?? null;

        unset($data['role']);

        if (auth()->user()->hasRole('Platform Admin')) {
            return $data;
        }

        $company = auth()->user()->company;

        if (! $company->canCreateUser()) {

            Notification::make()
                ->title('User limit reached')
                ->body('You have reached the maximum number of users allowed by your current subscription plan.')
                ->danger()
                ->persistent()
                ->send();

            $this->halt();
        }

        $data['company_id'] = $company->id;

        return $data;
    }

    protected function afterCreate(): void
    {
        if (! empty($this->roleData['role'])) {
            $this->record->assignRole($this->roleData['role']);
        }
    }
}