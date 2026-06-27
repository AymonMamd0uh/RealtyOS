<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected array $roleData = [];

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->roleData['role'] = $data['role'] ?? null;

        unset($data['role']);

        return $data;
    }

    protected function afterSave(): void
    {
        if (! empty($this->roleData['role'])) {
            $this->record->syncRoles([$this->roleData['role']]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}