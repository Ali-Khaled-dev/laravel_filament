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

        ])->syncRoles('super_admin');

        User::create([
            'name' => 'mohamad mohamad',
            'email' => 'm@gmail.com',
            'password' => Hash::make('123456'),

        ])->syncRoles('panel_user');
    }
}
