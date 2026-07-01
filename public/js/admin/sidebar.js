document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebarAdmin');
    const overlay = document.getElementById('sidebarOverlay');
    const btnHamburger = document.getElementById('btnHamburger');

    if (!sidebar || !overlay || !btnHamburger) return;

    function openSidebar() {
        sidebar.classList.add('is-open');
        overlay.classList.add('is-open');
    }

    function closeSidebar() {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-open');
    }

    btnHamburger.addEventListener('click', function () {
        sidebar.classList.contains('is-open') ? closeSidebar() : openSidebar();
    });

    overlay.addEventListener('click', closeSidebar);

    // Tutup sidebar otomatis saat layar kembali besar (desktop)
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) closeSidebar();
    });
});