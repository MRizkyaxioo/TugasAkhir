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
