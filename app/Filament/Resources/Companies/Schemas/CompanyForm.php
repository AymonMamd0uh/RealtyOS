<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('company_code')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('email')
                    ->email(),

                TextInput::make('phone')
                    ->tel(),

                TextInput::make('website')
                    ->url(),

                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('company-logos'),

                ColorPicker::make('primary_color')
                    ->default('#f59e0b'),

                Textarea::make('address')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
