<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleAndUserSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Créer un super administrateur
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'), // Remplacez par un mot de passe sécurisé
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Créer un administrateur
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password123'), // Remplacez par un mot de passe sécurisé
            ]
        );
        $admin->assignRole($adminRole);

        // Créer un utilisateur standard
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Standard User',
                'password' => bcrypt('password123'), // Remplacez par un mot de passe sécurisé
            ]
        );
        $user->assignRole($userRole);

        $this->command->info('Rôles et utilisateurs créés avec succès.');
    }
}

