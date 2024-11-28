<?php

namespace App\Filament\Resources\CentersResource\Pages;

use App\Filament\Resources\CentersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCenters extends EditRecord
{
    protected static string $resource = CentersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
