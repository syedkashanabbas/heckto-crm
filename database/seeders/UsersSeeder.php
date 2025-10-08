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
            ['email' => 'ashir@heckto.com', 'designation' => 'Video Editor', 'department' => 'Media'],
            ['email' => 'kashan@heckto.com', 'designation' => 'Full Stack Developer', 'department' => 'Development'],
            ['email' => 'rayyan@heckto.com', 'designation' => 'Graphic Designer', 'department' => 'Design'],
            ['email' => 'sajid@heckto.com', 'designation' => 'SEO Specialist', 'department' => 'Marketing'],
            ['email' => 'suleiman@heckto.com', 'designation' => 'Graphic Designer', 'department' => 'Design'],
        ];

        // Managers
        $managers = [
            ['email' => 'ahad@heckto.com', 'designation' => 'Tech Lead', 'department' => 'Development'],
            ['email' => 'rehman@heckto.com', 'designation' => 'Project Manager', 'department' => 'Operations'],
            ['email' => 'zain@heckto.com', 'designation' => 'WordPress Developer', 'department' => 'Development'],
        ];

        // Admin
        $admins = [
            ['email' => 'daniel@heckto.com', 'designation' => 'Administrator', 'department' => 'Management'],
        ];

        $this->createUsersWithRole($employees, 'Employee');
        $this->createUsersWithRole($managers, 'Manager');
        $this->createUsersWithRole($admins, 'Admin');
    }

    protected function createUsersWithRole(array $users, string $role)
    {
        foreach ($users as $userData) {
            $email = $userData['email'];
            $username = explode('@', $email)[0];
            $password = $username . '@0900-+$';

            // Create or find user
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($username),
                    'designation' => $userData['designation'] ?? null,
                    'department' => $userData['department'] ?? null,
                    'status' => 'Active',
                    'email_verified_at' => now(),
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(10),
                ]
            );

            // Assign unique employee code (based on actual ID)
            $user->employee_code = 'HKT-' . str_pad($user->id, 2, '0', STR_PAD_LEFT);
            $user->save();

            // Assign role
            $user->assignRole($role);
        }
    }
}
