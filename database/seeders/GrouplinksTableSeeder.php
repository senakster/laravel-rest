<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Grouplink;

class GrouplinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Schema::disableForeignKeyConstraints();
        Grouplink::truncate();
        Schema::enableForeignKeyConstraints();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 10; $i++) {
            Grouplink::create([
                'group_id' => $i+1,
                'name' => $faker->name,
                'url' => $faker->url,
                'description' => $faker->paragraph,
            ]);
        }
    }
}
