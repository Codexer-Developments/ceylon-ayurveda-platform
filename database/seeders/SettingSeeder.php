<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'company_name'], ['value' => 'Ceylon Ayurvedic Platform']);
        Setting::updateOrCreate(['key' => 'company_email'], ['value' => 'Ceylon Ayurvedic Platform']);
        Setting::updateOrCreate(['key' => 'currency'], ['value' => 'GBP']);
        Setting::updateOrCreate(['key' => 'country'], ['value' => 'UK']);

    }
}
