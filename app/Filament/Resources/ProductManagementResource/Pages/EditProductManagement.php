<?php

namespace App\Filament\Resources\ProductManagementResource\Pages;

use App\Filament\Resources\ProductManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductManagement extends EditRecord
{
    protected static string $resource = ProductManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
