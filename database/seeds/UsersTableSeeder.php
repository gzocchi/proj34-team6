<?php

use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@email.com',
        //     'password' => bcrypt('password!'),
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@deliveboo.com',
            'password' => bcrypt('password!'),
        ]);
    }
}
