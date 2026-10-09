<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $locations = [
            'Chennai',
            'Bangalore',
            'Hyderabad',
            'Mumbai',
            'Delhi',
            'Pune',
            'Coimbatore',
            'Kochi',
            'Madurai',
            'Tiruchirappalli',
        ];

        foreach ($locations as $location) {
            Location::firstOrCreate([
                'name' => $location,
            ]);
        }
    }
}