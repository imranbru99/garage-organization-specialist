<?php

namespace App\Filament\Widgets;

use App\Models\WorkOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class JobsChart extends ChartWidget
{
    protected static ?string $heading = 'Jobs by Status';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $rows = WorkOrder::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Jobs',
                    'data' => $rows->values()->all(),
                    'backgroundColor' => ['#F59E0B', '#0D9488', '#334155', '#64748B', '#22C55E', '#EF4444'],
                ],
            ],
            'labels' => $rows->keys()->map(fn ($s) => str_replace('_', ' ', ucfirst($s)))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
