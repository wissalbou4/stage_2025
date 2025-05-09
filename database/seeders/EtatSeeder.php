<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Etat;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $etats = [
            ['etat' => 'en saisie', 'role' => 'operateur'],
            ['etat' => 'en ramassage', 'role' => 'ramasseur'],
            ['etat' => 'Contrôle', 'role' => 'controleur'],
            ['etat' => 'Caisse', 'role' => 'caissier'],
            ['etat' => 'expedition', 'role' => 'admin'],
            ['etat' => 'valider', 'role' => 'admin'],
            ['etat' => 'annuler', 'role' => 'admin']
        ];

        foreach ($etats as $etat) {
            Etat::firstOrCreate(
                ['role' => $etat['role']],
                $etat
            );
        }

        $this->command->info(count($etats) . ' états créés avec succès!');
    }
    
}
