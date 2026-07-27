<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Nilai Peserta Magang</title>

<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:"Times New Roman", serif;
        font-size:12pt;
        color:#000;
        padding:20px 35px;
    }

    /* =========================
       KOP SURAT
    ========================== */

    .kop-table{
        width:100%;
        border-collapse:collapse;
    }

    .kop-table td{
        border:none;
    }

    .logo-cell{
        width:120px;
        text-align:center;
        vertical-align:middle;
    }

    .logo-cell img{
        width:95px;
        height:auto;
    }

    .kop-text{
        text-align:center;
        vertical-align:middle;
        padding-right:50px;
    }

    .line1{
        font-size:18pt;
        line-height:1.2;
    }

    .line2{
        font-size:17pt;
        font-weight:bold;
        margin-top:3px;
    }

    .line3{
        font-size:16pt;
        font-weight:bold;
        margin-top:2px;
    }

    .alamat{
        font-size:11pt;
        margin-top:6px;
        line-height:1.3;
    }

    .garis1{
        border-top:2px solid #000;
        margin-top:8px;
    }

    .garis2{
        border-top:1px solid #000;
        margin-top:2px;
        margin-bottom:25px;
    }

    /* =========================
       JUDUL
    ========================== */

    .judul{
        text-align:center;
        font-weight:bold;
        font-size:14pt;
        text-decoration:underline;
        text-transform:uppercase;
        margin-bottom:25px;
    }

    /* =========================
       DATA PESERTA
    ========================== */

    .info{
        margin-bottom:20px;
        font-size:11pt;
    }

    .info table{
        width:100%;
        border:none;
    }

    .info td{
        border:none;
        padding:2px 0;
    }

    .label{
        width:160px;
        font-weight:bold;
    }

    .colon{
        width:15px;
    }

    /* =========================
       TABEL NILAI
    ========================== */

    .nilai-table{
        width:100%;
        border-collapse:collapse;
        margin-top:10px;
        margin-bottom:14px;
    }

    .nilai-table th,
    .nilai-table td{
        border:1px solid #000;
        padding:8px;
        font-size:11pt;
    }

    .nilai-table th{
        text-align:center;
        font-weight:bold;
    }

    .nilai-table td:first-child{
        text-align:left;
    }

    .nilai-table td{
        text-align:center;
    }

    /* =========================
       NILAI AKHIR (TERPISAH)
    ========================== */

    .nilai-akhir-table{
        width:100%;
        border-collapse:collapse;
        margin-top:2px;
        margin-bottom:20px;
    }

    .nilai-akhir-table td{
        border:2px solid #000;
        padding:8px;
        font-size:12pt;
        font-weight:bold;
        text-align:center;
    }

    .nilai-akhir-table .label-akhir{
        width:50%;
        text-align:left;
    }

    /* =========================
       KETERANGAN
    ========================== */

    .keterangan{
        margin-top:10px;
        font-size:11pt;
    }

    .keterangan p{
        font-weight:bold;
        margin-bottom:5px;
    }

    .keterangan ul{
        padding-left:18px;
    }

    .keterangan li{
        margin-bottom:2px;
    }

    .pernyataan{
    margin-top:15px;
    margin-bottom:15px;
    font-size:11pt;
    text-align:justify;
    line-height:1.5;
    }
    /* =========================
       TANDA TANGAN
    ========================== */

    .ttd-section{
        margin-top:60px;
    }

    .ttd-table{
        width:100%;
        border:none;
    }

    .ttd-table td{
        border:none;
        width:50%;
        text-align:center;
        vertical-align:top;
    }

    .tanggal{
    margin-bottom:5px;
    font-size:11pt;
}

.jabatan{
    font-size:11pt;
    margin-bottom:90px; /* ruang untuk tanda tangan */
}

.nama{
    font-size:11pt;
    font-weight:normal;
    text-decoration:none;
}

.nip{
    margin-top:4px;
    font-size:11pt;
    font-weight:normal;
}
</style>

</head>
<body>

{{-- KOP SURAT --}}
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

