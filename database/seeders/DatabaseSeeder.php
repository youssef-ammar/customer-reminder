<?php

namespace Database\Seeders;

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
        DB::table('roles')->insert(['id'=> 1 , 'name' => 'admin']);
        DB::table('roles')->insert(['id'=> 2 , 'name' => 'user']);

        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'role_id' => '1',
            'password' => bcrypt('admin'),
        ]);
        
        DB::table('statuses')->insert(['id'=> 1 ,'name' => 'awaiting_review']);
        DB::table('statuses')->insert(['id'=> 2 ,'name' => 'underway ']);
        DB::table('statuses')->insert(['id'=> 3 ,'name' => 'done']);
        DB::table('statuses')->insert(['id'=> 4 ,'name' => 'canceled']);
    }
}
