<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Usuário administrador padrão para o primeiro acesso ao sistema.
        // Login: admin | Senha: admin123
        User::firstOrCreate(
            ['usuario' => 'admin'],
            [
                'name' => 'Administrador',
                'email' => 'admin@techfix.com',
                'password' => Hash::make('admin123'),
                'perfil' => 'Administrador',
            ]
        );
    }
}
