<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientsResource\Pages;
use App\Filament\Resources\PatientsResource\RelationManagers;
use App\Models\Patients;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Tabs;
class PatientsResource extends Resource
{
    protected static ?string $model = Patients::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Patient Details') // Create a tab layout
                ->tabs([
                    Tabs\Tab::make('Personal Information') // First tab
                    ->schema([
                        TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('middle_name')
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->required(),
                        TextInput::make('blood_group')
                            ->maxLength(10),
                    ]),

                    Tabs\Tab::make('Contact Information') // Second tab
                    ->schema([
                        TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone_number')
                            ->tel()
                            ->maxLength(15),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                    ]),

                    Tabs\Tab::make('Insurance Details') // Third tab
                    ->schema([
                        TextInput::make('tex_id')
                            ->label('Tax ID')
                            ->maxLength(255),
                        TextInput::make('insurance_id')
                            ->label('Insurance ID')
                            ->maxLength(255),
                        TextInput::make('insurance_name')
                            ->label('Insurance Name')
                            ->maxLength(255),
                        TextInput::make('insurance_group')
                            ->label('Insurance Group')
                            ->maxLength(255),
                        TextInput::make('insurance_type')
                            ->label('Insurance Type')
                            ->maxLength(255),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('middle_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('phone_number')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('dob')->date(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatients::route('/create'),
            'edit' => Pages\EditPatients::route('/{record}/edit'),
        ];
    }
}
