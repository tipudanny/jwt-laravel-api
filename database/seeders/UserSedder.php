<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Tipu',
            'email' => 'tipu@gmail.com',
            'phone' => '01763497369',
            'dob' => '20/12/1994',
            'address' => 'Dhaka, Bangladesh',
            'user_type' => 'super-admin',
            'user_branch' => NULL,
            'delivary_rate' => NULL,
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'Danny',
            'email' => 'danny@gmail.com',
            'phone' => '01673712498',
            'dob' => '18/12/1994',
            'address' => 'Dhaka, Bangladesh',
            'user_type' => 'manager',
            'user_branch' => 1,
            'delivary_rate' => 15,
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mahfujar',
            'email' => 'mahfuj@gmail.com',
            'phone' => '01673712587',
            'dob' => '05/01/1992',
            'address' => 'Rangpur, Bangladesh',
            'user_type' => 'rider',
            'user_branch' => NULL,
            'delivary_rate' => 25,
            'password' => Hash::make('12345678'),
        ]);
        DB::table('users')->insert([
            'name' => 'Al-Mamun',
            'email' => 'mamun@gmail.com',
            'phone' => '01714245824',
            'dob' => '05/07/1993',
            'address' => 'Rangpur, Bangladesh',
            'user_type' => 'customer',
            'user_branch' => NULL,
            'delivary_rate' =>NULL,
            'password' => Hash::make('12345678'),
        ]);
    }
}
