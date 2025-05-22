<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .kop-container {
            display: table;
            width: 100%;
            border-bottom: 3px solid black;
            margin-bottom: 20px;
            padding: 4px 30px;
        }

        .kop-logo-wrap,
        .kop-text {
            display: table-cell;
            vertical-align: middle;
            padding-bottom: 10px;
        }

        .kop-logo-wrap {
            width: 100px;
        }

        .kop-logo {
            height: 65px;
            display: block;
            margin-bottom: 10px;
        }

        .kop-text {
            position: relative;
        }

        .kop-text-inner {
            text-align: center;
            margin-left: -140px; 
        }

        .kop-text-inner h1, 
        .kop-text-inner h2, 
        .kop-text-inner h3, 
        .kop-text-inner p {
            margin: 0;
        }

        .kop-text-inner h1 { font-size: 20px; font-weight: normal; }
        .kop-text-inner h2 { font-size: 26px; font-weight: bold; }
        .kop-text-inner h3 { font-size: 16px; }
        .kop-text-inner p  { font-size: 12px; }

        h2 {
            margin-top: 20px;
            font-size: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        thead {
            background-color: #FEF212;
        }
    </style>
</head>
<body>
    <div class="kop-container">
        <div class="kop-logo-wrap">
            <img src="{{ public_path('build/assets/logo.png') }}" class="kop-logo">
        </div>
        <div class="kop-text">
            <div class="kop-text-inner">
                <h1>RUMAH SAKIT UMUM BUNDA THAMRIN</h1>
                <h2>TERAKREDITASI</h2>
                <p>Jl. Sei Batang Hari No.28-30-42, Babura Sunggal, Kec. Medan Sunggal, Kota Medan – Sumatera Utara, 20152</p>
                <p>Telepon: 0853-5947-3042 | Email: rsbundathamrin@gmail.com</p>
            </div>
        </div>
    </div>
    <h2>Data Pasien RSU Bunda Thamrin</h2>
    <table>
        <thead>
            <tr>
                <th>No. Pendaftaran</th>
                <th>Tanggal Pendaftaran</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>No. RM</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Tanggal Lahir</th>
                <th>Register Date</th>
            </tr>
        </thead>
        <tbody>
        @php
            $adaData = false;
        @endphp

        @foreach($pasiens as $pasien)
            @if($pasien->pendaftarans->count())
                @foreach($pasien->pendaftarans as $pendaftaran)
                    @php $adaData = true; @endphp
                    <tr>
                        <td>{{ $pendaftaran->no_pendaftaran }}</td>
                        <td>{{ $pendaftaran->pendaftaran_date }}</td>
                        <td>{{ $pasien->nik }}</td>
                        <td>{{ $pasien->nama }}</td>
                        <td>{{ $pasien->no_rm }}</td>
                        <td>{{ $pasien->alamat }}</td>
                        <td>{{ $pasien->agama }}</td>
                        <td>{{ $pasien->tanggal_lahir }}</td>
                        <td>{{ $pasien->register_date }}</td>
                    </tr>
                @endforeach
            @else
                @php $adaData = true; @endphp
                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ $pasien->nik }}</td>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->agama }}</td>
                    <td>{{ $pasien->tanggal_lahir }}</td>
                    <td>{{ $pasien->register_date }}</td>
                </tr>
            @endif
        @endforeach

        @if(!$adaData)
            <tr>
                <td colspan="9">Tidak ada data</td>
            </tr>
        @endif
        </tbody>
</body>
</html>