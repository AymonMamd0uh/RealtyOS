<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentProperties extends TableWidget
{
    protected static ?string $heading = 'Recent Properties';

    protected static ?int $sort = 20;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Property::query()
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->limit(5)
            )

            ->columns([

                Tables\Columns\TextColumn::make('reference_number')
                    ->label('Reference')
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(35),

                Tables\Columns\TextColumn::make('price')
                    ->money('EGP')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->since(),

            ])

            ->paginated(false);
    }

    public static function canView(): bool
    {
        return auth()->user()->hasRole('Agent');
    }
}