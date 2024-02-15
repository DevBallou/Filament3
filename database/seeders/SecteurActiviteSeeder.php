<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecteurActiviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scteurs = [
            ['name' => 'CALL CENTER'],
            ['name' => 'SECTEUR PHARMA'],
            ['name' => 'AERONAUTIQUE / AEROPOLE'],
            ['name' => 'MIX SECTEUR '],
            ['name' => 'MIX PFT /GRANDE DIST'],
            ['name' => 'MIX PFT/ AGRO '],
            ['name' => 'ZONE BOUSKOURA'],
            ['name' => 'AERONAUTIQUE / BERRECHID  '],
            ['name' => 'AERONAUTIQUE / SAPINO'],
            ['name' => 'AERONAUTIQUE / MIDPARC'],
            ['name' => 'MIX PFT /GRANDE DIST'],
            ['name' => 'MIX PFT / AUTO'],
            ['name' => 'AERONAUTIQUE /RAM '],
            ['name' => 'COMPTE SOTREG '],
            ['name' => 'STCR'],
        ];
        DB::table('secteur_activites')->insert($scteurs);
    }
}
