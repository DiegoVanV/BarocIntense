<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class SetupTestUsers extends Command
{
    protected $signature = 'app:setup-test-users';
    protected $description = 'Maakt test-afdeling, manager en werknemer aan';

    public function handle()
    {
        $this->info('--- Test setup gestart ---');


        $department = Department::firstOrCreate(
            ['slug' => 'product-management'],
            ['name' => 'Product Management']
        );
        $this->info("Department aangemaakt: {$department->name} (ID {$department->id})");


        $employee = User::firstOrCreate(
            ['email' => 'employee@test.com'],
            [
                'name' => 'Test Werknemer',
                'password' => Hash::make('password'),
                'department_id' => $department->id,
                'role' => 'employee',
            ]
        );
        $employee->department_id = $department->id;
        $employee->role = 'employee';
        $employee->save();
        $this->info("Werknemer aangemaakt: {$employee->name} / department_id = {$employee->department_id}");


        $manager = User::firstOrCreate(
            ['email' => 'manager@test.com'],
            [
                'name' => 'Test Manager',
                'password' => Hash::make('password'),
                'department_id' => null,
                'role' => 'manager',
            ]
        );
        $manager->department_id = null;
        $manager->role = 'manager';
        $manager->save();
        $this->info("Manager aangemaakt: {$manager->name}");

        $this->info('--- Test setup voltooid ---');
        $this->info('Inloggegevens:');
        $this->info('Werknemer → email: employee@test.com / password: password');
        $this->info('Manager   → email: manager@test.com / password: password');

        return Command::SUCCESS;
    }
}
