<?php

namespace App\Filament\Resources\SaleOrdersResource\Pages;

use App\Filament\Resources\SaleOrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaleOrders extends ListRecords
{
    protected static string $resource = SaleOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
