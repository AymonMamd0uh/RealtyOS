<?php

namespace App\Filament\Pages\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CompanySettingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->required(),

                TextInput::make('company_code')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('email')
                    ->email(),

                TextInput::make('phone'),

                TextInput::make('website')
                    ->url(),

                ColorPicker::make('primary_color'),

                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('company-logos')
                    ->visibility('public')
                    ->multiple(false)
                    ->imageEditor()
                    ->imagePreviewHeight('180'),

                Textarea::make('address')
                    ->columnSpanFull(),

            ]);
    }
}
