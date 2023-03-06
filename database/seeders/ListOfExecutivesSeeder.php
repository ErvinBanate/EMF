<?php

namespace Database\Seeders;

use App\Models\ListOfExecutives;
use Illuminate\Database\Seeder;

class ListOfExecutivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Barangay Chairman' => 'Roel O. Pacayra',
            'Barangay Secretary' => 'Gemma Laarni C. Baylon',
            'Barangay Treasurer' => 'Eufrencenia A. Bernardo',
            'Barangay Administrator' => 'James L. Quela',
            'EMS Fire Chief' => 'Tommy De Fiesta',
            'Barangay Coordinator' => 'Eden Verg Tuazon',
        ];

        foreach($data as $key => $value) {
            ListOfExecutives::factory()->create([
                'position' => $key,
                'name' => $value,
            ]);
        }
    }
}
