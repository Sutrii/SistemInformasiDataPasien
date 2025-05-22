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

        .no-data {
            text-align: center;
            font-size: 14px;
            font-style: italic;
            margin-top: 40px;
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

    <h2>Data Pendaftaran Pasien RSU Bunda Thamrin</h2>
    @if($start && $end)
        <p style="text-align: center; font-size: 13px;">Periode: {{ $start->format('d-m-Y') }} s/d {{ $end->format('d-m-Y') }}</p>
    @endif

    @if($pendaftaran->count())
        <table>
        <thead>
            <tr>
                <th>No. Pendaftaran</th>
                <th>Tanggal Pendaftaran</th>
                <th>No. RM</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Tanggal Lahir</th>
                <th>Register Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftaran as $data)
                <tr>
                    <td>{{ $data->no_pendaftaran }}</td>
                    <td>{{ $data->pendaftaran_date }}</td>
                    <td>{{ $data->no_rm }}</td>
                    <td>{{ optional($data->pasien)->nama ?? '-' }}</td>
                    <td>{{ optional($data->pasien)->nik ?? '-' }}</td>
                    <td>{{ optional($data->pasien)->alamat ?? '-' }}</td>
                    <td>{{ optional($data->pasien)->agama ?? '-' }}</td>
                    <td>{{ optional($data->pasien)->tanggal_lahir ?? '-' }}</td>
                    <td>{{ optional($data->pasien)->register_date ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; font-size: 14px;">
                        Tidak ada data pendaftaran pada periode tersebut.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @else
        <p class="no-data">Tidak ada data pendaftaran pada periode tersebut.</p>
    @endif
</body>
</html>
