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
        $RoleAdmin = Role::create(['name' => 'Admin']);
        $RoleUserJunior = Role::create(['name' => 'UserJunior']);
        $RoleUserVip = Role::create(['name' => 'UserVip']);

        Permission::create(['name' => 'admin.home'])->syncRoles([$RoleAdmin]);
        Permission::create(['name' => 'admin.edit'])->syncRoles([$RoleAdmin]);
        Permission::create(['name' => 'userjunior.edit'])->syncRoles([$RoleUserJunior]);
        Permission::create(['name' => 'uservip.create'])->syncRoles([$RoleUserVip]);
    }
}
