<?php

namespace App\Filament\Resources\SaleOrdersResource\Pages;

use App\Filament\Resources\SaleOrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaleOrders extends EditRecord
{
    protected static string $resource = SaleOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
