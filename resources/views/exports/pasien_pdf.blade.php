<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        th { background-color: #d2f8d2; }
    </style>
</head>
<body>
    <h2>Data Pasien</h2>
    <table>
        <thead>
            <tr>
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
            @foreach($pasiens as $pasien)
                <tr>
                    <td>{{ $pasien->nik }}</td>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td>{{ $pasien->alamat }}</td>
                    <td>{{ $pasien->agama }}</td>
                    <td>{{ $pasien->tanggal_lahir }}</td>
                    <td>{{ $pasien->register_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
