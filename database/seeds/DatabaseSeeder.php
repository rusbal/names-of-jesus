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
        App\User::truncate();
        App\Name::truncate();
        App\Revision::truncate();

        $this->call(UsersTableSeeder::class);
        $this->call(NamesTableSeeder::class);
        $this->call(RevisionsTableSeeder::class);
    }
}
