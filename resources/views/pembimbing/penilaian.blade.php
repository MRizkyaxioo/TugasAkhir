<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Peserta - Pembimbing</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --cream: #F5E6D0;
            --warm-white: #FDF4E7;
            --gold: #C8873A;
            --gold-light: #E8A85A;
            --dark: #1A1208;
            --muted: #7A6E62;
            --card-bg: #FFFFFF;
            --shadow: 0 4px 24px rgba(26,18,8,0.08);
            --radius: 16px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--cream);
            font-family: 'DM Sans', sans-serif;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
        header {
            background: var(--warm-white);
            border-bottom: 1px solid rgba(200,135,58,0.15);
            padding: 18px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(26,18,8,0.05);
            position: relative;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-wrap {
            width: 52px; height: 52px;
            display: flex; align-items: center; justify-content: center;
        }

        .logo-wrap img { width: 100%; height: 100%; object-fit: contain; }

        .header-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--dark);
            border: 2px solid rgba(200,135,58,0.25);
            padding: 8px 28px;
            border-radius: 50px;
            background: var(--card-bg);
            box-shadow: var(--shadow);
        }

        .btn-logout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--gold);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            box-shadow: 0 4px 14px rgba(200,135,58,0.35);
        }

        .btn-logout:hover { background: var(--gold-light); }

        /* MAIN */
        main { flex: 1; padding: 32px 48px 24px; }

        /* GRID */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .left-col { display: flex; flex-direction: column; gap: 16px; }
        .right-col { display: flex; flex-direction: column; gap: 16px; }

        /* CARD */
        .card {
            background: var(--card-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid rgba(200,135,58,0.08);
            padding: 20px 24px;
        }

        .card-label {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
            text-align: center;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 1px solid #F5E6D0;
        }

        /* INFO */
        .info-row {
            display: flex;
            align-items: baseline;
            padding: 7px 0;
            border-bottom: 1px solid #F5E6D0;
            gap: 10px;
        }

        .info-row:last-child { border-bottom: none; }

        .info-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--muted);
            width: 120px;
            flex-shrink: 0;
        }

        .info-label::after { content: ' :'; }
        .info-value { font-size: 0.85rem; color: var(--dark); }

        /* ALERT */
        .alert-success {
            background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534;
            font-size: 0.82rem; padding: 10px 14px; border-radius: 8px;
        }

        .alert-error {
            background: #FEF2F2; border: 1px solid #FECACA; color: #C0392B;
            font-size: 0.82rem; padding: 10px 14px; border-radius: 8px;
        }

        /* KRITERIA LIST */
        .kriteria-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #F5E6D0;
            font-size: 0.875rem;
        }

        .kriteria-item:last-child { border-bottom: none; }

        .nilai-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 7px 0;
            border-bottom: 1px solid #F5E6D0;
            font-size: 0.875rem;
        }

        .nilai-item:last-child { border-bottom: none; }

        .nilai-score {
            font-weight: 600;
            color: var(--gold);
        }

        /* FORM */
        .field { display: flex; flex-direction: column; gap: 5px; margin-bottom: 12px; }

        .field label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--muted);
        }

        .field input {
            padding: 9px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            width: 100%;
            transition: border-color 0.2s;
        }

        .field input:focus { border-color: var(--gold); }

        /* SELECT */
        .styled-select {
            width: 100%;
            padding: 9px 32px 9px 14px;
            border: 1.5px solid #E8D5B5;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            color: var(--dark);
            background: var(--warm-white);
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237A6E62' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            transition: border-color 0.2s;
            margin-bottom: 10px;
        }

        .styled-select:focus { border-color: var(--gold); }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 9px 20px;
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

        .empty-text {
            text-align: center;
            color: var(--muted);
            font-size: 0.82rem;
            padding: 12px 0;
        }

        /* FOOTER */
        footer { padding: 16px 48px 40px; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 22px;
            background: var(--gold);
            border: none;
            border-radius: 50px;
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
            box-shadow: 0 4px 12px rgba(200,135,58,0.3);
        }

        .btn-back:hover { background: var(--gold-light); }

        @media (max-width: 900px) {
            .content-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 600px) {
            header, main, footer { padding-left: 20px; padding-right: 20px; }
        }

        .btn-hapus {
    background: none;
    border: none;
    color: #C0392B;
    cursor: pointer;
    font-size: 0.8rem;
    margin-left: 10px;
    text-decoration: underline;
}
.btn-hapus:hover { color: #E74C3C; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
    <div class="logo-wrap">
        <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
    </div>

    <div class="header-title" style="position:absolute; left:50%; transform:translateX(-50%);">
        Penilaian Peserta
    </div>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">
            Logout
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
        </button>
    </form>
</header>

    <!-- MAIN -->
    <main>

        @if(session('success'))
            <div class="alert-success" style="margin-bottom:16px;">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert-error" style="margin-bottom:16px;">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif

        <div class="content-grid">

            <!-- KOLOM KIRI -->
            <div class="left-col">

                <!-- Info Peserta -->
                <div class="card">
                    <div class="card-label">Penilaian Peserta Magang</div>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value">{{ $peserta->nama }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Sekolah/Kampus</span>
                        <span class="info-value">{{ $peserta->sekolahKampus->nama_sekolah_kampus ?? '-' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jurusan</span>
                        <span class="info-value">{{ $peserta->jurusan->jurusan ?? '-' }}</span>
                    </div>
                </div>

                <!-- Daftar Kriteria -->
                <div class="card">
    <div class="card-label">Daftar Kriteria Penilaian</div>
    @forelse($kriteria as $k)
        <div class="kriteria-item">
            <span id="label-{{ $k->id_kriteria_nilai }}">{{ $k->kriteria_nilai }}</span>

            {{-- FORM EDIT (tersembunyi, muncul saat klik Edit) --}}
            <form id="form-edit-{{ $k->id_kriteria_nilai }}"
                  action="{{ route('pembimbing.kriteria.update', $k->id_kriteria_nilai) }}"
                  method="POST"
                  style="display:none; flex:1; margin-left:10px; gap:6px; align-items:center;">
                @csrf
                @method('PUT')
                <input type="text" name="kriteria"
                       value="{{ $k->kriteria_nilai }}"
                       style="flex:1; padding:5px 10px; border:1.5px solid #E8D5B5; border-radius:8px;
                              font-family:'DM Sans',sans-serif; font-size:0.82rem; outline:none;">
                <button type="submit"
                        style="padding:4px 12px; background:var(--gold); color:#fff; border:none;
                               border-radius:50px; font-size:0.78rem; cursor:pointer;">
                    Simpan
                </button>
                <button type="button"
                        onclick="cancelEdit({{ $k->id_kriteria_nilai }})"
                        style="padding:4px 12px; background:none; border:1px solid #E8D5B5;
                               border-radius:50px; font-size:0.78rem; cursor:pointer; color:var(--muted);">
                    Batal
                </button>
            </form>

            <div id="aksi-{{ $k->id_kriteria_nilai }}" style="display:flex; gap:8px; align-items:center;">
                <button type="button"
                        onclick="startEdit({{ $k->id_kriteria_nilai }})"
                        style="background:none; border:none; color:var(--gold); cursor:pointer;
                               font-size:0.8rem; text-decoration:underline;">
                    Edit
                </button>
                <form action="{{ route('pembimbing.kriteria.delete', $k->id_kriteria_nilai) }}"
                      method="POST" class="form-hapus-kriteria" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-hapus btn-hapus-kriteria">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="empty-text">Belum ada kriteria</p>
    @endforelse
</div>

                <!-- Nilai yang sudah diberikan -->
                <div class="card">
    <div class="card-label">Nilai Peserta Magang</div>
    @forelse($peserta->penilaian as $n)
        <div class="nilai-item" style="align-items:center; gap:10px;">
    <span style="flex:1;">
        {{ $n->kriteria->kriteria_nilai }}
    </span>

    <form action="{{ route('pembimbing.penilaian.simpan', $peserta->id_peserta) }}"
          method="POST"
          style="display:flex; align-items:center; gap:8px;">
        @csrf

        <input type="hidden"
               name="kriteria_id"
               value="{{ $n->id_kriteria_nilai }}">

        <input type="number"
               name="nilai"
               min="1"
               max="100"
               value="{{ $n->nilai }}"
               style="width:80px; padding:6px 10px;
                      border:1.5px solid #E8D5B5;
                      border-radius:8px;">

        <button type="submit"
                class="btn btn-primary"
                style="padding:6px 14px;">
            Update
        </button>
    </form>

    <form action="{{ route('pembimbing.penilaian.delete', ['peserta' => $peserta->id_peserta, 'kriteria' => $n->id_kriteria_nilai]) }}"
          method="POST"
          class="form-hapus-nilai">
        @csrf
        @method('DELETE')

        <button type="button"
                class="btn-hapus btn-hapus-nilai">
            Hapus
        </button>
    </form>
</div>
    @empty
        <p class="empty-text">Belum ada nilai</p>
    @endforelse
</div>

            </div>

            <!-- KOLOM KANAN -->
            <div class="right-col">

                <!-- Tambah Kriteria -->
                <div class="card">
                    <div class="card-label">Tambah Kriteria Penilaian</div>
                    <form action="{{ route('pembimbing.kriteria.store') }}" method="POST">
                        @csrf
                        <div class="field">
                            <input type="text" name="kriteria" placeholder="Tambah Kriteria" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%;">Tambah</button>
                    </form>
                </div>

                <!-- Pilih Kriteria & Input Nilai -->
                <div class="card">
                    <div class="card-label">Pilih Kriteria Penilaian</div>
                    <form method="GET">
                        <select name="kriteria_id" class="styled-select">
                            <option value="">Pilih Kriteria Penilaian</option>
                            @foreach($kriteria as $k)
                                <option value="{{ $k->id_kriteria_nilai }}"
                                    {{ request('kriteria_id') == $k->id_kriteria_nilai ? 'selected' : '' }}>
                                    {{ $k->kriteria_nilai }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary" style="width:100%;">Pilih</button>
                    </form>

                    @if(request('kriteria_id'))
                        @php $selected = $kriteria->firstWhere('id_kriteria_nilai', request('kriteria_id')); @endphp
                        @if($selected)
                            <hr style="border:none; border-top:1px solid #F5E6D0; margin:14px 0;">
                            <form method="POST" action="{{ route('pembimbing.penilaian.simpan', $peserta->id_peserta) }}">
                                @csrf
                                <input type="hidden" name="kriteria_id" value="{{ $selected->id_kriteria_nilai }}">
                                <div class="field">
                                    <label>Nilai untuk: {{ $selected->kriteria_nilai }}</label>
                                    <input type="number" name="nilai" min="1" max="100"
                                           placeholder="Masukkan nilai (1-100)"
                                           value="{{ $nilaiLama[$selected->id_kriteria_nilai]->nilai ?? '' }}"
                                           required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width:100%;">Simpan Nilai</button>
                            </form>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer>
        <a href="{{ route('pembimbing.dashboard') }}" class="btn-back">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
function startEdit(id) {
    document.getElementById('label-' + id).style.display = 'none';
    document.getElementById('aksi-' + id).style.display = 'none';
    const form = document.getElementById('form-edit-' + id);
    form.style.display = 'flex';
}

function cancelEdit(id) {
    document.getElementById('label-' + id).style.display = 'inline';
    document.getElementById('aksi-' + id).style.display = 'flex';
    document.getElementById('form-edit-' + id).style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    // Hapus kriteria
    document.querySelectorAll('.btn-hapus-kriteria').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const form = this.closest('form');
            Swal.fire({
                title: 'Hapus Kriteria?',
                text: 'Semua nilai yang menggunakan kriteria ini juga akan terhapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#C0392B',
                cancelButtonColor: '#7A6E62',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                background: '#FFFDF9',
                color: '#1A1208'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Hapus nilai
    document.querySelectorAll('.btn-hapus-nilai').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const form = this.closest('form');
            Swal.fire({
                title: 'Hapus Nilai?',
                text: 'Nilai ini akan dihapus dari peserta.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#C0392B',
                cancelButtonColor: '#7A6E62',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
                background: '#FFFDF9',
                color: '#1A1208'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

</body>
</html>
