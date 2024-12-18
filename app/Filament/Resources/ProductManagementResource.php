<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductManagementResource\Pages;
use App\Filament\Resources\ProductManagementResource\RelationManagers;
use App\Models\Centers;
use App\Models\ProductManagement;
use App\Models\Products;
use App\ResourceAccessTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductManagementResource extends Resource
{
    use ResourceAccessTrait;

    protected static ?string $model = ProductManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $getCenterDetails = Centers::where('status', 1)
            ->where('owner_id', auth()->user()->id)
            ->pluck('center_name', 'id')->toArray();

        $centerId = $getCenterDetails->id ?? null;

        $productItem = Products::where('status', 1)
            ->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product Name')
                    ->options($productItem)
                    ->required(),
                Forms\Components\Select::make('center_id')
                    ->label('Center')
                    ->options($getCenterDetails)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductManagement::route('/'),
            'create' => Pages\CreateProductManagement::route('/create'),
            'edit' => Pages\EditProductManagement::route('/{record}/edit'),
        ];
    }
}
