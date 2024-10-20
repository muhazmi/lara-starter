<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'              => 'SuperAdmin',
                'email'             => 'superadmin@gmail.com',
                'password'          => Hash::make('superadmin@gmail.com'),
                'photo'             => 'superadmin.png',
                'email_verified_at' => Carbon::now(),
            ],
            [
                'name'              => 'Admin Umum',
                'email'             => 'admin@gmail.com',
                'password'          => Hash::make('admin@gmail.com'),
                'photo'             => 'admin.png',
                'email_verified_at' => Carbon::now(),
            ],
        ];

        foreach ($users as $index => $userData) {
            $user       = User::create($userData);
            $roleName   = ['superadmin', 'admin'][$index];

            $user->assignRole($roleName);
        }
    }
}
