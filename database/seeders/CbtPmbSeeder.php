<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CbtPmbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Admin Account
        Admin::updateOrCreate(
            ['email' => 'admin@cic.ac.id'],
            [
                'name' => 'PMB Administrator',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Create 1 PMB Exam
        $exam = Exam::updateOrCreate(
            ['title' => 'Ujian CBT Seleksi PMB UCIC 2026/2027'],
            [
                'description' => 'Tes Potensi Akademik, Logika Penalaran, dan Bahasa Inggris untuk Calon Mahasiswa Baru Universitas Catur Insan Cendekia.',
                'start_time' => now()->subDay(),
                'end_time' => now()->addDays(30),
                'duration' => 90,
                'shuffle_questions' => true,
                'shuffle_options' => true,
                'fullscreen_enabled' => true,
                'autosave_enabled' => true,
                'anti_cheat_enabled' => true,
                'max_violation' => 3,
                'status' => 'active',
            ]
        );

        // 3. Create 10 Multiple Choice Questions
        $questionsData = [
            [
                'question' => 'Manakah di antara pernyataan berikut yang paling tepat mengenai prinsip dasar pengembangan sistem informasi berbasis jaringan komputer di lingkungan perguruan tinggi?',
                'options' => [
                    ['text' => 'Mengutamakan skabilitas, keamanan data, dan integrasi antar layanan secara berkesinambungan.', 'is_correct' => true],
                    ['text' => 'Membatasi akses seluruh mahasiswa agar data tidak dapat diakses sama sekali secara publik.', 'is_correct' => false],
                    ['text' => 'Menggunakan perangkat keras dengan spesifikasi paling sederhana tanpa backup data berkala.', 'is_correct' => false],
                    ['text' => 'Menghilangkan peran server pusat dan menggantikannya secara manual di setiap departemen.', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Choose the correct sentence that uses the Present Perfect Continuous tense correctly:',
                'options' => [
                    ['text' => 'They have been studying for the exam since two hours ago.', 'is_correct' => false],
                    ['text' => 'They have been studying for the exam for two hours.', 'is_correct' => true],
                    ['text' => 'They were studying for the exam since two hours.', 'is_correct' => false],
                    ['text' => 'They are studying for the exam since two hours ago.', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Jika 5 buah mesin cetak dapat menyelesaikan 1000 lembar brosur dalam waktu 40 menit, berapa waktu yang dibutuhkan oleh 8 mesin cetak dengan kecepatan sama untuk menyelesaikan 1600 lembar brosur?',
                'options' => [
                    ['text' => '30 menit', 'is_correct' => false],
                    ['text' => '40 menit', 'is_correct' => true],
                    ['text' => '45 menit', 'is_correct' => false],
                    ['text' => '50 menit', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Manakah pasangan kata berikut yang memiliki hubungan analogi paling setara dengan "ALPROG : PEMROGRAMAN"?',
                'options' => [
                    ['text' => 'KAMPUS : GEDUNG', 'is_correct' => false],
                    ['text' => 'ALGORITMA : LOGIKA', 'is_correct' => true],
                    ['text' => 'BUNYA : DAUN', 'is_correct' => false],
                    ['text' => 'KOMPUTER : LISTRIK', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Suatu deret angka memiliki pola: 3, 7, 15, 31, 63, ... Angka berikutnya dalam deret tersebut adalah:',
                'options' => [
                    ['text' => '127', 'is_correct' => true],
                    ['text' => '126', 'is_correct' => false],
                    ['text' => '128', 'is_correct' => false],
                    ['text' => '125', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Read the sentence: "Despite facing various challenges, the team managed to complete the project on schedule." What is the synonym of "managed"?',
                'options' => [
                    ['text' => 'Failed', 'is_correct' => false],
                    ['text' => 'Succeeded', 'is_correct' => true],
                    ['text' => 'Delayed', 'is_correct' => false],
                    ['text' => 'Postponed', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Komponen utama dalam arsitektur komputer Von Neumann yang bertugas melakukan operasi aritmatika dan logika adalah:',
                'options' => [
                    ['text' => 'Control Unit (CU)', 'is_correct' => false],
                    ['text' => 'Arithmetic Logic Unit (ALU)', 'is_correct' => true],
                    ['text' => 'RAM (Random Access Memory)', 'is_correct' => false],
                    ['text' => 'Hard Disk Drive (HDD)', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Semua mahasiswa UCIC disiplin dan rajin. Budi adalah mahasiswa UCIC yang mengambil program studi Teknik Informatika. Kesimpulan yang tepat adalah:',
                'options' => [
                    ['text' => 'Budi tidak selalu disiplin saat kuliah.', 'is_correct' => false],
                    ['text' => 'Budi disiplin dan rajin.', 'is_correct' => true],
                    ['text' => 'Budi hanya rajin di matakuliah Teknik Informatika.', 'is_correct' => false],
                    ['text' => 'Mahasiswa selain Budi tidak disiplin.', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Protokol standar yang digunakan untuk mengirimkan data halaman web secara aman dengan enkripsi SSL/TLS adalah:',
                'options' => [
                    ['text' => 'HTTP', 'is_correct' => false],
                    ['text' => 'HTTPS', 'is_correct' => true],
                    ['text' => 'FTP', 'is_correct' => false],
                    ['text' => 'SMTP', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Jika x = 4 dan y = 3, berapa nilai dari persamaan (2x^2 + 3y) / (x + y)?',
                'options' => [
                    ['text' => '5.85', 'is_correct' => false],
                    ['text' => '5.86', 'is_correct' => false],
                    ['text' => '5.857 (atau mendekati 5.86)', 'is_correct' => true],
                    ['text' => '6.00', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questionsData as $qIndex => $qData) {
            $question = Question::create([
                'exam_id' => $exam->id,
                'question_text' => $qData['question'],
                'weight' => 2.00,
            ]);

            foreach ($qData['options'] as $optData) {
                QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optData['text'],
                    'is_correct' => $optData['is_correct'],
                ]);
            }
        }
    }
}
