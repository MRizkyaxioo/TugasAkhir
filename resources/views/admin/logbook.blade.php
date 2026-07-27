<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Logbook - {{ $peserta->nama }} | Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/logbook.css') }}">
</head>
<body>

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
            <a href="{{ route('admin.peserta') }}" class="nav-item active">
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
            <a href="{{ route('admin.presensi') }}" class="nav-item">
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

    <!-- OVERLAY UNTUK MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="page-header">
            <button class="btn-hamburger" id="btnHamburger" aria-label="Buka menu" type="button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="6" x2="21" y2="6"/>
                    <line x1="3" y1="12" x2="21" y2="12"/>
                    <line x1="3" y1="18" x2="21" y2="18"/>
                </svg>
            </button>
            <div class="page-header-title">Logbook {{ $peserta->nama }}</div>
        </div>

        <div class="page-body">
            <!-- Info Peserta -->
            <div class="card" style="margin-bottom:20px;">
                <div class="info-flex">
                    <div><strong>Nama:</strong> {{ $peserta->nama }}</div>
                    <div><strong>NIS/NIM:</strong> {{ $peserta->nisn_nim }}</div>
                    <div><strong>Sekolah:</strong> {{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</div>
                    <div><strong>Jurusan:</strong> {{ $peserta->jurusan->jurusan ?? '-' }}</div>
                </div>
            </div>



            <!-- Tabel Logbook -->
            <div class="card">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kegiatan</th>
                                <th>Bukti Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="logbookTableBody">
                            @forelse($data as $i => $d)
                            <tr data-id="{{ $d->id_logbook }}">
                                <td data-label="No">{{ $i + 1 }}</td>
                                <td data-label="Tanggal" class="cell-tanggal">{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                                <td data-label="Kegiatan" class="cell-kegiatan">{{ $d->kegiatan }}</td>
                                <td data-label="Bukti Kegiatan" class="cell-bukti">
                                    @if($d->bukti_foto)
                                        @php $ext = pathinfo($d->bukti_foto, PATHINFO_EXTENSION); @endphp
                                        @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                            <img src="{{ asset('storage/'.$d->bukti_foto) }}" class="bukti-img" alt="Bukti">
                                        @else
                                            <a href="{{ asset('storage/'.$d->bukti_foto) }}" target="_blank" class="bukti-link">Lihat Bukti</a>
                                        @endif
                                    @else
                                        <span style="color:var(--muted); font-size:0.8rem;">-</span>
                                    @endif
                                </td>
                                <td data-label="Aksi">
                                    <button type="button" class="btn-icon-edit"
                                        onclick='openEditModal({{ $d->id_logbook }}, "{{ \Carbon\Carbon::parse($d->tanggal)->format('Y-m-d') }}", {{ json_encode($d->kegiatan) }})'>
                                        Edit
                                    </button>
                                    <button type="button" class="btn-icon-delete" onclick="hapusLogbook({{ $d->id_logbook }})">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr class="empty-row" id="emptyRow">
                                <td colspan="5">Belum ada data logbook</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="action-row">
    <button type="button" class="btn btn-primary" onclick="openTambahModal()">
        + Tambah Logbook
    </button>

    <a href="{{ route('admin.logbook.pdf', $peserta->id_peserta) }}"
       class="btn btn-primary">
        Cetak PDF
    </a>

    <a href="{{ route('admin.peserta') }}" class="btn btn-outline">
        ← Kembali ke Daftar Peserta
    </a>
</div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Logbook -->
    <div id="logbookModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <h3 id="modalTitle">Tambah Logbook</h3>
            <form id="logbookForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="logbookId" value="">
                <input type="hidden" id="formMode" value="tambah">

                <label for="tanggalInput">Tanggal</label>
                <input type="date" id="tanggalInput" name="tanggal" required>

                <label for="kegiatanInput">Kegiatan</label>
                <textarea id="kegiatanInput" name="kegiatan" rows="3" required></textarea>

                <label for="buktiInput">Bukti Kegiatan (kosongkan jika tidak ingin ganti)</label>
                <input type="file" id="buktiInput" name="bukti_foto" accept=".jpg,.jpeg,.png,.gif,.heic,.heif">

                <div class="modal-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-outline" onclick="closeLogbookModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <style>
    .modal-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,0.5);
        display: flex; align-items: center; justify-content: center; z-index: 999;
    }
    .modal-box {
        background: #fff; padding: 24px; border-radius: 12px;
        width: 90%; max-width: 420px;
    }
    .modal-box label { display:block; margin-top:12px; font-weight:500; font-size:0.9rem; }
    .modal-box input, .modal-box textarea {
        width: 100%; padding: 8px; margin-top:4px; border:1px solid #ddd; border-radius:6px;
        font-family: inherit; box-sizing: border-box;
    }
    .modal-actions { margin-top:18px; display:flex; gap:10px; justify-content:flex-end; }
    .btn-icon-edit, .btn-icon-delete {
        border:none; padding:5px 10px; border-radius:6px; font-size:0.8rem; cursor:pointer; margin-right:4px;
    }
    .btn-icon-edit { background:#e6b96a; color:#fff; }
    .btn-icon-delete { background:#e05656; color:#fff; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/admin/sidebar.js') }}"></script>
    <script src="{{ asset('js/admin/admin.js') }}"></script>

    <script>
    const pesertaId = {{ $peserta->id_peserta }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const todayStr = new Date().toISOString().split('T')[0]; // batas tanggal maksimal (hari ini)

    function openTambahModal() {
        document.getElementById('modalTitle').innerText = 'Tambah Logbook';
        document.getElementById('formMode').value = 'tambah';
        document.getElementById('logbookId').value = '';
        document.getElementById('tanggalInput').value = '';
        document.getElementById('tanggalInput').max = todayStr;
        document.getElementById('kegiatanInput').value = '';
        document.getElementById('buktiInput').value = '';
        document.getElementById('logbookModal').style.display = 'flex';
    }

    function openEditModal(id, tanggal, kegiatan) {
        document.getElementById('modalTitle').innerText = 'Edit Logbook';
        document.getElementById('formMode').value = 'edit';
        document.getElementById('logbookId').value = id;
        document.getElementById('tanggalInput').value = tanggal;
        document.getElementById('tanggalInput').max = todayStr;
        document.getElementById('kegiatanInput').value = kegiatan;
        document.getElementById('buktiInput').value = '';
        document.getElementById('logbookModal').style.display = 'flex';
    }

    function closeLogbookModal() {
        document.getElementById('logbookModal').style.display = 'none';
    }

    document.getElementById('logbookForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const mode = document.getElementById('formMode').value;
        const id = document.getElementById('logbookId').value;
        const formData = new FormData(this);

        let url = mode === 'tambah'
            ? `/admin/logbook/${pesertaId}/store`
            : `/admin/logbook/update/${id}`;

        if (mode === 'edit') {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async res => {
            const data = await res.json();
            if (!res.ok) {
                throw data;
            }
            return data;
        })
        .then(data => {
            closeLogbookModal();
            Swal.fire({ icon: 'success', title: data.message, timer: 1800, showConfirmButton: false });
            setTimeout(() => location.reload(), 900);
        })
        .catch(err => {
            const firstError = err.errors
                ? Object.values(err.errors)[0][0]
                : (err.message || 'Gagal menyimpan logbook.');
            Swal.fire({ icon: 'error', title: 'Gagal', text: firstError });
        });
    });

    function hapusLogbook(id) {
        Swal.fire({
            title: 'Hapus logbook ini?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/logbook/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    Swal.fire({ icon: 'success', title: data.message, timer: 1500, showConfirmButton: false });
                    setTimeout(() => location.reload(), 800);
                })
                .catch(() => {
                    Swal.fire({ icon: 'error', title: 'Gagal menghapus logbook' });
                });
            }
        });
    }
    </script>

</body>
</html>
