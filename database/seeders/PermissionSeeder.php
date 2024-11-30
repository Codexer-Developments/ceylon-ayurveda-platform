<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getJsonPermission = json_decode(file_get_contents(public_path('service_json/permission.json')));
        foreach ($getJsonPermission as $permission) {
            $permissionDetails = Permission::where('name', $permission->name)->first();
            if($permissionDetails) {
                continue;
            }
            Permission::create([
                'name' => $permission->name,
                'guard_name' => 'web',
                'created_at' => $permission->created_at,
            ]);
        }

    }
}
