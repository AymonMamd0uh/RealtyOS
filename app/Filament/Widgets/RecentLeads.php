<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentLeads extends TableWidget
{
    protected static ?string $heading = 'Recent Leads';

    protected static ?int $sort = 21;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Lead::query()
                    ->where('assigned_to', auth()->id())
                    ->latest()
                    ->limit(5)
            )

            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Client')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),

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