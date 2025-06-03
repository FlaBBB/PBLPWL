<?php

namespace Database\Seeders;

use App\Models\Tag;
use Database\Factories\TagFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'National Business Plan Competition',
            'IoT',
            'UI/UX',
            'Indie Game Ignite',
            'Capture The Flag (CTF)',
            'AI Innovation Challenge',
            'Hackathon Software Development',
            'Defender Keamanan Jaringan',
            'Smart Application',
            'Application Development Multimedia and Game',
            'Bisnis TIK',
            'Poster Infografis',
            'Pengembangan Aplikasi Permainan',
            'Sepak Bola',
            'Bola Basket',
            'Bulu Tangkis',
            'Tenis Meja',
            'Renang',
            'E-sports',
            'Catur',
            'Atletik',
            'Voli',
            'Futsal',
            'Seni',
            'Essay',
            'Karya Tulis Ilmiah',
            'Video Kreatif',
            'Robotik',
        ];

        foreach ($tags as $tagName) {
            Tag::create(['name' => $tagName]);
        }
    }
}
