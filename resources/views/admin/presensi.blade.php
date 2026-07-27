<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Peserta - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/presensi.css') }}">
</head>
<body>

    <!-- OVERLAY (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebarAdmin">
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
            <button type="button" class="btn-hamburger-admin" id="btnHamburger" aria-label="Buka menu">
                <span></span><span></span><span></span>
            </button>
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
                    <div class="action-group">
                        <span class="action-label">Buka Presensi</span>
                        <button type="button" id="btn-buka-presensi" class="btn btn-primary btn-sm">
                            Buka Presensi
                        </button>
                    </div>

                    @if($presensi && $presensi->status == 'dibuka')
<div class="action-group">
    <span class="action-label">Tutup Presensi</span>
    <button type="button" id="btn-tutup-presensi" class="btn btn-outline btn-sm">
        Tutup Presensi
    </button>
</div>
@endif

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
                    <div class="info-jadwal info-jadwal-ok">
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
                    <div class="info-jadwal info-jadwal-kosong">
                        ⚠️ Belum ada jadwal presensi hari ini.
                    </div>
                @endif

                <!-- TABLE -->
                <form id="form-presensi">
                    @csrf
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>NIS/NIM</th>
                                    <th>Nama</th>
                                    <th>Waktu Presensi</th>
                                    <th>Status</th>
                                    <th>Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $i => $d)
                                <tr>
                                    <td data-label="NISN/NIM">{{ $d->peserta->nisn_nim }}</td>
                                    <td data-label="Nama">{{ $d->peserta->nama }}</td>
                                    <td data-label="Waktu Presensi">{{ \Carbon\Carbon::parse($d->tanggal_presensi)->timezone('Asia/Makassar')->format('d-m-Y H:i') }} WITA</td>
                                    <td data-label="Status">
                                        <select
                                            class="status-select"
                                            data-id="{{ $d->id_presensi_peserta }}"
                                        >
                                            <option value="hadir" {{ $d->status_kehadiran == 'hadir' ? 'selected' : '' }}>
                                                Hadir
                                            </option>

                                            <option value="izin" {{ $d->status_kehadiran == 'izin' ? 'selected' : '' }}>
                                                Izin
                                            </option>

                                            <option value="sakit" {{ $d->status_kehadiran == 'sakit' ? 'selected' : '' }}>
                                                Sakit
                                            </option>

                                            <option value="alpa" {{ $d->status_kehadiran == 'alpa' ? 'selected' : '' }}>
                                                Alpa
                                            </option>
                                        </select>
                                    </td>
                                    <td data-label="Surat">
                                        @if($d->surat_pendukung_izin)
                                            <a href="{{ asset('storage/'.$d->surat_pendukung_izin) }}"
                                               target="_blank" class="surat-link">Lihat Surat</a>
                                        @else
                                            <span class="no-surat">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="5">
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

    <script src="{{ asset('js/admin/sidebar.js') }}"></script>

    <!-- JS tetap inline karena mengandung Blade syntax -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        document.getElementById('btn-tutup-presensi') && document.getElementById('btn-tutup-presensi').addEventListener('click', function(){

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

        document.querySelectorAll('.status-select').forEach(function(select){

            select.addEventListener('change', function(){

                fetch("{{ route('admin.presensi.updateStatus') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        id: this.dataset.id,
                        status: this.value
                    })
                })
                .then(response => response.json())
                .then(data => {

                    if(data.success){

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Status berhasil diperbarui',
                            showConfirmButton: false,
                            timer: 1200
                        });

                    }else{

                        Swal.fire(
                            'Gagal',
                            'Status tidak berhasil diperbarui.',
                            'error'
                        );

                    }

                })
                .catch(() => {

                    Swal.fire(
                        'Error',
                        'Terjadi kesalahan pada server.',
                        'error'
                    );

                });

            });

        });
    </script>
</body>
</html>
