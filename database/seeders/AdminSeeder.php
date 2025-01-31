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
        //akun untuk admin
        User::create([
            'name' => 'adminsalman',
            'email' => 'adminsalman@gmail.com',
            'password' => Hash::make('adminsalman'),
            'isAdmin' => 1,
        ]);

        //akun untuk user

    }
}
