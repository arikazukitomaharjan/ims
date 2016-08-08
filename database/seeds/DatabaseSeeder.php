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

//        $this->call(UsersTableSeeder::class);

        $category = factory(App\Category::class, 100000)->create();
    }
}
