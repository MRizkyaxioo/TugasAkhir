<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang Perpustakaan Poliban</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/peserta/landing.css') }}">
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="nav-brand">
            <div class="nav-logo">
                <img src="{{ asset('images/logo-poliban.jpg') }}" alt="Logo Poliban">
            </div>
            <div class="nav-brand-text">
                Perpustakaan Poliban
                <span>Penerimaan Peserta Magang</span>
            </div>
        </div>

        {{-- Desktop nav links — Alumni ditambahkan di antara Alur Magang dan Informasi --}}
        <ul class="nav-links">
            <li><a href="#beranda">Beranda</a></li>
            <li><a href="#alumni">Alumni</a></li>
            <li><a href="#alur">Alur Magang</a></li>
            <li><a href="#informasi">Informasi</a></li>
            <li><a href="#kontak">Kontak Kami</a></li>
        </ul>

        <a href="{{ route('peserta.login') }}" class="btn-nav-login">
            Login
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </a>

        <!-- Tombol hamburger (hanya muncul di mobile) -->
        <button class="btn-hamburger" id="btnHamburger" aria-label="Buka menu navigasi">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </nav>

    <!-- MOBILE MENU DRAWER -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-overlay" id="menuOverlay"></div>
        <div class="mobile-menu-panel">
            <div class="mobile-menu-header">
                <div class="nav-brand-text">
                    Perpustakaan Poliban
                    <span>Penerimaan Peserta Magang</span>
                </div>
                <button class="btn-close-menu" id="btnCloseMenu" aria-label="Tutup menu">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            <ul class="mobile-nav-links">
                <li>
                    <a href="#beranda" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <a href="#alumni" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        Alumni
                    </a>
                </li>
                <li>
                    <a href="#alur" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                        Alur Magang
                    </a>
                </li>
                <li>
                    <a href="#informasi" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        Informasi
                    </a>
                </li>
                <li>
                    <a href="#kontak" class="menu-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.61 5.61l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        Kontak Kami
                    </a>
                </li>
            </ul>

            <div class="mobile-menu-footer">
                <a href="{{ route('peserta.login') }}" class="btn-nav-login">
                    Login
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- HERO -->
    <section id="beranda" style="padding:0;">
        <div class="hero">
            <img src="{{ asset('images/perpustakaan.jpg') }}" alt="Perpustakaan Poliban" class="hero-img">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="hero-badge">Politeknik Negeri Banjarmasin</div>
                <h1 class="hero-title">
                    Sistem Pengelolaan Peserta Magang<br>
                    <em>Perpustakaan Poliban</em>
                </h1>
                <p class="hero-sub">
                    Platform terpadu untuk pendaftaran, seleksi, dan pengelolaan kegiatan
                    magang di Perpustakaan Politeknik Negeri Banjarmasin.
                </p>
            </div>
        </div>
    </section>

    <!-- INFORMASI WEBSITE -->
    <section id="info-website">
        <div class="info-grid">
            <div class="card">
                <div class="card-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                </div>
                <h3>Informasi Website</h3>
                <p>
                    Website Penerimaan dan Pengelolaan Peserta Magang adalah platform
                    yang digunakan untuk memudahkan proses pendaftaran, seleksi, dan
                    pengelolaan data peserta magang secara terpusat. Website ini membantu
                    Admin dalam mengatur informasi peserta, memantau status magang, serta
                    meningkatkan efisiensi dan transparansi dalam pengelolaan program magang.
                </p>
            </div>

            <div class="stat-cards">
                <div class="stat-card">
                    <h4>Kuota Magang</h4>
                    <div class="stat-num">{{ $kuota }}</div>
                    <div class="stat-label">orang</div>
                    <div class="badge-kuota">Tersisa</div>
                </div>
                <div class="stat-card">
                    <h4>Peserta Aktif</h4>
                    <div class="stat-num">{{ $pesertaAktif }}</div>
                    <div class="stat-label">orang</div>
                    <div class="badge-aktif">Sedang berjalan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- DATA ALUMNI -->
    <section id="alumni" class="alumni-section">

        <h2 class="section-title">Alumni Peserta Magang</h2>
        <div class="section-divider"></div>

        <div class="alumni-card">

            @forelse($alumni as $item)
                <div class="alumni-item">
                    <div class="alumni-avatar">
                        {{ strtoupper(substr($item->nama, 0, 1)) }}
                    </div>
                    <div class="alumni-info">
                        <h4>{{ $item->nama }}</h4>
                        <p>{{ $item->sekolahKampus->nama_sekolah_kampus }}</p>
                        <span>{{ $item->jurusan->jurusan }}</span>
                    </div>
                </div>
            @empty
                <div class="empty-alumni">
                    Belum ada alumni peserta magang.
                </div>
            @endforelse

            <div class="lihat-semua">
                <button type="button" id="btnAlumni" class="btn-lihat-semua">
                    <span class="btn-text">Lihat Semua Alumni</span>
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
            </div>

            {{-- Dropdown semua alumni (expand di tempat, tanpa popup) --}}
            <div class="alumni-dropdown" id="alumniDropdown">
                @forelse($allAlumni as $item)
                    <div class="alumni-item">
                        <div class="alumni-avatar">
                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                        </div>
                        <div class="alumni-info">
                            <h4>{{ $item->nama }}</h4>
                            <p>{{ $item->sekolahKampus->nama_sekolah_kampus }}</p>
                            <span>{{ $item->jurusan->jurusan }}</span>
                        </div>
                    </div>
                @empty
                    <p style="padding:20px; text-align:center; color:#999;">Belum ada alumni lain.</p>
                @endforelse
            </div>

        </div>

    </section>

    <!-- ALUR PENDAFTARAN -->
    <section id="alur" class="alur-section">
        <h2 class="section-title">Alur Pendaftaran Magang</h2>
        <div class="section-divider"></div>

        <div class="alur-grid">
            <div class="alur-card">
                <div class="alur-num">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </div>
                <div class="alur-card-body">
                    <h4>Pendaftaran Online</h4>
                    <p>Lengkapi formulir pendaftaran dengan data diri dan unggah berkas persyaratan yang diperlukan.</p>
                </div>
            </div>

            <div class="alur-card">
                <div class="alur-num">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                    </svg>
                </div>
                <div class="alur-card-body">
                    <h4>Seleksi Berkas</h4>
                    <p>Admin perpustakaan akan meninjau kelengkapan berkas dan menentukan kelulusan seleksi administrasi.</p>
                </div>
            </div>

            <div class="alur-card">
                <div class="alur-num">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <div class="alur-card-body">
                    <h4>Konfirmasi Penerimaan</h4>
                    <p>Peserta yang diterima akan mendapatkan notifikasi dan surat balasan melalui sistem.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI -->
    <section id="informasi" class="info-section">
        <h2 class="section-title">Informasi</h2>
        <div class="section-divider"></div>

        <div class="info-cards">

            <div class="info-main-card">
                <h3>
                    <span class="info-dot"></span>
                    Visi dan Misi UPA Perpustakaan Politeknik Negeri Banjarmasin
                </h3>
                <ol>
                    <li>
                        <strong>Visi</strong><br>
                        Visi UPA Perpustakaan adalah menjadi perpustakaan yang kompeten dan berkualitas.
                    </li>
                    <li style="margin-top:10px;">
                        <strong>Misi UPA Perpustakaan yaitu:</strong>
                        <ul style="list-style:lower-alpha; padding-left:20px; margin-top:6px;">
                            <li>Mengembangkan perpustakaan yang multi akses.</li>
                            <li>Menghimpun dan mengelola sumber daya informasi terdiana bidang sains terapan.</li>
                            <li>Mengembangkan SDM yang relevan baik kuantitas dan kualitas di bidang perpustakaan.</li>
                            <li>Membangun jejaring dengan pengelola sumber-sumber informasi (networking).</li>
                            <li>Menjadi bagian Tri Dharma Perguruan Tinggi.</li>
                        </ul>
                    </li>
                </ol>
            </div>

            <div class="info-2col">
                <div class="info-main-card">
                    <h3>
                        <span class="info-dot"></span>
                        Layanan Perpustakaan
                    </h3>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <a href="https://perpustakaan.poliban.ac.id/" target="_blank"
                           style="display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--dark); font-size:0.85rem; padding:10px 14px; background:var(--cream); border-radius:10px; border:1px solid rgba(200,135,58,0.15); transition:background 0.2s;"
                           onmouseover="this.style.background='rgba(200,135,58,0.1)'"
                           onmouseout="this.style.background='var(--cream)'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#C8873A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                            </svg>
                            perpustakaan.poliban.ac.id
                        </a>
                        <a href="https://web-polibandigitallibrary.moco.co.id/login" target="_blank"
                           style="display:flex; align-items:center; gap:10px; text-decoration:none; color:var(--dark); font-size:0.85rem; padding:10px 14px; background:var(--cream); border-radius:10px; border:1px solid rgba(200,135,58,0.15); transition:background 0.2s;"
                           onmouseover="this.style.background='rgba(200,135,58,0.1)'"
                           onmouseout="this.style.background='var(--cream)'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#C8873A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                            Poliban Digital Library
                        </a>
                    </div>
                </div>

                <div class="info-main-card">
                    <h3>
                        <span class="info-dot"></span>
                        Jam Layanan Perpustakaan
                    </h3>
                    <div class="jam-row">
                        <span class="jam-day">Senin – Kamis</span>
                        <span class="jam-time">08.00 – 16.00 Wita</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Jumat</span>
                        <span class="jam-time">08.00 – 16.30 Wita</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- KONTAK -->
    <section id="kontak" class="kontak-section">
        <h2 class="section-title">Kontak Kami</h2>
        <div class="section-divider"></div>

        <div class="kontak-grid">
            <a href="https://www.instagram.com/perpustakaan_poliban/" target="_blank" class="kontak-item">
                <div class="kontak-icon instagram">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </div>
                <div class="kontak-text">
                    perpustakaan_poliban
                    <small>Instagram</small>
                </div>
            </a>

            <a href="https://web.facebook.com/perpustakaan.banjarmasin.7?locale=id_ID" target="_blank" class="kontak-item">
                <div class="kontak-icon facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                    </svg>
                </div>
                <div class="kontak-text">
                    Perpustakaan Politeknik Negeri Banjarmasin
                    <small>Facebook</small>
                </div>
            </a>

            <div class="kontak-item kontak-item-split">
                <a href="https://wa.me/6287736567651" target="_blank" class="kontak-row">
                    <div class="kontak-icon telepon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.56 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.61 5.61l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </div>
                    <div class="kontak-text">
                        0852-4860-6122
                        <small>Telepon / WhatsApp</small>
                    </div>
                </a>

                <a href="mailto:magangperpustakaanpoliban@gmail.com" class="kontak-row">
                    <div class="kontak-icon email">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <div class="kontak-text">
                        upt_perpustakaan.poliban.ac.id
                        <small>Email admin</small>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-address">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>
            Jl. Brigjen H. Hasan Basri, Kayu Tangi, Banjarmasin 70123
        </div>
        <div class="footer-copy">
            &copy; {{ date('Y') }} Perpustakaan Politeknik Negeri Banjarmasin
        </div>
    </footer>

    <script src="{{ asset('js/peserta/landing.js') }}"></script>
</body>
</html>