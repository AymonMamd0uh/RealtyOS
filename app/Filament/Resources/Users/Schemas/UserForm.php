<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Spatie\Permission\Models\Role;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('phone')
                    ->tel(),

                TextInput::make('job_title')
                    ->label('Job Title'),

                Select::make('company_id')
                    ->label('Company')
                    ->options(
                        Company::pluck('name', 'id')
                    )
                    ->searchable()
                    ->required(fn() => auth()->user()->hasRole('Platform Admin'))
                    ->visible(fn() => auth()->user()->hasRole('Platform Admin')),

                Select::make('role')
                    ->options(function () {

                        if (auth()->user()->hasRole('Platform Admin')) {
                            return [
                                'Platform Admin' => 'Platform Admin',
                                'Owner' => 'Owner',
                                'Super Admin' => 'Super Admin',
                                'Manager' => 'Manager',
                                'Agent' => 'Agent',
                            ];
                        }

                        return [
                            'Manager' => 'Manager',
                            'Agent' => 'Agent',
                        ];
                    })
                    ->required()
                    ->searchable(),

                TextInput::make('password')
                    ->password()
                    ->required(fn(string $operation) => $operation === 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                    ->revealable(),

                FileUpload::make('avatar')
                    ->image()
                    ->directory('avatars'),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
