<?php

namespace App\Filament\Resources\Leads\Schemas;

use App\Enums\LeadStatus;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->components([

                        TextInput::make('name')
                            ->required(),

                        TextInput::make('phone')
                            ->tel()
                            ->required(),

                        TextInput::make('email')
                            ->email(),

                        TextInput::make('source')
                            ->placeholder('Facebook, Website, Referral, WhatsApp'),

                    ]),


                Section::make('Assignment')
                    ->components([

                        Select::make('assigned_to')
                            ->label('Assigned Agent')
                            ->relationship(
                                'assignedTo',
                                'name',
                                fn($query) => $query->where(
                                    'company_id',
                                    auth()->user()->company_id
                                )
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('property_id')
                            ->label('Interested Property (Optional)')
                            ->helperText('Leave empty if the client has not selected a property yet.')
                            ->relationship(
                                'property',
                                'title',
                                fn($query) => $query->where(
                                    'company_id',
                                    auth()->user()->company_id
                                )
                            )
                            ->searchable()
                            ->preload(),

                    ]),
                Section::make('CRM')
                    ->components([

                        DateTimePicker::make('next_follow_up_at')
                            ->label('Next Follow Up')
                            ->seconds(false),

                        Toggle::make('follow_up_completed')
                            ->label('Follow Up Completed')
                            ->default(false),

                        Select::make('status')
                            ->options(
                                collect(LeadStatus::cases())
                                    ->mapWithKeys(fn($case) => [
                                        $case->value => ucfirst($case->value),
                                    ])
                                    ->toArray()
                            )
                            ->default(LeadStatus::NEW->value)
                            ->required(),

                        Textarea::make('notes')
                            ->rows(5)
                            ->columnSpanFull(),

                    ]),


            ]);
    }
}
