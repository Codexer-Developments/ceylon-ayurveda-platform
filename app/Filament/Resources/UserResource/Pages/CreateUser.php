<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;


    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Hash the password before saving
        $data['password'] = Hash::make($data['password']);

        // Save the user
        $user = static::getModel()::create($data);

        // Assign role
        if (!empty($data['role'])) {
            $user->assignRole($data['role']);
        }

        return $user;
    }

    protected static function afterSave($record): void
    {
        if (request()->has('data.role')) {
            $roleName = request()->input('data.role');
            $record->syncRoles([$roleName]); // Update the role for the user
        }
    }
}
