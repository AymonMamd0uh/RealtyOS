<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
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

        $data['company_id'] = auth()->user()->company_id;

        return $data;
    }

    protected function afterCreate(): void
    {
        if (! empty($this->roleData['role'])) {
            $this->record->assignRole($this->roleData['role']);
        }
    }
}
