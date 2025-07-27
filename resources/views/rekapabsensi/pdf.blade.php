<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rekap Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 14px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="title">REKAPITULASI ABSENSI SISWA</div>
        <div class="subtitle">
            Tahun Akademik: {{ $tahunAktif->tahun }} - {{ ucfirst($tahunAktif->semester) }}<br>
            Jurusan: {{ $jurusan }} | Kelas: {{ $kelas }}<br>
            Periode: {{ $periode }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Kelas</th>
                <th class="text-center">Hadir</th>
                <th class="text-center">Sakit</th>
                <th class="text-center">Izin</th>
                <th class="text-center">Alpa</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['nisn'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['jurusan'] }}</td>
                    <td>{{ $item['kelas'] }}</td>
                    <td class="text-center">{{ $item['hadir'] }}</td>
                    <td class="text-center">{{ $item['sakit'] }}</td>
                    <td class="text-center">{{ $item['izin'] }}</td>
                    <td class="text-center">{{ $item['alpa'] }}</td>
                    <td class="text-center">{{ $item['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d/m/Y H:i') }}
    </div>
</body>

</html>
