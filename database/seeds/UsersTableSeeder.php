<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Raymond Usbal',
            'email' => 'raymond@philippinedev.com',
            'password' => bcrypt('default'),
        ]);
        DB::table('users')->insert([
            'name' => 'Arthur Macarubbo',
            'email' => 'arthur.macarubbo@yahoo.com',
            'password' => bcrypt('default'),
        ]);
    }
}
