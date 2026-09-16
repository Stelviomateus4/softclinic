<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'milton@softsalessolutions.com',
            'password' => bcrypt('admin'),
            'role_id' => Role::find(1)->id,
        ]);
    }
}
