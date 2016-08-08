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

        $category = factory(App\Category::class,100000)->create();
//        $this->call(UsersTableSeeder::class);
    }
}
