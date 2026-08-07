<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyProgram;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prodis = [
            'S1 Teknik Informatika',
            'S1 Sistem Informasi',
            'S1 Desain Komunikasi',
            'S1 Akuntansi',
            'S1 Manajemen',
            'S1 Bisnis Digital',
            'S1 Pendidikan Kepelatihan Olahraga',
            'S1 Pendidikan Matematika',
            'D3 Manajemen Informatika',
            'D3 Manajemen Bisnis',
            'D3 Manajemen',
        ];

        foreach ($prodis as $prodi) {
            StudyProgram::updateOrCreate(['name' => $prodi]);
        }
    }
}
