<?php

namespace App\Filament\Resources\Leads\RelationManagers;

use App\Enums\ActivityType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'activities';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('user_id')
                    ->relationship(
                        'user',
                        'name',
                        fn($query) => $query
                            ->where('company_id', auth()->user()->company_id)
                    )
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('type')
                    ->options(
                        collect(ActivityType::cases())
                            ->mapWithKeys(fn($case) => [
                                $case->value => ucfirst($case->value),
                            ])
                            ->toArray()
                    )
                    ->required()
                    ->hidden(),

                DateTimePicker::make('activity_date')
                    ->required()
                    ->default(now()),

                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('type')
            ->columns([

                TextColumn::make('type')
                    ->badge()
                    ->color(fn($state) => match ($state->value) {

                        'call' => 'info',

                        'meeting' => 'warning',

                        'viewing' => 'success',

                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Agent')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('activity_date')
                    ->since()
                    ->sortable(),

                TextColumn::make('notes')
                    ->limit(80)
                    ->tooltip(fn($record) => $record->notes),
            ])
            ->filters([
                //
            ])
            ->headerActions([

                CreateAction::make('logCall')
                    ->label('Log Call')
                    ->icon('heroicon-o-phone')
                    ->mutateFormDataUsing(fn(array $data): array => [
                        ...$data,
                        'type' => ActivityType::CALL,
                    ]),

                CreateAction::make('logMeeting')
                    ->label('Log Meeting')
                    ->icon('heroicon-o-user-group')
                    ->mutateFormDataUsing(fn(array $data): array => [
                        ...$data,
                        'type' => ActivityType::MEETING,
                    ]),

                CreateAction::make('logViewing')
                    ->label('Log Viewing')
                    ->icon('heroicon-o-home')
                    ->mutateFormDataUsing(fn(array $data): array => [
                        ...$data,
                        'type' => ActivityType::VIEWING,
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
