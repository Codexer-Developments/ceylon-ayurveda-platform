<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Products;
use App\Models\Centers;
use App\Models\DoctorAppointment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered users in the system')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Total Products', Products::where('status', 1)->count())
                ->description('Active products in inventory')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('Total Centers', Centers::where('status', 1)->count())
                ->description('Active centers')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),

            Stat::make('Total Appointments', DoctorAppointment::count())
                ->description('Doctor appointments')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
} 