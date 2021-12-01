<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('admin.admin_email')) {

            User::firstOrCreate(
                ['email' => config('admin.admin_email')],
                  ['role_id'=> config('admin.admin_role_id'),
                'password' => bcrypt(config('admin.admin_password')),
                ]
            );
        }
    }
}
