<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Peserta Bimbingan</title>

    <style>
        .kop-table{
    width:100%;
    border:none;
    border-collapse:collapse;
    margin-bottom:0;
}

.kop-table td{
    border:none;
}

.logo-cell{
    width:100px;
}

.logo-cell img{
    width:75px;
}

.kop-text{
    text-align:center;
    padding-right:50px;
}

.line1{
    font-size:12pt;
}

.line2{
    font-size:14pt;
    font-weight:bold;
}

.line3{
    font-size:13pt;
    font-weight:bold;
}

.alamat{
    font-size:9pt;
    line-height:1.3;
    margin-top:4px;
}

.garis1{
    border-top:2px solid #000;
    margin-top:8px;
}

.garis2{
    border-top:1px solid #000;
    margin-top:2px;
    margin-bottom:20px;
}

        

        h2 {
    text-align:center;
    font-size:14pt;
    font-weight:bold;
    text-transform:uppercase;
    text-decoration:underline;
    margin-bottom:10px;
}
        

        .sub{
    margin-bottom:20px;
    font-size:11pt;
    line-height:1.5;
}

        .data-table{
    width:100%;
    border-collapse:collapse;
}

.data-table th,
.data-table td{
    border:1px solid #000;
    padding:8px;
}

.data-table th{
    background:#f2f2f2;
    text-align:center;
}

        td {
            vertical-align: top;
        }

        body{
    font-family:"Times New Roman", serif;
    font-size:12pt;
    color:#000;
    padding:20px 35px;
}
    </style>
</head>
<body>
    <table class="kop-table">
    <tr>
        <td class="logo-cell">
            <img src="{{ public_path('images/logo-poliban.jpg') }}">
        </td>

        <td class="kop-text">

            <div class="line1">
                KEMENTERIAN PENDIDIKAN TINGGI, SAINS DAN TEKNOLOGI
            </div>

            <div class="line2">
                POLITEKNIK NEGERI BANJARMASIN
            </div>

            <div class="line3">
                UPA. PERPUSTAKAAN
            </div>

            <div class="alamat">
                Jl. Brigjen H. Hasan Basri (Kampus ULM), Kayutangi, Banjarmasin 70123<br>
                Telp/Fax : (0511) 3305052 · Website : www.poliban.ac.id ·
                e-mail : poliban@poliban.ac.id
            </div>

        </td>
    </tr>
</table>

<div class="garis1"></div>
<div class="garis2"></div>

    <h2>Data Peserta Bimbingan Magang</h2>

    <div class="sub">
    <strong>Pembimbing</strong> : {{ $pembimbing->nama }} <br>
    <strong>Unit Kerja</strong> : UPA Perpustakaan <br>
    <strong>Jumlah Peserta</strong> : {{ count($data) }} Orang <br>
    <strong>Tanggal Cetak</strong> :
    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
</div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN/NIM</th>
                <th>Sekolah/Kampus</th>
                <th>Jurusan</th>
                <th>Periode Magang</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $i => $d)
            <tr>
                <td style="text-align:center">
                    {{ $i + 1 }}
                </td>

                <td>
                    {{ $d->nama }}
                </td>

                <td>
                    {{ $d->nisn_nim }}
                </td>

                <td>
                    {{ $d->sekolahKampus->nama_sekolah_kampus ?? '-' }}
                </td>

                <td>
                    {{ $d->jurusan->jurusan ?? '-' }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($d->hasilPendaftaran->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }}
                    -
                    {{ \Carbon\Carbon::parse($d->hasilPendaftaran->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center">
                    Tidak ada data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
<br><br><br>

<table style="width:100%; border:none;">
    <tr>
        <td style="border:none;"></td>

        <td style="border:none; width:40%; text-align:center;">
    Banjarmasin,
    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}

    <br><br><br><br><br>

    Pembimbing Lapangan

    <br><br>

    {{ $pembimbing->nama }}
</td>
    </tr>
</table>
</body>
</html>
