<?php

namespace App\Filament\Resources\Properties\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Exports\PropertyExporter;
use Filament\Actions\ExportAction;

class PropertiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('coverImage.image')
                    ->label('Image')
                    ->disk('public')
                    ->square(),
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

                TextColumn::make('city.name')
                    ->label('City')
                    ->sortable(),

                TextColumn::make('area.name')
                    ->label('Area')
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
                EditAction::make(),
            ])
            ->toolbarActions([
                ExportAction::make()
                    ->exporter(PropertyExporter::class),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
