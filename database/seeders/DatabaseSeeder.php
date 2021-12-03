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
        DB::table('roles')->insert(['name' => 'admin']);
        DB::table('roles')->insert(['name' => 'user']);


        DB::table('users')->insert([

            'email' => 'admin@admin.com',
            'role_id' => '1',
            'password' => bcrypt('admin'),
        ]);
        DB::table('statuses')->insert(['name' => 'awaiting_review']);
        DB::table('statuses')->insert(['name' => 'underway ']);
        DB::table('statuses')->insert(['name' => 'done']);
        DB::table('statuses')->insert(['name' => 'canceled']);



    }
}
