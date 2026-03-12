<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Matheus',
                'email' => 'matheus.baptista@citral.tur.br',
                'password' => '123456',
            ],
            [
                'name' => 'Adriano',
                'email' => 'adriano@citral.tur.br',
                'password' => 'afr450',
            ],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'is_admin'=> true,
                ]
            );
        }
    }
}
