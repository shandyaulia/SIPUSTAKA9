<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Define Roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Create Default Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@sipustaka9.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
            ]
        );
        
        $superAdmin->assignRole($superAdminRole);
    }
}
