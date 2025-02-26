<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;


class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Doctor Booking Settings
            [
                'key' => 'doctor_booking_enabled',
                'value' => '1',
                'required' => true,
                'options' => '0,1',
                'placeholder' => 'Enable or Disable',
                'group' => 'Doctor Booking',
                'type' => 'toggle',
                'label' => 'Enable Doctor Booking',
            ],
            [
                'key' => 'doctor_booking_time_gap',
                'value' => '30',
                'required' => true,
                'options' => json_encode([
                    15 => 15,
                    30 => 30,
                    45 => 45,
                    60 => 60
                ]),
                'placeholder' => 'Select time slot in minutes',
                'group' => 'Doctor Booking',
                'type' => 'select',
                'label' => 'Doctor Booking Time Slots (minutes)',
            ],



            // POS Booking Settings
            [
                'key' => 'pos_booking_enabled',
                'value' => '1',
                'required' => true,
                'options' => '0,1',
                'placeholder' => 'Enable or Disable',
                'group' => 'POS',
                'type' => 'toggle',
                'label' => 'Enable POS Booking',
            ],
            [
                'key' => 'pos_booking_tax_rate',
                'value' => '5',
                'required' => true,
                'options' => null,
                'placeholder' => 'Enter tax rate (%)',
                'group' => 'POS',
                'type' => 'number',
                'label' => 'Tax Rate (%)',
            ],
            [
                'key' => 'pos_booking_currency',
                'value' => 'USD',
                'required' => true,
                'options' => json_encode([
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                    'GBP' => 'GBP',
                    'AUD' => 'AUD',
                ]),
                'placeholder' => 'Select currency',
                'group' => 'POS',
                'type' => 'select',
                'label' => 'Currency',
            ],


            [
                'key' => 'google_map_api_key',
                'value' => '',
                'required' => false,
                'placeholder' => 'Enter Google Map API Key',
                'group' => 'System',
                'type' => 'text',
                'label' => 'Google Map API Key',
            ],

            [
                'key' => 'google_map_api_secret',
                'value' => '',
                'required' => false,
                'placeholder' => 'API Secrets',
                'group' => 'System',
                'type' => 'text',
                'label' => 'Google Map API Secret',
            ],

            [
                'key' => 'mail_host',
                'value' => '',
                'required' => false,
                'placeholder' => 'Email Host',
                'group' => 'Email',
                'type' => 'text',
                'label' => 'Email Host',
            ],
            [
                'key' => 'mail_port',
                'value' => '',
                'required' => false,
                'placeholder' => 'Email Port',
                'group' => 'Email',
                'type' => 'text',
                'label' => 'Email Port',

            ],
            [
                'key' => 'mail_username',
                'value' => '',
                'required' => false,
                'placeholder' => 'Email Username',
                'group' => 'Email',
                'type' => 'text',
                'label' => 'Email Username',

            ],
            [
                'key' => 'mail_password',
                'value' => '',
                'required' => false,
                'placeholder' => 'Email Password',
                'group' => 'Email',
                'type' => 'password',
                'label' => 'Email Password',

            ],
            [
                'key' => 'mail_encryption',
                'value' => '',
                'required' => false,
                'placeholder' => 'Email Encryption',
                'group' => 'Email',
                'type' => 'text',
                'label' => 'Email Encryption',
            ],
            [
                'key' => 'mail_from_address',
                'value' => '',
                'required' => false,
                'placeholder' => 'Email From Address',
                'group' => 'Email',
                'type' => 'text',
                'label' => 'Email From Address',

            ]
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }

}
