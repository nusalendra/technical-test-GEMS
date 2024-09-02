<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Perintah Lembur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        .header {
            text-align: left;
            margin-bottom: 20px;
        }

        .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table td {
            padding: 10px;
            vertical-align: top;
        }

        table td:first-child {
            width: 30%;
            font-weight: bold;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
        }

        .signature-table td {
            width: 45%;
            text-align: center;
            vertical-align: bottom;
            height: 150px;
            padding-bottom: 20px;
        }

        .signature-table img {
            width: 100px;
            height: auto;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <p>Pada hari ini,
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}, dengan ini memberikan perintah lembur kepada :</p>
        </div>

        <table>
            <tr>
                <td>Nama</td>
                <td>: {{ $data->karyawan->user->name }}</td>
            </tr>
            <tr>
                <td>Posisi</td>
                <td>: {{ $data->karyawan->posisi->nama }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($data->tanggal)->locale('id')->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>Jam Mulai</td>
                <td>: {{ \Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}</td>
            </tr>
            <tr>
                <td>Jam Selesai</td>
                <td>: {{ \Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}</td>
            </tr>
            <tr>
                <td>Durasi</td>
                <td>: {{ $data->durasi }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{ $data->pekerjaan }}</td>
            </tr>
        </table>

        <table class="signature-table">
            <tr>
                <td style="font-weight: normal;">
                    Penerima Tugas<br>
                    <img src="{{ public_path('storage/' . $data->karyawan->url_tanda_tangan) }}" alt="Tanda Tangan"
                        class="mt-2">
                    <br>{{ $data->karyawan->user->name }}
                </td>
                <td style="font-weight: normal;">
                    Manager<br>
                    <img src="{{ public_path('storage/' . $user->manager->url_tanda_tangan) }}" alt="Tanda Tangan"
                        class="mt-2">
                    <br>{{ $user->name }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
