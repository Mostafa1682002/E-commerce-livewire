<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "User",
            'email' => 'user@gmail.com',
            'phone' => "01064564850",
            'password' => bcrypt('123456')
        ]);
    }
}
