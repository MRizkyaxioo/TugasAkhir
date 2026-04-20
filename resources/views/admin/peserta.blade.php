<h2>Peserta Magang</h2>

@foreach($data as $d)
<p>{{ $d->nama }} - {{ $d->sekolah }}</p>
@endforeach
