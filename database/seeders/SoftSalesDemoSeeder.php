<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Hospital;
use App\Models\Invoice;
use App\Models\OpdSales;
use App\Models\Package;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SoftSalesDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = [
            'appointments',
            'doctor_referreds',
            'examination_results',
            'invoice_returns',
            'invoices',
            'opd_sales',
            'package_sales',
            'package_tests',
            'packages',
            'reference_results',
            'reports',
            'service_sales',
            'temps',
            'test_antibiotic_results',
            'test_antibiotics',
            'test_examinations',
            'test_reference_results',
            'test_references',
            'test_reports',
            'test_results',
            'test_stains',
            'test_test_antibiotic',
            'test_test_reference',
            'tests',
            'services',
            'doctors',
            'employees',
            'patients',
            'departments',
            'password_resets',
        ];

        foreach ($tables as $table) {
            if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

        // Keep only the SoftSales admin account.
        User::query()->where('name', '!=', 'admin')->delete();

        $admin = User::query()->where('name', 'admin')->first();
        if ($admin) {
            $admin->update([
                'email' => 'milton@softsalessolutions.com',
                'password' => Hash::make('miltonmanjate'),
                'role_id' => 1,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Hospital::query()->where('id', 1)->update([
            'name' => 'SoftClinic',
            'slogan' => 'Soluções inteligentes para a sua clínica',
            'address' => 'Av. Julius Nyerere, Maputo, Moçambique',
            'contact' => '+258 84 000 0000',
            'email' => 'info@softsalessolutions.com',
            'website' => 'https://github.com/miltonmanjate',
            'description' => 'Clínica demo SoftSales Solutions — desenvolvida por Milton Manjate.',
            'invoice_prefix' => 'SSS-',
            'patient_prefix' => 'SSS-',
            'invoice_message' => 'Obrigado pela preferência. SoftSales Solutions.',
            'tax_type' => 'IVA',
            'tax_percent' => 5,
        ]);

        $departments = collect([
            'Medicina Geral',
            'Pediatria',
            'Ginecologia e Obstetrícia',
            'Laboratório Clínico',
            'Cardiologia',
            'Urgências',
        ])->mapWithKeys(function ($name) {
            $dept = Department::create(['name' => $name]);

            return [$name => $dept->id];
        });

        $staff = [
            [
                'first_name' => 'Carlos',
                'middle_name' => null,
                'last_name' => 'Mucavel',
                'email' => 'carlos.mucavel@softsalessolutions.com',
                'address' => 'Maputo',
                'phone' => '+258 84 111 1001',
                'education' => 'Medicina — UEM',
                'speciality' => 'Clínica Geral',
                'department' => 'Medicina Geral',
                'working_day' => 'Seg-Sex',
                'in_time' => '08:00',
                'out_time' => '16:00',
                'type' => 'doctor',
                'fee' => 1200,
                'opd_charge' => 800,
            ],
            [
                'first_name' => 'Ana',
                'middle_name' => 'Maria',
                'last_name' => 'Muchanga',
                'email' => 'ana.muchanga@softsalessolutions.com',
                'address' => 'Matola',
                'phone' => '+258 84 111 1002',
                'education' => 'Pediatria — UEM',
                'speciality' => 'Pediatria',
                'department' => 'Pediatria',
                'working_day' => 'Seg-Sex',
                'in_time' => '08:30',
                'out_time' => '15:30',
                'type' => 'doctor',
                'fee' => 1500,
                'opd_charge' => 900,
            ],
            [
                'first_name' => 'João',
                'middle_name' => null,
                'last_name' => 'Sitoe',
                'email' => 'joao.sitoe@softsalessolutions.com',
                'address' => 'Maputo',
                'phone' => '+258 84 111 1003',
                'education' => 'Cardiologia',
                'speciality' => 'Cardiologia',
                'department' => 'Cardiologia',
                'working_day' => 'Seg-Qui',
                'in_time' => '09:00',
                'out_time' => '17:00',
                'type' => 'doctor',
                'fee' => 2000,
                'opd_charge' => 1200,
            ],
            [
                'first_name' => 'Fátima',
                'middle_name' => null,
                'last_name' => 'Nhantumbo',
                'email' => 'fatima.nhantumbo@softsalessolutions.com',
                'address' => 'Maputo',
                'phone' => '+258 84 111 1004',
                'education' => 'Ginecologia',
                'speciality' => 'Ginecologia',
                'department' => 'Ginecologia e Obstetrícia',
                'working_day' => 'Seg-Sex',
                'in_time' => '08:00',
                'out_time' => '14:00',
                'type' => 'doctor',
                'fee' => 1800,
                'opd_charge' => 1000,
            ],
            [
                'first_name' => 'Sofia',
                'middle_name' => null,
                'last_name' => 'Cossa',
                'email' => 'sofia.cossa@softsalessolutions.com',
                'address' => 'Maputo',
                'phone' => '+258 84 111 1005',
                'education' => 'Análises Clínicas',
                'speciality' => 'Laboratório',
                'department' => 'Laboratório Clínico',
                'working_day' => 'Seg-Sab',
                'in_time' => '07:30',
                'out_time' => '15:00',
                'type' => 'staff',
                'fee' => null,
                'opd_charge' => null,
            ],
        ];

        $doctors = [];
        foreach ($staff as $person) {
            $employee = Employee::create([
                'first_name' => $person['first_name'],
                'middle_name' => $person['middle_name'],
                'last_name' => $person['last_name'],
                'email' => $person['email'],
                'address' => $person['address'],
                'phone' => $person['phone'],
                'education' => $person['education'],
                'description' => 'Equipa SoftClinic',
                'certificate' => 'Registo profissional MZ',
                'speciality' => $person['speciality'],
                'working_day' => $person['working_day'],
                'in_time' => $person['in_time'],
                'out_time' => $person['out_time'],
                'type' => $person['type'],
                'department_id' => $departments[$person['department']],
            ]);

            if ($person['type'] === 'doctor') {
                $doctors[] = Doctor::create([
                    'employee_id' => $employee->id,
                    'fee' => $person['fee'],
                    'opd_charge' => $person['opd_charge'],
                ]);
            }
        }

        $serviceDefs = [
            ['Consulta Medicina Geral', 800, 'Medicina Geral'],
            ['Consulta Pediatria', 900, 'Pediatria'],
            ['Consulta Cardiologia', 1200, 'Cardiologia'],
            ['Consulta Ginecologia', 1000, 'Ginecologia e Obstetrícia'],
            ['Hemograma Completo', 450, 'Laboratório Clínico'],
            ['Glicemia', 250, 'Laboratório Clínico'],
            ['ECG', 700, 'Cardiologia'],
            ['Atendimento de Urgência', 1500, 'Urgências'],
        ];

        $services = [];
        foreach ($serviceDefs as [$name, $amount, $dept]) {
            $services[$name] = Service::create([
                'name' => $name,
                'amount' => $amount,
                'department_id' => $departments[$dept],
            ]);
        }

        Test::create([
            'service_id' => $services['Hemograma Completo']->id,
            'name' => 'Hemograma Completo',
            'report_type' => 'haematology',
            'description' => 'Contagem sanguínea completa',
        ]);
        Test::create([
            'service_id' => $services['Glicemia']->id,
            'name' => 'Glicemia em jejum',
            'report_type' => 'biochemistry',
            'description' => 'Doseamento de glicose',
        ]);
        Test::create([
            'service_id' => $services['ECG']->id,
            'name' => 'Eletrocardiograma',
            'report_type' => 'examination',
            'description' => 'ECG de 12 derivações',
        ]);

        Package::create([
            'name' => 'Check-up Básico',
            'description' => 'Consulta + hemograma + glicemia',
            'price' => 1400,
        ]);
        Package::create([
            'name' => 'Pacote Cardíaco',
            'description' => 'Consulta cardiologia + ECG',
            'price' => 1800,
        ]);

        $patientDefs = [
            ['Esperança', null, 'Tembe', 28, 'Female', 'single', 'O+', 'Maputo', 'Comerciante'],
            ['Paulo', 'António', 'Mabunda', 41, 'Male', 'married', 'A+', 'Matola', 'Motorista'],
            ['Maria', null, 'Chissano', 35, 'Female', 'married', 'B+', 'Maputo', 'Professora'],
            ['Hélder', null, 'Guebuza', 52, 'Male', 'married', 'AB+', 'Boane', 'Agricultor'],
            ['Lídia', 'Rosa', 'Macuácua', 23, 'Female', 'single', 'O-', 'Maputo', 'Estudante'],
            ['Daniel', null, 'Nhampossa', 47, 'Male', 'married', 'A-', 'Marracuene', 'Técnico'],
            ['Beatriz', null, 'Mondlane', 31, 'Female', 'married', 'B-', 'Maputo', 'Enfermeira'],
            ['Samuel', 'José', 'Cuamba', 19, 'Male', 'single', 'O+', 'Maputo', 'Estudante'],
        ];

        $patients = [];
        foreach ($patientDefs as $i => $p) {
            $patients[] = Patient::create([
                'first_name' => $p[0],
                'middle_name' => $p[1],
                'last_name' => $p[2],
                'email' => strtolower($p[0]).'.'.strtolower($p[2]).'@email.mz',
                'age' => $p[3],
                'phone' => '+258 84 200 10'.str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
                'gender' => $p[4],
                'birth_date' => (string) (2026 - $p[3]).'-01-15',
                'country' => 'Moçambique',
                'state' => 'Maputo',
                'district' => $p[7],
                'location' => $p[7],
                'occupation' => $p[8],
                'description' => 'Paciente demo SoftSales',
                'relative_name' => 'Familiar '.$p[2],
                'relative_phone' => '+258 82 300 10'.str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT),
                'marital_status' => $p[5],
                'blood_group' => $p[6],
            ]);
        }

        $today = now()->startOfDay()->addHours(9);

        Appointment::create([
            'name' => 'Consulta de rotina',
            'description' => 'Acompanhamento clínico',
            'time' => '09:30',
            'appointment_date' => $today->copy()->setTime(9, 30),
            'status' => 0,
            'patient_id' => $patients[0]->id,
            'doctor_id' => $doctors[0]->id,
        ]);
        Appointment::create([
            'name' => 'Consulta pediátrica',
            'description' => 'Controlo de crescimento',
            'time' => '10:15',
            'appointment_date' => $today->copy()->setTime(10, 15),
            'status' => 0,
            'patient_id' => $patients[4]->id,
            'doctor_id' => $doctors[1]->id,
        ]);
        Appointment::create([
            'name' => 'Avaliação cardíaca',
            'description' => 'Dor no peito leve',
            'time' => '11:00',
            'appointment_date' => $today->copy()->setTime(11, 0),
            'status' => 1,
            'patient_id' => $patients[1]->id,
            'doctor_id' => $doctors[2]->id,
        ]);

        $invoice1 = Invoice::create([
            'invoice_no' => 'SSS-1001',
            'payment_type' => 'Cash',
            'sub_total' => 800,
            'discount' => 0,
            'tax_amount' => 40,
            'total_amount' => 840,
            'patient_id' => $patients[0]->id,
            'user_id' => $admin?->id ?? 3,
            'status' => 1,
        ]);

        $invoice2 = Invoice::create([
            'invoice_no' => 'SSS-1002',
            'payment_type' => 'M-Pesa',
            'sub_total' => 1200,
            'discount' => 50,
            'tax_amount' => 57.5,
            'total_amount' => 1207.5,
            'patient_id' => $patients[1]->id,
            'user_id' => $admin?->id ?? 3,
            'status' => 1,
        ]);

        // Touch timestamps to "today" for dashboard collections.
        DB::table('invoices')->whereIn('id', [$invoice1->id, $invoice2->id])->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        OpdSales::create([
            'opd_name' => 'Consulta Medicina Geral',
            'doctor_id' => $doctors[0]->id,
            'invoice_id' => $invoice1->id,
            'doctor_fee' => $doctors[0]->fee,
            'opd_charge' => $doctors[0]->opd_charge,
            'status' => 1,
        ]);
        OpdSales::create([
            'opd_name' => 'Consulta Cardiologia',
            'doctor_id' => $doctors[2]->id,
            'invoice_id' => $invoice2->id,
            'doctor_fee' => $doctors[2]->fee,
            'opd_charge' => $doctors[2]->opd_charge,
            'status' => 0,
        ]);

        DB::table('opd_sales')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
