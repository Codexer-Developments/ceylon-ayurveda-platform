<?php

namespace App\Filament\Resources\ProductManagementResource\Pages;

use App\Filament\Resources\ProductManagementResource;
use App\Models\Centers;
use App\Models\ProductManagement;
use App\Models\Products;
use App\Models\User;
use Filament\Resources\Pages\Page;

class BarcodeGenerator extends Page
{
    protected static string $resource = ProductManagementResource::class;

    protected static string $view = 'filament.resources.product-management-resource.pages.barcode-generator';

    public function mount($record)
    {
        $productManagement = ProductManagement::where('id', $record)->first();
        // Pass data to the page if needed
        $this->productManagement = $productManagement;
        $this->productDetails = Products::where('id', $productManagement->product_id)->first();
    }
}
