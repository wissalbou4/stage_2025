<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Etat;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Ensure Etat records exist
        $adminEtat = Etat::where('role', 'admin')->first();
        $operateurEtat = Etat::where('role', 'operateur')->first();
        $ramasseurEtat = Etat::where('role', 'ramasseur')->first();
        $controleurEtat = Etat::where('role', 'controleur')->first();
        $caissierEtat = Etat::where('role', 'caissier')->first();

        // Create users with unique code_barre
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'etat_id' => $adminEtat->id,
                'code_barre' => $this->generateUniqueCodeBarre(),
            ],
            [
                'name' => 'Operateur User',
                'email' => 'operateur@example.com',
                'password' => Hash::make('password123'),
                'etat_id' => $operateurEtat->id,
                'code_barre' => $this->generateUniqueCodeBarre(),
            ],
            [
                'name' => 'Ramasseur User',
                'email' => 'ramasseur@example.com',
                'password' => Hash::make('password123'),
                'etat_id' => $ramasseurEtat->id,
                'code_barre' => $this->generateUniqueCodeBarre(),
            ],
            [
                'name' => 'Controleur User',
                'email' => 'controleur@example.com',
                'password' => Hash::make('password123'),
                'etat_id' => $controleurEtat->id,
                'code_barre' => $this->generateUniqueCodeBarre(),
            ],
            [
                'name' => 'Caissier User',
                'email' => 'caissier@example.com',
                'password' => Hash::make('password123'),
                'etat_id' => $caissierEtat->id,
                'code_barre' => $this->generateUniqueCodeBarre(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }

    private function generateUniqueCodeBarre()
    {
        do {
            $codeBarre = mt_rand(10000000, 99999999);
        } while (User::where('code_barre', $codeBarre)->exists());

        return $codeBarre;
    }
}