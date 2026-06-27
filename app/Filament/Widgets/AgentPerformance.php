<?php

namespace App\Filament\Widgets;

use App\Enums\LeadStatus;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class AgentPerformance extends TableWidget
{
    protected static ?string $heading = 'Agent Performance';

    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 4;
    public function table(Table $table): Table
    {
        return $table
            ->query(function (): Builder {

                $query = User::query()
                    ->role('Agent')
                    ->withCount('leads')

                    ->withCount([
                        'leads as won_leads_count' => fn($query) =>
                        $query->where('status', LeadStatus::WON),

                        'leads as lost_leads_count' => fn($query) =>
                        $query->where('status', LeadStatus::LOST),
                    ]);

                if (! auth()->user()->hasRole('Platform Admin')) {
                    $query->where(
                        'company_id',
                        auth()->user()->company_id
                    );
                }

                return $query;
            })

            ->columns([

                TextColumn::make('name')
                    ->label('Agent')
                    ->searchable(),

                TextColumn::make('leads_count')
                    ->label('Total Leads')
                    ->sortable(),

                TextColumn::make('won_leads_count')
                    ->label('Won')
                    ->sortable(),

                TextColumn::make('lost_leads_count')
                    ->label('Lost')
                    ->sortable(),

                TextColumn::make('conversion_rate')
                    ->label('Conversion %')
                    ->state(function ($record) {

                        if ($record->leads_count == 0) {
                            return '0%';
                        }

                        return round(
                            ($record->won_leads_count / $record->leads_count) * 100,
                            2
                        ) . '%';
                    }),
            ]);
    }
}
