<?php

namespace App\Filament\Pages;

use App\Models\Lead;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\Action;

class FollowUps extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.follow-ups';

    protected static ?int $navigationSort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {

                $user = auth()->user();

                $query = Lead::query()
                    ->where('follow_up_completed', false)
                    ->whereNotNull('next_follow_up_at');

                if ($user->hasRole('Platform Admin')) {
                    return $query;
                }

                if ($user->hasRole('Agent')) {
                    return $query->where('assigned_to', $user->id);
                }

                return $query->where('company_id', $user->company_id);
            })
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('phone'),

                TextColumn::make('assignedTo.name')
                    ->label('Agent'),

                TextColumn::make('next_follow_up_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('follow_up_type')
                    ->options([
                        'overdue' => 'Overdue',
                        'today' => 'Today',
                        'upcoming' => 'Upcoming',
                    ])
                    ->query(function ($query, array $data) {

                        if (($data['value'] ?? null) === 'overdue') {
                            $query->where('next_follow_up_at', '<', now());
                        }

                        if (($data['value'] ?? null) === 'today') {
                            $query->whereDate('next_follow_up_at', today());
                        }

                        if (($data['value'] ?? null) === 'upcoming') {
                            $query->where('next_follow_up_at', '>', now());
                        }

                        return $query;
                    }),
            ])
            ->recordActions([

                Action::make('complete')
                    ->label('Mark Completed')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(fn(Lead $record) => $record->update([
                        'follow_up_completed' => true,
                    ])),

            ]);
    }
}
