<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        \App\Models\Company::factory(3)->create()->each(function ($company) use ($user) {

            $company->users()->attach($user->id);

            \App\Models\Department::factory(4)->create([
                'company_id' => $company->id
            ])->each(function ($department) {
                \App\Models\Designation::factory(5)->create([
                    'department_id' => $department->id
                ])->each(function ($designation) {

                    \App\Models\Employee::factory(5)->create([
                        'designation_id' => $designation->id

                    ])->each(function ($employee) use ($designation) {

                        \App\Models\Contract::factory()->create([
                            'employee_id' => $employee->id,
                            'designation_id' => $designation->id
                        ]);
                    });
                });
            });




        });

    }
}
