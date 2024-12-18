<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentersResource\Pages;
use App\Filament\Resources\CentersResource\RelationManagers;
use App\Models\Centers;
use App\Models\User;
use App\ResourceAccessTrait;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CentersResource extends Resource
{
    use ResourceAccessTrait;

    protected static ?string $model = Centers::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';




    public static function form(Form $form): Form
    {
        $userDetails = User::where('role', 'manager')->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Forms\Components\TextInput::make('center_name')
                    ->label('Center Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->nullable(),
                Forms\Components\Textarea::make('address')
                    ->label('Address')
                    ->nullable(),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone')
                    ->nullable(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->nullable(),
                Forms\Components\Toggle::make('status')
                    ->label('Active')
                    ->default(true),
                Forms\Components\Select::make('owner_id')
                    ->label('Owner')
                    ->options($userDetails)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('center_name')->label('Center Name')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\BooleanColumn::make('status')->label('Active'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListCenters::route('/'),
            'create' => Pages\CreateCenters::route('/create'),
            'edit' => Pages\EditCenters::route('/{record}/edit'),
        ];
    }


}
