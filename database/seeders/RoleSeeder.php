<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super_admin',
            'company_admin',
            'supervisor',
            'agent',
            'qa_analyst',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $permissions = [
            'view admin dashboard',
            'manage companies',
            'manage plans',
            'manage subscriptions',
            'manage payments',
            'view reports',

            'view company dashboard',
            'manage staff',
            'manage calls',
            'manage tickets',
            'manage contacts',
            'manage campaigns',
            'manage queues',
            'manage billing',
            'manage settings',

            'view supervisor dashboard',
            'live monitor',
            'view agents',
            'assign tickets',
            'manage campaigns',

            'view agent dashboard',
            'view my calls',
            'view my tickets',
            'view contacts',
            'manage callbacks',
            'view my performance',

            'view qa dashboard',
            'listen recordings',
            'manage evaluations',
            'view qa reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::where('name', 'super_admin')->first();
        $superAdmin->givePermissionTo(Permission::all());

        $companyAdmin = Role::where('name', 'company_admin')->first();
        $companyAdmin->givePermissionTo([
            'view company dashboard', 'manage staff', 'manage calls',
            'manage tickets', 'manage contacts', 'manage campaigns',
            'manage queues', 'manage billing', 'manage settings', 'view reports',
        ]);

        $supervisor = Role::where('name', 'supervisor')->first();
        $supervisor->givePermissionTo([
            'view supervisor dashboard', 'live monitor', 'view agents',
            'manage calls', 'assign tickets', 'manage campaigns', 'view reports',
        ]);

        $agent = Role::where('name', 'agent')->first();
        $agent->givePermissionTo([
            'view agent dashboard', 'view my calls', 'view my tickets',
            'view contacts', 'manage callbacks', 'view my performance',
        ]);

        $qaAnalyst = Role::where('name', 'qa_analyst')->first();
        $qaAnalyst->givePermissionTo([
            'view qa dashboard', 'listen recordings', 'manage evaluations', 'view qa reports',
        ]);
    }
}
