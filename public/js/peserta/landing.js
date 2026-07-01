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


// ===== MODAL ALUMNI =====

const btnAlumni = document.getElementById('btnAlumni');
const modalAlumni = document.getElementById('modalAlumni');
const btnCloseAlumni = document.getElementById('btnCloseAlumni');
const modalBackdrop = document.getElementById('modalBackdrop');

if(btnAlumni){

    btnAlumni.addEventListener('click', () => {

        modalAlumni.classList.add('show');
        document.body.style.overflow = 'hidden';

    });

    function closeAlumni(){

        modalAlumni.classList.remove('show');
        document.body.style.overflow = '';

    }

    btnCloseAlumni.addEventListener('click', closeAlumni);
    modalBackdrop.addEventListener('click', closeAlumni);

    document.addEventListener('keydown', function(e){

        if(e.key === 'Escape'){
            closeAlumni();
        }

    });

}
