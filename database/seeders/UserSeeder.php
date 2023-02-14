<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'Admin',
                'admin@gmail.com',
                'adminlowerbicutanfire',
                3,
            ],
            [
                'Team Leader',
                'team.leader@gmail.com',
                'teamleaderlowerbicutanfire',
                2,
            ],
            [
                'On Site Employee',
                'employee@gmail.com',
                'employeelowerbicutanfire',
                1,
            ],
        ];

        foreach($users as $user) {
            User::factory()->create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'role_id' => $user[3],
            ]);
        }
    }
}
