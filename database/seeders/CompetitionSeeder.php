<?php

namespace Database\Seeders;

use Database\Factories\CompetitionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competitions = [
            'Nusantara Writing Festival 3',
            'POMPROV 2025',
            'POMNAS 2025',
            'Lomba Karya Tulis Ilmiah Nasional (LKTIN) SPEAR MSC',
            'Lomba Karya Tulis Ilmiah IKAB-KIP National Scientific Writing and Youth Competition (INSIGHT).',
            'Lomba EEJ (Eltech Epoch Jember) 2024',
            'FS2T Research and Innovation Challenge (FRIC) tingkat Nasional',
            'National Tourism Vocational Skills Competitions (NTVSC)',
            'Lomba Video Kreatif Nasional pada Midwifery Competition',
            'KRI (Kontes Robot Indonesia)',
            'PORSENI',
            'Pekan HIMAKOM ZENITH UGO UMKM GO DIGITAL',
            'Multimedia and game event (MAGE) X Tingkat Nasional',
            'Infographic Competition IPB Mathematics Challenge',
            'Information Technology Creative Competition (ITCC)',
            'PlayIT Polinema',
            'Indonesian Polytechnic English Championship',
            'Research and Innovation Challenge (FRIC) tingkat Nasional 2024',
            'COMPFEST UI ke 16 tahun 2024',
            'GEMASTIK XVII',
            'Kompetisi Mahasiswa bidang Informatika Politeknik Nasional VI 2024',
            'Olimpiade Vokasi Indonesia',
            'Event 9 (MAGE 9)',
            '4C National Competition 2023',
        ];

        foreach ($competitions as $competitionName) {
            CompetitionFactory::new()->create([
                'name' => $competitionName
            ]);
        }
    }
}
