<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupsTableSeeder::class);
        $this->call(GrouplinksTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
