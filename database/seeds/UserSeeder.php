<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run initial user for tests.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Wanderson',
            'last_name' => 'Costa',
            'email' => 'wcostaprijo@hotmail.com',
            'password' => \Hash::make('derson123'),
        ]);
    }
}
