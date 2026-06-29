<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Peserta - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5E6D0;
            --warm-white: #FFFDF9;
            --gold: #C8873A;
            --gold-light: #E8A85A;
            --dark: #1A1208;
            --muted: #7A6E62;
            --card-bg: #FFFFFF;
            --shadow: 0 4px 24px rgba(26,18,8,0.08);
            --radius: 16px;
            --sidebar-w: 220px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--warm-white);
            border-right: 1px solid rgba(200,135,58,0.15);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 200;
            box-shadow: 2px 0 12px rgba(26,18,8,0.06);
        }

        .sidebar-logo {
            padding: 24px 20px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(200,135,58,0.12);
        }

        .sidebar-logo img { width: 64px; height: 64px; object-fit: contain; }

        .sidebar-nav {
            flex: 1;
            padding: 16px 0;
            display: flex;
            flex-direction: column;
            gap: 2px;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--muted);
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .nav-item:hover { background: rgba(200,135,58,0.08); color: var(--dark); }
        .nav-item.active { background: rgba(200,135,58,0.12); color: var(--gold); font-weight: 500; }
        .nav-item svg { flex-shrink: 0; opacity: 0.7; }
        .nav-item.active svg { opacity: 1; }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(200,135,58,0.12);
        }

        .btn-logout {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 16px;
            background: rgba(200,135,58,0.1);
            border: 1px solid rgba(200,135,58,0.2);
            border-radius: 50px;
            color: var(--gold);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .btn-logout:hover { background: var(--gold); color: #fff; }

        /* MAIN */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-header {
            padding: 28px 36px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 12px 40px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
        }

        .page-body { padding: 24px 36px 40px; }

        /* ALERT */
        .alert-success {
            background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534;
            font-size: 0.85rem; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;
        }
        .alert-error {
            background: #FEF2F2; border: 1px solid #FECACA; color: #C0392B;
            font-size: 0.85rem; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;
        }

        /* ACTION BAR */
        .action-bar {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .action-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .action-label {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--muted);
        }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 24px 28px;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: background 0.2s, transform 0.15s;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-primary { background: var(--gold); color: #fff; box-shadow: 0 3px 10px rgba(200,135,58,0.3); }
        .btn-primary:hover { background: var(--gold-light); transform: translateY(-1px); }
        .btn-outline { background: transparent; border: 1.5px solid var(--gold); color: var(--gold); }
        .btn-outline:hover { background: var(--gold); color: #fff; }
        .btn-sm { padding: 6px 14px; font-size: 0.78rem; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }

        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }

        thead tr { background: var(--cream); }
        thead th {
            padding: 11px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--muted);
            border-bottom: 2px solid #E8D5B5;
        }

        tbody tr { border-bottom: 1px solid #F5E6D0; transition: background 0.15s; }
        tbody tr:hover { background: #FFFDF9; }
        tbody td { padding: 10px 14px; color: var(--dark); vertical-align: middle; }

        /* SELECT STATUS */
        .status-select {
            padding: 6px 28px 6px 10px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%237A6E62' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            cursor: pointer;
            transition: border-color 0.2s;
        }

        .status-select:focus { border-color: var(--gold); }

        .surat-link {
            color: var(--gold);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
        }

        .surat-link:hover { text-decoration: underline; }

        .no-surat { color: var(--muted); font-size: 0.82rem; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
            .page-body { padding: 16px; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.calon') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                    <line x1="8" y1="18" x2="21" y2="18"/>
                    <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                    <line x1="3" y1="18" x2="3.01" y2="18"/>
                </svg>
                Daftar Calon Peserta
            </a>
            <a href="{{ route('admin.peserta') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Daftar Peserta Magang
            </a>
            <a href="{{ route('admin.riwayat') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <polyline points="16 11 18 13 22 9"/>
                </svg>
                Daftar Riwayat Peserta
            </a>
            <a href="{{ route('admin.presensi') }}" class="nav-item active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                Presensi
            </a>
            <a href="{{ route('admin.pembimbing') }}" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
                Data Pembimbing
            </a>
            <a href="{{ route('admin.jurusan') }}"
   class="nav-item {{ request()->routeIs('admin.jurusan') ? 'active' : '' }}">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
    </svg>
    Data Jurusan
</a>

<a href="{{ route('admin.sekolah') }}"
   class="nav-item {{ request()->routeIs('admin.sekolah') ? 'active' : '' }}">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
        <polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    Data Sekolah/Kampus
</a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-content">
        <div class="page-header">
            <div class="page-header-title">Presensi Peserta</div>
        </div>

        <div class="page-body">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <div class="card">

                <!-- ACTION BAR -->
                <div class="action-bar">
    {{-- Tombol Atur Waktu --}}
    <div class="action-group">
    <span class="action-label">Buka Presensi</span>
    <button type="button" id="btn-buka-presensi" class="btn btn-primary btn-sm">
        Buka Presensi
    </button>
</div>

@if($presensi)
<div class="action-group">
    <span class="action-label">Tutup Presensi</span>
    <button type="button" id="btn-tutup-presensi" class="btn btn-outline btn-sm">
        Tutup Presensi
    </button>
</div>
@endif

    {{-- Simpan Perubahan Status --}}
    <div class="action-group">
        <span class="action-label">Simpan Perubahan Kehadiran</span>
        <button type="button" id="btn-simpan-status" class="btn btn-outline btn-sm">
            Ubah Kehadiran
        </button>
    </div>

    <div class="action-group">
        <span class="action-label">Rekap Presensi</span>
        <a href="{{ route('admin.rekap.presensi') }}" class="btn btn-outline btn-sm">Rekap Presensi</a>
    </div>
    <div class="action-group">
        <span class="action-label">Rekap Surat</span>
        <a href="{{ route('admin.rekap.surat') }}" class="btn btn-outline btn-sm">Rekap Surat</a>
    </div>
</div>

{{-- INFORMASI JADWAL PRESENSI --}}
            @if($presensi)
                <div style="margin-bottom:16px; padding:10px 14px; background:#F0FDF4; border:1px solid #BBF7D0; border-radius:8px; font-size:0.85rem; color:#166534;">
                    ⏰ Presensi dibuka: <strong>{{ \Carbon\Carbon::parse($presensi->jam_buka)->format('H:i') }} WITA</strong>
                    &nbsp;|&nbsp;
                    Ditutup: <strong>{{ \Carbon\Carbon::parse($presensi->jam_tutup)->format('H:i') }} WITA</strong>
                    @if($presensi->status == 'dibuka')
    <span style="color:#16A34A;font-weight:600;">
        (Sedang dibuka)
    </span>

@elseif($presensi->status == 'ditutup')
    <span style="color:#DC2626;font-weight:600;">
        (Sudah ditutup)
    </span>

@else
    <span style="color:var(--muted);">
        (Belum dibuka)
    </span>
@endif
                </div>
            @else
                <div style="margin-bottom:16px; padding:10px 14px; background:#FEF2F2; border:1px solid #FECACA; border-radius:8px; font-size:0.85rem; color:#C0392B;">
                    ⚠️ Belum ada jadwal presensi hari ini.
                </div>
            @endif


                <!-- TABLE -->
                <form id="form-presensi" method="POST" action="{{ route('admin.presensi.simpanStatus') }}">
                    @csrf
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>NISN/NIM</th>
                                    <th>Nama</th>
                                    <th>Waktu Presensi</th>
                                    <th>Status</th>
                                    <th>Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $i => $d)
                                <tr>
                                    <td>{{ $d->peserta->nisn_nim }}</td>
                                    <td>{{ $d->peserta->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tanggal_presensi)->timezone('Asia/Makassar')->format('d-m-Y H:i') }} WITA</td>
                                    <td>
                                        <select name="status[{{ $d->id_presensi_peserta }}]"
                                                class="status-select">
                                            <option value="hadir"  {{ $d->status_kehadiran == 'hadir'  ? 'selected' : '' }}>Hadir</option>
                                            <option value="izin"   {{ $d->status_kehadiran == 'izin'   ? 'selected' : '' }}>Izin</option>
                                            <option value="sakit"  {{ $d->status_kehadiran == 'sakit'  ? 'selected' : '' }}>Sakit</option>
                                            <option value="alpa"  {{ $d->status_kehadiran == 'alpa'  ? 'selected' : '' }}>Alpa</option>
                                        </select>
                                    </td>
                                    <td>
                                        @if($d->surat_pendukung_izin)
                                            <a href="{{ asset('storage/'.$d->surat_pendukung_izin) }}"
                                               target="_blank" class="surat-link">Lihat Surat</a>
                                        @else
                                            <span class="no-surat">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" style="text-align:center; color:var(--muted); padding:28px;">
                                        Belum ada data presensi hari ini
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>

            </div>
        </div>
    </div>
<script>

    document.getElementById('btn-buka-presensi').addEventListener('click', function () {

    Swal.fire({
        title: 'Buka Presensi',
        html:
            '<input id="swal-tanggal" type="date" class="swal2-input" value="{{ date("Y-m-d") }}">' +
            '<input id="swal-buka" type="time" class="swal2-input" value="08:00">' +
            '<input id="swal-tutup" type="time" class="swal2-input" value="16:00">',
        showCancelButton: true,
        confirmButtonText: 'Buka',
        preConfirm: () => {

            return {
                tanggal: document.getElementById('swal-tanggal').value,
                buka: document.getElementById('swal-buka').value,
                tutup: document.getElementById('swal-tutup').value
            };

        }

    }).then((result)=>{

        if(result.isConfirmed){

            const form=document.createElement('form');

            form.method='POST';

            form.action='{{ route("admin.presensi.buka") }}';

            form.innerHTML=`
                @csrf
                <input name="tanggal" value="${result.value.tanggal}">
                <input name="jam_buka" value="${result.value.buka}">
                <input name="jam_tutup" value="${result.value.tutup}">
            `;

            document.body.appendChild(form);

            form.submit();

        }

    });

});

document.getElementById('btn-simpan-status').addEventListener('click', function() {
    Swal.fire({
        title: 'Simpan Perubahan?',
        text: 'Status peserta akan diperbarui tanpa menutup presensi.',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya, Simpan',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-presensi').submit();
        }
    });
});

document.getElementById('btn-tutup-presensi').addEventListener('click', function(){

    Swal.fire({

        title:'Tutup Presensi?',

        text:'Peserta tidak dapat melakukan presensi lagi.',

        icon:'warning',

        showCancelButton:true,

        confirmButtonText:'Ya, Tutup'

    }).then((result)=>{

        if(result.isConfirmed){

            const form=document.createElement('form');

            form.method='POST';

            form.action='{{ $presensi ? route("admin.presensi.tutup", $presensi->id_presensi) : "#" }}';

            form.innerHTML='@csrf';

            document.body.appendChild(form);

            form.submit();

        }

    });

});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
