<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook Harian - Magang Poliban</title>
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
            --sidebar-w: 200px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--warm-white);
            border-right: 1px solid rgba(200,135,58,0.15);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 300;
            box-shadow: 2px 0 12px rgba(26,18,8,0.06);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

        /* ── SIDEBAR OVERLAY ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(26,18,8,0.45);
            z-index: 299;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .sidebar-overlay.is-open {
            display: block;
            opacity: 1;
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            padding: 20px 36px 0;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* Hamburger — hanya tampil di mobile */
        .btn-hamburger-sidebar {
            display: none;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 5px;
            width: 38px;
            height: 38px;
            background: transparent;
            border: 1px solid rgba(200,135,58,0.25);
            border-radius: 8px;
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
            transition: background 0.2s;
        }

        .btn-hamburger-sidebar:hover { background: rgba(200,135,58,0.1); }

        .btn-hamburger-sidebar span {
            display: block;
            width: 18px;
            height: 2px;
            background: var(--dark);
            border-radius: 2px;
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
            flex: 1;
            text-align: center;
        }

        /* Spacer kiri agar title center di desktop */
        .header-spacer {
            width: 38px;
            flex-shrink: 0;
        }

        /* ── PAGE BODY ── */
        .page-body { padding: 24px 36px 40px; }

        /* ── CARD ── */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 24px 28px;
        }

        /* ── ALERTS ── */
        .alert-success {
            background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534;
            font-size: 0.85rem; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;
        }

        .alert-error {
            background: #FEF2F2; border: 1px solid #FECACA; color: #C0392B;
            font-size: 0.85rem; padding: 12px 16px; border-radius: 10px; margin-bottom: 16px;
        }

        /* ── FORM ── */
        .form-row {
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            gap: 16px;
            align-items: end;
            margin-bottom: 24px;
        }

        .field { display: flex; flex-direction: column; gap: 5px; }

        .field label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--muted);
        }

        .field input[type="date"],
        .field textarea {
            padding: 9px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            transition: border-color 0.2s;
        }

        .field input[type="date"]:focus,
        .field textarea:focus { border-color: var(--gold); }

        .field textarea {
            resize: vertical;
            min-height: 42px;
            min-width: 200px;
        }

        /* ── FILE INPUT ── */
        .file-field { display: flex; flex-direction: column; gap: 5px; }

        .file-field label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--muted);
        }

        .file-btn-wrap {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .file-pick-btn {
            padding: 8px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            background: var(--warm-white);
            color: var(--dark);
            cursor: pointer;
            text-align: center;
            white-space: nowrap;
        }

        input[type="file"] { display: none; }

        .btn-kirim {
            padding: 9px 24px;
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            box-shadow: 0 4px 12px rgba(200,135,58,0.3);
            align-self: flex-end;
            white-space: nowrap;
        }

        .btn-kirim:hover { background: var(--gold-light); transform: translateY(-1px); }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; margin-top: 8px; }

        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }

        thead tr { background: var(--cream); }
        thead th {
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.82rem;
            color: var(--muted);
            border-bottom: 2px solid #E8D5B5;
            white-space: nowrap;
        }

        tbody tr { border-bottom: 1px solid #F5E6D0; transition: background 0.15s; }
        tbody tr:hover { background: #FFFDF9; }
        tbody td { padding: 10px 14px; color: var(--dark); vertical-align: middle; }

        .empty-row td {
            text-align: center;
            color: var(--muted);
            padding: 28px;
        }

        .bukti-img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 6px;
            object-fit: cover;
        }

        .btn-edit {
            background: #C8873A;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 0.78rem;
            cursor: pointer;
            margin-left: 8px;
        }

        .btn-edit:hover { background: #E8A85A; }

        .btn-cetak {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 50px;
            background: var(--gold);
            color: #fff;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(200,135,58,0.3);
            margin-bottom: 16px;
        }

        .btn-cetak:hover { background: var(--gold-light); }

        /* ══════════════════════════════════════════
           RESPONSIVE — MOBILE (≤768px)
        ══════════════════════════════════════════ */
        @media (max-width: 768px) {

            /* Sidebar jadi drawer */
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.is-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            /* Page header */
            .page-header {
                padding: 16px 12px 0;
                gap: 10px;
            }

            .btn-hamburger-sidebar {
                display: flex;
            }

            /* Sembunyikan spacer — tidak perlu centering trick di mobile */
            .header-spacer {
                display: none;
            }

            .page-header-title {
                font-size: 1rem;
                padding: 10px 20px;
                border-radius: 12px;
                text-align: left;
            }

            /* Page body */
            .page-body {
                padding: 16px 12px 32px;
            }

            .card {
                padding: 18px 16px;
            }

            /* Form: stack semua field jadi 1 kolom */
            .form-row {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .field textarea {
                min-width: 0;
                width: 100%;
            }

            .btn-kirim {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            /* Tabel: kolom No & Tanggal lebih rapat */
            thead th,
            tbody td {
                padding: 8px 10px;
                font-size: 0.8rem;
            }

            /* Gambar bukti lebih kecil di mobile */
            .bukti-img {
                max-width: 56px;
                max-height: 56px;
            }

            /* Tombol Cetak PDF full width */
            .btn-cetak {
                width: 100%;
                justify-content: center;
            }
        }

        /* ══════════════════════════════════════════
           RESPONSIVE — SMALL MOBILE (≤400px)
        ══════════════════════════════════════════ */
        @media (max-width: 400px) {
            .page-header-title {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            thead th,
            tbody td {
                font-size: 0.75rem;
                padding: 7px 8px;
            }

            .bukti-img {
                max-width: 44px;
                max-height: 44px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR OVERLAY -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
        </div>
        <nav class="sidebar-nav">
            <a href="/dashboard-peserta" class="nav-item">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                    <rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('peserta.logbook') }}" class="nav-item active">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
                Logbook Harian
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('peserta.logout') }}" method="POST">
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
            <!-- Hamburger (mobile only) -->
            <button class="btn-hamburger-sidebar" id="btnOpenSidebar" aria-label="Buka menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <div class="page-header-title">Logbook Harian</div>

            <!-- Spacer agar title center di desktop -->
            <div class="header-spacer"></div>
        </div>

        <div class="page-body">



            <div class="card">

                {{-- Tombol Cetak PDF --}}
                <a href="{{ route('peserta.logbook.export.pdf') }}" class="btn-cetak" target="_blank">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9"/>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                    Cetak PDF
                </a>

                {{-- FORM CREATE --}}
                @if(!$presensiHariIni)
                    <div style="text-align:center; padding:20px; color:var(--muted); font-size:0.9rem;">
                        ⚠️ Anda belum melakukan presensi hari ini. Silakan presensi terlebih dahulu.
                    </div>
                @elseif(!$logbookHariIni)
                    <form action="{{ route('peserta.logbook.store') }}" method="POST"
                          enctype="multipart/form-data" id="form-logbook">
                        @csrf
                        <div class="form-row">
                            <div class="field">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" readonly required>
                            </div>
                            <div class="field">
                                <label>Kegiatan</label>
                                <textarea name="kegiatan" rows="2" required></textarea>
                            </div>
                            <div class="file-field">
                                <label>Bukti Kegiatan</label>
                                <div class="file-btn-wrap">
                                    <label for="bukti-input" class="file-pick-btn" id="file-label">Pilih File</label>
                                    <input type="file" id="bukti-input" name="bukti_foto"
                                           accept="image/*"
                                           onchange="document.getElementById('file-label').textContent = this.files[0]?.name || 'Pilih File'">
                                </div>
                            </div>
                            <button type="submit" class="btn-kirim">Kirim</button>
                        </div>
                    </form>
                @else
                    <div style="margin-bottom:20px; padding:12px; background:#FFFDF9; border:1px solid #E8D5B5; border-radius:8px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                            <strong>Logbook Hari Ini ({{ \Carbon\Carbon::parse($logbookHariIni->tanggal)->format('d-m-Y') }})</strong>
                            @if($bisaEdit)
                                <button class="btn-edit" onclick="editLogbook({{ $logbookHariIni->id_logbook }})">Edit</button>
                            @else
                                <span style="font-size:0.8rem; color:var(--muted);">Terkunci (Presensi sudah ditutup)</span>
                            @endif
                        </div>
                        <p style="margin-top:8px;">{{ $logbookHariIni->kegiatan }}</p>
                        @if($logbookHariIni->bukti_foto)
                            <div style="margin-top:8px;">
                                @php $ext = pathinfo($logbookHariIni->bukti_foto, PATHINFO_EXTENSION); @endphp
                                @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                    <img src="{{ asset('storage/'.$logbookHariIni->bukti_foto) }}" class="bukti-img" alt="Bukti">
                                @else
                                    <a href="{{ asset('storage/'.$logbookHariIni->bukti_foto) }}" target="_blank">Lihat Bukti (PDF)</a>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <!-- TABLE -->
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $i => $d)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td style="white-space:nowrap;">{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $d->kegiatan }}</td>
                                <td>
                                    @if($d->bukti_foto)
                                        @php $ext = pathinfo($d->bukti_foto, PATHINFO_EXTENSION); @endphp
                                        @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                            <img src="{{ asset('storage/'.$d->bukti_foto) }}" class="bukti-img" alt="Bukti">
                                        @else
                                            <a href="{{ asset('storage/'.$d->bukti_foto) }}" target="_blank" style="color:var(--gold); font-size:0.8rem;">PDF</a>
                                        @endif
                                    @else
                                        <span style="color:var(--muted); font-size:0.8rem;">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr class="empty-row">
                                <td colspan="4">Belum ada data logbook</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        confirmButtonText: 'OK',
        confirmButtonColor: '#C8873A'
    });
});
</script>
@endif

