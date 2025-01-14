<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorsResource\Pages;
use App\Filament\Resources\DoctorsResource\RelationManagers;
use App\Models\Doctors;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorsResource extends Resource
{
    protected static ?string $model = User::class;

    public static function getLabel(): string
    {
        return 'Doctor';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->query(User::where('role','doctors'))
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctors::route('/create'),
            'edit' => Pages\EditDoctors::route('/{record}/edit'),
        ];
    }
}
