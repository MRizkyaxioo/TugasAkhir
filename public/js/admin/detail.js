// KONFIRMASI TERIMA
document.getElementById('formTerima').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Terima peserta?',
        text: 'Peserta akan diterima sebagai peserta magang.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#166534',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Terima',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});

// KONFIRMASI TOLAK
document.getElementById('formTolak').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Tolak peserta?',
        text: 'Data peserta akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#991B1B',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Tolak',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
