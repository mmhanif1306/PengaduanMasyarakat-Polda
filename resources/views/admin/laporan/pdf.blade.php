<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan {{ $laporan->judul }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background-color: #1e40af;
            color: white;
            padding: 10px 15px;
            margin: 0 0 15px 0;
            font-size: 16px;
            font-weight: bold;
        }
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            padding: 8px 15px 8px 0;
            font-weight: bold;
            width: 30%;
            vertical-align: top;
        }
        .info-value {
            display: table-cell;
            padding: 8px 0;
            vertical-align: top;
        }
        .bukti-image {
            max-width: 100%;
            height: auto;
            border: 1px solid #e5e7eb;
            margin: 10px 0;
        }
        .content-box {
            border: 1px solid #e5e7eb;
            padding: 15px;
            background-color: #f9fafb;
            margin-top: 10px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN PENGADUAN MASYARAKAT</h1>
        <p>POLDA JAWA TENGAH</p>
        <p>Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Informasi Laporan -->
    <div class="section">
        <h2 class="section-title">INFORMASI LAPORAN</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Judul:</div>
                <div class="info-value">{{ $laporan->judul }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->status)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Dibuat:</div>
                <div class="info-value">{{ $laporan->created_at->format('d F Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

    <!-- Informasi Pelapor -->
    <div class="section">
        <h2 class="section-title">INFORMASI PELAPOR</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Nama:</div>
                <div class="info-value">{{ $laporan->user->nama }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $laporan->user->email }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">No. Telepon:</div>
                <div class="info-value">{{ $laporan->user->no_telp ?? 'Tidak tersedia' }}</div>
            </div>
        </div>
    </div>

    <!-- Lokasi Kejadian -->
    <div class="section">
        <h2 class="section-title">LOKASI KEJADIAN</h2>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Provinsi:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->provinsi)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kota/Kabupaten:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->kota)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kecamatan:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->kecamatan)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Kelurahan:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->kelurahan)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Alamat Lengkap:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->alamat)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Longitude:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->longitude)) }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Latitude:</div>
                <div class="info-value">{{ ucwords(strtolower($laporan->latitude)) }}</div>
            </div>
        </div>
    </div>

    <!-- Isi Laporan -->
    <div class="section">
        <h2 class="section-title">ISI LAPORAN</h2>
        <div class="content-box">
            {{ $laporan->deskripsi }}
        </div>
    </div>

    <!-- Bukti Pendukung -->
    @if($laporan->url_file)
    <div class="section">
        <h2 class="section-title">BUKTI PENDUKUNG</h2>
        @php
            $isImage = preg_match('/\.(jpg|jpeg|png|gif|bmp)$/i', $laporan->url_file);
        @endphp
        @if($isImage)
            <div style="text-align: center; margin-top: 15px;">
                <img src="{{ $laporan->url_file }}" alt="Bukti Pendukung" class="bukti-image" style="max-width: 400px; max-height: 300px; border: 1px solid #e5e7eb;">
            </div>
        @else
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">File Bukti:</div>
                    <div class="info-value">{{ basename($laporan->url_file) }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">URL:</div>
                    <div class="info-value">{{ $laporan->url_file }}</div>
                </div>
            </div>
        @endif
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh Sistem Pengaduan Masyarakat POLDA Jawa Tengah</p>
        <p>Untuk verifikasi keaslian dokumen, silakan hubungi pihak berwenang</p>
    </div>
</body>
</html>