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
        // Employees
        $employees = [
            'ashir@heckto.com',
            'kashan@heckto.com',
            'rayyan@heckto.com',
            'sajid@heckto.com',
            'suleiman@heckto.com',
        ];

        // Managers
        $managers = [
            'ahad@heckto.com',
            'rehman@heckto.com',
            'zain@heckto.com',
        ];

        // Admin
        $admins = [
            'daniel@heckto.com',
        ];

        $this->createUsersWithRole($employees, 'Employee');
        $this->createUsersWithRole($managers, 'Manager');
        $this->createUsersWithRole($admins, 'Admin');
    }

    protected function createUsersWithRole(array $emails, string $role)
    {
        foreach ($emails as $email) {
            $username = explode('@', $email)[0];
            $password = $username . '@0900-+$';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($username),
                    'email_verified_at' => now(),
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(10),
                ]
            );

            $user->assignRole($role);
        }
    }
}
