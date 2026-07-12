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
            ->columns(2)
            ->components([

                TextInput::make('name')
                    ->label('Company Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('company_code')
                    ->label('Company Code')
                    ->disabled()
                    ->dehydrated(false),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Phone')
                    ->tel()
                    ->maxLength(30),

                TextInput::make('website')
                    ->label('Website')
                    ->url(),

                ColorPicker::make('primary_color')
                    ->label('Brand Color'),

                FileUpload::make('logo')
                    ->label('Company Logo')
                    ->image()
                    ->disk('public')
                    ->directory('company-logos')
                    ->visibility('public')
                    ->imageEditor()
                    ->imagePreviewHeight('180')
                    ->columnSpanFull(),

                Textarea::make('address')
                    ->label('Address')
                    ->rows(3)
                    ->columnSpanFull(),

            ]);
    }
}