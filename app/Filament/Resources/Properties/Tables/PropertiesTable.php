<?php

namespace App\Filament\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;

use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\RepeatableEntry;
use App\Filament\Resources\Properties\Infolists\PropertyInfolist;
use App\Filament\Resources\Properties\PropertyResource;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('reference_number')
                    ->label('Ref')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                TextColumn::make('company.name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->visible(
                        fn() => auth()->user()->hasRole('Platform Admin')
                    ),

                TextColumn::make('user.name')
                    ->label('Agent')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('property_type')
                    ->badge(),

                TextColumn::make('listing_type')
                    ->badge(),

                TextColumn::make('compound.name')
                    ->label('Compound')
                    ->sortable(),

                TextColumn::make('stage.name')
                    ->label('Stage')
                    ->sortable(),

                TextColumn::make('price')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('bedrooms')
                    ->sortable(),

                TextColumn::make('bathrooms')
                    ->sortable(),

                IconColumn::make('is_furnished')
                    ->label('Furnished')
                    ->boolean(),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                \Filament\Tables\Filters\SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
                    ->searchable()
                    ->preload(),

                \Filament\Tables\Filters\SelectFilter::make('area_id')
                    ->label('Area')
                    ->relationship('area', 'name')
                    ->searchable()
                    ->preload(),

                \Filament\Tables\Filters\SelectFilter::make('compound_id')
                    ->label('Compound')
                    ->relationship('compound', 'name')
                    ->searchable()
                    ->preload(),

                \Filament\Tables\Filters\SelectFilter::make('user_id')
                    ->label('Agent')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload(),

                \Filament\Tables\Filters\SelectFilter::make('property_type')
                    ->options([
                        'apartment' => 'Apartment',
                        'villa' => 'Villa',
                        'townhouse' => 'Townhouse',
                        'twin_house' => 'Twin House',
                        'penthouse' => 'Penthouse',
                        'office' => 'Office',
                        'shop' => 'Shop',
                        'land' => 'Land',
                    ]),

                \Filament\Tables\Filters\SelectFilter::make('listing_type')
                    ->options([
                        'sale' => 'Sale',
                        'rent' => 'Rent',
                    ]),

                \Filament\Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'available' => 'Available',
                        'reserved' => 'Reserved',
                        'sold' => 'Sold',
                        'rented' => 'Rented',
                    ]),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(
                        fn($record) => PropertyResource::getUrl('view', [
                            'record' => $record,
                        ])
                    ),
                EditAction::make(),

            ])
            ->toolbarActions([
                Action::make('export')
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('gray')
                    ->url(function ($livewire) {
                        $filters = $livewire->tableFilters ?? [];

                        return route('properties.export.direct', [
                            'search' => $livewire->tableSearch ?? null,

                            'city_id' => $filters['city_id']['value'] ?? null,

                            'area_id' => $filters['area_id']['value'] ?? null,

                            'compound_id' => $filters['compound_id']['value'] ?? null,

                            'user_id' => $filters['user_id']['value'] ?? null,

                            'property_type' => $filters['property_type']['value'] ?? null,

                            'listing_type' => $filters['listing_type']['value'] ?? null,

                            'status' => $filters['status']['value'] ?? null,
                        ]);
                    })
                    ->openUrlInNewTab(),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
