<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadsChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    protected ?string $heading = 'Monthly Leads';

    protected ?string $description = 'Lead creation trend for the current year';

    protected function getData(): array
    {
        $user = auth()->user();

        $query = Lead::query();

        if ($user->hasRole('Agent')) {
            $query->where('assigned_to', $user->id);
        } elseif (! $user->hasRole('Platform Admin')) {
            $query->where('company_id', $user->company_id);
        }

        $leads = $query
            ->selectRaw('EXTRACT(MONTH FROM created_at)::integer AS month')
            ->selectRaw('COUNT(*) AS total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $labels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec',
        ];

        $data = [];

        foreach (range(1, 12) as $month) {
            $data[] = $leads[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $data,
                    'fill' => true,
                    'tension' => 0.35,
                    'borderWidth' => 3,
                ],
            ],

            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getMaxHeight(): ?string
    {
        return '320px';
    }
}