<?php

namespace App\Filament\Pages;

use App\Models\Lead;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Concerns\InteractsWithTable;

class FollowUps extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.follow-ups';

    protected static ?string $navigationLabel = 'Follow Ups';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static string|\UnitEnum|null $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {

                $user = auth()->user();

                $query = Lead::query()
                    ->with('assignedTo')
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

            ->defaultSort('next_follow_up_at')

            ->columns([

                TextColumn::make('name')
                    ->label('Lead')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('phone')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('assignedTo.name')
                    ->label('Agent')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('next_follow_up_at')
                    ->label('Next Follow Up')
                    ->dateTime('d M Y - h:i A')
                    ->sortable()
                    ->badge()
                    ->color(function (Lead $record) {

                        if ($record->next_follow_up_at->isPast()) {
                            return 'danger';
                        }

                        if ($record->next_follow_up_at->isToday()) {
                            return 'warning';
                        }

                        return 'success';
                    }),

            ])

            ->filters([

                SelectFilter::make('follow_up_type')
                    ->label('Status')
                    ->options([
                        'overdue' => 'Overdue',
                        'today' => 'Today',
                        'upcoming' => 'Upcoming',
                    ])
                    ->query(function ($query, array $data) {

                        return match ($data['value'] ?? null) {

                            'overdue' => $query->where(
                                'next_follow_up_at',
                                '<',
                                now()
                            ),

                            'today' => $query->whereDate(
                                'next_follow_up_at',
                                today()
                            ),

                            'upcoming' => $query->where(
                                'next_follow_up_at',
                                '>',
                                now()
                            ),

                            default => $query,
                        };
                    }),

            ])

            ->recordActions([

                Action::make('complete')
                    ->label('Complete')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Lead $record) {

                        $record->update([
                            'follow_up_completed' => true,
                        ]);
                    }),

            ])

            ->emptyStateHeading('No follow ups found.')

            ->emptyStateDescription('There are no pending follow ups.')

            ->emptyStateIcon('heroicon-o-phone');
    }

    public static function canAccess(): bool
    {
        return auth()->check();
    }
}
