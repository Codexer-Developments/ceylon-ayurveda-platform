<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;


    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $slug = 'settings';
    protected static ?int $navigationSort = 1;



    public static function form(Form $form): Form
    {
        // Fetch all settings from the database
        $settings = Setting::all()->keyBy('key'); // Use keyBy to access settings by key

        return $form->schema([
            Section::make('Settings')->schema([
                Tabs::make('Settings Tabs')
                    ->tabs(self::generateTabs($settings)), // Pass settings data to the generateTabs method
            ]),
        ])->statePath('data');
    }

    private static function generateTabs($settings): array
    {
        $groupedSettings = $settings->groupBy('group'); // Group settings by 'group'
        $tabs = [];

        foreach ($groupedSettings as $group => $groupSettings) {
            $tabFields = [];

            foreach ($groupSettings as $setting) {
                $settingArray = $setting->toArray();

                $field = match ($settingArray['type']) {
                    'text' => TextInput::make("settings.{$settingArray['key']}")
                        ->label($settingArray['label'])
                        ->required($settingArray['required'])
                        ->placeholder($settingArray['placeholder'])
                        ->default($settingArray['value']),

                    'number' => TextInput::make("settings.{$settingArray['key']}")
                        ->label($settingArray['label'])
                        ->numeric()
                        ->required($settingArray['required'])
                        ->default($settingArray['value']),

                    'toggle' => Toggle::make("settings.{$settingArray['key']}")
                        ->label($settingArray['label'])
                        ->default((bool) $settingArray['value']),

                    'select' => Select::make("settings.{$settingArray['key']}")
                        ->label($settingArray['label'])
                        ->options(json_decode($settingArray['options'], true) ?? [])
                        ->default($settingArray['value']),

                    default => TextInput::make("settings.{$settingArray['key']}")
                        ->label($settingArray['label'])
                        ->default($settingArray['value']),
                };

                $tabFields[] = $field;
            }

            $tabs[] = Tab::make(ucwords(str_replace('_', ' ', $group)))->schema($tabFields);
        }

        return $tabs;
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
            'index' => Pages\ListSettings::route('settings'),
            'edit' => Pages\EditSetting::route('edit/{record}'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false; // Hide default navigation since we will manually register it
    }
}