@if($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal',
        html: `
            <ul style="text-align:left; margin:0; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `,
        confirmButtonText: 'OK',
        confirmButtonColor: '#C8873A'
    });
});
</script>
@endif
    <script>
        // ── Sidebar drawer ──
        const sidebar        = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const btnOpen        = document.getElementById('btnOpenSidebar');

        function openSidebar() {
            sidebar.classList.add('is-open');
            sidebarOverlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('is-open');
            sidebarOverlay.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        btnOpen.addEventListener('click', openSidebar);
        sidebarOverlay.addEventListener('click', closeSidebar);

        document.querySelectorAll('.nav-item').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });

        // ── Edit Logbook ──
        const updateUrlBase = "{{ route('peserta.logbook.update', ['id' => '__ID__']) }}";

        function editLogbook(id) {
            Swal.fire({
                title: 'Edit Logbook',
                html: `
                    <textarea id="swal-kegiatan" class="swal2-textarea" placeholder="Kegiatan"
                              style="height:100px; width:100%;">${ "{{ $logbookHariIni ? addslashes($logbookHariIni->kegiatan) : '' }}" }</textarea>
                    <div style="margin-top:12px; text-align:left;">
                        <label for="swal-bukti" style="display:inline-block; background:#C8873A; color:#fff;
                               padding:8px 16px; border-radius:6px; cursor:pointer; font-size:0.85rem;">
                            Ubah Gambar
                        </label>
                        <input type="file" id="swal-bukti" accept="image/*" style="display:none;">
                        <span id="swal-file-name" style="margin-left:10px; font-size:0.8rem; color:var(--muted);"></span>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                didOpen: () => {
                    document.getElementById('swal-bukti').addEventListener('change', function() {
                        document.getElementById('swal-file-name').textContent = this.files[0]?.name || '';
                    });
                },
                preConfirm: () => {
                    const kegiatan = document.getElementById('swal-kegiatan').value;
                    if (!kegiatan) {
                        Swal.showValidationMessage('Kegiatan wajib diisi');
                        return false;
                    }
                    return { kegiatan, file: document.getElementById('swal-bukti').files[0] || null };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method', 'PUT');
                    formData.append('kegiatan', result.value.kegiatan);
                    if (result.value.file) formData.append('bukti_foto', result.value.file);

                    fetch(updateUrlBase.replace('__ID__', id), {
                        method: 'POST',
                        body: formData,
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(r => r.json().then(data => ({ ok: r.ok, data })))
                    .then(({ ok, data }) => {
                        if (ok) {
                            Swal.fire('Berhasil', data.message || 'Logbook berhasil diperbarui', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Gagal', data.message || 'Terjadi kesalahan', 'error');
                        }
                    })
                    .catch(() => Swal.fire('Gagal', 'Terjadi kesalahan jaringan', 'error'));
                }
            });
        }
    </script>

</body>
</html>
