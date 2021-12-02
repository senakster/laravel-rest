<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Group::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            Group::create([
                'name' => $faker->name,
                'municipality' => $faker->country,
                'grouptype' => 'lokalgruppe',
                'description' => $faker->paragraph,
                'status' => 'active',
            ]);
        }
    }
}
