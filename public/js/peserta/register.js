// ── Toggle Password ──
function togglePassword(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye = document.getElementById(eyeId);
    if (input.type === 'password') {
        input.type = 'text';
        eye.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
        `;
    } else {
        input.type = 'password';
        eye.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
        `;
    }
}

// ── Validasi Tanggal & Konfirmasi ──
document.addEventListener('DOMContentLoaded', function () {
    const awal = document.getElementById('awal_magang');
    const akhir = document.getElementById('akhir_magang');
    const form = document.getElementById('formRegister');

    function tambahSatuBulan(tanggalString) {
        const [tahun, bulan, hari] = tanggalString.split('-').map(Number);
        const tanggal = new Date(tahun, bulan - 1, hari);
        tanggal.setMonth(tanggal.getMonth() + 1);
        return tanggal;
    }

    function formatTanggal(date) {
        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const dd = String(date.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    if (!awal.value) {
        akhir.disabled = true;
    } else {
        akhir.disabled = false;
        akhir.min = formatTanggal(tambahSatuBulan(awal.value));
    }

    awal.addEventListener('change', function () {
        akhir.value = '';
        if (!this.value) {
            akhir.disabled = true;
            akhir.removeAttribute('min');
            return;
        }
        akhir.disabled = false;
        const minimal = tambahSatuBulan(this.value);
        akhir.min = formatTanggal(minimal);
    });

    akhir.addEventListener('change', function () {
        if (!awal.value || !akhir.value) return;
        const minimal = tambahSatuBulan(awal.value);
        const [tahun, bulan, hari] = akhir.value.split('-').map(Number);
        const tanggalAkhir = new Date(tahun, bulan - 1, hari);
        if (tanggalAkhir < minimal) {
            Swal.fire({
                icon: 'warning',
                title: 'Tanggal tidak valid',
                text: `Tanggal akhir magang minimal ${formatTanggal(minimal)}.`
            });
            this.value = '';
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        if (awal.value && akhir.value) {
            const minimal = tambahSatuBulan(awal.value);
            const [tahun, bulan, hari] = akhir.value.split('-').map(Number);
            const tanggalAkhir = new Date(tahun, bulan - 1, hari);
            if (tanggalAkhir < minimal) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tanggal tidak valid',
                    text: `Tanggal akhir magang minimal ${formatTanggal(minimal)}.`
                });
                return;
            }
        }

        Swal.fire({
            title: 'Kirim Pendaftaran?',
            text: 'Pastikan seluruh data yang dimasukkan sudah benar.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#C8873A',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Daftar',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Mengirim...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                form.submit();
            }
        });
    });
});
