<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'gender' => 'male',
            'date_of_birth' => '1988/07/05',
            'phone_number_one' => '0911111111',
            'phone_number_two' => '0922222222',
            'region' => 'yangon',
            'town' => 'yangon',
            'address' => 'no.657',
            'status' => 0,
            'role' => 'admin',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
    }
}
