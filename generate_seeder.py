import re

text = """
SOAL 1
Pertanyaan:
PADI : BERAS = ... : ...

A. Kapas : Benang
B. Kayu : Meja
C. Susu : Sapi
D. Kertas : Pohon

Jawaban benar: A

---

SOAL 2
Pertanyaan:
DOKTER : PASIEN = GURU : ...

A. Sekolah
B. Murid
C. Buku
D. Kelas

Jawaban benar: B

---

SOAL 3
Pertanyaan:
Kata "BIJAKSANA" memiliki makna yang sama dengan...

A. Ceroboh
B. Arif
C. Sombong
D. Pemarah

Jawaban benar: B

---

SOAL 4
Pertanyaan:
Kata "EFEKTIF" memiliki makna yang sama dengan...

A. Boros
B. Tepat guna
C. Rumit
D. Lambat

Jawaban benar: B

---

SOAL 5
Pertanyaan:
Lawan kata dari "OPTIMIS" adalah...

A. Percaya diri
B. Pesimis
C. Realistis
D. Antusias

Jawaban benar: B

---

SOAL 6
Pertanyaan:
Lawan kata dari "KONSISTEN" adalah...

A. Stabil
B. Berubah-ubah
C. Tetap
D. Teratur

Jawaban benar: B

---

SOAL 7
Pertanyaan:
Belajar secara konsisten setiap hari, meskipun hanya sebentar, terbukti lebih efektif dibandingkan belajar dalam waktu lama namun tidak teratur. Hal ini karena otak membutuhkan waktu untuk memproses dan menyimpan informasi ke dalam memori jangka panjang.

Ide pokok paragraf di atas adalah...

A. Belajar lama lebih baik daripada belajar sebentar
B. Konsistensi belajar lebih efektif daripada belajar tidak teratur
C. Otak manusia sulit menyimpan informasi
D. Belajar setiap hari membuang waktu

Jawaban benar: B

---

SOAL 8
Pertanyaan:
Berdasarkan paragraf berikut:

"Belajar secara konsisten setiap hari, meskipun hanya sebentar, terbukti lebih efektif dibandingkan belajar dalam waktu lama namun tidak teratur. Hal ini karena otak membutuhkan waktu untuk memproses dan menyimpan informasi ke dalam memori jangka panjang."

Alasan belajar konsisten lebih efektif adalah...

A. Otak membutuhkan waktu memproses dan menyimpan informasi ke memori jangka panjang
B. Belajar lama membuat otak lelah
C. Guru menyarankan cara tersebut
D. Belajar sebentar tidak membutuhkan usaha

Jawaban benar: A

---

SOAL 9
Pertanyaan:
Semua mahasiswa penerima KIP Kuliah wajib menjaga IPK minimal 3,00. Andi adalah penerima KIP Kuliah. Kesimpulan yang tepat adalah...

A. Andi tidak wajib menjaga IPK
B. Andi wajib menjaga IPK minimal 3,00
C. Andi memiliki IPK di bawah 3,00
D. Andi bukan mahasiswa

Jawaban benar: B

---

SOAL 10
Pertanyaan:
Jika hujan turun, maka jalan menjadi basah. Kenyataannya jalan tidak basah. Kesimpulan yang tepat adalah...

A. Hujan turun
B. Hujan tidak turun
C. Jalan akan basah
D. Tidak dapat disimpulkan

Jawaban benar: B

SOAL 11
Pertanyaan:
Seorang mahasiswa mendapat beasiswa yang menanggung 80% biaya kuliah sebesar Rp5.000.000 per semester. Berapa yang harus ia bayar sendiri?

A. Rp1.000.000
B. Rp800.000
C. Rp1.200.000
D. Rp1.500.000

Jawaban benar: A

---

SOAL 12
Pertanyaan:
Nilai ujian seorang siswa naik dari 70 menjadi 84. Berapa persen kenaikan nilainya?

A. 14%
B. 16%
C. 20%
D. 24%

Jawaban benar: C

---

SOAL 13
Pertanyaan:
Perbandingan jumlah mahasiswa laki-laki dan perempuan penerima KIP Kuliah di sebuah kampus adalah 3:5. Jika total penerima 160 orang, jumlah mahasiswa perempuan adalah...

A. 60 orang
B. 80 orang
C. 100 orang
D. 120 orang

Jawaban benar: C

---

SOAL 14
Pertanyaan:
Sebuah larutan dibuat dengan perbandingan air dan gula 4:1. Jika digunakan 500 ml air, gula yang dibutuhkan adalah...

A. 100 ml
B. 125 ml
C. 150 ml
D. 200 ml

Jawaban benar: B

---

SOAL 15
Pertanyaan:
Perhatikan pola bilangan berikut: 2, 6, 12, 20, 30, ... Angka selanjutnya adalah...

A. 40
B. 42
C. 44
D. 36

Jawaban benar: B

---

SOAL 16
Pertanyaan:
Perhatikan pola bilangan berikut: 3, 5, 9, 15, 23, ... Angka selanjutnya adalah...

A. 30
B. 31
C. 33
D. 35

Jawaban benar: C

---

SOAL 17
Pertanyaan:
Untuk menyelesaikan sebuah proyek, 4 orang membutuhkan waktu 12 hari. Jika dikerjakan oleh 6 orang dengan kecepatan kerja yang sama, waktu yang dibutuhkan adalah...

A. 6 hari
B. 8 hari
C. 9 hari
D. 10 hari

Jawaban benar: B

---

SOAL 18
Pertanyaan:
Harga 3 buku adalah Rp45.000. Berapa harga 7 buku dengan harga satuan yang sama?

A. Rp95.000
B. Rp100.000
C. Rp105.000
D. Rp110.000

Jawaban benar: C

---

SOAL 19
Pertanyaan:
Jumlah penerima KIP Kuliah di sebuah kampus: 2021 = 120 orang, 2022 = 150 orang, 2023 = 180 orang, 2024 = 200 orang. Rata-rata pertambahan penerima per tahun adalah...

A. 20 orang
B. 26,7 orang
C. 30 orang
D. 40 orang

Jawaban benar: B

---

SOAL 20
Pertanyaan:
Berdasarkan data pada soal nomor 19, persentase kenaikan jumlah penerima dari tahun 2023 ke 2024 adalah...

A. 10,5%
B. 11,1%
C. 12,5%
D. 15%

Jawaban benar: B

SOAL 21
Pertanyaan:
Seorang mahasiswa penerima KIP Kuliah mengalami penurunan IPK karena bekerja paruh waktu untuk membantu orang tua. Tindakan paling tepat yang sebaiknya ia lakukan adalah...

A. Berhenti kuliah dan fokus bekerja
B. Mengatur ulang jadwal dan berkonsultasi dengan dosen pembimbing akademik
C. Membiarkan IPK turun karena keadaan ekonomi
D. Meminta teman mengerjakan tugasnya

Jawaban benar: B

---

SOAL 22
Pertanyaan:
Dua mahasiswa mengerjakan tugas kelompok. Salah satu jarang berkontribusi namun mendapat nilai yang sama. Sikap paling tepat dari mahasiswa yang aktif adalah...

A. Diam saja agar tidak berkonflik
B. Membicarakan masalah tersebut secara terbuka dengan anggota kelompok, dan ke dosen bila perlu
C. Ikut tidak mengerjakan tugas sebagai balasan
D. Melaporkan tanpa berdiskusi terlebih dahulu

Jawaban benar: B

---

SOAL 23
Pertanyaan:
Ani jarang mengikuti kelas karena harus menjaga adiknya di rumah. Akibat yang paling mungkin terjadi adalah...

A. Nilai Ani meningkat
B. Pemahaman materi Ani menjadi tertinggal
C. Ani menjadi lebih disiplin
D. Tidak ada dampak apa pun

Jawaban benar: B

---

SOAL 24
Pertanyaan:
Kenaikan harga kebutuhan pokok menyebabkan sebagian keluarga kurang mampu kesulitan membiayai pendidikan anak. Program KIP Kuliah dibuat sebagai...

A. Penyebab masalah tersebut
B. Solusi untuk mengurangi dampak masalah tersebut
C. Akibat dari masalah tersebut
D. Hal yang tidak berkaitan

Jawaban benar: B

---

SOAL 25
Pertanyaan:
Sebuah kampus mencatat bahwa 70% mahasiswa yang aktif berorganisasi memiliki IPK di atas 3,25, sedangkan mahasiswa yang pasif berorganisasi mayoritas memiliki IPK di bawah 3,00. Kesimpulan paling tepat berdasarkan data ini adalah...

A. Berorganisasi pasti menyebabkan IPK tinggi
B. Ada kecenderungan hubungan antara keaktifan organisasi dan IPK, namun bukan berarti hubungan sebab-akibat mutlak
C. Mahasiswa harus berhenti kuliah agar bisa berorganisasi
D. Organisasi tidak ada hubungannya dengan akademik

Jawaban benar: B

---

SOAL 26
Pertanyaan:
Dalam sebuah survei, 60% responden menyatakan lebih suka belajar pada malam hari. Apakah kesimpulan "semua orang belajar lebih baik pada malam hari" tepat?

A. Tepat, karena mayoritas menyatakan demikian
B. Tidak tepat, karena data hanya menunjukkan preferensi, bukan bukti efektivitas belajar
C. Tepat, karena survei adalah bukti ilmiah mutlak
D. Tidak relevan untuk dibahas

Jawaban benar: B

---

SOAL 27
Pertanyaan:
"Karena rajin belajar, Budi pasti akan lulus dengan nilai terbaik." Asumsi yang mendasari pernyataan tersebut adalah...

A. Kerajinan belajar selalu menjamin hasil terbaik
B. Budi memiliki fasilitas belajar yang lengkap
C. Nilai terbaik ditentukan oleh dosen
D. Budi tidak pernah gagal sebelumnya

Jawaban benar: A

---

SOAL 28
Pertanyaan:
"Karena berasal dari keluarga kurang mampu, mahasiswa tersebut pasti kurang mampu secara akademik." Pernyataan ini mengandung asumsi yang keliru karena...

A. Keluarga kurang mampu selalu memiliki anak yang pintar
B. Kemampuan ekonomi tidak menentukan kemampuan akademik seseorang
C. Semua mahasiswa KIP Kuliah pasti berprestasi
D. Pernyataan tersebut sudah benar dan tidak keliru

Jawaban benar: B

---

SOAL 29
Pertanyaan:
Seorang mahasiswa memiliki dua pilihan: mengikuti kegiatan organisasi yang berguna untuk pengalaman, atau fokus penuh pada nilai akademik yang sedang menurun. Keputusan paling bijak adalah...

A. Memilih salah satu secara ekstrem tanpa evaluasi
B. Mengevaluasi prioritas, memperbaiki nilai akademik lebih dulu, lalu mengatur waktu untuk organisasi secara terbatas
C. Mengikuti organisasi penuh dan mengabaikan akademik
D. Berhenti dari kedua kegiatan

Jawaban benar: B

---

SOAL 30
Pertanyaan:
Mahasiswa penerima KIP Kuliah ditawari pekerjaan sampingan dengan gaji besar namun jam kerja bentrok dengan jadwal kuliah wajib. Keputusan yang paling tepat adalah...

A. Menerima pekerjaan dan meninggalkan kelas
B. Menolak, atau mencari kesepakatan jam kerja yang tidak mengganggu kewajiban akademik
C. Meminta teman mengisi absensi
D. Mengabaikan kewajiban kuliah demi uang

Jawaban benar: B

SOAL 31
Pertanyaan:
"Semua mahasiswa penerima beasiswa pasti berasal dari keluarga miskin, karena beasiswa hanya untuk yang tidak mampu." Kelemahan argumen ini adalah...

A. Argumen ini benar sepenuhnya
B. Generalisasi berlebihan karena ada berbagai jenis beasiswa dengan syarat berbeda-beda
C. Semua beasiswa memang khusus untuk keluarga miskin
D. Argumen ini tidak dapat dievaluasi

Jawaban benar: B

---

SOAL 32
Pertanyaan:
"Nilai akademik adalah satu-satunya penentu kesuksesan seseorang." Argumen ini paling tepat dinilai sebagai...

A. Benar karena nilai menentukan segalanya
B. Kurang tepat, karena kesuksesan dipengaruhi banyak faktor selain nilai akademik
C. Tidak relevan untuk dibahas
D. Selalu terbukti secara ilmiah

Jawaban benar: B

---

SOAL 33
Pertanyaan:
Seorang teman berkata, "Tidak perlu membaca petunjuk soal, langsung saja kerjakan." Bagaimana sikap kritis yang tepat terhadap saran ini?

A. Langsung menerima saran tersebut
B. Mengevaluasi risikonya dan tetap membaca petunjuk agar tidak salah memahami soal
C. Mengikuti saran karena teman lebih berpengalaman
D. Mengabaikan soal sepenuhnya

Jawaban benar: B

---

SOAL 34
Pertanyaan:
Seorang mahasiswa kesulitan memahami mata kuliah tertentu meski sudah belajar sendiri. Solusi paling tepat adalah...

A. Berhenti mengikuti mata kuliah tersebut
B. Mencari bantuan tambahan seperti bertanya ke dosen, kelompok belajar, atau tutor sebaya
C. Menyalin jawaban teman saat ujian
D. Mengabaikan mata kuliah tersebut hingga akhir semester

Jawaban benar: B

---

SOAL 35
Pertanyaan:
Sinyal internet di rumah mahasiswa penerima KIP Kuliah sering terputus saat kuliah daring. Solusi paling realistis adalah...

A. Berhenti kuliah karena keterbatasan fasilitas
B. Mencari alternatif seperti fasilitas kampus, tempat dengan sinyal lebih baik, atau melapor ke pihak kampus
C. Tidak mengikuti kelas tanpa memberi kabar
D. Menyalahkan dosen atas gangguan sinyal

Jawaban benar: B

---

SOAL 36
Pertanyaan:
Mahasiswa memiliki jadwal kuliah yang padat dan tugas menumpuk. Strategi paling efektif adalah...

A. Mengerjakan semua tugas secara acak tanpa prioritas
B. Membuat skala prioritas berdasarkan tenggat waktu dan tingkat kesulitan
C. Menunda semua tugas hingga H-1
D. Meminta perpanjangan waktu untuk semua tugas tanpa alasan jelas

Jawaban benar: B

---

SOAL 37
Pertanyaan:
Dalam sebuah pengumuman beasiswa tertulis: "Berkas dikumpulkan paling lambat 10 Agustus pukul 16.00 WIB melalui portal resmi, tidak menerima berkas susulan." Informasi paling penting yang harus diperhatikan mahasiswa adalah...

A. Nama panitia seleksi
B. Batas waktu dan cara pengumpulan berkas
C. Jumlah total pendaftar
D. Sejarah program beasiswa

Jawaban benar: B

---

SOAL 38
Pertanyaan:
Sebuah soal ujian menyajikan banyak data, namun hanya sebagian yang relevan untuk menjawab pertanyaan. Sikap kritis yang tepat adalah...

A. Menggunakan semua data tanpa menyeleksi
B. Mengidentifikasi data yang relevan dengan pertanyaan sebelum menjawab
C. Mengabaikan seluruh data yang diberikan
D. Menjawab tanpa membaca data

Jawaban benar: B

---

SOAL 39
Pertanyaan:
Seorang mahasiswa memiliki keterbatasan biaya untuk membeli buku kuliah. Solusi paling tepat adalah...

A. Tidak mengikuti mata kuliah tersebut
B. Memanfaatkan perpustakaan kampus, e-book resmi, atau meminjam dari senior
C. Berutang tanpa mempertimbangkan kemampuan membayar
D. Berhenti kuliah karena tidak mampu membeli buku

Jawaban benar: B

---

SOAL 40
Pertanyaan:
Mahasiswa mendapati bahwa metode belajarnya selama ini tidak efektif meningkatkan pemahaman. Langkah paling tepat adalah...

A. Tetap menggunakan metode yang sama tanpa evaluasi
B. Mengevaluasi metode belajar dan mencoba pendekatan lain yang lebih sesuai
C. Menyalahkan mata kuliah sebagai penyebabnya
D. Berhenti belajar sama sekali

Jawaban benar: B

SOAL 41
Pertanyaan:
Saat mengerjakan tugas kuliah, seorang mahasiswa menemukan sebuah artikel daring tanpa nama penulis dan tanpa sumber rujukan yang jelas. Sikap paling tepat adalah...

A. Langsung mengutip karena informasinya menarik
B. Memverifikasi informasi tersebut melalui sumber lain yang kredibel sebelum digunakan
C. Menggunakan artikel tersebut sebagai satu-satunya sumber
D. Mengabaikan tugas karena sulit mencari sumber

Jawaban benar: B

---

SOAL 42
Pertanyaan:
Ketika mencari referensi ilmiah untuk tugas akhir, sumber yang paling dapat dipercaya untuk dikutip adalah...

A. Blog pribadi tanpa identitas jelas
B. Jurnal ilmiah terakreditasi atau situs resmi lembaga terpercaya
C. Status media sosial teman
D. Forum diskusi anonim

Jawaban benar: B

---

SOAL 43
Pertanyaan:
Seorang mahasiswa menerima pesan berantai di grup WhatsApp berisi informasi kesehatan tanpa sumber jelas dan menggunakan bahasa provokatif. Tindakan paling tepat adalah...

A. Langsung menyebarkan ke grup lain agar semua tahu
B. Memeriksa kebenaran informasi tersebut sebelum membagikannya
C. Mempercayai begitu saja karena dikirim oleh teman
D. Menghapus pesan tanpa memeriksa kebenarannya

Jawaban benar: B

---

SOAL 44
Pertanyaan:
Ciri informasi yang patut dicurigai sebagai hoaks adalah...

A. Berasal dari lembaga resmi dan memiliki data pendukung
B. Menggunakan judul provokatif berlebihan, tanpa sumber jelas, dan meminta segera disebarkan
C. Ditulis dengan bahasa yang netral dan berimbang
D. Mencantumkan tanggal dan penulis yang jelas

Jawaban benar: B

---

SOAL 45
Pertanyaan:
Saat berdiskusi daring di forum kelas, seorang mahasiswa tidak setuju dengan pendapat temannya. Sikap yang mencerminkan etika digital yang baik adalah...

A. Menyampaikan ketidaksetujuan dengan bahasa yang sopan dan disertai alasan
B. Menyerang secara pribadi teman tersebut di kolom komentar
C. Mengabaikan diskusi sepenuhnya
D. Menyebarkan tangkapan layar percakapan untuk mempermalukan teman

Jawaban benar: A

---

SOAL 46
Pertanyaan:
Mengunggah foto atau video orang lain tanpa izin ke media sosial merupakan pelanggaran terhadap...

A. Etika digital dan hak privasi orang lain
B. Kebebasan berekspresi yang sah
C. Hal yang wajar dilakukan di era digital
D. Ketentuan yang tidak perlu diperhatikan

Jawaban benar: A

---

SOAL 47
Pertanyaan:
Untuk menjaga keamanan akun email dan portal akademik, tindakan yang paling tepat adalah...

A. Menggunakan kata sandi yang sama untuk semua akun agar mudah diingat
B. Menggunakan kata sandi yang kuat dan berbeda untuk setiap akun serta mengaktifkan verifikasi dua langkah
C. Membagikan kata sandi kepada teman dekat
D. Menuliskan kata sandi di tempat umum agar tidak lupa

Jawaban benar: B

---

SOAL 48
Pertanyaan:
Mahasiswa menerima email yang mengatasnamakan pihak kampus dan meminta mengklik tautan untuk "verifikasi akun beasiswa" secara mendesak. Tindakan paling tepat adalah...

A. Langsung mengklik tautan karena terlihat resmi
B. Memeriksa keaslian email dan menghubungi pihak kampus secara langsung sebelum mengklik apa pun
C. Membalas email dengan data pribadi lengkap
D. Meneruskan email ke seluruh teman kelas

Jawaban benar: B

---

SOAL 49
Pertanyaan:
Sebelum mengisi formulir daring yang meminta data pribadi seperti NIK dan nomor rekening, mahasiswa sebaiknya...

A. Mengisi tanpa mempertimbangkan apa pun karena diminta oleh sistem
B. Memastikan situs tersebut resmi dan terpercaya serta memahami tujuan penggunaan data
C. Mengabaikan keamanan karena data pribadi tidak penting
D. Membagikan data tersebut ke media sosial agar transparan

Jawaban benar: B

---

SOAL 50
Pertanyaan:
Membagikan data pribadi seperti NISN, alamat rumah, dan foto KTP secara terbuka di media sosial berisiko menyebabkan...

A. Meningkatkan popularitas akun
B. Penyalahgunaan data oleh pihak yang tidak bertanggung jawab
C. Tidak berdampak apa pun
D. Mempercepat proses seleksi beasiswa

Jawaban benar: B

---

SOAL 51
Pertanyaan:
Ketika menggunakan chatbot AI untuk mencari referensi tugas, sikap kritis yang tepat adalah...

A. Menerima seluruh jawaban AI sebagai kebenaran mutlak
B. Memverifikasi kembali informasi yang diberikan AI dengan sumber terpercaya lain
C. Menyalin seluruh jawaban tanpa membaca ulang
D. Tidak perlu memeriksa karena AI selalu benar

Jawaban benar: B

---

SOAL 52
Pertanyaan:
Salah satu keterbatasan alat kecerdasan buatan (AI) dalam menjawab pertanyaan adalah...

A. AI selalu memberikan informasi yang benar tanpa kesalahan
B. AI dapat menghasilkan informasi yang tidak akurat atau sudah ketinggalan zaman sehingga perlu diverifikasi
C. AI tidak pernah membutuhkan data untuk bekerja
D. AI dapat menggantikan seluruh proses berpikir manusia

Jawaban benar: B

---

SOAL 53
Pertanyaan:
Seorang mahasiswa menggunakan AI untuk membantu menyusun kerangka tugas esai, kemudian ia mengembangkan dan menuliskan ulang gagasan tersebut dengan pemahamannya sendiri. Tindakan ini termasuk...

A. Pelanggaran akademik
B. Pemanfaatan AI yang bertanggung jawab sebagai alat bantu belajar
C. Kecurangan dalam ujian
D. Tindakan yang dilarang tanpa terkecuali

Jawaban benar: B

---

SOAL 54
Pertanyaan:
Menyalin seluruh jawaban dari AI dan mengumpulkannya sebagai tugas esai pribadi tanpa proses berpikir sendiri merupakan tindakan yang...

A. Dianjurkan karena lebih efisien
B. Tidak etis karena tidak mencerminkan pemahaman dan usaha pribadi mahasiswa
C. Diperbolehkan selama hasilnya bagus
D. Tidak memiliki risiko akademik

Jawaban benar: B

---

SOAL 55
Pertanyaan:
Mahasiswa hendak mengakses portal akademik menggunakan jaringan WiFi publik di tempat umum. Tindakan paling aman adalah...

A. Langsung memasukkan kata sandi tanpa memeriksa keamanan jaringan
B. Menghindari mengakses data sensitif, atau menggunakan koneksi yang lebih aman seperti VPN saat memakai WiFi publik
C. Membagikan hasil login ke teman yang menggunakan jaringan sama
D. Mengabaikan risiko karena WiFi publik selalu aman

Jawaban benar: B

---

SOAL 56
Pertanyaan:
Tanda bahwa sebuah situs web cukup aman untuk memasukkan data pribadi antara lain...

A. Alamat situs menggunakan protokol https dan memiliki reputasi yang jelas
B. Situs meminta data sebanyak mungkin tanpa alasan jelas
C. Situs sering menampilkan iklan mencurigakan
D. Situs tidak memiliki kebijakan privasi

Jawaban benar: A

---

SOAL 57
Pertanyaan:
Untuk mengelola tugas kuliah dengan banyak tenggat waktu, mahasiswa dapat memanfaatkan...

A. Membiarkan semua tugas diingat tanpa pencatatan
B. Aplikasi kalender atau manajemen tugas untuk mencatat dan mengingatkan tenggat waktu
C. Menunda pencatatan hingga tugas terlupakan
D. Menghindari penggunaan teknologi sama sekali

Jawaban benar: B

---

SOAL 58
Pertanyaan:
Saat mengerjakan tugas kelompok secara daring dengan anggota di lokasi berbeda, alat yang paling tepat digunakan adalah...

A. Aplikasi kolaborasi dokumen daring dan platform komunikasi yang disepakati bersama
B. Mengerjakan sendiri tanpa berkoordinasi dengan anggota lain
C. Mengandalkan komunikasi tatap muka meskipun berjauhan
D. Tidak menggunakan alat bantu apa pun

Jawaban benar: A

---

SOAL 59
Pertanyaan:
Saat ujian daring tanpa pengawasan langsung, sikap yang mencerminkan integritas akademik adalah...

A. Mencari jawaban dari internet atau teman karena tidak diawasi
B. Mengerjakan soal secara mandiri sesuai kemampuan sendiri meskipun tidak diawasi
C. Bekerja sama dengan teman tanpa izin dosen
D. Membuka banyak tab untuk mencari jawaban

Jawaban benar: B

---

SOAL 60
Pertanyaan:
Menyalin sebagian besar tulisan orang lain dalam tugas tanpa mencantumkan sumber (plagiarisme) merupakan pelanggaran karena...

A. Tidak menghargai karya orang lain dan melanggar kejujuran akademik
B. Merupakan cara belajar yang efisien
C. Tidak berdampak pada penilaian
D. Dianggap wajar dalam dunia akademik

Jawaban benar: A
"""

