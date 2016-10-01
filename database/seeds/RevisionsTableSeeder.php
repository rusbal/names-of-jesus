<?php

use Illuminate\Database\Seeder;

class RevisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Revision::class, 50)->create();
    }
}
