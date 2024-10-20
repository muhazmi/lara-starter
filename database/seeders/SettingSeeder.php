<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name'                  => 'Rental Mobil',
            'description'           => 'Rental Mobil adalah perusahaan rental mobil yang memiliki service dan harga terbaik di Palembang.',
            'logo'                  => 'app-logo.jpg',
            'tax_name'                  => 'PPN',
            'tax_value'                 => '11',
            'tax_status'                => '0',
            'smtp_protocol'             => 'smtp',
            'smtp_host'                 => 'smtp.zoho.com',
            'smtp_username'             => 'emailpercobaan@amperakoding.com',
            'smtp_password'             => encrypt('j88vycWVCx3x'),
            'smtp_port'                 => '587',
            'smtp_encryption'           => 'tls',            
            'driver_price_daily'        => '500000',
        ]);
    }
}
