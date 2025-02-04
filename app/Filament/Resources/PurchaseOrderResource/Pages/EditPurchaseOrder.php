<?php

namespace App\Filament\Resources\PurchaseOrderResource\Pages;

use App\Filament\Resources\PurchaseOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\Action;


class EditPurchaseOrder extends EditRecord
{
    protected static string $resource = PurchaseOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getActions(): array
    {
        return [
            Action::make('Print Invoice')
                ->label('Print Invoice')
                ->url(fn ($record) => route('purchase-orders.invoice', $record->id))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer'),
        ];
    }
}
