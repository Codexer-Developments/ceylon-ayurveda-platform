<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GoodsReceivedNoteResource\Pages;
use App\Filament\Resources\GoodsReceivedNoteResource\RelationManagers;
use App\Models\Centers;
use App\Models\GoodsReceivedNote;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use App\Models\PurchaseOrder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class GoodsReceivedNoteResource extends Resource
{
    protected static ?string $model = GoodsReceivedNote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Purchase';


    public static function form(Form $form): Form
    {
        $centerDetails = Centers::whereIn('id', getCenters(auth()->user()))->pluck('center_name', 'id');

        return $form
            ->schema([
                Forms\Components\Section::make('Goods Received Note Details')
                    ->schema([

                        Forms\Components\Select::make('center_id')
                            ->label('Center')
                            ->options($centerDetails)
                            ->required(),



                        Select::make('purchase_order_id')
                            ->label('Purchase Order')
                            ->options(PurchaseOrder::pluck('order_number', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('items', PurchaseOrder::find($state)?->items->map(fn ($item) => [
                                    'product_id' => $item->product_id,
                                    'unit_price' => $item->price,
                                    'received_quantity' => $item->quantity,
                                    'total_price' => $item->price * $item->quantity,
                                ])->toArray() ?? []) // Convert Collection to array
                            ),


                        DatePicker::make('received_date')->required(),

                        Placeholder::make('total_amount_display')
                            ->label('Total Amount')
                            ->content(fn ($get) => 'LKR ' . number_format($get('total_amount') ?? 0, 2)),
                        Hidden::make('total_amount'),
                    ]),

                Forms\Components\Section::make('Received Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('product_id')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->reactive()
                                    ->default(fn ($record) => $record?->product_id), // Ensure product ID is preloaded

                                TextInput::make('received_quantity')
                                    ->numeric()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(fn ($state, callable $set, callable $get) =>
                                        $set('total_price', ($state ?? 1) * ($get('unit_price') ?? 0))
                                    ),

                                TextInput::make('unit_price')
                                    ->numeric()
                                    ->required()
                                    ->readOnly(),
                                TextInput::make('total_price')
                                    ->numeric()
                                    ->readOnly()
                                    ->default(0),
                            ])
                            ->columns(4)
                            ->createItemButtonLabel('Add Item')
                            ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('total_amount', collect($state)->sum('total_price'))
                            ),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('purchaseOrder.order_number')->sortable()->searchable(),
                TextColumn::make('received_date')->sortable(),
                TextColumn::make('total_amount')->sortable(),
                TextColumn::make('status')->badge(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
       return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGoodsReceivedNotes::route('/'),
            'create' => Pages\CreateGoodsReceivedNote::route('/create'),
            'edit' => Pages\EditGoodsReceivedNote::route('/{record}/edit'),
        ];
    }
}
