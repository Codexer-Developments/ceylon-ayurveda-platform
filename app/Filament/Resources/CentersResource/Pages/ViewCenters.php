<?php

namespace App\Filament\Resources\CentersResource\Pages;

use App\Filament\Resources\CentersResource;
use App\Filament\Widgets\CenterSalesChart;
use App\Filament\Widgets\CenterAppointmentsChart;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Models\User;
use App\Models\DoctorAppointment;
use App\Models\SalesOrder;
use App\Models\GoodsReceivedNote;

class ViewCenters extends ViewRecord
{
    protected static string $resource = CentersResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CenterSalesChart::class,
            CenterAppointmentsChart::class,
        ];
    }

    protected function getHeaderWidgetsData(): array
    {
        return [
            CenterSalesChart::class => [
                'centerId' => $this->record->id,
            ],
            CenterAppointmentsChart::class => [
                'centerId' => $this->record->id,
            ],
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make(4)
                    ->schema([
                        TextEntry::make('doctors_count')
                            ->label('Total Doctors')
                            ->state(fn () => User::where('role', 'doctor')
                                ->where('center_id', $this->record->id)
                                ->count())
                            ->icon('heroicon-o-user-group')
                            ->color('primary')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('appointments_count')
                            ->label('Total Appointments')
                            ->state(fn () => DoctorAppointment::where('center_id', $this->record->id)
                                ->count())
                            ->icon('heroicon-o-calendar')
                            ->color('success')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('sales_count')
                            ->label('Total Sales')
                            ->state(fn () => SalesOrder::where('center_id', $this->record->id)
                                ->count())
                            ->icon('heroicon-o-currency-dollar')
                            ->color('warning')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('grn_count')
                            ->label('Total GRN')
                            ->state(fn () => GoodsReceivedNote::where('center_id', $this->record->id)
                                ->count())
                            ->icon('heroicon-o-clipboard-document-list')
                            ->color('info')
                            ->weight('bold')
                            ->size('lg'),
                    ]),
                Section::make('Center Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('center_name')
                                    ->label('Center Name'),
                                TextEntry::make('description')
                                    ->label('Description'),
                                TextEntry::make('address')
                                    ->label('Address'),
                                TextEntry::make('phone')
                                    ->label('Phone'),
                                TextEntry::make('email')
                                    ->label('Email'),
                                TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        '1' => 'success',
                                        '0' => 'danger',
                                    }),
                                TextEntry::make('owner.name')
                                    ->label('Owner'),
                            ]),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getTabs(): array
    {
        return [
            'doctors' => \Filament\Resources\Pages\ViewRecord\Tab::make('Doctors')
                ->schema([
                    \Filament\Tables\Table::make([
                        'query' => User::query()
                            ->where('role', 'doctor')
                            ->where('center_id', $this->record->id),
                        'columns' => [
                            TextColumn::make('name')
                                ->label('Doctor Name')
                                ->searchable(),
                            TextColumn::make('email')
                                ->label('Email')
                                ->searchable(),
                            TextColumn::make('phone')
                                ->label('Phone'),
                            TextColumn::make('status')
                                ->label('Status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    '1' => 'success',
                                    '0' => 'danger',
                                }),
                        ],
                    ]),
                ]),
            'appointments' => \Filament\Resources\Pages\ViewRecord\Tab::make('Appointments')
                ->schema([
                    \Filament\Tables\Table::make([
                        'query' => DoctorAppointment::query()
                            ->where('center_id', $this->record->id),
                        'columns' => [
                            TextColumn::make('id')
                                ->label('Appointment ID'),
                            TextColumn::make('patient.name')
                                ->label('Patient Name'),
                            TextColumn::make('doctor.name')
                                ->label('Doctor Name'),
                            TextColumn::make('appointment_date')
                                ->label('Date')
                                ->dateTime(),
                            TextColumn::make('status')
                                ->label('Status')
                                ->badge(),
                        ],
                    ]),
                ]),
            'sales' => \Filament\Resources\Pages\ViewRecord\Tab::make('Sales')
                ->schema([
                    \Filament\Tables\Table::make([
                        'query' => SalesOrder::query()
                            ->where('center_id', $this->record->id),
                        'columns' => [
                            TextColumn::make('id')
                                ->label('Sale ID'),
                            TextColumn::make('created_at')
                                ->label('Date')
                                ->dateTime(),
                            TextColumn::make('total_amount')
                                ->label('Total Amount')
                                ->money('LKR'),
                            TextColumn::make('status')
                                ->label('Status')
                                ->badge(),
                        ],
                    ]),
                ]),
            'good_receive_notes' => \Filament\Resources\Pages\ViewRecord\Tab::make('Good Receive Notes')
                ->schema([
                    \Filament\Tables\Table::make([
                        'query' => GoodsReceivedNote::query()
                            ->where('center_id', $this->record->id),
                        'columns' => [
                            TextColumn::make('id')
                                ->label('GRN ID'),
                            TextColumn::make('created_at')
                                ->label('Date')
                                ->dateTime(),
                            TextColumn::make('total_amount')
                                ->label('Total Amount')
                                ->money('LKR'),
                            TextColumn::make('status')
                                ->label('Status')
                                ->badge(),
                        ],
                    ]),
                ]),
        ];
    }
} 