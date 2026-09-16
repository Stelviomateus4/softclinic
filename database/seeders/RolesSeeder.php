<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::truncate();
        $role = Role::create([
            'name' => 'Superadmin',
            'description' => 'Role for Super administrator',
        ]);
        $permissionIds = Permission::query()->pluck('id')->toArray();
        $role->permissions()->attach($permissionIds);
    }
}
