<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductManagementResource\Pages;
use App\Filament\Resources\ProductManagementResource\RelationManagers;
use App\Models\Centers;
use App\Models\ProductManagement;
use App\Models\Products;
use App\Models\SalesOrder;
use App\Models\User;
use App\ResourceAccessTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;
use App\Rules\ProductManagementUniqueProductRule;

class ProductManagementResource extends Resource
{
    use ResourceAccessTrait;

    protected static ?string $model = ProductManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Products';


    public static function form(Form $form): Form
    {
        $getCenterDetails = Centers::where('owner_id', auth()->user()->id)
            ->pluck('center_name', 'id')->toArray();

        $userDetails  = [
            auth()->user()->id => auth()->user()->name
        ];


        $centerId = $getCenterDetails->id ?? null;
        $productItem = Products::where('status', 1)
            ->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->label('Product Name')
                    ->options($productItem),
                Forms\Components\Select::make('user_id')
                    ->label('User ID')
                    ->default(auth()->user()->id)
                    ->options($userDetails)->required(),
                Forms\Components\Select::make('center_id')
                    ->label('Center')
                    ->options($getCenterDetails)
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('status')
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table->query(ProductManagement::whereIn('center_id', getCenters(auth()->user())))
            ->columns([
                TextColumn::make('center_id')
                    ->label('Center')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('product.name') // Fetch product name via the relationship
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('status')
                    ->label('Active'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('printBarCode')
                    ->label('Print Barcode')
                    ->url(fn (ProductManagement $record) => url('admin/product-managements/barcode-generate',[
                        $record->id
                    ])) // Adjust the route name and parameters as needed
                    ->icon('heroicon-o-document-text')
                    ->color('success'),
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
            'barcode-generate' => Pages\BarcodeGenerator::route('/barcode-generate/{record}'),
        ];
    }
}
