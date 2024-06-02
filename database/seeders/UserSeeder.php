<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Ali barakat',
            'email' => 'a@gmail.com',
            'password' => Hash::make('123456'),

        ])->assignRole('super_admin');

        User::create([
            'name' => 'mohamad mohamad',
            'email' => 'm@gmail.com',
            'password' => Hash::make('123456'),

        ])->assignRole('panel_userer');
    }
}
