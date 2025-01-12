<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaleOrdersResource\Pages;
use App\Filament\Resources\SaleOrdersResource\RelationManagers;
use Filament\Tables\Actions\Action;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\SalesOrder;
use Filament\Tables\Filters\Filter;

class SaleOrdersResource extends Resource
{
    protected static ?string $model = SalesOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->label('Description')
                    ->nullable(),

                Forms\Components\Select::make('center_id')
                    ->label('Center')
                    ->relationship('center', 'name')
                    ->required(),

                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->relationship('patient', 'name')
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required(),

                Forms\Components\TextInput::make('status')
                    ->label('Order Status')
                    ->default('pending')
                    ->required(),

                Forms\Components\TextInput::make('payment_status')
                    ->label('Payment Status')
                    ->default('pending')
                    ->required(),

                Forms\Components\TextInput::make('payment_method')
                    ->label('Payment Method'),

                Forms\Components\TextInput::make('payment_reference')
                    ->label('Payment Reference'),

                Forms\Components\DatePicker::make('payment_date')
                    ->label('Payment Date'),

                Forms\Components\TextInput::make('delivery_status')
                    ->label('Delivery Status')
                    ->default('pending')
                    ->required(),

                Forms\Components\TextInput::make('delivery_method')
                    ->label('Delivery Method'),

                Forms\Components\TextInput::make('cash_balance')
                    ->label('Cash Balance')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('discount')
                    ->label('Discount')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('tax')
                    ->label('Tax')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('grand_total')
                    ->label('Grand Total')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('paid_amount')
                    ->label('Paid Amount')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('due_amount')
                    ->label('Due Amount')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('return_amount')
                    ->label('Return Amount')
                    ->numeric()
                    ->default(0),

                Forms\Components\Textarea::make('order_note')
                    ->label('Order Note')
                    ->json(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('center.center_name')->label('Center'),
                Tables\Columns\TextColumn::make('patient.full_name')->label('Patient'),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('payment_status')->sortable(),
                Tables\Columns\TextColumn::make('total_amount')->money('usd')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                Filter::make('pending')
                    ->query(fn (Builder $query) => $query->where('status', 'pending'))
                    ->label('Pending Orders'),
                Filter::make('complete')
                    ->query(fn (Builder $query) => $query->where('status', 'complete'))
                    ->label('Completed Orders'),
            ])
            ->actions([
                Action::make('viewInvoice')
                    ->label('View Invoice')
                    ->url(fn (SalesOrder $record) => route('patient.invoice',[
                       $record->center_id,$record->id
                    ])) // Adjust the route name and parameters as needed
                    ->icon('heroicon-o-document-text')
                    ->color('success'),

            ])
            ->bulkActions([

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
            'index' => Pages\ListSaleOrders::route('/'),
            'create' => Pages\CreateSaleOrders::route('/create'),
            'edit' => Pages\EditSaleOrders::route('/{record}/edit'),
        ];
    }
}
