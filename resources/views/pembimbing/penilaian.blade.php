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

        <div class="header-title">
            Penilaian Peserta
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="header-logout-form">
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
                        <span class="info-label">NIS/NIM</span>
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
                            <span id="label-{{ $k->id_kriteria_nilai }}" class="kriteria-label">{{ $k->kriteria_nilai }}</span>

                            {{-- FORM EDIT (tersembunyi, muncul saat klik Edit) --}}
                            <form id="form-edit-{{ $k->id_kriteria_nilai }}"
                                  action="{{ route('pembimbing.kriteria.update', $k->id_kriteria_nilai) }}"
                                  method="POST"
                                  class="kriteria-edit-form">
                                @csrf
                                @method('PUT')
                                <input type="text" name="kriteria" value="{{ $k->kriteria_nilai }}">
                                <button type="submit" class="btn-simpan-kriteria">
                                    Simpan
                                </button>
                                <button type="button"
                                        onclick="cancelEdit({{ $k->id_kriteria_nilai }})"
                                        class="btn-batal-kriteria">
                                    Batal
                                </button>
                            </form>

                            <div id="aksi-{{ $k->id_kriteria_nilai }}" class="kriteria-aksi">
                                <button type="button"
                                        onclick="startEdit({{ $k->id_kriteria_nilai }})"
                                        class="btn-hapus" style="color:var(--gold);">
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
                        <div class="nilai-item">
                            <span class="nilai-label">
                                {{ $n->kriteria->kriteria_nilai }}
                            </span>

                            <form action="{{ route('pembimbing.penilaian.simpan', $peserta->id_peserta) }}"
                                  method="POST"
                                  class="nilai-update-form">
                                @csrf

                                <input type="hidden"
                                       name="kriteria_id"
                                       value="{{ $n->id_kriteria_nilai }}">

                                <input type="number"
                                       name="nilai"
                                       min="1"
                                       max="100"
                                       value="{{ $n->nilai }}"
                                       class="nilai-input">

                                <button type="submit"
                                        class="btn btn-primary btn-sm">
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