questions = []
current_q = None

for line in text.split('\n'):
    line = line.strip()
    if line.startswith('SOAL'):
        if current_q:
            questions.append(current_q)
        current_q = {'question': '', 'options': {}}
    elif line.startswith('Pertanyaan:'):
        continue
    elif line.startswith('A.') or line.startswith('B.') or line.startswith('C.') or line.startswith('D.'):
        opt = line[0]
        val = line[2:].strip()
        current_q['options'][opt] = val
    elif line.startswith('Jawaban benar:'):
        current_q['correct'] = line.split(':')[1].strip()
    elif line and not line.startswith('---'):
        if current_q is not None and not current_q['options'] and 'correct' not in current_q:
            if current_q['question']:
                current_q['question'] += '\n' + line
            else:
                current_q['question'] = line

if current_q:
    questions.append(current_q)

import json
# print(json.dumps(questions, indent=2))

php_code = """<?php

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
"""

for q in questions:
    php_code += "            [\n"
    q_text = q['question'].replace("'", "\\'")
    php_code += f"                'question' => '{q_text}',\n"
    php_code += "                'options' => [\n"
    for opt_k in ['A', 'B', 'C', 'D']:
        opt_v = q['options'][opt_k].replace("'", "\\'")
        is_correct = 'true' if q['correct'] == opt_k else 'false'
        php_code += f"                    ['text' => '{opt_v}', 'is_correct' => {is_correct}],\n"
    php_code += "                ],\n"
    php_code += "            ],\n"

php_code += """        ];

        foreach ($questionsData as $qIndex => $qData) {
            $question = Question::create([
                'exam_id' => $exam->id,
                'question_text' => str_replace("\\n", "<br>", $qData['question']),
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
"""

with open('d:/ujian-pmb/database/seeders/CbtPmbSeeder.php', 'w', encoding='utf-8') as f:
    f.write(php_code)

print("Seeder file written successfully!")
