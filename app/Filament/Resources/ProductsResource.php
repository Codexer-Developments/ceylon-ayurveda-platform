<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\ProductCategory;
use App\Models\Products;
use App\ResourceAccessTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsResource extends Resource
{
    use ResourceAccessTrait;

    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $categoryDetails = ProductCategory::pluck('name', 'id')->toArray();
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                Forms\Components\FileUpload::make('image')
                    ->label('Image URL')
                    ->nullable(),
                Forms\Components\TextInput::make('default_price')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label('Active Status')
                    ->default(true),
                Forms\Components\Select::make('product_category_id')
                    ->label('Category')->options($categoryDetails)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('default_price')
                    ->label('Price')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('status')->label('Active'),
                Tables\Columns\TextColumn::make('product_category_id')
                    ->label('Category'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
