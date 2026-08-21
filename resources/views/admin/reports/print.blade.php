<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Hasil Ujian - CBT PMB UCIC</title>
    <style>
        @page { margin: 40px 50px; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 20px;
        }
        .header {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }
        .header-table td {
            border: none;
            vertical-align: middle;
        }
        .header h1 {
            margin: 0;
            font-size: 15pt;
            text-transform: uppercase;
            font-weight: bold;
        }
        .header h2 {
            margin: 5px 0 0;
            font-size: 13pt;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10pt;
        }
        .report-title {
            text-align: center;
            margin-bottom: 25px;
        }
        .report-title h3 {
            margin: 0;
            font-size: 13pt;
            text-decoration: underline;
            font-weight: bold;
            text-transform: uppercase;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
            border: none;
        }
        .info td {
            padding: 3px 0;
            vertical-align: top;
            border: none;
        }
        .info td:first-child {
            width: 150px;
            font-weight: bold;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .data-table th, .data-table td {
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: left;
            vertical-align: middle;
        }
        .data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .data-table td.text-center {
            text-align: center;
        }
        .footer {
            width: 100%;
            margin-top: 30px;
        }
        .footer-table {
            width: 100%;
            border: none;
        }
        .footer-table td {
            border: none;
        }
        .signature-box {
            width: 300px;
            text-align: center;
            float: right;
        }
        .signature-box p {
            margin: 2px 0;
        }
        .signature-box .name {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
        
        @media print {
            body { padding: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body @if(!$isExport) onload="window.print()" @endif>

    @if(!$isExport)
    <div class="no-print" style="margin-bottom: 25px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 24px; font-size: 12pt; cursor: pointer; background: #0d6efd; color: white; border: none; border-radius: 6px; font-family: Arial, sans-serif; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            🖨️ Cetak Sekarang
        </button>
    </div>
    @endif

    <?php
        $logoPath = public_path('images/logo-ucic.png');
        $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
        $logoSrc = 'data:image/png;base64,' . $logoBase64;
    ?>

    @if(request('type') != 'excel' && request('type') != 'word')
    <div class="header">
        <table class="header-table">
            <tr>
                <td style="width: 15%; text-align: center;">
                    @if($logoBase64)
                        <img src="{{ $logoSrc }}" alt="Logo UCIC" style="width: 90px; height: auto;">
                    @endif
                </td>
                <td style="width: 85%; text-align: center; padding-right: 15%;">
                    <h1>UNIVERSITAS CATUR INSAN CENDEKIA (UCIC)</h1>
                    <h2>PANITIA PENERIMAAN MAHASISWA BARU (PMB)</h2>
                    <p>Jl. Kesambi No. 202, Cirebon, Jawa Barat 45133 | Email:info@cic.ac.id</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="report-title">
        <h3>Laporan Hasil Ujian Seleksi PMB</h3>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>Program Studi</td>
                <td>: {{ $prodiFilter }}</td>
            </tr>
            <tr>
                <td>Tanggal Cetak</td>
                <td>: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Jumlah Peserta</td>
                <td>: {{ $sessions->count() }} Orang</td>
            </tr>
        </table>
    </div>
    @else
    <div style="text-align: center; margin-bottom: 20px; font-weight: bold; font-size: 14pt;">
        LAPORAN HASIL UJIAN SELEKSI PMB
    </div>
    @endif

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Peserta</th>
                <th style="width: 48%;">Program Studi Pilihan</th>
                <th style="width: 10%;">Skor</th>
                <th style="width: 12%;">Ket.</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessions as $index => $session)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $session->participant->name ?? '-' }}</td>
                <td>
                    <div style="margin-bottom: 4px;"><strong>Pilihan 1:</strong> {{ $session->participant->major_choice_1 ?? '-' }}</div>
                    <div><strong>Pilihan 2:</strong> {{ $session->participant->major_choice_2 ?? '-' }}</div>
                </td>
                <td class="text-center" style="font-weight: bold; font-size: 11pt;">
                    {{ $session->score !== null ? number_format($session->score, 2) : '0.00' }}
                </td>
                <td class="text-center">Selesai</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px;">Belum ada data peserta yang menyelesaikan ujian.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
