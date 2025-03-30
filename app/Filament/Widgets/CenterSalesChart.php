<?php

namespace App\Filament\Widgets;

use App\Models\SalesOrder;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CenterSalesChart extends ChartWidget
{
    public ?int $centerId = null;

    protected static ?string $heading = 'Last Week Sales';

    protected function getData(): array
    {
        if (!$this->centerId) {
            return [
                'datasets' => [
                    [
                        'label' => 'Daily Sales',
                        'data' => [],
                        'borderColor' => '#f59e0b',
                        'backgroundColor' => '#f59e0b',
                    ],
                ],
                'labels' => [],
            ];
        }

        $data = $this->getLastWeekSalesData();

        return [
            'datasets' => [
                [
                    'label' => 'Daily Sales',
                    'data' => $data['sales'],
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $data['dates'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "LKR " + value; }',
                    ],
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return "LKR " + context.raw; }',
                    ],
                ],
            ],
        ];
    }

    protected function getLastWeekSalesData(): array
    {
        $dates = [];
        $sales = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = $date->format('M d');
            
            $dailySales = SalesOrder::where('center_id', $this->centerId)
                ->whereDate('created_at', $date)
                ->sum('total_amount');
            
            $sales[] = $dailySales;
        }

        return [
            'dates' => $dates,
            'sales' => $sales,
        ];
    }
} 