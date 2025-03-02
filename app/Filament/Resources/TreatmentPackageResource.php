<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentPackageResource\Pages;
use App\Filament\Resources\TreatmentPackageResource\RelationManagers;
use App\Models\TreatmentPackages;
use App\Models\Treatments;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

class TreatmentPackageResource extends Resource
{
    protected static ?string $model = TreatmentPackages::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Treatment Packages';
    protected static ?string $pluralLabel = 'Treatment Packages';



    public static function form(Forms\Form $form): Forms\Form
    {
        $treatments = Treatments::where('status',1)->pluck('treatment_name','id')->toArray();

        return $form->schema([
            Section::make('Settings')->schema([
                Tabs::make('Treatment Package')
                    ->tabs([
                        Tab::make('General')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->required(),
                                TextInput::make('price')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('duration')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('sessions')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('discount')
                                    ->numeric()
                                    ->required(),
                                Select::make('status')
                                    ->options([
                                        0 => 'Inactive',
                                        1 => 'Active',
                                    ])
                                    ->required(),
                            ]),
                        Tab::make('Treatments')
                            ->schema([
                                Repeater::make('treatments')
                                    ->schema([
                                        Select::make('name')
                                            ->options($treatments)
                                            ->required(),
                                        TextInput::make('type')->required(),
                                    ]),
                            ]),
                        Tab::make('Settings')
                            ->schema([
                                Repeater::make('settings')
                                    ->schema([
                                        TextInput::make('key')->required(),
                                        TextInput::make('value')->required(),
                                    ]),
                            ]),
                    ]),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('duration')->sortable(),
                TextColumn::make('sessions')->sortable(),
                TextColumn::make('discount')->sortable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        0 => 'Inactive',
                        1 => 'Active',
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
            'index' => Pages\ListTreatmentPackages::route('/'),
            'create' => Pages\CreateTreatmentPackage::route('/create'),
            'edit' => Pages\EditTreatmentPackage::route('/{record}/edit'),
        ];
    }
}
