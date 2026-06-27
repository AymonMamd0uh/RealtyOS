<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TopAgents extends TableWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Top Agents';

    public static function canView(): bool
    {
        return ! auth()->user()->hasRole('Agent');
    }

    public function table(Table $table): Table
    {
        $user = auth()->user();

        $query = User::query()
            ->withCount([
                'properties',
                'assignedLeads',
            ])
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Agent');
            });

        if (! $user->hasRole('Platform Admin')) {
            $query->where('company_id', $user->company_id);
        }

        return $table
            ->query(
                $query->orderByDesc('assigned_leads_count')
            )
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->label('Agent')
                    ->searchable(),

                Tables\Columns\TextColumn::make('company.name')
                    ->label('Company')
                    ->visible(
                        fn() => auth()->user()->hasRole('Platform Admin')
                    ),

                Tables\Columns\TextColumn::make('assigned_leads_count')
                    ->label('Leads')
                    ->sortable(),

                Tables\Columns\TextColumn::make('properties_count')
                    ->label('Properties')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->date(),
            ])
            ->defaultPaginationPageOption(5);
    }
}
