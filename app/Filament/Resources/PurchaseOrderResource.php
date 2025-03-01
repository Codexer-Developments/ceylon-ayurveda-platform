<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseOrderResource\Pages;
use App\Filament\Resources\PurchaseOrderResource\RelationManagers;
use App\Models\Centers;
use App\Models\GoodsReceivedNote;
use App\Models\ProductManagement;
use App\Models\Products;
use App\Models\PurchaseOrder;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;


class PurchaseOrderResource extends Resource
{
    protected static ?string $model = PurchaseOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Purchase';


    public static function form(Form $form): Form
    {
        $centerDetails = Centers::whereIn('id', getCenters(auth()->user()))->pluck('center_name', 'id');

        return $form
            ->schema([
                Section::make('Purchase Order Details')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Section::make('Purchase Order Details')->schema([
                                    Select::make('center_id')
                                        ->label('Center')
                                        ->options($centerDetails)
                                        ->required()
                                        ->reactive()
                                        ->live() // Ensure dynamic updates
                                        ->afterStateUpdated(fn (callable $set) => $set('items', [])), // Reset items when center changes

                                    TextInput::make('order_number')
                                        ->required()
                                        ->unique(),
                                ])->columnSpan(1),

                                Section::make('Purchase Order Supplier Details')->schema([
                                    Select::make('supplier_id')
                                        ->relationship('supplier', 'name')
                                        ->required(),
                                    DatePicker::make('order_date')->required(),
                                ])->columnSpan(1),
                            ]),

                        Placeholder::make('total_amount_display')
                            ->label('Total Amount')
                            ->content(fn ($get) => 'LKR ' . number_format($get('total_amount') ?? 0, 2)),
                        Hidden::make('total_amount'),
                    ]),

                Section::make('Order Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->label('Product')
                                    ->options(function (callable $get, callable $set) {
                                        $centerId = $get('center_id');

                                        if (!$centerId) {
                                            return [];
                                        }

                                        // Get available products for the selected center
                                        $productIds = ProductManagement::where('center_id', $centerId)
                                            ->pluck('product_id');

                                        $products = Products::whereIn('id', $productIds)->pluck('name', 'id');

                                        // Save the options for later use
                                        $set('product_options', $products->toArray());

                                        return $products;
                                    })
                                    ->reactive()
                                    ->required()
                                    ->afterStateHydrated(fn ($state, callable $set) =>
                                    $set('product_options', Products::where('id', $state)->pluck('name', 'id')->toArray())
                                    ),

                                TextInput::make('quantity')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                                    $set('total', ($state ?? 1) * ($get('price') ?? 0))
                                    ),

                                TextInput::make('price')
                                    ->numeric()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                                    $set('total', ($state ?? 0) * ($get('quantity') ?? 1))
                                    ),

                                TextInput::make('total')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->default(0),
                            ])
                            ->columns(4)
                            ->createItemButtonLabel('Add Item')
                            ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('total_amount', collect($state)->sum('total'))
                            ),
                    ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->sortable()->searchable(),
                TextColumn::make('supplier.name')->sortable()->searchable(),
                TextColumn::make('order_date')->sortable(),
                TextColumn::make('total_amount')->sortable(),
                TextColumn::make('status')->badge(),
            ])
            ->actions([
                Tables\Actions\LinkAction::make('Print Invoice')
                    ->label('Print Invoice')
                    ->url(fn ($record) => route('purchase-orders.invoice', $record->id))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),

                Tables\Actions\Action::make('Goods Re-v Notes')
                    ->icon('heroicon-o-document-text')
                    ->modalHeading('Goods Received Notes Summary')
                    ->modalDescription('Summary of goods received under this purchase order.')
                    ->modalContent(fn ($record) => view('filament.modals.grn-summary', [
                        'goodsReceivedNotes' => GoodsReceivedNote::where('purchase_order_id', $record->id)->get()
                    ])),

            ])
            ->filters([
                //
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
            'index' => Pages\ListPurchaseOrders::route('/'),
            'create' => Pages\CreatePurchaseOrder::route('/create'),
            'edit' => Pages\EditPurchaseOrder::route('/{record}/edit'),
        ];
    }
}
