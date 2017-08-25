<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Project::truncate();
        // $this->call(UsersTableSeeder::class);
        App\Project::insert([
            ['']
        ]);
    }
}
