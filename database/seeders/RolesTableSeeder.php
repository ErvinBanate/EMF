<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'employee' => 'Employee Role',
            'team_leader' => 'Team Leader Role',
            'admin' => 'Admin Role',
        ];

        foreach ($roles as $key => $value) {
            Role::factory()->create([
                'role_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => $value,
            ]);
        }
    }
}
