<?php

namespace App\Filament\Widgets;

use App\Models\SalesOrder;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Weekly Sales Summary';
    protected static ?int $sort = 2;
    protected static ?string $pollingInterval = '15s';
    protected static ?string $maxHeight = '400px';

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();
        
        $sales = SalesOrder::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = $sales->pluck('date')->map(function($date) {
            return Carbon::parse($date)->format('M d');
        })->toArray();

        $data = $sales->pluck('count')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Daily Sales',
                    'data' => $data,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'tension' => 0.4,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
} 