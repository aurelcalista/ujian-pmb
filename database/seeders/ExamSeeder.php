<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample questions logic: Hanya 1 ujian utama (Default Umum)
        $this->seedDefaultExam();
    }

    private function seedDefaultExam()
    {
        $exam = \App\Models\Exam::create([
            'title' => 'Ujian Umum PMB (Default)',
            'description' => 'Soal Tes Potensi Akademik Umum',
            'start_time' => now(),
            'end_time' => now()->addDays(30),
            'duration' => 90,
            'study_program_id' => null,
            'status' => 'active',
        ]);

        $this->createSampleQuestions($exam->id, 'Umum');
    }

    private function seedProdiExam($prodi)
    {
        $exam = \App\Models\Exam::create([
            'title' => 'Ujian Masuk - ' . $prodi->name,
            'description' => 'Soal Khusus ' . $prodi->name,
            'start_time' => now(),
            'end_time' => now()->addDays(30),
            'duration' => 60,
            'study_program_id' => $prodi->id,
            'status' => 'active',
        ]);

        $this->createSampleQuestions($exam->id, $prodi->name);
    }

    private function createSampleQuestions($examId, $topic)
    {
        $questions = [];
        $topicLower = strtolower($topic);

        if (str_contains($topicLower, 'informatika') || str_contains($topicLower, 'komputer')) {
            $questions = [
                [
                    'text' => "Manakah dari berikut ini yang merupakan bahasa pemrograman untuk pengembangan web front-end?",
                    'image' => 'questions/dummy.png',
                    'options' => ['HTML/CSS', 'Python', 'C++', 'Java'],
                    'correct' => 0
                ],
                [
                    'text' => "Apa kepanjangan dari SQL?",
                    'image' => null,
                    'options' => ['Structured Query Language', 'Strong Question Language', 'Standard Query Logic', 'System Query Language'],
                    'correct' => 0
                ],
                [
                    'text' => "Dalam konsep OOP, kemampuan suatu class turunan untuk memodifikasi metode dari class induk disebut?",
                    'image' => null,
                    'options' => ['Polymorphism', 'Encapsulation', 'Inheritance', 'Abstraction'],
                    'correct' => 0
                ]
            ];
        } elseif (str_contains($topicLower, 'informasi')) {
            $questions = [
                [
                    'text' => "Fokus utama dari Sistem Informasi dalam sebuah perusahaan adalah?",
                    'image' => 'questions/dummy.png',
                    'options' => ['Mendukung proses bisnis dan pengambilan keputusan', 'Hanya untuk membuat website', 'Memperbaiki perangkat keras komputer', 'Menghitung pajak perusahaan'],
                    'correct' => 0
                ],
                [
                    'text' => "Diagram yang digunakan untuk menggambarkan alur kerja (workflow) adalah?",
                    'image' => null,
                    'options' => ['Flowchart', 'Use Case Diagram', 'Class Diagram', 'ERD'],
                    'correct' => 0
                ],
                [
                    'text' => "Manakah yang BUKAN merupakan komponen utama Sistem Informasi?",
                    'image' => null,
                    'options' => ['Cuaca', 'Perangkat Keras (Hardware)', 'Perangkat Lunak (Software)', 'Manusia (Brainware)'],
                    'correct' => 0
                ]
            ];
        } elseif (str_contains($topicLower, 'desain') || str_contains($topicLower, 'visual') || str_contains($topicLower, 'dkv')) {
            $questions = [
                [
                    'text' => "Warna apa yang dihasilkan dari campuran merah dan kuning?",
                    'image' => 'questions/dummy.png',
                    'options' => ['Oranye', 'Hijau', 'Ungu', 'Cokelat'],
                    'correct' => 0
                ],
                [
                    'text' => "Software standar industri yang sering digunakan untuk desain vektor adalah?",
                    'image' => null,
                    'options' => ['Adobe Illustrator', 'Microsoft Word', 'Adobe Premiere Pro', 'Notepad'],
                    'correct' => 0
                ],
                [
                    'text' => "Prinsip desain yang mengatur keseimbangan letak elemen visual disebut?",
                    'image' => null,
                    'options' => ['Balance', 'Contrast', 'Alignment', 'Repetition'],
                    'correct' => 0
                ]
            ];
        } elseif (str_contains($topicLower, 'manajemen') || str_contains($topicLower, 'akuntansi') || str_contains($topicLower, 'bisnis')) {
            $questions = [
                [
                    'text' => "Rumus dasar persamaan akuntansi adalah?",
                    'image' => 'questions/dummy.png',
                    'options' => ['Aset = Kewajiban + Ekuitas', 'Aset = Kewajiban - Ekuitas', 'Pendapatan = Beban + Laba', 'Kewajiban = Aset + Ekuitas'],
                    'correct' => 0
                ],
                [
                    'text' => "Fungsi manajemen yang berkaitan dengan pembagian tugas dan wewenang disebut?",
                    'image' => null,
                    'options' => ['Organizing', 'Planning', 'Actuating', 'Controlling'],
                    'correct' => 0
                ],
                [
                    'text' => "Laporan yang menunjukkan posisi keuangan perusahaan pada saat tertentu adalah?",
                    'image' => null,
                    'options' => ['Neraca (Balance Sheet)', 'Laporan Laba Rugi', 'Laporan Arus Kas', 'Jurnal Umum'],
                    'correct' => 0
                ]
            ];
        } elseif (str_contains($topicLower, 'olahraga')) {
            $questions = [
                [
                    'text' => "Latihan beban (weight training) terutama bertujuan untuk meningkatkan?",
                    'image' => 'questions/dummy.png',
                    'options' => ['Kekuatan otot', 'Kelenturan tubuh', 'Kecepatan berlari', 'Keseimbangan'],
                    'correct' => 0
                ],
                [
                    'text' => "Dalam pertandingan sepak bola, berapakah jumlah pemain utama di lapangan untuk satu tim?",
                    'image' => null,
                    'options' => ['11 orang', '5 orang', '10 orang', '12 orang'],
                    'correct' => 0
                ],
                [
                    'text' => "Faktor penting dalam menyusun program latihan fisik adalah?",
                    'image' => null,
                    'options' => ['Frekuensi, Intensitas, Waktu, Tipe (FITT)', 'Makan banyak sebelum tidur', 'Berhenti latihan jika pegal', 'Tidur kurang dari 4 jam'],
                    'correct' => 0
                ]
            ];
        } elseif (str_contains($topicLower, 'matematika')) {
            $questions = [
                [
                    'text' => "Turunan pertama dari f(x) = 3x^2 + 5x - 2 adalah?",
                    'image' => 'questions/dummy.png',
                    'options' => ['f\'(x) = 6x + 5', 'f\'(x) = 6x - 2', 'f\'(x) = 3x + 5', 'f\'(x) = x^2 + 5'],
                    'correct' => 0
                ],
                [
                    'text' => "Berapakah nilai dari log basis 10 dari 1000?",
                    'image' => null,
                    'options' => ['3', '10', '100', '2'],
                    'correct' => 0
                ],
                [
                    'text' => "Sebuah segitiga siku-siku memiliki alas 3 cm dan tinggi 4 cm. Berapakah panjang sisi miringnya?",
                    'image' => null,
                    'options' => ['5 cm', '7 cm', '6 cm', '8 cm'],
                    'correct' => 0
                ]
            ];
        } else {
            // Default Umum
            $questions = [
                [
                    'text' => "Siapakah presiden pertama Republik Indonesia?",
                    'image' => 'questions/dummy.png',
                    'options' => ['Soekarno', 'B.J. Habibie', 'Soeharto', 'Megawati'],
                    'correct' => 0
                ],
                [
                    'text' => "Berapakah hasil dari 15 + 25 x 2?",
                    'image' => null,
                    'options' => ['65', '80', '40', '50'],
                    'correct' => 0
                ],
                [
                    'text' => "Sinonim dari kata 'Eksklusif' adalah?",
                    'image' => null,
                    'options' => ['Istimewa', 'Umum', 'Terbuka', 'Biasa'],
                    'correct' => 0
                ]
            ];
        }

        foreach ($questions as $q) {
            $question = \App\Models\Question::create([
                'exam_id' => $examId,
                'question_text' => $q['text'],
                'image' => $q['image'],
                'weight' => 2.0,
            ]);

            foreach ($q['options'] as $idx => $optText) {
                \App\Models\QuestionOption::create([
                    'question_id' => $question->id,
                    'option_text' => $optText,
                    'is_correct' => ($idx === $q['correct']),
                ]);
            }
        }
    }
}
