<?php

namespace Database\Seeders;

use App\Models\Pays;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pays::insert([
            ["libelle" => "Cote d'ivoire"],
            ["libelle" => "Cameroun"],
            ["libelle" => "Ghana"],
            ["libelle" => "Benin"],
            ["libelle" => "Togo"],
        ]);
    }
}
