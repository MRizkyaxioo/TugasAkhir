<h2>Nilai Peserta Magang</h2>

<p><b>Nama:</b> {{ $peserta->nama }}</p>
<p><b>Sekolah/Kampus:</b> {{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</p>
<table border="1" width="100%" cellpadding="5">
<tr>
    <th>Kriteria</th>
    <th>Nilai</th>
    <th>Grade</th>
</tr>

@foreach($peserta->penilaian as $p)
<tr>
    <td>{{ $p->kriteria->kriteria_nilai }}</td>
    <td>{{ $p->nilai }}</td>
    <td>
        @if($p->nilai >= 75)
            A
        @elseif($p->nilai >= 65)
            B
        @elseif($p->nilai >= 55)
            C
        @elseif($p->nilai >= 45)
            D
        @else
            E
        @endif
    </td>
</tr>
@endforeach
</table>
<br>

<p><b>Keterangan Grade:</b></p>
<ul>
    <li>75 - 100 : A</li>
    <li>65 - 74  : B</li>
    <li>55 - 64  : C</li>
    <li>45 - 54  : D</li>
    <li>< 45     : E</li>
</ul>
