<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Project::create([
                'name' => $faker->name,
                'municipality' => $faker->country,
                'geolocation' => '['.$faker->latitude().','. $faker->longitude().']',
                'description' => $faker->paragraph,
                'status' => 'prospect',
            ]);
        }
    }
}
