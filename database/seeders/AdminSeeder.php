<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Cek apakah user dengan email ini sudah ada
        User::create([
            'name' => 'adminsalman',
            'email' => 'adminsalman@gmail.com',
            'password' => Hash::make('adminsalman'),
            'role' => 'admin',
        ]);
}

}
