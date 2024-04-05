<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Trabajador']);

        Permission::create(['name' => 'admin.usuarios.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.usuarios.update'])->assignRole($role1);


    }
}