<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        \DB::table('admins')->insert([
            'name' => 'Xuân Bách',
            'username' => 'xuanbachdev',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('12345678'),
            'phone_number' => '123456789',
            'address' => 'Hà Nội',
            'gender' => '1',
            'birthday' => \Carbon\Carbon::now(),
            'created_at' => now()
        ]);
    }
}
