<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'username' => 'luonghx',
            'email' => 'luonghx@gmail.com',
            'password' => Hash::make('1'),
            'role' => 1,
            'merchant_id' => Str::random(8),
            'merchant_key' => Str::random(20)
        ]);
    }
}
