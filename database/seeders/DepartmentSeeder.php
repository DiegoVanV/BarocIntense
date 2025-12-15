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
        $products = Department::firstOrCreate(
            ['name' => 'Products'],
            ['slug' => 'products']
        );

        $sales = Department::firstOrCreate(
            ['name' => 'Sales'],
            ['slug' => 'sales']
        );

        $onderhoud = Department::firstOrCreate(
            ['name' => 'Onderhoud'],
            ['slug' => 'onderhoud']
        );

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
            ['email' => 'sales@example.com'],
            [
                'name' => 'Sales Employee',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'department_id' => $sales->id,
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
