<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('students')->delete();
        factory(\App\Model\Student::class,50)->create();
        //
        DB::table('teachers')->delete();
        factory(\App\Teacher::class,50)->create();


    }
}
