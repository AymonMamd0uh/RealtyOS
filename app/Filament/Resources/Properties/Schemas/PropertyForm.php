<?php

namespace App\Filament\Resources\Properties\Schemas;

use App\Enums\ListingType;
use App\Enums\PropertyStatus;
use App\Enums\PropertyType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\CheckboxList;
use App\Models\Area;
use App\Models\Compound;
use App\Models\Stage;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

class PropertyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('user_id')
                    ->label('Assigned Agent')
                    ->relationship(
                        'user',
                        'name',
                        fn($query) => $query->where(
                            'company_id',
                            auth()->user()->company_id
                        )
                    )
                    ->default(auth()->id())
                    ->disabled(fn() => auth()->user()->hasRole('Agent'))
                    ->dehydrated()
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->columnSpanFull(),

                Select::make('property_type')
                    ->options(
                        collect(PropertyType::cases())
                            ->mapWithKeys(fn($case) => [
                                $case->value => ucfirst($case->value),
                            ])
                            ->toArray()
                    )
                    ->required(),

                Select::make('listing_type')
                    ->options(
                        collect(ListingType::cases())
                            ->mapWithKeys(fn($case) => [
                                $case->value => ucfirst($case->value),
                            ])
                            ->toArray()
                    )
                    ->required(),

                Select::make('city_id')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('area_id', null);
                        $set('compound_id', null);
                        $set('stage_id', null);
                    })
                    ->required(),

                Select::make('area_id')
                    ->options(
                        fn(Get $get) => Area::query()
                            ->where('city_id', $get('city_id'))
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('compound_id', null);
                        $set('stage_id', null);
                    })
                    ->required(),

                Select::make('compound_id')
                    ->options(
                        fn(Get $get) => Compound::query()
                            ->where('area_id', $get('area_id'))
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(function (Set $set) {
                        $set('stage_id', null);
                    }),

                Select::make('stage_id')
                    ->options(
                        fn(Get $get) => Stage::query()
                            ->where('compound_id', $get('compound_id'))
                            ->pluck('name', 'id')
                            ->toArray()
                    )
                    ->searchable(),

                TextInput::make('price')
                    ->numeric()
                    ->minValue(1)
                    ->prefix('EGP')
                    ->required(),

                TextInput::make('built_area')
                    ->numeric(),

                TextInput::make('land_area')
                    ->numeric(),

                TextInput::make('bedrooms')
                    ->numeric()
                    ->minValue(0),

                TextInput::make('bathrooms')
                    ->numeric()
                    ->minValue(0),

                TextInput::make('floor_number')
                    ->numeric(),

                Toggle::make('is_furnished')
                    ->default(false),
                CheckboxList::make('features')
                    ->relationship('features', 'name')
                    ->columns(3)
                    ->searchable()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(
                        collect(PropertyStatus::cases())
                            ->mapWithKeys(fn($case) => [
                                $case->value => ucfirst($case->value),
                            ])
                            ->toArray()
                    )
                    ->default(PropertyStatus::DRAFT->value)
                    ->required(),
            ]);
    }
}
