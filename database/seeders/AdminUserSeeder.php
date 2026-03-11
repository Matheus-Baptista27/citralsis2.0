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
                'name' => 'Administrador 1',
                'email' => 'matheus.baptista@citral.com.br',
                'password' => '123456',
            ],
            [
                'name' => 'Administrador 2',
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
                ]
            );
        }
    }
}
