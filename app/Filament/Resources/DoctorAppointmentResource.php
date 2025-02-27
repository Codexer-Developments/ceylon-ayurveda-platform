<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorAppointmentResource\Pages;
use App\Filament\Resources\DoctorAppointmentResource\RelationManagers;
use App\Models\Centers;
use App\Models\DoctorAppointment;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;

class DoctorAppointmentResource extends Resource
{
    protected static ?string $model = DoctorAppointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Forms\Form $form): Forms\Form
    {
        $getCentersAuth = Centers::whereIn('id', getCenters(auth()->user()))->pluck('center_name', 'id')->toArray();

        $getDoctorDetails = User::where('role', 'doctor')->whereIn('center_id', $getCentersAuth)
            ->pluck('name', 'id')->toArray();

        $patientDetails = User::where('role', 'patient')->pluck('name', 'id')->toArray();

        return $form
            ->schema([
                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(500)
                    ->nullable(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),

                DateTimePicker::make('date')
                    ->label('Appointment Date')
                    ->required(),

                // Patient Selection with the ability to create a new patient
                Forms\Components\Select::make('patient_id')
                    ->label('Patient')
                    ->relationship('patient', 'first_name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('first_name')->required(),
                        TextInput::make('middle_name')->nullable(),
                        TextInput::make('last_name')->required(),
                        TextInput::make('address')->required(),
                        TextInput::make('phone_number')->nullable(),
                        TextInput::make('email')->email()->nullable(),
                        Forms\Components\DatePicker::make('dob')->label('Date of Birth')->required(),
                        TextInput::make('blood_group')->label('Blood Group')->nullable(),
                        TextInput::make('insurance_id')->nullable(),
                        TextInput::make('insurance_name')->nullable(),
                    ]),

                Forms\Components\Select::make('center_id')
                    ->options($getCentersAuth)
                    ->label('Center ID')
                    ->required(),

                Forms\Components\Select::make('doctor_id')
                    ->options($getDoctorDetails)
                    ->label('Doctor')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->query(User::where('role', 'doctor')->whereIn('center_id', getCenters(auth()->user())))
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('status')->sortable(),
                TextColumn::make('date')->label('Appointment Date')->dateTime(),
                TextColumn::make('patient_id')->label('Patient ID'),
                TextColumn::make('center_id')->label('Center ID'),
                TextColumn::make('doctor_id')->label('Doctor ID'),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctorAppointments::route('/'),
            'create' => Pages\CreateDoctorAppointment::route('/create'),
            'edit' => Pages\EditDoctorAppointment::route('/{record}/edit'),
        ];
    }
}
