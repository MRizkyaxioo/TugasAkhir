<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook Harian - Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/logbook.css') }}">
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
