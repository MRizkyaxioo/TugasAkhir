document.getElementById('formSelesai').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Akhiri sesi magang?',
        text: 'Peserta akan dipindahkan ke riwayat peserta magang.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#166534',
        cancelButtonColor: '#7A6E62',
        confirmButtonText: 'Ya, Selesaikan',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
