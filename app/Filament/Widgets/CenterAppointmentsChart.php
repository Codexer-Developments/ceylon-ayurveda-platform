<?php

namespace App\Filament\Widgets;

use App\Models\DoctorAppointment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class CenterAppointmentsChart extends ChartWidget
{
    public ?int $centerId = null;

    protected static ?string $heading = 'Last Week Appointments';

    protected function getData(): array
    {
        if (!$this->centerId) {
            return [
                'datasets' => [
                    [
                        'label' => 'Daily Appointments',
                        'data' => [],
                        'borderColor' => '#10b981',
                        'backgroundColor' => '#10b981',
                    ],
                ],
                'labels' => [],
            ];
        }

        $data = $this->getLastWeekAppointmentsData();

        return [
            'datasets' => [
                [
                    'label' => 'Daily Appointments',
                    'data' => $data['appointments'],
                    'borderColor' => '#10b981',
                    'backgroundColor' => '#10b981',
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
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) { return context.raw + " appointments"; }',
                    ],
                ],
            ],
        ];
    }

    protected function getLastWeekAppointmentsData(): array
    {
        $dates = [];
        $appointments = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates[] = $date->format('M d');
            
            $dailyAppointments = DoctorAppointment::where('center_id', $this->centerId)
                ->whereDate('appointment_date', $date)
                ->count();
            
            $appointments[] = $dailyAppointments;
        }

        return [
            'dates' => $dates,
            'appointments' => $appointments,
        ];
    }
} 