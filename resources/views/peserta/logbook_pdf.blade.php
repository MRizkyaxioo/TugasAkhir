<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logbook Magang</title>

    <style>

    /* =========================
   KOP SURAT
========================= */

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
    width:120px;

}

.logo-cell img{
    width:85px;
    height:auto;
}

.kop-text{
    text-align:center;
    padding-right:50px;
}

.line1{
    font-size:16px;
}

.line2{
    font-size:17px;
    font-weight:bold;
}

.line3{
    font-size:16px;
    font-weight:bold;
}

.alamat{
    font-size:11px;
    margin-top:5px;
    line-height:1.4;
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

/* =========================
   INFO PESERTA
========================= */

.info p{
    margin:4px 0;
}

/* =========================
   TANDA TANGAN
========================= */

.ttd{
    margin-top:50px;
    width:100%;
}

.ttd-kanan{
    width:40%;
    float:right;
    text-align:center;
}

.ttd-tanggal{
    margin-bottom:5px;
}

.ttd-jabatan{
    margin-bottom:80px;
}

.ttd-nama{
    margin-top:5px;
}

        body{
    font-family:"Times New Roman", serif;
    font-size:12pt;
    color:#000;
    padding:20px 35px;
}

    h2{
    width:100%;
    text-align:center;
    font-weight:bold;
    font-size:14pt;
    text-decoration:underline;
    text-transform:uppercase;
    margin:25px auto;
}

        .info{
    margin-bottom:20px;
    font-size:11pt;
}

        table{
    width:100%;
    border-collapse:collapse;
}

table{
    width:100%;
    border-collapse:collapse;
}

.logbook-table,
.logbook-table th,
.logbook-table td{
    text-align:center;
    vertical-align:middle;
}

th, td{
    padding:8px;
    font-size:11pt;
}

th{
    font-weight:bold;
    text-align:center;
    background:#eee;
}

.bukti-foto{
    width:80px;
    height:auto;
    display:block;
    margin:0 auto;
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
                KEMENTERIAN PENDIDIKAN TINGGI, SAINS
            </div>

            <div class="line1">
                DAN TEKNOLOGI
            </div>

            <div class="line2">
                POLITEKNIK NEGERI BANJARMASIN
            </div>

            <div class="line3">
                UPA. PERPUSTAKAAN
            </div>

            <div class="alamat">
                Jl. Brigjen H. Hasan Basri (Kampus ULM), Kayutangi, Banjarmasin 70123<br>
                Telp/Fax : (0511) 3305052 · Website : www.poliban.ac.id · e-mail : poliban@poliban.ac.id
            </div>
        </td>
    </tr>
</table>

<div class="garis1"></div>
<div class="garis2"></div>

<h2>LOGBOOK KEGIATAN MAGANG</h2>

<div class="info">
    <p><strong>Nama:</strong> {{ $peserta->nama }}</p>
    <p><strong>Sekolah:</strong> {{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</p>
    <p><strong>Jurusan:</strong> {{ $peserta->jurusan->jurusan ?? '-' }}</p>
    <p>
    <strong>Periode Magang:</strong>
    {{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d/m/Y') }}
    s/d
    {{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d/m/Y') }}
</p>
</div>

<table class="logbook-table">
    <tr>
       <th style="width:10%">No</th>
        <th style="width:20%">Tanggal</th>
        <th style="width:40%">Kegiatan</th>
        <th style="width:30%">Bukti Foto</th>
    </tr>

    @foreach($data as $index => $d)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $d->tanggal }}</td>
        <td>{{ $d->kegiatan }}</td>
        <td>
            <img class="bukti-foto"
     src="{{ public_path('storage/'.$d->bukti_foto) }}">
        </td>
    </tr>
    @endforeach
</table>


<br><br>
<div class="ttd">
    <div class="ttd-kanan">

        <div class="ttd-tanggal">
    Banjarmasin,
    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
</div>

<div class="ttd-jabatan">
    Pembimbing Lapangan
</div>

<div class="ttd-nama">
    {{ $peserta->pembimbing->first()->nama ?? 'Belum ada pembimbing' }}
</div>

    </div>
</div>
</body>
</html>
