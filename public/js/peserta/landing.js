const btnHamburger = document.getElementById('btnHamburger');
const btnCloseMenu = document.getElementById('btnCloseMenu');
const menuOverlay  = document.getElementById('menuOverlay');
const mobileMenu   = document.getElementById('mobileMenu');
const menuLinks    = document.querySelectorAll('.menu-link');

function openMenu() {
    mobileMenu.classList.add('is-open');
    btnHamburger.classList.add('is-open');
    document.body.style.overflow = 'hidden';
}

function closeMenu() {
    mobileMenu.classList.remove('is-open');
    btnHamburger.classList.remove('is-open');
    document.body.style.overflow = '';
}

btnHamburger.addEventListener('click', openMenu);
btnCloseMenu.addEventListener('click', closeMenu);
menuOverlay.addEventListener('click', closeMenu);

// Tutup menu otomatis saat link diklik
menuLinks.forEach(link => {
    link.addEventListener('click', closeMenu);
});


// ===== ALUMNI DROPDOWN (ganti modal) =====
// Ganti seluruh blok "MODAL ALUMNI" di landing.js dengan kode ini

const btnAlumni     = document.getElementById('btnAlumni');
const alumniDropdown = document.getElementById('alumniDropdown');

if (btnAlumni && alumniDropdown) {

    btnAlumni.addEventListener('click', function () {

        const isOpen = alumniDropdown.classList.contains('is-open');

        if (isOpen) {
            // Tutup
            alumniDropdown.classList.remove('is-open');
            btnAlumni.classList.remove('is-open');
            btnAlumni.querySelector('.btn-text').textContent = 'Lihat Semua Alumni';
        } else {
            // Buka
            alumniDropdown.classList.add('is-open');
            btnAlumni.classList.add('is-open');
            btnAlumni.querySelector('.btn-text').textContent = 'Sembunyikan Alumni';

            // Scroll smooth ke dropdown setelah animasi sedikit berjalan
            setTimeout(() => {
                alumniDropdown.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 100);
        }

    });

}
