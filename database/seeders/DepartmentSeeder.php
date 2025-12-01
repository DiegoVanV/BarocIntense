<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create departments
        $products = Department::firstOrCreate(
            ['name' => 'Products'],
            ['slug' => 'products']
        );

        $automaten = Department::firstOrCreate(
            ['name' => 'Automaten'],
            ['slug' => 'automaten']
        );

        $koffiebonen = Department::firstOrCreate(
            ['name' => 'Koffiebonen'],
            ['slug' => 'koffiebonen']
        );

        $onderhoud = Department::firstOrCreate(
            ['name' => 'Onderhoud'],
            ['slug' => 'onderhoud']
        );

        // Create test users
        User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Manager User',
                'password' => bcrypt('password'),
                'role' => 'manager',
                'department_id' => $products->id,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'automaten@example.com'],
            [
                'name' => 'Automaten Employee',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'department_id' => $automaten->id,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'koffiebonen@example.com'],
            [
                'name' => 'Koffiebonen Employee',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'department_id' => $koffiebonen->id,
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'onderhoud@example.com'],
            [
                'name' => 'Onderhoud Employee',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'department_id' => $onderhoud->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
