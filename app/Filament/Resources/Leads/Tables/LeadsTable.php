<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Exports\LeadExporter;
use Filament\Actions\ExportAction;
use App\Enums\LeadStatus;
use Filament\Actions\Action;
use App\Models\LeadActivity;
use App\Enums\ActivityType;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->searchable(),

                TextColumn::make('company.name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->visible(
                        fn() => auth()->user()->hasRole('Platform Admin')
                    ),

                TextColumn::make('assignedTo.name')
                    ->label('Agent')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('property.title')
                    ->label('Property')
                    ->limit(30),

                TextColumn::make('source')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => match ($state->value) {

                        'new' => 'gray',

                        'contacted' => 'info',

                        'qualified' => 'warning',

                        'viewing' => 'success',

                        'negotiation' => 'warning',

                        'won' => 'success',

                        'lost' => 'danger',

                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])

            ->filters([

                Filter::make('status')
                    ->form([
                        Select::make('status')
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'qualified' => 'Qualified',
                                'viewing' => 'Viewing',
                                'negotiation' => 'Negotiation',
                                'won' => 'Won',
                                'lost' => 'Lost',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['status'] ?? null,
                            fn(Builder $query, $status) => $query->where('status', $status)
                        );
                    }),

                Filter::make('agent')
                    ->form([
                        Select::make('agent_id')
                            ->label('Agent')
                            ->options(
                                User::role('Agent')
                                    ->when(
                                        ! auth()->user()->hasRole('Platform Admin'),
                                        fn($query) => $query->where(
                                            'company_id',
                                            auth()->user()->company_id
                                        )
                                    )
                                    ->pluck('name', 'id')
                                    ->toArray()
                            ),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['agent_id'] ?? null,
                            fn(Builder $query, $agentId) => $query->where('assigned_to', $agentId)
                        );
                    }),

                Filter::make('source')
                    ->form([
                        Select::make('source')
                            ->options([
                                'Facebook' => 'Facebook',
                                'Website' => 'Website',
                                'WhatsApp' => 'WhatsApp',
                                'Referral' => 'Referral',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['source'] ?? null,
                            fn(Builder $query, $source) => $query->where('source', $source)
                        );
                    }),

            ])

            ->recordActions([

                Action::make('viewing')
                    ->label('Viewing')
                    ->icon('heroicon-o-home')
                    ->color('success')
                    ->action(fn($record) => $record->update([
                        'status' => LeadStatus::VIEWING,
                    ])),

                Action::make('negotiation')
                    ->label('Negotiation')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->color('warning')
                    ->action(function ($record) {

                        LeadActivity::create([
                            'lead_id' => $record->id,
                            'user_id' => auth()->id(),
                            'type' => ActivityType::NEGOTIATION,
                            'notes' => 'Lead moved to negotiation stage',
                            'activity_date' => now(),
                        ]);
                    }),

                Action::make('won')
                    ->label('Won')
                    ->icon('heroicon-o-trophy')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($record) {

                        LeadActivity::create([
                            'lead_id' => $record->id,
                            'user_id' => auth()->id(),
                            'type' => ActivityType::WON,
                            'notes' => 'Lead marked as won',
                            'activity_date' => now(),
                        ]);
                    }),

                Action::make('lost')
                    ->label('Lost')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function ($record) {

                        LeadActivity::create([
                            'lead_id' => $record->id,
                            'user_id' => auth()->id(),
                            'type' => ActivityType::LOST,
                            'notes' => 'Lead marked as lost',
                            'activity_date' => now(),
                        ]);
                    }),

                EditAction::make(),
            ])

            ->toolbarActions([
                ExportAction::make()
                    ->exporter(LeadExporter::class),

                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
