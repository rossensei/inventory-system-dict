<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role_admin = Role::create(['name' => 'Administrator']);
        $role_user = Role::create(['name' => 'User']);

        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'edit-category']);
        Permission::create(['name' => 'delete-category']);

        Permission::create(['name' => 'create-office']);
        Permission::create(['name' => 'edit-office']);
        Permission::create(['name' => 'delete-office']);

        Permission::create(['name' => 'create-employee']);
        Permission::create(['name' => 'edit-employee']);
        Permission::create(['name' => 'delete-employee']);

        Permission::create(['name' => 'create-acquisition']);
        Permission::create(['name' => 'edit-acquisition']);
        Permission::create(['name' => 'delete-acquisition']);

        Permission::create(['name' => 'create-property']);
        Permission::create(['name' => 'edit-property']);
        Permission::create(['name' => 'delete-property']);

        $role_admin->givePermissionTo(Permission::all());
        
        $role_user->givePermissionTo([
            'create-category',
            'edit-category',
            'delete-category',
            'create-office',
            'edit-office',
            'delete-office',
            'create-acquisition',
            'edit-acquisition',
            'delete-acquisition',
            'create-property',
            'edit-property',
            'delete-property',
        ]);

        $employee = Employee::create([
            'id_no' => '993485',
            'fname' => 'Jay Mar',
            'mname' => 'Justol',
            'lname' => 'Masibay',
            'emp_type' => 'Plantilla',
            'address' => 'Antequera, Bohol',
            'status' => 'Active',
        ]);

        $employee->user->assignRole($role_admin);
    }
}
