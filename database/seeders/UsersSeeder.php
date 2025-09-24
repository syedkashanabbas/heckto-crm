<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $password = '12345678';

        // Employees
        $employees = [
            'ashir@heckto.com',
            'kashan@heckto.com',
            'rayaan@heckto.com',
            'sajid@heckto.com',
        ];

        // Managers
        $managers = [
            'ahad@heckto.com',
            'rehman@heckto.com',
            'zain@heckto.com',
        ];

        // Admin
        $admins = [
            'daniyal@heckto.com',
        ];

        $this->createUsersWithRole($employees, 'Employee', $password);
        $this->createUsersWithRole($managers, 'Manager', $password);
        $this->createUsersWithRole($admins, 'Admin', $password);
    }

    protected function createUsersWithRole(array $emails, string $role, string $password)
    {
        foreach ($emails as $email) {
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $this->makeName($email),
                    'email_verified_at' => now(),
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(10),
                ]
            );

            $user->assignRole($role);
        }
    }

    protected function makeName(string $email): string
    {
        $local = explode('@', $email)[0];
        return ucfirst($local);
    }
}
