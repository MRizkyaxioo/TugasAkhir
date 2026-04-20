<h2>Riwayat Peserta</h2>

@foreach($data as $d)
<p>{{ $d->nama }} - {{ $d->sekolah }}</p>
@endforeach
