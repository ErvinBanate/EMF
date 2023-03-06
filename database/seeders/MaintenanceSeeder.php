<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Logo' => 'output-onlinepngtools.png',
            'LogIn Background Image' => 'logInPage.png',
        ];

        foreach($data as $key => $value) {
            Maintenance::factory()->create([
                'description' => $key,
                'img_url' => $value,
            ]);
        }
    }
}
