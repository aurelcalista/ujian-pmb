<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CbtPmbSeeder extends Seeder
{
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

        // 2. Delete existing questions and options to start fresh
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        QuestionOption::truncate();
        Question::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 3. Create 1 PMB Exam
        $exam = Exam::updateOrCreate(
            ['title' => 'Ujian CBT Seleksi PMB UCIC 2026/2027'],
            [
                'description' => 'Tes Potensi Akademik, Logika Penalaran, dan Bahasa Inggris untuk Calon Mahasiswa Baru Universitas Catur Insan Cendekia.',
                'start_time' => now()->subDay(),
                'end_time' => now()->addDays(30),
                'duration' => 150, // Updated to 150 based on the instruction earlier
                'shuffle_questions' => true,
                'shuffle_options' => true,
                'fullscreen_enabled' => true,
                'autosave_enabled' => true,
                'anti_cheat_enabled' => true,
                'max_violation' => 3,
                'status' => 'active',
            ]
        );

        // 4. Create 60 Questions
        $questionsData = [
            [
                'question' => 'PADI : BERAS = ... : ...',
                'options' => [
                    ['text' => 'Kapas : Benang', 'is_correct' => true],
                    ['text' => 'Kayu : Meja', 'is_correct' => false],
                    ['text' => 'Susu : Sapi', 'is_correct' => false],
                    ['text' => 'Kertas : Pohon', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'DOKTER : PASIEN = GURU : ...',
                'options' => [
                    ['text' => 'Sekolah', 'is_correct' => false],
                    ['text' => 'Murid', 'is_correct' => true],
                    ['text' => 'Buku', 'is_correct' => false],
                    ['text' => 'Kelas', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Kata "BIJAKSANA" memiliki makna yang sama dengan...',
                'options' => [
                    ['text' => 'Ceroboh', 'is_correct' => false],
                    ['text' => 'Arif', 'is_correct' => true],
                    ['text' => 'Sombong', 'is_correct' => false],
                    ['text' => 'Pemarah', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Kata "EFEKTIF" memiliki makna yang sama dengan...',
                'options' => [
                    ['text' => 'Boros', 'is_correct' => false],
                    ['text' => 'Tepat guna', 'is_correct' => true],
                    ['text' => 'Rumit', 'is_correct' => false],
                    ['text' => 'Lambat', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Lawan kata dari "OPTIMIS" adalah...',
                'options' => [
                    ['text' => 'Percaya diri', 'is_correct' => false],
                    ['text' => 'Pesimis', 'is_correct' => true],
                    ['text' => 'Realistis', 'is_correct' => false],
                    ['text' => 'Antusias', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Lawan kata dari "KONSISTEN" adalah...',
                'options' => [
                    ['text' => 'Stabil', 'is_correct' => false],
                    ['text' => 'Berubah-ubah', 'is_correct' => true],
                    ['text' => 'Tetap', 'is_correct' => false],
                    ['text' => 'Teratur', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Belajar secara konsisten setiap hari, meskipun hanya sebentar, terbukti lebih efektif dibandingkan belajar dalam waktu lama namun tidak teratur. Hal ini karena otak membutuhkan waktu untuk memproses dan menyimpan informasi ke dalam memori jangka panjang.
Ide pokok paragraf di atas adalah...',
                'options' => [
                    ['text' => 'Belajar lama lebih baik daripada belajar sebentar', 'is_correct' => false],
                    ['text' => 'Konsistensi belajar lebih efektif daripada belajar tidak teratur', 'is_correct' => true],
                    ['text' => 'Otak manusia sulit menyimpan informasi', 'is_correct' => false],
                    ['text' => 'Belajar setiap hari membuang waktu', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Berdasarkan paragraf berikut:
"Belajar secara konsisten setiap hari, meskipun hanya sebentar, terbukti lebih efektif dibandingkan belajar dalam waktu lama namun tidak teratur. Hal ini karena otak membutuhkan waktu untuk memproses dan menyimpan informasi ke dalam memori jangka panjang."
Alasan belajar konsisten lebih efektif adalah...',
                'options' => [
                    ['text' => 'Otak membutuhkan waktu memproses dan menyimpan informasi ke memori jangka panjang', 'is_correct' => true],
                    ['text' => 'Belajar lama membuat otak lelah', 'is_correct' => false],
                    ['text' => 'Guru menyarankan cara tersebut', 'is_correct' => false],
                    ['text' => 'Belajar sebentar tidak membutuhkan usaha', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Semua mahasiswa penerima KIP Kuliah wajib menjaga IPK minimal 3,00. Andi adalah penerima KIP Kuliah. Kesimpulan yang tepat adalah...',
                'options' => [
                    ['text' => 'Andi tidak wajib menjaga IPK', 'is_correct' => false],
                    ['text' => 'Andi wajib menjaga IPK minimal 3,00', 'is_correct' => true],
                    ['text' => 'Andi memiliki IPK di bawah 3,00', 'is_correct' => false],
                    ['text' => 'Andi bukan mahasiswa', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Jika hujan turun, maka jalan menjadi basah. Kenyataannya jalan tidak basah. Kesimpulan yang tepat adalah...',
                'options' => [
                    ['text' => 'Hujan turun', 'is_correct' => false],
                    ['text' => 'Hujan tidak turun', 'is_correct' => true],
                    ['text' => 'Jalan akan basah', 'is_correct' => false],
                    ['text' => 'Tidak dapat disimpulkan', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa mendapat beasiswa yang menanggung 80% biaya kuliah sebesar Rp5.000.000 per semester. Berapa yang harus ia bayar sendiri?',
                'options' => [
                    ['text' => 'Rp1.000.000', 'is_correct' => true],
                    ['text' => 'Rp800.000', 'is_correct' => false],
                    ['text' => 'Rp1.200.000', 'is_correct' => false],
                    ['text' => 'Rp1.500.000', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Nilai ujian seorang siswa naik dari 70 menjadi 84. Berapa persen kenaikan nilainya?',
                'options' => [
                    ['text' => '14%', 'is_correct' => false],
                    ['text' => '16%', 'is_correct' => false],
                    ['text' => '20%', 'is_correct' => true],
                    ['text' => '24%', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Perbandingan jumlah mahasiswa laki-laki dan perempuan penerima KIP Kuliah di sebuah kampus adalah 3:5. Jika total penerima 160 orang, jumlah mahasiswa perempuan adalah...',
                'options' => [
                    ['text' => '60 orang', 'is_correct' => false],
                    ['text' => '80 orang', 'is_correct' => false],
                    ['text' => '100 orang', 'is_correct' => true],
                    ['text' => '120 orang', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Sebuah larutan dibuat dengan perbandingan air dan gula 4:1. Jika digunakan 500 ml air, gula yang dibutuhkan adalah...',
                'options' => [
                    ['text' => '100 ml', 'is_correct' => false],
                    ['text' => '125 ml', 'is_correct' => true],
                    ['text' => '150 ml', 'is_correct' => false],
                    ['text' => '200 ml', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Perhatikan pola bilangan berikut: 2, 6, 12, 20, 30, ... Angka selanjutnya adalah...',
                'options' => [
                    ['text' => '40', 'is_correct' => false],
                    ['text' => '42', 'is_correct' => true],
                    ['text' => '44', 'is_correct' => false],
                    ['text' => '36', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Perhatikan pola bilangan berikut: 3, 5, 9, 15, 23, ... Angka selanjutnya adalah...',
                'options' => [
                    ['text' => '30', 'is_correct' => false],
                    ['text' => '31', 'is_correct' => false],
                    ['text' => '33', 'is_correct' => true],
                    ['text' => '35', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Untuk menyelesaikan sebuah proyek, 4 orang membutuhkan waktu 12 hari. Jika dikerjakan oleh 6 orang dengan kecepatan kerja yang sama, waktu yang dibutuhkan adalah...',
                'options' => [
                    ['text' => '6 hari', 'is_correct' => false],
                    ['text' => '8 hari', 'is_correct' => true],
                    ['text' => '9 hari', 'is_correct' => false],
                    ['text' => '10 hari', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Harga 3 buku adalah Rp45.000. Berapa harga 7 buku dengan harga satuan yang sama?',
                'options' => [
                    ['text' => 'Rp95.000', 'is_correct' => false],
                    ['text' => 'Rp100.000', 'is_correct' => false],
                    ['text' => 'Rp105.000', 'is_correct' => true],
                    ['text' => 'Rp110.000', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Jumlah penerima KIP Kuliah di sebuah kampus: 2021 = 120 orang, 2022 = 150 orang, 2023 = 180 orang, 2024 = 200 orang. Rata-rata pertambahan penerima per tahun adalah...',
                'options' => [
                    ['text' => '20 orang', 'is_correct' => false],
                    ['text' => '26,7 orang', 'is_correct' => true],
                    ['text' => '30 orang', 'is_correct' => false],
                    ['text' => '40 orang', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Berdasarkan data pada soal nomor 19, persentase kenaikan jumlah penerima dari tahun 2023 ke 2024 adalah...',
                'options' => [
                    ['text' => '10,5%', 'is_correct' => false],
                    ['text' => '11,1%', 'is_correct' => true],
                    ['text' => '12,5%', 'is_correct' => false],
                    ['text' => '15%', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa penerima KIP Kuliah mengalami penurunan IPK karena bekerja paruh waktu untuk membantu orang tua. Tindakan paling tepat yang sebaiknya ia lakukan adalah...',
                'options' => [
                    ['text' => 'Berhenti kuliah dan fokus bekerja', 'is_correct' => false],
                    ['text' => 'Mengatur ulang jadwal dan berkonsultasi dengan dosen pembimbing akademik', 'is_correct' => true],
                    ['text' => 'Membiarkan IPK turun karena keadaan ekonomi', 'is_correct' => false],
                    ['text' => 'Meminta teman mengerjakan tugasnya', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Dua mahasiswa mengerjakan tugas kelompok. Salah satu jarang berkontribusi namun mendapat nilai yang sama. Sikap paling tepat dari mahasiswa yang aktif adalah...',
                'options' => [
                    ['text' => 'Diam saja agar tidak berkonflik', 'is_correct' => false],
                    ['text' => 'Membicarakan masalah tersebut secara terbuka dengan anggota kelompok, dan ke dosen bila perlu', 'is_correct' => true],
                    ['text' => 'Ikut tidak mengerjakan tugas sebagai balasan', 'is_correct' => false],
                    ['text' => 'Melaporkan tanpa berdiskusi terlebih dahulu', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Ani jarang mengikuti kelas karena harus menjaga adiknya di rumah. Akibat yang paling mungkin terjadi adalah...',
                'options' => [
                    ['text' => 'Nilai Ani meningkat', 'is_correct' => false],
                    ['text' => 'Pemahaman materi Ani menjadi tertinggal', 'is_correct' => true],
                    ['text' => 'Ani menjadi lebih disiplin', 'is_correct' => false],
                    ['text' => 'Tidak ada dampak apa pun', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Kenaikan harga kebutuhan pokok menyebabkan sebagian keluarga kurang mampu kesulitan membiayai pendidikan anak. Program KIP Kuliah dibuat sebagai...',
                'options' => [
                    ['text' => 'Penyebab masalah tersebut', 'is_correct' => false],
                    ['text' => 'Solusi untuk mengurangi dampak masalah tersebut', 'is_correct' => true],
                    ['text' => 'Akibat dari masalah tersebut', 'is_correct' => false],
                    ['text' => 'Hal yang tidak berkaitan', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Sebuah kampus mencatat bahwa 70% mahasiswa yang aktif berorganisasi memiliki IPK di atas 3,25, sedangkan mahasiswa yang pasif berorganisasi mayoritas memiliki IPK di bawah 3,00. Kesimpulan paling tepat berdasarkan data ini adalah...',
                'options' => [
                    ['text' => 'Berorganisasi pasti menyebabkan IPK tinggi', 'is_correct' => false],
                    ['text' => 'Ada kecenderungan hubungan antara keaktifan organisasi dan IPK, namun bukan berarti hubungan sebab-akibat mutlak', 'is_correct' => true],
                    ['text' => 'Mahasiswa harus berhenti kuliah agar bisa berorganisasi', 'is_correct' => false],
                    ['text' => 'Organisasi tidak ada hubungannya dengan akademik', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Dalam sebuah survei, 60% responden menyatakan lebih suka belajar pada malam hari. Apakah kesimpulan "semua orang belajar lebih baik pada malam hari" tepat?',
                'options' => [
                    ['text' => 'Tepat, karena mayoritas menyatakan demikian', 'is_correct' => false],
                    ['text' => 'Tidak tepat, karena data hanya menunjukkan preferensi, bukan bukti efektivitas belajar', 'is_correct' => true],
                    ['text' => 'Tepat, karena survei adalah bukti ilmiah mutlak', 'is_correct' => false],
                    ['text' => 'Tidak relevan untuk dibahas', 'is_correct' => false],
                ],
            ],
            [
                'question' => '"Karena rajin belajar, Budi pasti akan lulus dengan nilai terbaik." Asumsi yang mendasari pernyataan tersebut adalah...',
                'options' => [
                    ['text' => 'Kerajinan belajar selalu menjamin hasil terbaik', 'is_correct' => true],
                    ['text' => 'Budi memiliki fasilitas belajar yang lengkap', 'is_correct' => false],
                    ['text' => 'Nilai terbaik ditentukan oleh dosen', 'is_correct' => false],
                    ['text' => 'Budi tidak pernah gagal sebelumnya', 'is_correct' => false],
                ],
            ],
            [
                'question' => '"Karena berasal dari keluarga kurang mampu, mahasiswa tersebut pasti kurang mampu secara akademik." Pernyataan ini mengandung asumsi yang keliru karena...',
                'options' => [
                    ['text' => 'Keluarga kurang mampu selalu memiliki anak yang pintar', 'is_correct' => false],
                    ['text' => 'Kemampuan ekonomi tidak menentukan kemampuan akademik seseorang', 'is_correct' => true],
                    ['text' => 'Semua mahasiswa KIP Kuliah pasti berprestasi', 'is_correct' => false],
                    ['text' => 'Pernyataan tersebut sudah benar dan tidak keliru', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa memiliki dua pilihan: mengikuti kegiatan organisasi yang berguna untuk pengalaman, atau fokus penuh pada nilai akademik yang sedang menurun. Keputusan paling bijak adalah...',
                'options' => [
                    ['text' => 'Memilih salah satu secara ekstrem tanpa evaluasi', 'is_correct' => false],
                    ['text' => 'Mengevaluasi prioritas, memperbaiki nilai akademik lebih dulu, lalu mengatur waktu untuk organisasi secara terbatas', 'is_correct' => true],
                    ['text' => 'Mengikuti organisasi penuh dan mengabaikan akademik', 'is_correct' => false],
                    ['text' => 'Berhenti dari kedua kegiatan', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Mahasiswa penerima KIP Kuliah ditawari pekerjaan sampingan dengan gaji besar namun jam kerja bentrok dengan jadwal kuliah wajib. Keputusan yang paling tepat adalah...',
                'options' => [
                    ['text' => 'Menerima pekerjaan dan meninggalkan kelas', 'is_correct' => false],
                    ['text' => 'Menolak, atau mencari kesepakatan jam kerja yang tidak mengganggu kewajiban akademik', 'is_correct' => true],
                    ['text' => 'Meminta teman mengisi absensi', 'is_correct' => false],
                    ['text' => 'Mengabaikan kewajiban kuliah demi uang', 'is_correct' => false],
                ],
            ],
            [
                'question' => '"Semua mahasiswa penerima beasiswa pasti berasal dari keluarga miskin, karena beasiswa hanya untuk yang tidak mampu." Kelemahan argumen ini adalah...',
                'options' => [
                    ['text' => 'Argumen ini benar sepenuhnya', 'is_correct' => false],
                    ['text' => 'Generalisasi berlebihan karena ada berbagai jenis beasiswa dengan syarat berbeda-beda', 'is_correct' => true],
                    ['text' => 'Semua beasiswa memang khusus untuk keluarga miskin', 'is_correct' => false],
                    ['text' => 'Argumen ini tidak dapat dievaluasi', 'is_correct' => false],
                ],
            ],
            [
                'question' => '"Nilai akademik adalah satu-satunya penentu kesuksesan seseorang." Argumen ini paling tepat dinilai sebagai...',
                'options' => [
                    ['text' => 'Benar karena nilai menentukan segalanya', 'is_correct' => false],
                    ['text' => 'Kurang tepat, karena kesuksesan dipengaruhi banyak faktor selain nilai akademik', 'is_correct' => true],
                    ['text' => 'Tidak relevan untuk dibahas', 'is_correct' => false],
                    ['text' => 'Selalu terbukti secara ilmiah', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang teman berkata, "Tidak perlu membaca petunjuk soal, langsung saja kerjakan." Bagaimana sikap kritis yang tepat terhadap saran ini?',
                'options' => [
                    ['text' => 'Langsung menerima saran tersebut', 'is_correct' => false],
                    ['text' => 'Mengevaluasi risikonya dan tetap membaca petunjuk agar tidak salah memahami soal', 'is_correct' => true],
                    ['text' => 'Mengikuti saran karena teman lebih berpengalaman', 'is_correct' => false],
                    ['text' => 'Mengabaikan soal sepenuhnya', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa kesulitan memahami mata kuliah tertentu meski sudah belajar sendiri. Solusi paling tepat adalah...',
                'options' => [
                    ['text' => 'Berhenti mengikuti mata kuliah tersebut', 'is_correct' => false],
                    ['text' => 'Mencari bantuan tambahan seperti bertanya ke dosen, kelompok belajar, atau tutor sebaya', 'is_correct' => true],
                    ['text' => 'Menyalin jawaban teman saat ujian', 'is_correct' => false],
                    ['text' => 'Mengabaikan mata kuliah tersebut hingga akhir semester', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Sinyal internet di rumah mahasiswa penerima KIP Kuliah sering terputus saat kuliah daring. Solusi paling realistis adalah...',
                'options' => [
                    ['text' => 'Berhenti kuliah karena keterbatasan fasilitas', 'is_correct' => false],
                    ['text' => 'Mencari alternatif seperti fasilitas kampus, tempat dengan sinyal lebih baik, atau melapor ke pihak kampus', 'is_correct' => true],
                    ['text' => 'Tidak mengikuti kelas tanpa memberi kabar', 'is_correct' => false],
                    ['text' => 'Menyalahkan dosen atas gangguan sinyal', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Mahasiswa memiliki jadwal kuliah yang padat dan tugas menumpuk. Strategi paling efektif adalah...',
                'options' => [
                    ['text' => 'Mengerjakan semua tugas secara acak tanpa prioritas', 'is_correct' => false],
                    ['text' => 'Membuat skala prioritas berdasarkan tenggat waktu dan tingkat kesulitan', 'is_correct' => true],
                    ['text' => 'Menunda semua tugas hingga H-1', 'is_correct' => false],
                    ['text' => 'Meminta perpanjangan waktu untuk semua tugas tanpa alasan jelas', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Dalam sebuah pengumuman beasiswa tertulis: "Berkas dikumpulkan paling lambat 10 Agustus pukul 16.00 WIB melalui portal resmi, tidak menerima berkas susulan." Informasi paling penting yang harus diperhatikan mahasiswa adalah...',
                'options' => [
                    ['text' => 'Nama panitia seleksi', 'is_correct' => false],
                    ['text' => 'Batas waktu dan cara pengumpulan berkas', 'is_correct' => true],
                    ['text' => 'Jumlah total pendaftar', 'is_correct' => false],
                    ['text' => 'Sejarah program beasiswa', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Sebuah soal ujian menyajikan banyak data, namun hanya sebagian yang relevan untuk menjawab pertanyaan. Sikap kritis yang tepat adalah...',
                'options' => [
                    ['text' => 'Menggunakan semua data tanpa menyeleksi', 'is_correct' => false],
                    ['text' => 'Mengidentifikasi data yang relevan dengan pertanyaan sebelum menjawab', 'is_correct' => true],
                    ['text' => 'Mengabaikan seluruh data yang diberikan', 'is_correct' => false],
                    ['text' => 'Menjawab tanpa membaca data', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa memiliki keterbatasan biaya untuk membeli buku kuliah. Solusi paling tepat adalah...',
                'options' => [
                    ['text' => 'Tidak mengikuti mata kuliah tersebut', 'is_correct' => false],
                    ['text' => 'Memanfaatkan perpustakaan kampus, e-book resmi, atau meminjam dari senior', 'is_correct' => true],
                    ['text' => 'Berutang tanpa mempertimbangkan kemampuan membayar', 'is_correct' => false],
                    ['text' => 'Berhenti kuliah karena tidak mampu membeli buku', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Mahasiswa mendapati bahwa metode belajarnya selama ini tidak efektif meningkatkan pemahaman. Langkah paling tepat adalah...',
                'options' => [
                    ['text' => 'Tetap menggunakan metode yang sama tanpa evaluasi', 'is_correct' => false],
                    ['text' => 'Mengevaluasi metode belajar dan mencoba pendekatan lain yang lebih sesuai', 'is_correct' => true],
                    ['text' => 'Menyalahkan mata kuliah sebagai penyebabnya', 'is_correct' => false],
                    ['text' => 'Berhenti belajar sama sekali', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Saat mengerjakan tugas kuliah, seorang mahasiswa menemukan sebuah artikel daring tanpa nama penulis dan tanpa sumber rujukan yang jelas. Sikap paling tepat adalah...',
                'options' => [
                    ['text' => 'Langsung mengutip karena informasinya menarik', 'is_correct' => false],
                    ['text' => 'Memverifikasi informasi tersebut melalui sumber lain yang kredibel sebelum digunakan', 'is_correct' => true],
                    ['text' => 'Menggunakan artikel tersebut sebagai satu-satunya sumber', 'is_correct' => false],
                    ['text' => 'Mengabaikan tugas karena sulit mencari sumber', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Ketika mencari referensi ilmiah untuk tugas akhir, sumber yang paling dapat dipercaya untuk dikutip adalah...',
                'options' => [
                    ['text' => 'Blog pribadi tanpa identitas jelas', 'is_correct' => false],
                    ['text' => 'Jurnal ilmiah terakreditasi atau situs resmi lembaga terpercaya', 'is_correct' => true],
                    ['text' => 'Status media sosial teman', 'is_correct' => false],
                    ['text' => 'Forum diskusi anonim', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa menerima pesan berantai di grup WhatsApp berisi informasi kesehatan tanpa sumber jelas dan menggunakan bahasa provokatif. Tindakan paling tepat adalah...',
                'options' => [
                    ['text' => 'Langsung menyebarkan ke grup lain agar semua tahu', 'is_correct' => false],
                    ['text' => 'Memeriksa kebenaran informasi tersebut sebelum membagikannya', 'is_correct' => true],
                    ['text' => 'Mempercayai begitu saja karena dikirim oleh teman', 'is_correct' => false],
                    ['text' => 'Menghapus pesan tanpa memeriksa kebenarannya', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Ciri informasi yang patut dicurigai sebagai hoaks adalah...',
                'options' => [
                    ['text' => 'Berasal dari lembaga resmi dan memiliki data pendukung', 'is_correct' => false],
                    ['text' => 'Menggunakan judul provokatif berlebihan, tanpa sumber jelas, dan meminta segera disebarkan', 'is_correct' => true],
                    ['text' => 'Ditulis dengan bahasa yang netral dan berimbang', 'is_correct' => false],
                    ['text' => 'Mencantumkan tanggal dan penulis yang jelas', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Saat berdiskusi daring di forum kelas, seorang mahasiswa tidak setuju dengan pendapat temannya. Sikap yang mencerminkan etika digital yang baik adalah...',
                'options' => [
                    ['text' => 'Menyampaikan ketidaksetujuan dengan bahasa yang sopan dan disertai alasan', 'is_correct' => true],
                    ['text' => 'Menyerang secara pribadi teman tersebut di kolom komentar', 'is_correct' => false],
                    ['text' => 'Mengabaikan diskusi sepenuhnya', 'is_correct' => false],
                    ['text' => 'Menyebarkan tangkapan layar percakapan untuk mempermalukan teman', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Mengunggah foto atau video orang lain tanpa izin ke media sosial merupakan pelanggaran terhadap...',
                'options' => [
                    ['text' => 'Etika digital dan hak privasi orang lain', 'is_correct' => true],
                    ['text' => 'Kebebasan berekspresi yang sah', 'is_correct' => false],
                    ['text' => 'Hal yang wajar dilakukan di era digital', 'is_correct' => false],
                    ['text' => 'Ketentuan yang tidak perlu diperhatikan', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Untuk menjaga keamanan akun email dan portal akademik, tindakan yang paling tepat adalah...',
                'options' => [
                    ['text' => 'Menggunakan kata sandi yang sama untuk semua akun agar mudah diingat', 'is_correct' => false],
                    ['text' => 'Menggunakan kata sandi yang kuat dan berbeda untuk setiap akun serta mengaktifkan verifikasi dua langkah', 'is_correct' => true],
                    ['text' => 'Membagikan kata sandi kepada teman dekat', 'is_correct' => false],
                    ['text' => 'Menuliskan kata sandi di tempat umum agar tidak lupa', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Mahasiswa menerima email yang mengatasnamakan pihak kampus dan meminta mengklik tautan untuk "verifikasi akun beasiswa" secara mendesak. Tindakan paling tepat adalah...',
                'options' => [
                    ['text' => 'Langsung mengklik tautan karena terlihat resmi', 'is_correct' => false],
                    ['text' => 'Memeriksa keaslian email dan menghubungi pihak kampus secara langsung sebelum mengklik apa pun', 'is_correct' => true],
                    ['text' => 'Membalas email dengan data pribadi lengkap', 'is_correct' => false],
                    ['text' => 'Meneruskan email ke seluruh teman kelas', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Sebelum mengisi formulir daring yang meminta data pribadi seperti NIK dan nomor rekening, mahasiswa sebaiknya...',
                'options' => [
                    ['text' => 'Mengisi tanpa mempertimbangkan apa pun karena diminta oleh sistem', 'is_correct' => false],
                    ['text' => 'Memastikan situs tersebut resmi dan terpercaya serta memahami tujuan penggunaan data', 'is_correct' => true],
                    ['text' => 'Mengabaikan keamanan karena data pribadi tidak penting', 'is_correct' => false],
                    ['text' => 'Membagikan data tersebut ke media sosial agar transparan', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Membagikan data pribadi seperti NISN, alamat rumah, dan foto KTP secara terbuka di media sosial berisiko menyebabkan...',
                'options' => [
                    ['text' => 'Meningkatkan popularitas akun', 'is_correct' => false],
                    ['text' => 'Penyalahgunaan data oleh pihak yang tidak bertanggung jawab', 'is_correct' => true],
                    ['text' => 'Tidak berdampak apa pun', 'is_correct' => false],
                    ['text' => 'Mempercepat proses seleksi beasiswa', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Ketika menggunakan chatbot AI untuk mencari referensi tugas, sikap kritis yang tepat adalah...',
                'options' => [
                    ['text' => 'Menerima seluruh jawaban AI sebagai kebenaran mutlak', 'is_correct' => false],
                    ['text' => 'Memverifikasi kembali informasi yang diberikan AI dengan sumber terpercaya lain', 'is_correct' => true],
                    ['text' => 'Menyalin seluruh jawaban tanpa membaca ulang', 'is_correct' => false],
                    ['text' => 'Tidak perlu memeriksa karena AI selalu benar', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Salah satu keterbatasan alat kecerdasan buatan (AI) dalam menjawab pertanyaan adalah...',
                'options' => [
                    ['text' => 'AI selalu memberikan informasi yang benar tanpa kesalahan', 'is_correct' => false],
                    ['text' => 'AI dapat menghasilkan informasi yang tidak akurat atau sudah ketinggalan zaman sehingga perlu diverifikasi', 'is_correct' => true],
                    ['text' => 'AI tidak pernah membutuhkan data untuk bekerja', 'is_correct' => false],
                    ['text' => 'AI dapat menggantikan seluruh proses berpikir manusia', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Seorang mahasiswa menggunakan AI untuk membantu menyusun kerangka tugas esai, kemudian ia mengembangkan dan menuliskan ulang gagasan tersebut dengan pemahamannya sendiri. Tindakan ini termasuk...',
                'options' => [
                    ['text' => 'Pelanggaran akademik', 'is_correct' => false],
                    ['text' => 'Pemanfaatan AI yang bertanggung jawab sebagai alat bantu belajar', 'is_correct' => true],
                    ['text' => 'Kecurangan dalam ujian', 'is_correct' => false],
                    ['text' => 'Tindakan yang dilarang tanpa terkecuali', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Menyalin seluruh jawaban dari AI dan mengumpulkannya sebagai tugas esai pribadi tanpa proses berpikir sendiri merupakan tindakan yang...',
                'options' => [
                    ['text' => 'Dianjurkan karena lebih efisien', 'is_correct' => false],
                    ['text' => 'Tidak etis karena tidak mencerminkan pemahaman dan usaha pribadi mahasiswa', 'is_correct' => true],
                    ['text' => 'Diperbolehkan selama hasilnya bagus', 'is_correct' => false],
                    ['text' => 'Tidak memiliki risiko akademik', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Mahasiswa hendak mengakses portal akademik menggunakan jaringan WiFi publik di tempat umum. Tindakan paling aman adalah...',
                'options' => [
                    ['text' => 'Langsung memasukkan kata sandi tanpa memeriksa keamanan jaringan', 'is_correct' => false],
                    ['text' => 'Menghindari mengakses data sensitif, atau menggunakan koneksi yang lebih aman seperti VPN saat memakai WiFi publik', 'is_correct' => true],
                    ['text' => 'Membagikan hasil login ke teman yang menggunakan jaringan sama', 'is_correct' => false],
                    ['text' => 'Mengabaikan risiko karena WiFi publik selalu aman', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Tanda bahwa sebuah situs web cukup aman untuk memasukkan data pribadi antara lain...',
                'options' => [
                    ['text' => 'Alamat situs menggunakan protokol https dan memiliki reputasi yang jelas', 'is_correct' => true],
                    ['text' => 'Situs meminta data sebanyak mungkin tanpa alasan jelas', 'is_correct' => false],
                    ['text' => 'Situs sering menampilkan iklan mencurigakan', 'is_correct' => false],
                    ['text' => 'Situs tidak memiliki kebijakan privasi', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Untuk mengelola tugas kuliah dengan banyak tenggat waktu, mahasiswa dapat memanfaatkan...',
                'options' => [
                    ['text' => 'Membiarkan semua tugas diingat tanpa pencatatan', 'is_correct' => false],
                    ['text' => 'Aplikasi kalender atau manajemen tugas untuk mencatat dan mengingatkan tenggat waktu', 'is_correct' => true],
                    ['text' => 'Menunda pencatatan hingga tugas terlupakan', 'is_correct' => false],
                    ['text' => 'Menghindari penggunaan teknologi sama sekali', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Saat mengerjakan tugas kelompok secara daring dengan anggota di lokasi berbeda, alat yang paling tepat digunakan adalah...',
                'options' => [
                    ['text' => 'Aplikasi kolaborasi dokumen daring dan platform komunikasi yang disepakati bersama', 'is_correct' => true],
                    ['text' => 'Mengerjakan sendiri tanpa berkoordinasi dengan anggota lain', 'is_correct' => false],
                    ['text' => 'Mengandalkan komunikasi tatap muka meskipun berjauhan', 'is_correct' => false],
                    ['text' => 'Tidak menggunakan alat bantu apa pun', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Saat ujian daring tanpa pengawasan langsung, sikap yang mencerminkan integritas akademik adalah...',
                'options' => [
                    ['text' => 'Mencari jawaban dari internet atau teman karena tidak diawasi', 'is_correct' => false],
                    ['text' => 'Mengerjakan soal secara mandiri sesuai kemampuan sendiri meskipun tidak diawasi', 'is_correct' => true],
                    ['text' => 'Bekerja sama dengan teman tanpa izin dosen', 'is_correct' => false],
                    ['text' => 'Membuka banyak tab untuk mencari jawaban', 'is_correct' => false],
                ],
            ],
            [
                'question' => 'Menyalin sebagian besar tulisan orang lain dalam tugas tanpa mencantumkan sumber (plagiarisme) merupakan pelanggaran karena...',
                'options' => [
                    ['text' => 'Tidak menghargai karya orang lain dan melanggar kejujuran akademik', 'is_correct' => true],
                    ['text' => 'Merupakan cara belajar yang efisien', 'is_correct' => false],
                    ['text' => 'Tidak berdampak pada penilaian', 'is_correct' => false],
                    ['text' => 'Dianggap wajar dalam dunia akademik', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questionsData as $qIndex => $qData) {
            $question = Question::create([
                'exam_id' => $exam->id,
                'question_text' => str_replace("\n", "<br>", $qData['question']),
                'weight' => 1.66,
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
