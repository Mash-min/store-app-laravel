<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Mashiyyat',
            'lastname' => 'Delos Santos',
            'contact' => '09982205660',
            'role' => 'admin',
            'address' => 'none',
            'slug' => 'none',
            'email' => 'delossantos.mash@gmail.com',
            'password' => Hash::make('11111111'),
        ]);
    }
}
