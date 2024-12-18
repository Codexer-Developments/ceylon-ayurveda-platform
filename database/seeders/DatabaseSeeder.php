<?php

namespace Database\Seeders;

use App\Models\Centers;
use App\Models\ProductCategory;
use App\Models\Products;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ProductsFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         ProductCategory::factory(10)->create();
         Products::factory(10)->create();
         Centers::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'role'=> 'admin'
        ]);
    }
}
