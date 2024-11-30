<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getJsonRoles = json_decode(file_get_contents(public_path('service_json/roles.json')));
        foreach ($getJsonRoles as $role) {
            $permissionDetails = Permission::where('name', $role->name)->first();
            if($permissionDetails) {
                continue;
            }
            Role::create([
                'name' => $role->name,
                'guard_name' => 'web',
                'created_at' => $role->created_at,
            ]);
        }
    }
}
