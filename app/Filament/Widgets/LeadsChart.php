<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadsChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';
    protected ?string $heading = 'Leads Per Month';

    protected function getData(): array
    {
        $user = auth()->user();

        $query = Lead::query();

        if (! $user->hasRole('Platform Admin')) {
            $query->where('company_id', $user->company_id);
        }

        if ($user->hasRole('Agent')) {
            $query->where('assigned_to', $user->id);
        }

        $leads = $query
            ->selectRaw('EXTRACT(MONTH FROM created_at)::integer as month')
            ->selectRaw('COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $months = [
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

        for ($i = 1; $i <= 12; $i++) {
            $data[] = $leads[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $data,
                ],
            ],

            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
