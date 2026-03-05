<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si el usuario ya existe
        $user = User::where('email', 'info@bluedraft.cc')->first();
        
        if (!$user) {
            User::create([
                'name' => 'Blue Draft Admin',
                'email' => 'info@bluedraft.cc',
                'password' => Hash::make('BlueDraft2024!'),
            ]);
            
            $this->command->info('Usuario administrador creado exitosamente!');
            $this->command->info('Email: info@bluedraft.cc');
            $this->command->info('Password: BlueDraft2024!');
        } else {
            $this->command->warn('El usuario administrador ya existe.');
        }
    }
}

