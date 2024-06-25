<?php

namespace Database\Seeders;

use App\Models\Pays;
use App\Models\Recrutement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecrutementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recrutement::insert([
            ["libelle" => "Recrutement Front End", "poste_disponible" => 3],
            ["libelle" => "Recrutement Back End", "poste_disponible" => 10],
            ["libelle" => "Recrutement Full Stack", "poste_disponible" => 20],
        ]);
    }
}
