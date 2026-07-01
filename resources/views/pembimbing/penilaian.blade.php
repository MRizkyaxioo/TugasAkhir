<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Peserta - Pembimbing</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pembimbing/penilaian.css') }}">
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
                        <span class="info-label">NISN/NIM</span>
                        <span class="info-value">{{ $peserta->nisn_nim }}</span>
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
    <script src="{{ asset('js/pembimbing/penilaian.js') }}"></script>
</body>
</html>
