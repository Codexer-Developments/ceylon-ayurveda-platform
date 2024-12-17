<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data):Model
    {
        // Custom logic for storing data
        $data['password'] = bcrypt($data['password']); // Encrypt password manually

        // Save to the database
        return static::getModel()::create($data);
    }
}
