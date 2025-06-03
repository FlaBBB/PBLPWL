<?php

namespace Database\Seeders;

use App\Models\RoleSupervisor;
use Database\Factories\RoleSupervisorFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $descriptions = [
            'Melakukan pembinaan kegiatan mahasiswa di bidang akademik (PA) dan kemahasiswaan (BEM, Maperwa, dan lain-lain)',
            'Membimbing mahasiswa menghasilkan produk saintifik bereputasi dan mendapat pengakuan tingkat Internasional',
            'Membimbing mahasiswa menghasilkan produk saintifik bereputasi dan mendapat pengakuan tingkat Nasional',
            'Membimbing mahasiswa mengikuti kompetisi dibidang akademik dan kemahasiswaan bereputasi dan mencapai juara tingkat Internasional',
            'Membimbing mahasiswa mengikuti kompetisi dibidang akademik dan kemahasiswaan bereputasi dan mencapai juara tingkat Nasional',
        ];

        foreach ($descriptions as $description) {
            RoleSupervisor::create([
                'description' => $description,
            ]);
        }
    }
}
