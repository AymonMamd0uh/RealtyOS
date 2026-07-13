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
    protected static ?string $heading = 'Top Performing Agents';

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(function (): Builder {

                $query = User::query()
                    ->role('Agent')
                    ->withCount('leads')
                    ->withCount([
                        'leads as won_leads_count' => fn ($query) => $query->where('status', LeadStatus::WON),

                        'leads as lost_leads_count' => fn ($query) => $query->where('status', LeadStatus::LOST),
                    ]);

                if (! auth()->user()->hasRole('Platform Admin')) {
                    $query->where(
                        'company_id',
                        auth()->user()->company_id
                    );
                }

                return $query
                    ->orderByDesc('won_leads_count')
                    ->orderByDesc('leads_count');
            })

            ->defaultSort('won_leads_count', 'desc')

            ->paginated([10, 25, 50])

            ->striped()

            ->columns([

                TextColumn::make('name')
                    ->label('Agent')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('leads_count')
                    ->label('Leads')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('won_leads_count')
                    ->label('Won')
                    ->badge()
                    ->color('success')
                    ->sortable(),

                TextColumn::make('lost_leads_count')
                    ->label('Lost')
                    ->badge()
                    ->color('danger')
                    ->sortable(),

                TextColumn::make('conversion_rate')
                    ->label('Conversion')
                    ->badge()
                    ->color(function ($record) {

                        if ($record->leads_count === 0) {
                            return 'gray';
                        }

                        $rate = ($record->won_leads_count / $record->leads_count) * 100;

                        return match (true) {
                            $rate >= 70 => 'success',
                            $rate >= 40 => 'warning',
                            default => 'danger',
                        };
                    })
                    ->state(function ($record) {

                        if ($record->leads_count === 0) {
                            return '0%';
                        }

                        return round(
                            ($record->won_leads_count / $record->leads_count) * 100,
                            1
                        ) . '%';
                    })

            ])

            ->emptyStateHeading('No agents found')

            ->emptyStateDescription('No agents have been added yet.')

            ->emptyStateIcon('heroicon-o-users');
    }
}