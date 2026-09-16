<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hospitals')->insert([
            'name' => 'SoftClinic',
            'slogan' => 'Soluções inteligentes para a sua clínica',
            'logo' => 'uploads/logo.png',
            'address' => 'Maputo, Moçambique',
            'contact' => '+258',
            'email' => 'info@softsalessolutions.com',
            'pan_no' => '123',
            'registration_no' => '12345',
            'website' => 'https://github.com/miltonmanjate',
            'description' => 'Sistema de Gestão Clínica desenvolvido por Milton Manjate na SoftSales Solutions.',
            'tax_type' => 'Health Tax',
            'tax_percent' => 5,
            'invoice_prefix' => 'SSS-',
            'patient_prefix' => 'SSS-',
            'invoice_message' => 'Obrigado pela preferência. SoftSales Solutions.',
        ]);
    }
}
