<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CentersResource\Pages;
use App\Filament\Resources\CentersResource\RelationManagers;
use App\Models\Centers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class CentersResource extends Resource
{
    protected static ?string $model = Centers::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function shouldRegisterNavigation(): bool
    {
        // Check if the authenticated user has the 'Customer' role
        return !auth()->user()?->hasRole('Customer');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Center Name')
                    ->required()
                    ->maxLength(255),

                Textarea::make('address')
                    ->label('Address'),

                TextInput::make('phone')
                    ->label('Phone'),

                TextInput::make('email')
                    ->label('Email')
                    ->email(),

                TextInput::make('website')
                    ->label('Website')
                    ->url(),

                Textarea::make('description')
                    ->label('Description'),

                Forms\Components\Select::make('role')
                    ->label('Shop Owner')
                    ->options(User::role('Shop Owner')->get()->pluck('name', 'name'))
                    ->required(),

                Toggle::make('status')
                    ->label('Active')
                    ->default(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('email')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable(),
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
            'index' => Pages\ListCenters::route('/'),
            'create' => Pages\CreateCenters::route('/create'),
            'edit' => Pages\EditCenters::route('/{record}/edit'),
        ];
    }


}
