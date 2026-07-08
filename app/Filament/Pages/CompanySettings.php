<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Schemas\CompanySettingsForm;
use App\Models\Company;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;

class CompanySettings extends Page
{
    protected static ?string $navigationLabel = 'Company Settings';

    protected static string|\UnitEnum|null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.company-settings';

    public Company $company;

    public ?array $data = [];

    public function mount(): void
    {
        $this->company = auth()->user()->company;

        $this->form->fill(
            $this->company->toArray()
        );
    }

    public function form(Schema $schema): Schema
    {
        return CompanySettingsForm::configure($schema)
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->company->update($data);

        Notification::make()
            ->title('Company updated successfully.')
            ->success()
            ->send();
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->action('save'),
        ];
    }
}
