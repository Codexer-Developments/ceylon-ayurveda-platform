<?php

namespace App\Filament\Resources\CentersResource\Pages;

use App\Filament\Resources\CentersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateCenters extends CreateRecord
{
    protected static string $resource = CentersResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['center_name']).'-'.Str::random(5);
        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['center_name']).'-'.Str::random(5);
        return $data;
    }
}
