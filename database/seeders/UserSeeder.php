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
                'admin.example@gmail.com',
                'adminexample',
                3,
            ],
            [
                'Team Leader',
                'teamlead.example@gmail.com',
                'teamleaderxample',
                2,
            ],
            [
                'On Site Employee',
                'onsitelead.example@gmail.com',
                'onsiteexample',
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
