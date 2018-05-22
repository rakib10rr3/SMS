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
        factory(\App\Model\Student::class, 100)->create();
        //
        DB::table('teachers')->delete();
        factory(\App\Teacher::class, 100)->create();
        //
        DB::table('staff')->delete();
        factory(\App\Model\Staff::class, 20)->create();
        //
        DB::table('subjects')->delete();
        factory(\App\Model\Subject::class, 100)->create();

    }
}
