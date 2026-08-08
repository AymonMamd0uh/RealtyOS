<?php

namespace App\Filament\Actions;

use App\Models\Lead;
use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

class ExportLeadsAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'export_leads';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this
            ->label('Export')
            ->icon('heroicon-o-arrow-down-tray')
            ->color('gray')
            ->action(function ($livewire) {
                /** @var Builder $query */
                $query = $livewire->getTableQueryForExport();

                $query->with([
                    'assignedTo',
                    'property',
                ]);

                $writer = new Writer();

                $writer->openToBrowser('leads.xlsx');

                $writer->addRow(Row::fromValues([
                    'Name',
                    'Phone',
                    'Agent',
                    'Property',
                    'Status',
                ]));

                $query
                    ->orderBy('id')
                    ->chunk(500, function ($leads) use ($writer) {
                        foreach ($leads as $lead) {
                            $writer->addRow(Row::fromValues([
                                $lead->name ?? '',
                                $lead->phone ?? '',
                                $lead->assignedTo?->name ?? '',
                                $lead->property?->title ?? '',
                                $lead->status?->value ?? '',
                            ]));
                        }
                    });

                $writer->close();

                exit;
            });
    }
}