<?php

namespace App\Filament\Resources\Properties\RelationManagers;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('properties')
                    ->required(),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Toggle::make('is_cover')
                    ->default(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image')
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->visibility('public')
                    ->square(),

                TextColumn::make('sort_order')
                    ->sortable(),

                IconColumn::make('is_cover')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('uploadImages')
                    ->label('Upload Images')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->directory('properties')
                            ->required(),
                    ])
                    ->action(function (array $data): void {

                        $hasCover = $this->ownerRecord
                            ->images()
                            ->where('is_cover', true)
                            ->exists();

                        foreach ($data['images'] as $index => $image) {

                            $this->ownerRecord->images()->create([
                                'image'      => $image,
                                'sort_order' => $index + 1,
                                'is_cover'   => ! $hasCover && $index === 0,
                            ]);
                        }
                    }),
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