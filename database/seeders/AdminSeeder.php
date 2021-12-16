<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name'=>"Ahmad",
            'last_name'=>"Al Zein",
            "email"=>"ahmadalzein06@gmail.com",
            "password"=>bcrypt("12345")
        ]);
    }
}
