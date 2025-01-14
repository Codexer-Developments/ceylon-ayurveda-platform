<?php

namespace App\Filament\Resources\ProductManagementResource\Pages;

use App\Filament\Resources\ProductManagementResource;
use App\Models\ProductManagement;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductManagement extends CreateRecord
{
    protected static string $resource = ProductManagementResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $productExistingDetails = ProductManagement::where('product_id', $data['product_id'])
            ->where('center_id', $data['center_id'])
            ->first();
        if($productExistingDetails){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'product_id' => 'The selected product already exists for this center.',
            ]);
        }

        return $data;
    }
}