{{-- JUDUL --}}
<div class="judul">
    Nilai Peserta Magang
</div>

{{-- DATA PESERTA --}}
<div class="info">
    <table>
        <tr>
            <td class="label">Nama</td>
            <td class="colon">:</td>
            <td>{{ $peserta->nama }}</td>
        </tr>

        <tr>
            <td class="label">NIS/NIM</td>
            <td class="colon">:</td>
            <td>{{ $peserta->nisn_nim ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Sekolah/Kampus</td>
            <td class="colon">:</td>
            <td>{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Jurusan</td>
            <td class="colon">:</td>
            <td>{{ $peserta->jurusan->jurusan ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Periode Magang</td>
            <td class="colon">:</td>
            <td>
                {{ \Carbon\Carbon::parse($peserta->awal_magang)->format('d-m-Y') }}
                s/d
                {{ \Carbon\Carbon::parse($peserta->akhir_magang)->format('d-m-Y') }}
            </td>
        </tr>
    </table>
</div>

{{-- TABEL KRITERIA --}}
<table class="nilai-table">
    <thead>
        <tr>
            <th width="50%">Kriteria</th>
            <th width="20%">Nilai</th>
            <th width="30%">Grade</th>
        </tr>
    </thead>

    <tbody>
        @foreach($peserta->penilaian as $p)
        <tr>
            <td>{{ $p->kriteria->kriteria_nilai }}</td>
            <td>{{ $p->nilai }}</td>
            <td>
                @if($p->nilai >= 75)
                    Baik Sekali
                @elseif($p->nilai >= 65)
                    Baik
                @elseif($p->nilai >= 55)
                    Cukup
                @elseif($p->nilai >= 45)
                    Kurang
                @else
                    Kurang Sekali
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- NILAI AKHIR, TERPISAH DARI TABEL KRITERIA --}}
<table class="nilai-akhir-table">
    <tr>
        <td class="label-akhir">Nilai Akhir</td>
        <td>{{ $peserta->nilai_akhir ?? '-' }}</td>
        <td>{{ $peserta->grade_akhir }}</td>
    </tr>
</table>

{{-- KETERANGAN --}}
<div class="keterangan">
    <p>Keterangan Grade :</p>

    <ul>
        <li>75 - 100 : Baik Sekali</li>
        <li>65 - 74 : Baik</li>
        <li>55 - 64 : Cukup</li>
        <li>45 - 54 : Kurang</li>
        <li>&lt; 45 : Kurang Sekali</li>
    </ul>
</div>

<div class="pernyataan">
    Dengan ini menerangkan bahwa peserta magang yang tersebut di atas telah
    menyelesaikan seluruh rangkaian kegiatan magang di UPA Perpustakaan
    Politeknik Negeri Banjarmasin pada periode yang telah ditetapkan dan
    memperoleh hasil penilaian sebagaimana tercantum pada tabel di atas.
</div>

{{-- TTD --}}
<div class="ttd-section">

    <table class="ttd-table">
        <tr>
            <td>
                <div class="tanggal">
                    Banjarmasin,
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                </div>

                <div class="jabatan">
                    Pembimbing Lapangan
                </div>

                <div class="nama">
    {{ $peserta->pembimbing->first()->nama ?? 'Belum ada pembimbing' }}
</div>
            </td>

            <td>
                <div class="tanggal">
                    Banjarmasin,
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}
                </div>

                <div class="jabatan">
                    Kepala UPA Perpustakaan
                </div>

                <div class="nama">
                    {{ $kepala->nama ?? '....................................' }}
                </div>

                <div class="nip">
    NIP.
    @if(!empty($kepala->nip) && strlen($kepala->nip) == 18)
        {{ substr($kepala->nip, 0, 8) }}
        {{ substr($kepala->nip, 8, 6) }}
        {{ substr($kepala->nip, 14, 1) }}
        {{ substr($kepala->nip, 15, 3) }}
    @else
        ....................................
    @endif
</div>
            </td>
        </tr>
    </table>

</div>

</body>
</html>