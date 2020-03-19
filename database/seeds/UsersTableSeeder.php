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
        \App\User::create([
            'name' => 'Shubham Singh Chahar',
            'password' => bcrypt('password'),
            'email' => 'thefallenmerc@gmail.com'
        ]);
    }
}
